<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Tenant;
use App\TenantUser;
use App\User;
use App\Priority;
use App\ProfilUser;
use Auth;

class HomeController extends Controller
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

        $check = TenantUser::where('user_id',Auth::user()->id)->get();

        $checkprofil = ProfilUser::where('user_id',Auth::user()->id)->get();

        $tenant = TenantUser::where('user_id',Auth::user()->id)
        ->Join('tenant', ['tenant_user.tenant_id'=>'tenant.id'])
        ->select('tenant.*')
        ->get();

        if(count($check) == 0){

        }
        
        else{

            foreach( $check as $ck){
                
                $profil= TenantUser::where('tenant_id', $ck->tenant_id )
                ->Join('profil_user', ['profil_user.user_id'=>'tenant_user.user_id'])
                ->get();
    
            }
        }

        $priority = Priority::all();

        // $tenant = Tenant::where();
        $user = User::Where(Auth::user()->id);

        $this->data['check'] = $check;
        $this->data['tenant'] = $tenant;
        $this->data['priority'] = $priority;
        $this->data['checkprofil'] = $checkprofil;
        if(count($check) == 0){
        }else{
            $this->data['profil'] = $profil;
        }
        
        // return response()->json($checkprofil);
        return view('tenant.dashboard',$this->data);
    }
}
