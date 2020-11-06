<?php

namespace App\Http\Controllers\Profile;

use DB;
use Auth;
use Session;
use App\User;
use App\ProfilUser;
use App\TenantUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfilRequest;

class ProfileUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilan data profile user yang sedang login
     */

    public function indexprofil($id)
    {
        $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => $id])
            ->join('role_user', ['users.id' => 'role_user.user_id'])
            ->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])
            ->select('users.id as uid', 'profil_user.*', 'users.email')
            ->first();

        // $profil= ProfilUser::all();

        // $this->data['data']=$data;
        // $this->data['profil']=$profil;

        // return response()->json($data);
        return view('profile.index', $data);
        // return $data;
    }

    public function edit($id)
    {
        $check = TenantUser::where('user_id', Auth::user()->id)->get();

        $data = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => $id])
            ->join('role_user', ['users.id' => 'role_user.user_id'])
            ->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])
            ->select('users.id as uid', 'profil_user.*', 'users.email')
            ->first();

        $this->data['data'] = $data;
        $this->data['check'] = $check;

        // return response()->json($data);
        return view('tenant.editprofiluser', $this->data);
    }

    public function index()
    {
        if (request()->user()->hasRole(['mentor'])) {
            $data['data'] = User::where(['users.id' => Auth::user()->id])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid', 'users.email as email', 'profil_user.*')->first();
            if (!$data['data']->id) {
                request()->session()->now('message', 'Tolong lengkapi data profil anda');
                request()->session()->now('alert-type', 'warning');
            }
        }
        return view('profile.index', $data);
        // return $data;
    }
    /**
     * menampilkan detail profil user lain berdasarkan request()->id
     */
    public function show($id)
    {
        if (request()->user()->hasRole(['inkubator', 'tenant'])) {
            $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'users.id' => $id])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid', 'users.email as email', 'profil_user.*')->firstOrFail();
        }
        return view('profile.index', $data);
    }

    public function createuser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $data = $request->all();

        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move('theme/images/faces', $fileName);
        }

        $tenant = TenantUser::where('user_id', Auth::user()->id)->get();

        foreach ($tenant as $tenant) {
            $tenantid = $tenant->tenant_id;
        }


        $user = new User;
        $user->name = $data['name'];
        $user->inkubator_id = Auth::user()->inkubator_id;
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        $roleuser = new RoleUser;
        $roleuser->user_id = $user->id;
        $roleuser->role_id = 2;
        $roleuser->save();

        $tenanuser = new TenantUser;
        $tenanuser->user_id = $user->id;
        $tenanuser->tenant_id = $tenantid;
        $tenanuser->save();

        $profiluser = new ProfilUser;
        $profiluser->user_id = $user->id;
        $profiluser->nama = $data['nama'];
        $profiluser->kontak = $data['kontak'];
        $profiluser->alamat = $data['alamat'];
        $profiluser->nik = $data['nik'];
        $profiluser->deskripsi = $data['deskripsi'];
        $profiluser->foto = $fileName;
        $profiluser->jenkel = $data['jenkel'];
        $profiluser->save();

        // $this->data['data']= $data;
        // $this->data['fileName']= $fileName;

        if ($fileName) {
            Session::flash('success', 'User berhasil di simpan');
        } else {
            Session::flash('error', 'User Gagal di simpan');
        }

        // return response()->json($this->data);
        return redirect('/tenant');
    }

    public function update(UpdateProfilRequest $request)
    {
        $profil = ProfilUser::where('user_id', Auth::user()->id)->first();
        $tujuan_upload = 'img/mentor/profile/';
        if ($profil) {
            if ($profil->foto) {
                \File::delete($tujuan_upload . $profil->foto);
            }
        }


        $file = $request->foto;
        $filename = time() . \Str::slug($request->get('nama')) . '.' . $file->getClientOriginalExtension();
        $file->move($tujuan_upload, $filename);

        ProfilUser::updateOrCreate(
            ['user_id'  =>  Auth::user()->id],
            [
                'nama' =>  $request->nama,
                'jenkel' =>  $request->jenkel,
                'kontak' =>  $request->kontak,
                'alamat' =>  $request->alamat,
                'nik' =>  $request->nik,
                'foto' =>  $filename,
                'deskripsi' =>  $request->deskripsi,
                'status' =>  '1',
            ],
        );
        $notification = array(
            'message' => 'Data Profil Berhasil Diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function addprofil(Request $request)
    {
        $data = $request->all();

        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move('theme/images/faces', $fileName);
        }

        $profiluser = new ProfilUser;
        $profiluser->user_id = Auth::user()->id;
        $profiluser->nama = $data['nama'];
        $profiluser->kontak = $data['kontak'];
        $profiluser->alamat = $data['alamat'];
        $profiluser->nik = $data['nik'];
        $profiluser->deskripsi = $data['deskripsi'];
        $profiluser->foto = $fileName;
        $profiluser->jenkel = $data['jenkel'];
        $profiluser->save();

        if ($fileName) {
            Session::flash('success', 'Profil berhasil di simpan');
        } else {
            Session::flash('error', 'Profil Gagal di simpan');
        }

        // return response()->json($request);
        return redirect('/tenant');
    }

    public function updateprofileuser(Request $request, $id)
    {
        $profil = ProfilUser::find($id);

        $userID = $profil->user_id;

        $fileName = $profil->foto;

        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move('theme/images/faces', $fileName);
            File::delete('theme/images/faces' . $profil->foto);
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
        if ($id == Auth::user()->id) {

            return back()->with(Session::flash('error', 'User gagal dihapus'));
        } else {

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
