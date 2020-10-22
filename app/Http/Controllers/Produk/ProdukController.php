<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Tenant;
use App\TenantUser;
use App\TenantMentor;
use App\Inkubator;
use App\ProdukTeam;
use App\Priority;
use Auth;
use App\ProdukImage;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\{QueryBuilder, AllowedFilter};
use Illuminate\Support\Collection;
use File;

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
            $ink = Tenant::where('inkubator_id', $request->user()->inkubator_id)->first()->toArray();
            //$ink = implode(' ', array_values($ink));
            $produk = Produk::with('tenant','priority','produk_image')
                ->where('tenant_id','=', $ink )
                ->paginate(12);
        }elseif($request->user()->hasRole('mentor')){
            $mentor = TenantMentor::where('user_id', $request->user()->id)->get()->toArray();
            $produks = Produk::with('tenant','priority','produk_image')
                ->where('tenant_id', $mentor->tenant_id)
                ->get();
        }elseif($request->user()->hasRole('tenant')){
            $tenant = TenantUser::where('user_id', $request->user()->id)->first();
            $produk = Produk::with('tenant','priority','produk_image')
                ->where('tenant_id', $tenant->tenant_id)
                ->paginate(12);
        }
        //return $ink;
        //return $mentor;
        return view('produk.index', compact('produk','priority'));
    }
	public function show($id)
    {
        $produk = Produk::find($id);
        $produk = Produk::with(['tenant','produk_image'])->where('id', $id)->first();
        $produk_team = ProdukTeam::with('profil_user.user')->where('produk_id', $id)->get();

        return view('produk.detailProduk', compact('produk','produk_team'));
        //return $produk_team;
    }
	public function kategori($kategori)
    {
        return view('tenant.produk');
    }

	public function detail($kategori,$id)
    {
        return view('tenant.produk');
    }

    public function create()
    {
        // $kategori_berita =  kategori::orderBy('category')->get();
        // $inkubator = Inkubator::orderBy('nama')->get();
        // $penulis = profil_user::orderBy('nama')->get();

        return view('produk.formTambah');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . Str::slug($request->tittle) . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(900,585);
            $image_resize->save(public_path('storage/produk/'.$filename));

            $produk = Produk::create([
                'tittle'                => $request->tittle,
                'harga'                 => $request->harga_jual,
                'subtitle'              => $request->subtitle,
                'phone'                 => $request->phone,
                'publish'               => $request->publish,
                'tenant_id'             => $request->tenant_id,
                'priority_id'           => $request->priority_id,
            ]);

            $produk_image = ProdukImage::create([
                'foto'                  => $filename->image,
            ]);


            // $notification = array(
            //     'message' => 'Berita Berhasil Ditambahkan!',
            //     'alert-type' => 'success'
            // );

            return redirect(route('tenant.produk'));
        }
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        File::delete(storage_path('app/public/img/produk' . $produk->foto));

        return redirect()->back();
    }
}
