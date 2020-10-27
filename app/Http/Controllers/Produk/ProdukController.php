<?php

namespace App\Http\Controllers\Produk;


use Auth;
use File;
use Image;
use App\User;
use App\Produk;
use App\Tenant;
use App\Priority;
use App\Inkubator;
use App\ProdukTeam;
use App\ProfilUser;
use App\TenantUser;
use App\ProdukImage;
use App\profil_user;
use App\TenantMentor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
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
        if ( $request->user()->hasRole('inkubator') ) {
            $ink = Tenant::where('inkubator_id', $request->user()->inkubator_id)->get('id');
            $produk = Produk::with('tenant','priority','produk_image')
                ->whereIn('tenant_id', $ink )
                ->paginate(12);
        }elseif($request->user()->hasRole('mentor')){
            $mentor = TenantMentor::where('user_id', $request->user()->id)->get('id');
            $produk = Produk::with('tenant','priority','produk_image')
                ->whereIn('tenant_id', $mentor)
                ->paginate(12);
        }elseif($request->user()->hasRole('tenant')){
            $tenant = TenantUser::where('user_id', $request->user()->id)->first();
            $produk = Produk::with('tenant','priority','produk_image')
                ->where('tenant_id', $tenant->tenant_id)
                ->paginate(12);
        }
        return view('produk.index', compact('produk','priority'));
    }

	public function show($id)
    {
        $produk = Produk::find($id);
        $produk = Produk::with(['tenant','produk_image'])->where('id', $id)->first();
        $produk_team = ProdukTeam::with('profil_user.user')->where('produk_id', $id)->get();

        return view('produk.detailProduk', compact('produk','produk_team'));
    }

    public function create(Request $request)
    {
        $team = TenantUser::with('profilUser')->where('tenant_id', $request->user()->id)->get();
        $tenant = Tenant::orderBy('title')->get();
        // $penulis = profil_user::orderBy('nama')->get();

        return view('produk.formTambah', compact('team', 'tenant'));
    }

    public function store(Request $request)
    {
        $produk_id = Produk::orderBy('id','DESC')->first('id');
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . Str::slug($request->tittle) . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(900,585);
            $image_resize->save(public_path('img/produk/'.$filename));

            $file = $request->file('proposal');
            $proposal_file = time()."_".$file->getClientOriginalExtension();
            $proposal_file->storeAs('img/proposalProduk/'.$proposal_file);
            //$file->storeAs('public/produk', $filename);
            $file = $request->file('foto');
            //$filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            //$file->storeAs('public/produk', $filename);

            $produk = Produk::create([


                'id'                    => $produk_id,
                'tenant_id'             => $request->tenant_id,
                'inventor_id'           => $request->inventor_id,
                'priority_id'           => $request->priority_id,
                'title'                 => $request->title,
                'subtitle'              => $request->subtitle,
                'harga_pokok'           => $request->harga_pokok,
                'harga_jual'            => $request->harga_jual,
                'tag'                   => $request->tag,
                'location'              => $request->location,
                'address'               => $request->address,
                'contact'               => $request->contact,
                'tentang'               => $request->tentang,
                'latar'                 => $request->latar,
                'keterbaharuan'         => $request->keterbaharuan,
                'spesifikasi'           => $request->spesifikasi,
                'manfaat'               => $request->manfaat,
                'keunggulan'            => $request->keunggulan,
                'teknologi'             => $request->teknologi,
                'pengembangan'          => $request->pengembangan,
                'proposal'              => $proposal_file,
                'publish'               => $request->publish,
            ]);

            $produk_image = ProdukImage::create([
                'produk_id'             => $produk_id,
                'foto'                  => $filename,
                'judul'                 => $filename,
            ]);

            $produk_team = ProdukTeam::create([
                'user_id'               => $request->user_id,
                'produk_id'             => $produk_id,
                'jabatan'               => $request->jabatan,
                'divisi'                => $request->divisi,
                'tugas'                 => $request->tugas,
            ]);


            // $notification = array(
            //     'message' => 'Berita Berhasil Ditambahkan!',
            //     'alert-type' => 'success'
            // );

            // return redirect(route('tenant.produk'));
            return view('tenant.produk');
        }
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        File::delete(storage_path('app/public/img/produk' . $produk->foto));

        return redirect()->back();
    }

    public function edit($id)
    {
        $produk = Produk::find($id);

        return $produk;
    }

    public function update($id, Request $request)
    {
        $produk = Produk::find($id);        
    }
}
