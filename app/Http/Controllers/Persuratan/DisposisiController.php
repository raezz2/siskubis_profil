<?php

namespace App\Http\Controllers\Persuratan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Disposisi;
use Session;
use DB;
use Auth;
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
        $disposisi = Disposisi::all();

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
        $surat = Surat::findOrFail($id);
        $priority = DB::table('priority')->get();
        
        $user = DB::table('users')->get();
        // $surat = Surat::where('id', '!=', $id)->orderBy('name', 'asc')->get();

        $this->data['surat'] = $surat;
        $this->data['user'] = $user;
        $this->data['priority'] = $priority;
        return view('mentor.surat.edit', $this->data);
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
        $surat = Surat::find($id);
        $filename = $surat->dokumen;
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Auth::user()->name.'_' .time() . '.' . $file->getClientOriginalName();
            $file->move('file/dokumen', $filename);
            File::delete('file/dokumen' . $surat->dokumen);
        }

        Surat::where('id', $surat->id)
        ->update ([
            'title' => $request->judul,
            'dari' => Auth::user()->email,
            'kepada' => $request->kepada,
            'perihal' => $request->perihal,
            'dokumen' => $filename,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        
        if ($filename) {
            Session::flash('success', 'Surat Berhasil Dirubah');
        } else {
            Session::flash('error', 'Surat Gagal Dirubah');
        }

    	return redirect('mentor/suratmasuk');
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
