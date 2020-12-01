<?php

namespace App\Http\Controllers\Produk;


use Auth;
use File;
use Image;
use App\User;
use App\Produk;
use App\ProdukBisnis;
use App\ProdukCanvas;
use App\ProdukIjin;
use App\ProdukImage;
use App\ProdukKI;
use App\ProdukRiset;
use App\ProdukSertifikasi;
use App\ProdukTeam;
use App\Tenant;
use App\Priority;
use App\Inkubator;
use App\ProfilUser;
use App\TenantUser;
use App\profil_user;
use App\TenantMentor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\{QueryBuilder, AllowedFilter};

class ProdukController extends Controller
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
        $priority = Priority::orderBy('name', 'ASC')->get();

        if(request()->has('filter')){
            if(array_key_exists('title', $request->filter)){
                $title = request()->filter['title'];
            }else{
                $title = null;
            }
        }else{
            $title = null;
        }

        if ( $request->user()->hasRole('inkubator') ) {
            $ink = Tenant::where('inkubator_id', $request->user()->inkubator_id)->get('id');
            $produk = QueryBuilder::for(Produk::class)
                ->allowedFilters([
                    AllowedFilter::partial('title'),
                    AllowedFilter::exact('priority', 'priority_id'),
                ])
                ->with('tenant','priority','produk_image')
                ->whereIn('tenant_id', $ink )
                ->paginate(12);
        }elseif($request->user()->hasRole('mentor')){
            $mentor = TenantMentor::where('user_id', $request->user()->id)->get('id');
            $produk = QueryBuilder::for(Produk::class)
                ->allowedFilters([
                    AllowedFilter::partial('title'),
                    AllowedFilter::exact('priority', 'priority_id'),
                ])
                ->whereIn('tenant_id', $mentor)
                ->paginate(12);
        }elseif($request->user()->hasRole('tenant')){
            $tenant = TenantUser::where('user_id', $request->user()->id)->first();
            $produk = QueryBuilder::for(Produk::class)
                ->allowedFilters([
                    AllowedFilter::partial('title'),
                    AllowedFilter::exact('priority', 'priority_id'),
                ])
                ->where('tenant_id', $tenant->tenant_id)
                ->paginate(12);
        }
        return view('produk.index', compact('produk','priority','title'));
    }

    public function show($id)
    {
        $produk         = Produk::find($id);
        $produk         = Produk::with(['tenant','priority','produk_bisnis','produk_canvas','produk_ijin','produk_image','produk_ki','produk_riset','produk_sertifikasi'])->where('id', $id)->first();
        $image          = ProdukImage::where('produk_id',$id)->get();
        $produk_team    = ProdukTeam::with('profil_user.user')->where('produk_id', $id)->get();
        $tag            = explode(',',$produk->tag);
        $spesifikasi    = explode(';',$produk->spesifikasi);
        $manfaat        = explode(';',$produk->manfaat);
        $keunggulan     = explode(';',$produk->keunggulan);
        $produksi_harga = explode(';',$produk->produk_bisnis->produksi_harga);

        return view('produk.detailProduk', compact('produk','produk_team','image','tag','spesifikasi','manfaat','keunggulan','produksi_harga'));
    }

    public function create()
    {

        $tenant = TenantUser::where('user_id', request()->user()->id)->first();

        $user_id = TenantUser::where('tenant_id', $tenant->tenant_id)
            ->join('profil_user',['tenant_user.user_id' =>  'profil_user.user_id'])
            ->select('profil_user.*')
            ->get();
        $tenant = Tenant::orderBy('title')->get();

        return view('produk.formTambah', compact('user_id', 'tenant'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title_produk'                 => 'required',
            'subtitle_produk'              => 'required',
            'harga_pokok_produk'           => 'required|numeric',
            'harga_jual_produk'            => 'required|numeric',
            'kategori_produk'              => 'required',
            'tag_produk'                   => 'required',
            'location_produk'              => 'required',
            'address_produk'               => 'required',
            'contact_produk'               => 'required|numeric',

            'tentang_produk_produk'        => 'required',
            'latar_produk_produk'          => 'required',
            'keterbaharuan_produk'         => 'required',
            'spesifikasi_produk'           => 'required',
            'manfaat_produk'               => 'required',
            'keunggulan_produk'            => 'required',
            'teknologi_produk'             => 'required',
            'pengembangan_produk'          => 'required',
            'proposal_produk'              => 'required|file',

            'kompetitor_bisnis'            => 'required',
            'target_pasar_bisnis'          => 'required',
            'dampak_sosek_bisnis'          => 'required',
            'produksi_harga_bisnis'        => 'required',
            'pemasaran_bisnis'             => 'required',

            'canvas_canvas'                => 'required',
            'kategori_canvas'              => 'required',
            'tanggal_canvas'               => 'required|date',

            'jenis_ijin'                   => 'required',
            'pemberi_ijin'                 => 'required',
            'status_ijin'                  => 'required',
            'tahun_ijin'                   => 'required|numeric',
            'tanggal_ijin'                 => 'required|date',
            'dokumen_ijin'                 => 'required|file',

            'foto_image'                   => 'required|image|mimes:jpg,png,jpeg',
            'caption_image'                => 'required',

            'jenis_ki'                     => 'required',
            'status_ki'                    => 'required',
            'permohonan_ki'                => 'required',
            'sertifikat_ki'                => 'required',
            'berlaku_mulai_ki'             => 'required|date',
            'berlaku_sampai_ki'            => 'required|date',
            'pemilik_ki'                   => 'required',

            'nama_riset'                   => 'required',
            'pelaksana_riset'              => 'required',
            'tahun_riset'                  => 'required|numeric',
            'pendanaan_riset'              => 'required',
            'skema_riset'                  => 'required',
            'nilai_riset'                  => 'required',
            'aktifitas_riset'              => 'required',
            'tujuan_riset'                 => 'required',
            'hasil_riset'                  => 'required',

            'jenis_sertifikasi'            => 'required',
            'pemberi_sertifikasi'          => 'required',
            'tanggal_sertifikasi'          => 'required|date',
            'tahun_sertifikasi'            => 'required|numeric',
            'dokumen_sertifikasi'          => 'required|file',
            'status_sertifikasi'           => 'required',
        ]);
        DB::transaction(function () use ($request) {
            $tenant = TenantUser::with('tenants')->where('user_id', $request->user()->id)->first();
            $tenant_id = $tenant->tenant_id;
            $priority_tenant=$tenant->tenants->priority;

            $file = $request->file('proposal_produk');
            $dokumen_file_proposal = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/produk/',$dokumen_file_proposal);

            $file = $request->file('dokumen_sertifikasi');
            $dokumen_file_sertifikasi = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/sertifikasi/',$dokumen_file_sertifikasi);

            $file = $request->file('dokumen_ijin');
            $dokumen_file_ijin = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/ijin/',$dokumen_file_ijin);

            $file = $request->file('sertifikat_ki');
            $dokumen_file_ki = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/ki/',$dokumen_file_ki);


            $string = implode(",", $request->tag);
            $produk = Produk::create([
                'tenant_id'             => $tenant_id,
                'inventor_id'           => 0,
                'priority_id'           => $priority_tenant,
                'title'                 => $request->title_produk,
                'subtitle'              => $request->subtitle_produk,
                'harga_pokok'           => $request->harga_pokok_produk,
                'harga_jual'            => $request->harga_jual_produk,
                'kategori_id'           => $request->kategori_id_produk,
                'tag'                   => $string,
                'location'              => $request->location_produk,
                'address'               => $request->address_produk,
                'contact'               => $request->contact_produk,
                'tentang'               => $request->tentang_produk,
                'latar'                 => $request->latar_produk,
                'keterbaharuan'         => $request->keterbaharuan_produk,
                'spesifikasi'           => $request->spesifikasi_produk,
                'manfaat'               => $request->manfaat_produk,
                'keunggulan'            => $request->keunggulan_produk,
                'teknologi'             => $request->teknologi_produk,
                'pengembangan'          => $request->pengembangan_produk,
                'proposal'              => $dokumen_file_proposal,
            ]);

            $produk->produk_bisnis()->create([
                'kompetitor'            => $request->kompetitor_bisnis,
                'target_pasar'          => $request->target_pasar_bisnis,
                'dampak_sosek'          => $request->dampak_sosek_bisnis,
                'produksi_harga'        => $request->produksi_harga_bisnis,
                'pemasaran'             => $request->pemasaran_bisnis,
            ]);

            $produk->produk_canvas()->create([
                'canvas'                => $request->canvas_canvas,
                'kategori'              => $request->kategori_canvas,
                'tanggal'               => $request->tanggal_canvas,
            ]);

            $produk->produk_ki()->create([
                'jenis_ki'              => $request->jenis_ki,
                'status_ki'             => $request->status_ki,
                'permohonan'            => $request->permohonan_ki,
                'sertifikat'            => $dokumen_file_ki,
                'berlaku_mulai'         => $request->berlaku_mulai_ki,
                'berlaku_sampai'        => $request->berlaku_sampai_ki,
                'pemilik_ki'            => $request->pemilik_ki,
            ]);

            $produk->produk_riset()->create([
                'nama_riset'            => $request->nama_riset,
                'pelaksana'             => $request->pelaksana_riset,
                'tahun'                 => $request->tahun_riset,
                'pendanaan'             => $request->pendanaan_riset,
                'skema'                 => $request->skema_riset,
                'nilai'                 => $request->nilai_riset,
                'aktifitas'             => $request->aktifitas_riset,
                'tujuan'                => $request->tujuan_riset,
                'hasil'                 => $request->hasil_riset,
            ]);

            $produk->produk_sertifikasi()->create([
                'jenis_sertif'          => $request->jenis_sertifikasi,
                'pemberi_sertif'        => $request->pemberi_sertifikasi,
                'status'                => $request->status_sertifikasi,
                'tahun'                 => $request->tahun_sertifikasi,
                'tanggal'               => $request->tanggal_sertifikasi,
                'dokumen'               => $dokumen_file_sertifikasi,
            ]);

            $produk->produk_ijin()->create([
                'jenis_ijin'            => $request->jenis_ijin,
                'pemberi'               => $request->pemberi_ijin,
                'status'                => $request->status_ijin,
                'tahun'                 => $request->tahun_ijin,
                'tanggal'               => $request->tanggal_ijin,
                'dokumen'               => $dokumen_file_ijin,
            ]);

            $images = $request->foto_image;
            $image_files = $request->file('foto_image');
            for ($i=0; $i < count($images); $i++) {
                $captions = $request->caption_image;
                $filename = time() . Str::slug($request->title_produk). $i .'.' . $image_files[$i]->getClientOriginalExtension();
                $image_resize = Image::make($image_files[$i]->getRealPath());
                $image_resize->resize(900,585);
                $image_resize->save(public_path('img/produk/'.$filename));
                $data = array(
                    'produk_id' =>  $produk->id,
                    'image'     =>  $filename,
                    'judul'     =>  $request->title_produk,
                    'caption'   =>  $captions[$i],
                );
                $image_data[]  = $data;
            }
            ProdukImage::insert($image_data);

            $user_id = $request->user_id_team;
            $jabatan = $request->jabatan_team;
            $divisi = $request->divisi_team;
            $tugas = $request->tugas_team;
            for($count = 0; $count < count($user_id); $count++)
            {
                $data = array(
                    'produk_id' => $produk->id,
                    'user_id'   => $user_id[$count],
                    'jabatan'   => $jabatan[$count],
                    'divisi'    => $divisi[$count],
                    'tugas'     => $tugas[$count]
                );
                $insert_data[] = $data;
            }


            ProdukTeam::insert($insert_data);
        });
            
        $notification = array(
            'message' => 'Produk Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect(route('tenant.produk'))->with($notification);

    }

    public function destroy($id)
    {
        // $produk = Produk::find($id);
        // File::delete('file/produk/produk' . $produk->proposal);
        // $produk->delete();

        // $produk_bisnis = ProdukBisnis::where('produk_id', $id)->first();
        // $produk_bisnis->delete();

        // $produk_canvas = ProdukCanvas::where('produk_id', $id)->first();
        // $produk_canvas->delete();

        // $produk_ijin = ProdukIjin::where('produk_id', $id)->first();
        // File::delete('file/produk/ijin' . $produk_ijin->dokumen);
        // $produk_ijin->delete();

        // $image          = ProdukImage::where('produk_id',$id)->get();
        //     foreach ($image as $row){
        //         File::delete('img/produk' . $row->image);
        //     }
        // $image->delete();

        // $produk_ki = ProdukKI::where('produk_id', $id)->first();
        // File::delete('file/produk/ki' . $produk_ki->sertifikat);
        // $produk_ki->delete();

        // $produk_riset = ProdukRiset::where('produk_id', $id)->first();
        // $produk_riset->delete();

        // $produk_sertifikasi = ProdukSertifikasi::where('produk_id', $id)->first();
        // File::delete('file/produk/sertifiksi' . $produk_sertifikasi->dokumen);
        // $produk_sertifikasi->delete();

        // $produk_team = ProdukTeam::where('produk_id', $id)->get();
        // $produk_team->delete();

        $produk = Produk::with('produk_ijin','produk_ki','produk_sertifikasi')->where('id', $id)->first();
        File::delete('file/produk/produk' . $produk->proposal);
        $ijin = $produk->produk_ijin->dokumen;
        File::delete('file/produk/ijin' . $ijin);
        $ki = $produk->produk_ki->sertifikat;
        File::delete('file/produk/ki' . $ki);
        $sertif = $produk->produk_sertifikasi->dokumen;
        File::delete('file/produk/sertifikasi' . $sertif);

        $image          = ProdukImage::where('produk_id',$id)->get();
            foreach ($image as $row){
                File::delete('img/produk' . $row);
            }

        $produk_bisnis = ProdukBisnis::where('produk_id', $id)->delete();
        $produk_canvas = ProdukCanvas::where('produk_id', $id)->delete();
        $produk_ijin = ProdukIjin::where('produk_id', $id)->delete();
        $produk_image = ProdukImage::where('produk_id', $id)->delete();
        $produk_ki = ProdukKI::where('produk_id', $id)->delete();
        $produk_riset = ProdukRiset::where('produk_id', $id)->delete();
        $produk_sertifikasi = ProdukSertifikasi::where('produk_id', $id)->delete();
        $produk_team = ProdukTeam::where('produk_id', $id)->delete();
        $produk = Produk::where('id', $id)->delete();

        $notification = array(
            'message' => 'Produk Berhasil Dihapus!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        //$produk = Produk::find($id);
        $produk         = Produk::with(['tenant','priority','produk_bisnis','produk_canvas','produk_ijin','produk_image','produk_ki','produk_riset','produk_sertifikasi'])->where('id', $id)->first();
        $image          = ProdukImage::where('produk_id',$id)->get();
        $tenant = TenantUser::where('user_id', request()->user()->id)->first();
        $user_id = TenantUser::where('tenant_id', $tenant->tenant_id)
            ->join('profil_user',['tenant_user.user_id' =>  'profil_user.user_id'])
            ->select('profil_user.*')
            ->get();

        $produk_team    = ProdukTeam::with('profil_user.user')->where('produk_id', $id)->get();
        
        return view('produk.formEdit', compact('produk','user_id','image','produk_team'));
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title_produk'                 => 'required',
            'subtitle_produk'              => 'required',
            'harga_pokok_produk'           => 'required|numeric',
            'harga_jual_produk'            => 'required|numeric',
            'kategori_produk'              => 'required',
            'tag_produk'                   => 'required',
            'location_produk'              => 'required',
            'address_produk'               => 'required',
            'contact_produk'               => 'required|numeric',

            'tentang_produk_produk'        => 'required',
            'latar_produk_produk'          => 'required',
            'keterbaharuan_produk'         => 'required',
            'spesifikasi_produk'           => 'required',
            'manfaat_produk'               => 'required',
            'keunggulan_produk'            => 'required',
            'teknologi_produk'             => 'required',
            'pengembangan_produk'          => 'required',
            'proposal_produk'              => 'nullable',

            'kompetitor_bisnis'            => 'required',
            'target_pasar_bisnis'          => 'required',
            'dampak_sosek_bisnis'          => 'required',
            'produksi_harga_bisnis'        => 'required',
            'pemasaran_bisnis'             => 'required',

            'canvas_canvas'                => 'required',
            'kategori_canvas'              => 'required',
            'tanggal_canvas'               => 'required|date',

            'jenis_ijin'                   => 'required',
            'pemberi_ijin'                 => 'required',
            'status_ijin'                  => 'required',
            'tahun_ijin'                   => 'required|numeric',
            'tanggal_ijin'                 => 'required|date',
            'dokumen_ijin'                 => 'nullable',

            'foto_image'                   => 'nullable|image|mimes:jpg,png,jpeg',
            'caption_image'                => 'nullable',

            'jenis_ki'                     => 'required',
            'status_ki'                    => 'required',
            'permohonan_ki'                => 'required',
            'sertifikat_ki'                => 'nullable',
            'berlaku_mulai_ki'             => 'required|date',
            'berlaku_sampai_ki'            => 'required|date',
            'pemilik_ki'                   => 'required',

            'nama_riset'                   => 'required',
            'pelaksana_riset'              => 'required',
            'tahun_riset'                  => 'required|numeric',
            'pendanaan_riset'              => 'required',
            'skema_riset'                  => 'required',
            'nilai_riset'                  => 'required',
            'aktifitas_riset'              => 'required',
            'tujuan_riset'                 => 'required',
            'hasil_riset'                  => 'required',

            'jenis_sertifikasi'            => 'required',
            'pemberi_sertifikasi'          => 'required',
            'tanggal_sertifikasi'          => 'required|date',
            'tahun_sertifikasi'            => 'required|numeric',
            'dokumen_sertifikasi'          => 'nullable',
            'status_sertifikasi'           => 'required',
        ]);

        $tenant = TenantUser::with('tenants')->where('user_id', $request->user()->id)->first();
        $tenant_id=$tenant->tenant_id;
        $priority_tenant=$tenant->tenants->priority;

        $produk = Produk::find($id);
        $produks = Produk::with(['tenant','priority','produk_bisnis','produk_canvas','produk_ijin','produk_image','produk_ki','produk_riset','produk_sertifikasi'])->where('id', $id)->first();
        $images = ProdukImage::where('produk_id', $id)->get();
        $id = $produk->id;
        $dokumen_file_proposal = $produk->proposal;
        $dokumen_file_ijin = $produk->produk_ijin->dokumen;
        $dokumen_file_ki = $produk->produk_ki->sertifikat;
        $dokumen_file_sertifikasi = $produk->produk_sertifikasi->dokumen;

        if ($request->hasFile('proposal_produk')) {
            $file = $request->file('proposal_produk');
            $dokumen_file_proposal = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/produk/',$dokumen_file_proposal);
            File::delete('file/produk/produk/' . $produk->proposal);
        }

        if ($request->hasFile('dokumen_ijin')) {
            $file = $request->file('dokumen_ijin');
            $dokumen_file_ijin = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/ijin/',$dokumen_file_ijin);
            File::delete('file/produk/ijin/' . $produks->produk_ijin->proposal);
        }

        if ($request->hasFile('sertifikat_ki')) {
            $file = $request->file('sertifikat_ki');
            $dokumen_file_ki = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/ki/',$dokumen_file_ki);
            File::delete('file/produk/ki/' . $produks->produk_ki->sertifikat);
        }

        if ($request->hasFile('dokumen_sertifikasi')) {
            $file = $request->file('dokumen_sertifikasi');
            $dokumen_file_sertifikasi = time() . Str::slug($request->title_produk).".".$file->getClientOriginalExtension();
            $file->move('file/produk/sertifikasi/',$dokumen_file_sertifikasi);
            File::delete('file/produk/sertifikasi/' . $produks->produk_sertifikasi->sertifikasi);
        }

        if ($request->hasFile('foto_image')) {
            $images = $request->foto_image;
            $image_files = $request->file('foto_image');
            for ($i=0; $i < count($images); $i++) {
                $captions = $request->caption_image[$i];
                $filename = time() . Str::slug($request->title_produk). $i .'.' . $image_files[$i]->getClientOriginalExtension();
                $image_resize = Image::make($image_files[$i]->getRealPath());
                $image_resize->resize(900,585);
                $image_resize->save(public_path('img/produk/'.$filename));
                $data = array(
                    'produk_id' =>  $produks->id,
                    'image'     =>  $filename,
                    'judul'     =>  $request->title_produk,
                    'caption'   =>  $captions,
                );
                $image_data[]  = $data;
            }
            ProdukImage::insert($image_data);
        }

        $produk = Produk::where('id', $id)->update([
            'tenant_id'             => $tenant_id,
            'inventor_id'           => 0,
            'priority_id'           => $priority_tenant,
            'title'                 => $request->title_produk,
            'subtitle'              => $request->subtitle_produk,
            'harga_pokok'           => $request->harga_pokok_produk,
            'harga_jual'            => $request->harga_jual_produk,
            'kategori_id'           => $request->kategori_id_produk,
            'tag'                   => implode(",", $request->tag),
            'location'              => $request->location_produk,
            'address'               => $request->address_produk,
            'contact'               => $request->contact_produk,
            'tentang'               => $request->tentang_produk,
            'latar'                 => $request->latar_produk,
            'keterbaharuan'         => $request->keterbaharuan_produk,
            'spesifikasi'           => $request->spesifikasi_produk,
            'manfaat'               => $request->manfaat_produk,
            'keunggulan'            => $request->keunggulan_produk,
            'teknologi'             => $request->teknologi_produk,
            'pengembangan'          => $request->pengembangan_produk,
            'proposal'              => $dokumen_file_proposal,
        ]);

        $produk_bisnis = ProdukBisnis::where('produk_id',$id)->update([
            'kompetitor'            => $request->kompetitor_bisnis,
            'target_pasar'          => $request->target_pasar_bisnis,
            'dampak_sosek'          => $request->dampak_sosek_bisnis,
            'produksi_harga'        => $request->produksi_harga_bisnis,
            'pemasaran'             => $request->pemasaran_bisnis,
        ]);

        $produk_canvas = ProdukCanvas::where('produk_id', $id)->update([
            'canvas'                => $request->canvas_canvas,
            'kategori'              => $request->kategori_canvas,
            'tanggal'               => $request->tanggal_canvas,
        ]);

        $produk_ijin = ProdukIjin::where('produk_id', $id)->update([
            'jenis_ijin'            => $request->jenis_ijin,
            'pemberi'               => $request->pemberi_ijin,
            'status'                => $request->status_ijin,
            'tahun'                 => $request->tahun_ijin,
            'tanggal'               => $request->tanggal_ijin,
            'dokumen'               => $dokumen_file_ijin,
        ]);

        $produk_ki = ProdukKI::where('produk_id', $id)->update([
            'jenis_ki'              => $request->jenis_ki,
            'status_ki'             => $request->status_ki,
            'permohonan'            => $request->permohonan_ki,
            'sertifikat'            => $dokumen_file_ki,
            'berlaku_mulai'         => $request->berlaku_mulai_ki,
            'berlaku_sampai'        => $request->berlaku_sampai_ki,
            'pemilik_ki'            => $request->pemilik_ki,
        ]);

        $produk_riset = ProdukRiset::where('produk_id', $id)->update([
            'nama_riset'            => $request->nama_riset,
            'pelaksana'             => $request->pelaksana_riset,
            'tahun'                 => $request->tahun_riset,
            'pendanaan'             => $request->pendanaan_riset,
            'skema'                 => $request->skema_riset,
            'nilai'                 => $request->nilai_riset,
            'aktifitas'             => $request->aktifitas_riset,
            'tujuan'                => $request->tujuan_riset,
            'hasil'                 => $request->hasil_riset,
        ]);

        $produk_sertifikasi = ProdukSertifikasi::where('produk_id', $id)->update([
            'jenis_sertif'          => $request->jenis_sertifikasi,
            'pemberi_sertif'        => $request->pemberi_sertifikasi,
            'status'                => $request->status_sertifikasi,
            'tahun'                 => $request->tahun_sertifikasi,
            'tanggal'               => $request->tanggal_sertifikasi,
            'dokumen'               => $dokumen_file_sertifikasi,
        ]);
        
        $user_id = $request->user_id_team;
        $jabatan = $request->jabatan_team;
        $divisi = $request->divisi_team;
        $tugas = $request->tugas_team;
        for($count = 0; $count < count($user_id); $count++)
        {
            $data = array(
                'produk_id' => $produks->id,
                'user_id'   => $user_id[$count],
                'jabatan'   => $jabatan[$count],
                'divisi'    => $divisi[$count],
                'tugas'     => $tugas[$count]
            );
            $insert_data[] = $data;
        }
        ProdukTeam::where('produk_id', $id)->delete();
        ProdukTeam::insert($insert_data);
        
        

        $notification = array(
            'message' => 'Produk Berhasil Diedit!',
            'alert-type' => 'success'
        );

        return redirect(route('tenant.detailProduk', $id))->with($notification);

    }

    public function getUser()
    {
        $tenant = TenantUser::where('user_id', request()->user()->id)->first();

        $user = TenantUser::where('tenant_id', $tenant->tenant_id)
            ->join('profil_user',['tenant_user.user_id' =>  'profil_user.user_id'])
            ->select('profil_user.*')
            ->get();

        $html = '<option>Silahkan pilih team</option>';
        foreach ($user as $u) {
            $html .= '<option value="'.$u->user_id.'">'.$u->nama.'</option>';
        }
        return response()->json(['option'=>$html]);
    }

    public function deleteImage($id)
    {
        $image = ProdukImage::find($id);
        $images = ProdukImage::where('produk_id', $image->produk_id)->get();
        if (count($images)>1) {
            File::delete('img/produk/' . $image->image);
            $image->delete();
            return response()->json(['success'  =>  'Gambar berhasil dihapus']);
        } else {
            return response()->json(['errors'   =>  'Gambar ini tidak dapat dihapus, setidaknya produk ini memiliki 1 gambar']);
        }
    }

    public function deleteTeam($id)
    {
        $team = ProdukTeam::find($id);
        $teams = ProdukTeam::where('produk_id', $team->produk_id)->get();
        if (count($teams)>1) {
            $team->delete();
            return response()->json(['success'  =>  'Anggota team berhasil dihapus']);
        } else {
            return response()->json(['errors'   =>  'Setidaknya produk ini memiliki 1 anggota team']);
        }   
    }
}
