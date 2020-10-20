<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Tenant;
use Auth;
use App\ProdukImage;
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
        if ( $request->user()->hasRole('inkubator') ) {
            //$filter = Produk::with('tenant')->get();
            $produk = Produk::with('tenant','priority','produk_image')->paginate(12);
        }elseif($request->user()->hasRole('mentor')){
            $produk = Produk::with('tenant','priority','produk_image')->paginate(12);
            //$produk = Produk::where('mentor_id', Auth::user('id') )->paginate(12);
        }elseif($request->user()->hasRole('tenant')){
            $produk = Produk::with('tenant','priority','produk_image')->paginate(12);
            $tenant = Auth::user()->tenants()->first();
        }

        return view('produk.index', compact('produk'));
    }
	public function show($id)
    {
        $produk = Produk::find($id);
        $produk = Produk::with(['tenant','produk_image'])->where('id', $id)->first();

        return view('produk.detailProduk', compact('produk'));
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
}
