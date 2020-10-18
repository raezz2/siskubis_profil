<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $event = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('priority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'),
                AllowedFilter::scope('between', 'dateBetween'),
            ])
            ->latest()->paginate();
        return view('tenant.produk', compact('event', 'priority', 'exp', 'title'));
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
