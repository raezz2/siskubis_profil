<?php

namespace App\Http\Controllers\Berita;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\kategori;


class KategoriController extends Controller
{
	public function create(){
		$berita_category = kategori::orderBy('category')->get();
		$datas = array(
			'berita_category' => $berita_category,
			'no'        => 1
		);

		$data = array('title'   => 'category');
		return view('kategori.create',$data,$datas);
	}
	public function store(){
		kategori::create([
			'category'      => request('category'),
		]);
		return redirect(route('inkubator.kategori.create'));
	}
	public function edit(kategori $kategori)
	{
		$data = array(
			'title'       => 'kategori',
			'kategori'     => $kategori
		);
		return view('kategori.edit',$data);
	}

	public function update(kategori $kategori)
	{
		$kategori->update([
			'category'      => request('category'),
		]);
		return redirect(route('inkubator.kategori.create'));
	}

	public function destroy(kategori $kategori){
    	$kategori->delete();
    	
        return redirect(route('inkubator.kategori.create'));
	}
}
