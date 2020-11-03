<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\ProfilUser;
use App\User;
use DB;

class ProfileUserController extends Controller
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
	 
    public function index($id)
    {
        $data['data']=User::where(['users.inkubator_id'=>Auth::user()->inkubator_id,'users.id'=>$id])
        ->join('role_user',['users.id'=>'role_user.user_id'])
        ->leftJoin('profil_user',['users.id'=>'profil_user.user_id'])
        ->select('users.id as uid','profil_user.*','users.email')
        ->first();

        // $profil= ProfilUser::all();

        // $this->data['data']=$data;
        // $this->data['profil']=$profil;

        // return response()->json($data);
        return view('profile.index',$data);
        // return $data;
    }

    public function edit($id)
    {
        $data['data']=User::where(['users.inkubator_id'=>Auth::user()->inkubator_id,'users.id'=>$id])
        ->join('role_user',['users.id'=>'role_user.user_id'])
        ->leftJoin('profil_user',['users.id'=>'profil_user.user_id'])
        ->select('users.id as uid','profil_user.*','users.email')
        ->first();

        // return response()->json($data);
        return view('tenant.editprofiluser', $data);
    }

    public function update(Request $request, $id)
    {
        $profil = ProfilUser::find($id);

        $userID = $profil->user_id;

        $fileName = $profil->foto;

        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time(). '_'. $file->getClientOriginalName();
 
            $file->move('theme/images/faces', $fileName);
            File::delete('theme/images/faces'. $profil->foto);
         }

        ProfilUser::where('id', $profil->id)
        ->update([
        'user_id' => $userID,
        'nama' => $request->nama,
        'kontak' => $request->kontak,
        'alamat' => $request->alamat,
        'nik' => $request->nik,
        'deskripsi' => $request->deskripsi,
        'foto' => $fileName,
        'jenkel' => $request->jenkel,
        ]);

        // $this->data['data']= $data;
        // $this->data['fileName']= $fileName;
        // $this->data['request']= $request;

        if ($fileName) {
            Session::flash('success', 'User berhasil di update');
        } else {
            Session::flash('error', 'User Gagal di update');
        }
        // return response()->json($this->data);
        return redirect('/tenant');
    }

    public function destroy($id)
    {
        if ( $id == Auth::user()->id) {
            
            return back()->with( Session::flash('error', 'User gagal dihapus'));
        }
        else {

            $user  = User::findOrFail($id);
            $user->TenantUser()->detach();
            $user->ProfilUser()->detach();
    
            if ($user->delete()) {
                Session::flash('success', 'User berhasil dihapus');
            }

            return back();
        }

    }

}
