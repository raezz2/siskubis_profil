<?php

namespace App\Http\Controllers\Produk;

use Auth;
use App\Produk;
use App\Tenant;
use App\Priority;
use App\inkubator;
use App\ProdukTeam;
use App\ProdukImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TenantMentor;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
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
        $priority = Priority::orderBy('name', 'ASC')->get();
        if ( $request->user()->hasRole('inkubator') ) {
            // $produk = Produk::with('tenant','priority','produk_image')->paginate(12);
        
            $priority = Priority::orderBy('name', 'ASC')->get();
            $produk = QueryBuilder::for(Produk::class)
                ->allowedFilters([
                    // AllowedFilter::partial('title'),
                    AllowedFilter::exact('priority', 'priority_id'),
                    // AllowedFilter::exact('publish', 'publish'),
                ])
                ->with('tenant','priority','produk_image')->latest()->paginate();
    
        }elseif($request->user()->hasRole('mentor')){
            // $tenant = Auth::user()->mentors()->get()->tenant_id;
            // $tenant = TenantMentor::with('mentor')->where(Auth::user()->mentors()->tenant_id);
            $produk = Produk::with('mentors','priority','produk_image')->where(Auth::user()->mentors()->tenant_id);
            dd ($produk);
        }elseif($request->user()->hasRole('tenant')){
            $produk = Produk::with('tenant','priority','produk_image')->paginate(12);
            $tenant = Auth::user()->tenants()->first();
        }
        
        return view('produk.index', compact('produk','priority'));
    }
	public function show($id)
    {
        $produk = Produk::find($id);
        $produk = Produk::with(['tenant','produk_image'])->where('id', $id)->first();
        $produk_team = ProdukTeam::with('profil_user.user')->where('produk_id', $id)->get();

        return view('produk.detailProduk', compact('produk','produk_team'));
        //return $produk_team;
    }

    public function create()
    {
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

	public function kategori($kategori)
    {
        return view('tenant.produk');
    }

	public function detail($kategori,$id)
    {
        return view('tenant.produk');
    }

    //Function Filter
    public function indexInkubator(Request $request)
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

        $priority = Priority::orderBy('name', 'ASC')->get();
        $produk = QueryBuilder::for(Produk::class)
            ->allowedFilters([
                // AllowedFilter::partial('title'),
                AllowedFilter::exact('filterByPriority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'),
            ])
            ->latest()->paginate();
        return view('produk.index', compact('produk', 'priority', 'exp', 'title'));
    }

    public function indexMentor(Request $request)
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

        $priority = Priority::orderBy('name', 'ASC')->get();
        $produk = QueryBuilder::for(Produk::class)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('filterByPriority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'),
            ])->where('inkubator_id', '=', Auth::user()->inkubator_id)
            ->latest()->paginate();
        return view('produk.index', compact('produk', 'priority', 'exp', 'title'));
    }

    public function indexTenant(Request $request)
    {

        $tenant = Auth::user()->tenants()->first();
        $produk = Produk::where([
            ['inkubator_id', '=', Auth::user()->inkubator_id],
            ['priority_id', '=', $tenant->priority],
            ['publish', '=', 1]
        ])->latest()->paginate();

        return view('produk.index', compact('produk'));
    }

}
