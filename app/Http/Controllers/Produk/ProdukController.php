<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use Auth;

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
        return view('produk.index');
    }
	
	public function detail($kategori,$id)
    {
        return view('produk.index');
    }
}
