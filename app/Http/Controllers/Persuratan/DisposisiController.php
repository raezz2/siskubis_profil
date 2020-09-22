<?php

namespace App\Http\Controllers\Persuratan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Disposisi;
use Session;
use App\Surat;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mentorsuratmasuk()
    {
        $disposisi = Disposisi::get();

        return view('mentor.surat.index', compact('disposisi'));
    }

    public function mentorsuratkeluar()
    {

        $surat = Surat::get();

        return view('mentor.surat.keluar', compact('surat'));
    }

    public function tenantsuratmasuk()
    {
        $disposisi = Disposisi::get();

        return view('Tenant.surat.index', compact('disposisi'));
    }

    public function tenantsuratkeluar()
    {
        $surat = Surat::get();

        return view('Tenant.surat.keluar', compact('surat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disposisi = Disposisi::get();

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disposisi  = Disposisi::findOrFail($id);

        if ($disposisi->delete()) {
            Session::flash('success', 'Surat berhasil dihapus');
        }

        return back();
    
    }
}
