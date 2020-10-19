<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use Auth;
use App\{Event, Priority};
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
            $produk = Produk::paginate(12);
            //$produk = Produk::where('mentor_id', Auth::user('id') )->paginate(12);
        }elseif($request->user()->hasRole('tenant')){
            $produk = Produk::paginate(12);
            //$produk = Produk::where('tenant_id', Auth::user('id') )->paginate(12);
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

    public function indexTenant(Request $request)
    {

        $tenant = Auth::user()->tenants()->first();
        $event = Event::where([
            ['inkubator_id', '=', Auth::user()->inkubator_id],
            ['priority_id', '=', $tenant->priority],
            ['publish', '=', 1]
        ])->latest()->paginate();

        return view('tenant.produk', compact('event'));
    }
}
