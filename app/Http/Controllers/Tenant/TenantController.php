<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Priority;
use File;
use Illuminate\Support\Facades\Auth;
use App\Tenant;
use App\TenantUser;
use Illuminate\Support\Facades\DB;
use App\Pengumuman;
use App\User;
use App\RoleUser;
use App\ProfilUser;
use Session;

use Spatie\QueryBuilder\QueryBuilder;


class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(request()->has('filter')){
            if(array_key_exists('between', $request->filter)){
                $test = request()->filter['between'];
                $exp = explode(',', $test);
            }else{
                $exp = null;
            }

            if(array_key_exists('title', $request->filter)){
                $title = request()->filter['title'];
            }else{
                $title = null;
            }
        }else{
            $exp = null;
            $title = null;
        }

		// //$data['data']=Tenant::where('inkubator_id',Auth::user()->inkubator_id)->leftJoin('tenant_user',['tenant.id'=>'tenant_user.tenant_id'])->leftJoin('tenant_mentor',['tenant.id'=>'tenant_mentor.tenant_id'])->select('tenant.*','tenant_user.user_id as personil','tenant_mentor.user_id as mentor')->get();
        $data = QueryBuilder::for(Tenant::class)
        ->leftJoin('priority',['tenant.priority'=>'priority.id'])
        ->select('tenant.*', 'priority.name')
        ->allowedFilters(['title', 'description','priority'])
        ->get();

        $user = Tenant::where('inkubator_id',Auth::user()->inkubator_id)
        ->leftJoin('tenant_user',['tenant.id'=>'tenant_user.tenant_id'])
        ->Join('profil_user',['profil_user.user_id'=>'tenant_user.user_id'])
        ->select('profil_user.*', 'tenant_user.tenant_id')
        ->get();

        $priority = DB::table('priority')->get();

        $mentor = QueryBuilder::for(Tenant::class)
        ->leftJoin('priority',['tenant.priority'=>'priority.id'])
        ->leftJoin('tenant_mentor',['tenant.id'=>'tenant_mentor.tenant_id'])
        ->leftJoin('profil_user',['profil_user.user_id'=>'tenant_mentor.user_id'])
        ->select('tenant_mentor.*', 'tenant.*', 'profil_user.*')
        ->get();
        
        $this->data['data'] = $data;
        $this->data['user'] = $user;
        $this->data['mentor'] = $mentor;
        $this->data['priority'] = $priority;
        $this->data['title'] = $title;
        $this->data['exp'] = $exp;
        
        // return response()->json($this->data);

		return view('tenant.index',$this->data);
    }

    public function priority(Request $request){

        $keyword = $request->get('priority');

        return "berhasil";

    }
	
	public function detail($kategori,$id)
    {
        $tenant = Tenant::findOrFail($id);

        // return response()->json($tenant);

        $this->data['tenant'] = $tenant;


        return view('tenant.'.$kategori, $this->data);
    }
	

    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('inkubator_id', Auth::user()->inkubator_id)->where(function ($query) {
            $query->where('publish', 1);
        })->get();
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        return view('tenant.pengumuman', compact('pengumuman', 'kategori', 'inkubator'));
    }

    public function tenant()
    {

        $pengumuman = Pengumuman::where([['author_id', Auth::user()->id], ['inkubator_id', 0]])->get();
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        return view('tenant.pengumuman', compact('pengumuman', 'kategori', 'inkubator'));
    }

    public function show($slug)
    {
        $pengumuman = DB::table('pengumuman')->where('slug', $slug)->get();
        return view('tenant.detail', ['pengumuman' => $pengumuman]);
    }

    public function kategori($id)
    {
        $pengumuman = Pengumuman::where([['priority_id', $id], ['inkubator_id', \Auth::user()->inkubator_id],['publish', 1]])->latest()->get();
        $kategori = DB::table('priority')->get();
        return view('tenant.pengumuman', compact('pengumuman', 'kategori'));

    }

    public function search(Request $request)
    {

        $keyword = $request->get('keyword');


        if ($keyword) {
            $pengumuman = pengumuman::where([['title', 'like', '%' . $keyword . '%'], ['inkubator_id', \Auth::user()->inkubator_id], ['publish', 1]])->get();
        } else {
            return redirect('tenant/pengumuman');
        }

        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        return view('tenant.pengumuman', compact('pengumuman', 'kategori', 'inkubator', 'keyword'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = $request->all();

        $user = new User;
        $user->name = $data['name'];
        $user->inkubator_id = Auth::user()->inkubator_id;
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        $roleuser = new RoleUser;
        $roleuser->user_id = $user->id;
        $roleuser->role_id = 6;
        $roleuser->save();

        if ($roleuser) {
            Session::flash('success', 'User berhasil di simpan');
        } else {
            Session::flash('error', 'User Gagal di simpan');
        }

        return redirect('inkubator/tenant');

    }

    public function profil(Request $request)
    {
        $check = TenantUser::where('user_id',Auth::user()->id)->get();

        if( count($check) == 0) {
            
            if ($request->has('file')) {
                $dokumen = $request->file('file');
                $name = time();
                $fileName = $name . '_' . $dokumen->getClientOriginalName();
    
                $folder = 'img/tenant';
                // $filePath = $dokumen->storeAs( $fileName, 'public');
                $filePath = $dokumen->move($folder, $fileName, 'public');
    
                $data = $request->all();
    
                $tenantuser = new Tenant;
                $tenantuser->title = $data['title'];
                $tenantuser->inkubator_id = Auth::user()->inkubator_id;
                $tenantuser->subtitle = $data['subtitle'];
                $tenantuser->description = $data['deskripsi'];
                $tenantuser->priority = $data['priority'];
                $tenantuser->bidang_usaha = $data['bidang'];
                $tenantuser->tanggal_berdiri = $data['tanggalberdiri'];
                $tenantuser->visi = $data['visi'];
                $tenantuser->misi = $data['misi'];
                $tenantuser->slogan = $data['slogan'];
                $tenantuser->alamat = $data['alamat'];
                $tenantuser->kontak = $data['kontak'];
                $tenantuser->jam_operasional = $data['operasional'];
                $tenantuser->foto = $fileName;
                $tenantuser->created_at = date('Y-m-d H:i:s');
                $tenantuser->updated_at = date('Y-m-d H:i:s');
                $tenantuser->save();
    
                DB::table('tenant_user')->insert([
                    'user_id' => Auth::user()->id,
                    'tenant_id' => $tenantuser->id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
                
    
                if ($filePath) {
                    Session::flash('success', 'Profil berhasil disimpan');
                } else {
                    Session::flash('error', 'Profil Gagal disimpan');
                }
    
                return redirect('/tenant');
    
            }
        }else{

            return "Data sudah ada";
        }

        
    }

    public function editprofil($id)
    {
        $tenant = Tenant::findOrFail($id);
        $priority = Priority::all();

        $select = Priority::find( $tenant->priority);

        $check = TenantUser::where('Tenant_user.user_id',Auth::user()->id)
        ->leftJoin('users',['users.id'=>'tenant_user.user_id'])
        ->get();

        $this->data['tenant']= $tenant;
        $this->data['priority']= $priority;
        $this->data['select']= $select;
        $this->data['check']= $check;

        foreach($check as $ck){

            if($ck->tenant_id == $id){

                return view('tenant/editprofil', $this->data);
            }else{
                return redirect('/tenant')->with(Session::flash('success', 'Profil berhasil di update'));
            }

        }
        // return response()->json($check);
        
        // return view('tenant/editprofil', $this->data);
        
    }

    Public function updateprofil(Request $request, $id)
    {

        $tenant = Tenant::find($id);

        $fileName = $tenant->foto;

        if ($request->has('file')) {
           $file = $request->file('file');
           $fileName = time(). '_'. $file->getClientOriginalName();

           $file->move('img/tenant', $fileName);
           File::delete('img/tenant'. $tenant->foto);
        }
        Tenant::where( 'id', $tenant->id )
        ->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' =>$request->deskripsi,
            'priority' =>$request->priority,
            'bidang_usaha' =>$request->bidang,
            'tanggal_berdiri' =>$request->tanggalberdiri,
            'visi' =>$request->visi,
            'misi' =>$request->misi,
            'slogan' =>$request->slogan,
            'alamat' =>$request->alamat,
            'kontak' =>$request->kontak,
            'jam_operasional' =>$request->operasional,
            'foto' => $fileName,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        if ($fileName) {
            Session::flash('success', 'Profil berhasil di update');
        } else {
            Session::flash('error', 'Profil Gagal di update');
        }

        return redirect('/tenant');

    }

    public function createuser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $data = $request->all();

        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time(). '_'. $file->getClientOriginalName();
 
            $file->move('theme/images/faces', $fileName);
         }

        $tenant = TenantUser::where('user_id', Auth::user()->id)->get();

        foreach( $tenant as $tenant){
            $tenantid = $tenant->tenant_id;
        }


        $user = new User;
        $user->name = $data['name'];
        $user->inkubator_id = Auth::user()->inkubator_id;
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        $roleuser = new RoleUser;
        $roleuser->user_id = $user->id;
        $roleuser->role_id = 2;
        $roleuser->save();
        
        $tenanuser = new TenantUser;
        $tenanuser->user_id = $user->id;
        $tenanuser->tenant_id = $tenantid;
        $tenanuser->save();

        $profiluser = new ProfilUser;
        $profiluser->user_id = $user->id;
        $profiluser->nama = $data['nama'];
        $profiluser->kontak = $data['kontak'];
        $profiluser->alamat = $data['alamat'];
        $profiluser->nik = $data['nik'];
        $profiluser->deskripsi = $data['deskripsi'];
        $profiluser->foto = $fileName;
        $profiluser->jenkel = $data['jenkel'];
        $profiluser->save();

        // $this->data['data']= $data;
        // $this->data['fileName']= $fileName;

        if ($fileName) {
            Session::flash('success', 'User berhasil di simpan');
        } else {
            Session::flash('error', 'User Gagal di simpan');
        }

        // return response()->json($this->data);
        return redirect('/tenant');
    }

    public function detailtenant()
    {
        
        $detailtenant = TenantUser::where('user_id', Auth::user()->id)
        ->leftJoin('tenant',['tenant.id'=>'tenant_user.tenant_id'])
        ->get();

        foreach($detailtenant as $dt){
          $data = $dt;
        }
        $label = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        // DATA TABLE ARUS KAS
        $users = DB::table('users')->get();
        // Menampilkan Data Tenant
        $tenant = DB::table('tenant_user')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->join('tenant', 'tenant_user.tenant_id', '=', 'tenant.id')            
            ->select('users.id', 'tenant_user.*', 'tenant.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->get();
        // Menampilkan Data Arus Kas Keuangan Pada Bagian Table
        $keuangan = DB::table('tenant_user')
            ->join('arus_kas', 'tenant_user.tenant_id', '=', 'arus_kas.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select('users.id', 'tenant_user.user_id', 'arus_kas.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', date('m'))
            ->get();

        // Menampilkan Data Arus Kas Keuangan Pada Bagian Grafik
        $categories = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        for($bulan=1;$bulan < 13;$bulan++){
        
        // Menampilkan Data Keuangan Pada Bagian Grafik Masuk
        $masuk = DB::table('tenant_user')
            ->join('arus_kas', 'tenant_user.tenant_id', '=', 'arus_kas.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select(DB::raw("SUM(IF(jenis='1', jumlah, 0)) AS totalMasuk"))
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', '=', $bulan)
            ->first();
            $arusMasuk[] = $masuk->totalMasuk;

        // Menampilkan Data Keuangan Pada Bagian Grafik Keluar
        $keluar = DB::table('tenant_user')
            ->join('arus_kas', 'tenant_user.tenant_id', '=', 'arus_kas.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select(DB::raw("SUM(IF(jenis='0', jumlah, 0)) AS totalKeluar"))
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', '=', $bulan)
            ->first();
            $arusKeluar[] = $keluar->totalKeluar;
        }
                
        // Relasi antara Tenant dengan User
        $user = User::where('users.id', Auth::user()->id)
            ->join('tenant_user', 'users.id', '=', 'tenant_user.user_id')
            ->select('users.*', 'tenant_user.*')
            ->get();

        // Menghitung Totalan Arus Kas Pada Bagian Table
        $total_masuk = 0;
        $total_keluar = 0;

        foreach ($keuangan as $row) {
            if ($row->jenis == '1')
                $total_masuk = $total_masuk + $row->jumlah;

            elseif ($row->jenis == '0')
                $total_keluar = $total_keluar + $row->jumlah;
        }

        $total = $total_masuk - $total_keluar;

        // DATA TABLE LABA RUGI
        // Menampilkan Data Laba Rugi Keuangan Pada Bagian Table
        $labaRugi = DB::table('tenant_user')
            ->join('laba_rugi', 'tenant_user.tenant_id', '=', 'laba_rugi.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select('users.id', 'tenant_user.user_id', 'laba_rugi.*')
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereMonth('tanggal', date('m'))
            ->get();

        // Menampilkan Data Laba Rugi Keuangan Pada Bagian Grafik
        $grafikLaba = DB::table('tenant_user')
            ->join('laba_rugi', 'tenant_user.tenant_id', '=', 'laba_rugi.tenant_id')
            ->join('users', 'tenant_user.user_id', '=', 'users.id')
            ->select(DB::raw("(SUM(jumlah)) as count"))
            ->where([
                ['user_id', \Auth::user()->id]
            ])
            ->whereYear('tanggal', date('Y'))
            ->groupBy(DB::raw("Month(tanggal)", "asc"))
            ->pluck('count');
            
        // Relasi antara Tenant dengan User
        $userId = User::where('users.id', Auth::user()->id)
            ->join('tenant_user', 'users.id', '=', 'tenant_user.user_id')
            ->select('users.*', 'tenant_user.*')
            ->get();

        // Menghitung Totalan Laba Rugi Pada Bagian Table
        $masuk_labaRugi = 0;
        $keluar_labaRugi = 0;

        foreach ($labaRugi as $row) {
            if ($row->jenis == '1')
                $masuk_labaRugi = $masuk_labaRugi + $row->jumlah;

            elseif ($row->jenis == '0')
                $keluar_labaRugi = $keluar_labaRugi + $row->jumlah;
        }

        $totalLaba = $masuk_labaRugi - $keluar_labaRugi;
        // return response()->json($data);

        $this->data['data']= $data;
        
        return view ('tenant.detailtenant',compact('keuangan','arusMasuk','arusKeluar','categories','total','total_masuk','total_keluar','user','grafikLaba','labaRugi','totalLaba','masuk_labaRugi','keluar_labaRugi','label','userId','tenant'), $this->data);

    }
}
