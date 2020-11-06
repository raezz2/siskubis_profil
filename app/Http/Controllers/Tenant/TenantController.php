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
use App\TenantGallery;
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

        $tenantuser = TenantUser::where('tenant_id', $id)
        ->leftJoin('profil_user',['profil_user.user_id'=>'tenant_user.user_id'])
        ->get();

        $gallery = TenantGallery::where('tenant_id', $id)->paginate(6);

        
        $this->data['tenant'] = $tenant;
        $this->data['tenantuser'] = $tenantuser;
        $this->data['gallery'] = $gallery;
        
        return response()->json($tenantuser);

        // return view('tenant.'.$kategori, $this->data);
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
                $tenantuser->website = $data['website'];
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
            'website' =>$request->website,
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


    public function detailtenant()
    {
        
        $detailtenant = TenantUser::where('user_id', Auth::user()->id)
        ->leftJoin('tenant',['tenant.id'=>'tenant_user.tenant_id'])
        ->get();

        $check = TenantUser::where('user_id',Auth::user()->id)->get();

        if(count($check) > 0){

            foreach( $check as $ck){
                
                $profil= TenantUser::where('tenant_id', $ck->tenant_id )
                ->Join('profil_user', ['profil_user.user_id'=>'tenant_user.user_id'])
                ->get();

                $this->data['profil']= $profil;
    
            }
        }
        
        $priority = Priority::all();
        
        if( count($detailtenant) > 0){
            foreach($detailtenant as $dt){
                $data = $dt;
            }
            
            $gallery = TenantGallery::where('tenant_id', $dt->tenant_id)->paginate(6);

            $this->data['data']= $data;
            $this->data['gallery']= $gallery;
        }
        
        // return response()->json($detailtenant);

        $this->data['priority']= $priority;
        $this->data['check']= $check;
        
        return view ('tenant.detailtenant', $this->data);

    }


}
