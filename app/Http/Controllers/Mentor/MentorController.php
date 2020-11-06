<?php

namespace App\Http\Controllers\Mentor;

use Auth;
use File;
use App\Post;
use App\User;
use App\Tenant;
use App\TenantGallery;
use App\Pengumuman;
use App\TenantMentor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\TenantUser;
use Illuminate\Support\Facades\Validator;

use Spatie\QueryBuilder\QueryBuilder;

class MentorController extends Controller
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
    public function index()
    {
        $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'role_user.role_id' => 4])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid','users.email as email',  'profil_user.*')->get();
        // $data['data'] = User::with('profile')->where(['users.inkubator_id' => Auth::user()->inkubator_id])
        //     ->whereHas('roles', function ($q) {
        //         $q->where('name', 'Mentor');
        //     })->get();
        $data['tenant'] = Tenant::where(['inkubator_id' => Auth::user()->inkubator_id])->get();
        return view('mentor.index', $data);
    }

    public function indexTenant()
    {
        $mentor = TenantMentor::where('tenant_id', Auth::user()->tenantId())->get('user_id');
        // $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id])->whereIn('id', $mentor)->get();
        $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id])->whereIn('users.id', $mentor)->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid','users.email as email',  'profil_user.*')->get();
        return view('mentor.index', $data);
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('inkubator_id', Auth::user()->inkubator_id)->where(function ($query) {
            $query->where('publish', 1);
        })->get();
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        // $pengumuman = Pengumuman::where()->get();
        return view('mentor.pengumuman', compact('pengumuman', 'kategori', 'inkubator'));
    }

    public function tampil(Request $request)
    {
        if ($request->user()->hasRole('inkubator')) {
            $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id, 'role_user.role_id' => 4])->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid','users.email as email', 'profil_user.*')->get();
        } elseif ($request->user()->hasRole('tenant')) {
            $mentor = TenantMentor::where('tenant_id', Auth::user()->tenantId())->get('user_id');
            $data['data'] = User::where(['users.inkubator_id' => Auth::user()->inkubator_id])->whereIn('users.id', $mentor)->join('role_user', ['users.id' => 'role_user.user_id'])->leftJoin('profil_user', ['users.id' => 'profil_user.user_id'])->select('users.id as uid','users.email as email',  'profil_user.*')->get();
        }
        return view('mentor.mentor-list', $data);
    }

    public function tenant()
    {
        $pengumuman = Pengumuman::where([['author_id', \Auth::user()->id], ['inkubator_id', 0]])->get();
        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        return view('mentor.pengumuman', compact('pengumuman', 'kategori', 'inkubator'));
    }

    public function show($slug)
    {
        $pengumuman = DB::table('pengumuman')->where('slug', $slug)->get();
        return view('mentor.detail', ['pengumuman' => $pengumuman]);
    }
    public function kategori($id)
    {
        $pengumuman = Pengumuman::where([['priority_id', $id], ['inkubator_id', \Auth::user()->inkubator_id], ['publish', 1]])->latest()->get();
        $kategori = DB::table('priority')->get();
        return view('mentor.pengumuman', compact('pengumuman', 'kategori'));
    }

    public function search(Request $request)
    {

        $keyword = $request->get('keyword');


        if ($keyword) {
            $pengumuman = Pengumuman::where([['title', 'like', '%' . $keyword . '%'], ['inkubator_id', \Auth::user()->inkubator_id], ['publish', 1]])->get();
        }

        $kategori = DB::table('priority')->get();
        $inkubator = DB::table('inkubator')->get();
        return view('mentor.pengumuman', compact('pengumuman', 'kategori', 'inkubator', 'keyword'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'required',
            'tenant_id' => 'required',
        ]);

        $tenantmentor = TenantMentor::create([
            'user_id'                => $request->user_id,
            'tenant_id'              => $request->tenant_id,

        ]);

        $notification = array(
            'message' => 'Berhasil Ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect(route('inkubator.mentor'))->with($notification);
    }

    public function daftartenant( Request $request)
    {
        if(request()->has('filter')){
            if(array_key_exists('between', $request->filter)){
                $test = request()->filter['between'];
                $exp = explode(',', $test);
            }else{
                $exp = null;
            }

            if(array_key_exists('title', $request->filter)){
                $title = request()->filter['title'];
            }else{
                $title = null;
            }
        }else{
            $exp = null;
            $title = null;
        }
        

        $data = QueryBuilder::for(Tenant::class)
        ->leftJoin('tenant_mentor',['tenant.id'=>'tenant_mentor.tenant_id'])
        ->leftJoin('priority',['tenant.priority'=>'priority.id'])
        ->where('user_id','=', Auth::user()->id )
        ->allowedFilters(['title', 'description','priority'])
        ->get();


        $user = Tenant::where('inkubator_id',Auth::user()->inkubator_id)
        ->leftJoin('tenant_user',['tenant.id'=>'tenant_user.tenant_id'])
        ->Join('profil_user',['profil_user.user_id'=>'tenant_user.user_id'])
        ->select('profil_user.*', 'tenant_user.tenant_id')
        ->get();

        

        $priority = DB::table('priority')->get();

        // return response()->json($data);
        
        $this->data['data'] = $data;
        $this->data['user'] = $user;
        $this->data['title'] = $title;
        $this->data['exp'] = $exp;
        $this->data['priority'] = $priority;
        
        return view('mentor.daftartenant', $this->data);
    }

    public function detailtenant( $kategori, $id)
    {
        $tenant = Tenant::findOrFail($id);

        $tenantuser = TenantUser::where('tenant_id', $id)
        ->leftJoin('profil_user',['profil_user.user_id'=>'tenant_user.user_id'])
        ->get();

        $gallery = TenantGallery::where('tenant_id', $id)->paginate(6);

        
        $this->data['tenant'] = $tenant;
        $this->data['tenantuser'] = $tenantuser;
        $this->data['gallery'] = $gallery;

        // return response()->json($tenantuser);


        return view('tenant.'.$kategori, $this->data);
    }
}
