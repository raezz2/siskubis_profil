<?php

namespace App\Http\Controllers\Event;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\{Event, Priority, Tenant, Inkbator, User};
use Spatie\QueryBuilder\{QueryBuilder, AllowedFilter};

class EventController extends Controller
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
        $priority = Priority::orderBy('name', 'ASC')->get();
        $event = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('priority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'),
                AllowedFilter::scope('between', 'dateBetween'),
            ])
            ->latest()->paginate(10);
        return view('event.index', compact('event', 'priority'));
    }

    public function indexMentor()
    {
        $priority = Priority::orderBy('name', 'ASC')->get();
        $event = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('priority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'),
                AllowedFilter::scope('between', 'dateBetween'),
            ])->where('inkubator_id', '=', Auth::user()->inkubator_id)
            ->latest()->paginate(10);
        return view('event.index', compact('event', 'priority'));
    }

    public function indexTenant()
    {
        // $user_id = Auth::user()->id;
        // $tenant_user = DB::table('tenant_user')->where('user_id', '=', $user_id)->first();
        // $tenant = DB::table('tenant')->where('id', '=', $tenant_user->tenant_id)->first();
        $tenant = Auth::user()->tenants()->first();
        $event = Event::where([
            ['inkubator_id', '=', Auth::user()->inkubator_id],
            ['priority_id', '=', $tenant->priority],
            ['publish', '=', 1]
        ])->latest()->paginate(10);

        return view('/event/index', compact('event'));
    }

    public function test()
    {
        $tenant = Auth::user()->tenants()->first();
        $event = Event::where([
            ['inkubator_id', '=', Auth::user()->inkubator_id],
            ['priority_id', '=', $tenant->priority],
            ['publish', '=', 1]
        ])->latest()->paginate(10);
        dd($event);
    }

    public function calendar()
    {
        $event = Event::all();
        return view('event.calendar', compact('event'));
    }

    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }

    public function create()
    {
        $priority = Priority::all();
        return view('event.create', compact('priority'));
    }

    public function store()
    {
        $attr = request()->validate([
            'title' => 'required|min:3',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048',
            'priority_id' => 'required',
            'event' => 'required',
            'publish' => 'required',
            'tgl_mulai' => 'required',
            'waktu_mulai' => 'required',
            'tgl_selesai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        $slug = \Str::slug(request('title'));
        $attr['slug'] = $slug;
        $attr['author_id'] = Auth::user()->id;
        $attr['inkubator_id'] = Auth::user()->inkubator_id;

        $foto = request()->file('foto');
        $fotoUrl = $foto->storeAs("/image/event", "{$slug}.{$foto->extension()}");

        $attr['foto'] = $fotoUrl;

        // session()->flash('success', 'Event Baru Telah Ditambah');
        $notification = array(
            'message' => 'Event Baru Berhasil Ditambah',
            'alert-type' => 'success'
        );
        Event::create($attr);
        return redirect()->to('/inkubator/event')->with($notification);
    }

    public function edit(Event $event)
    {
        $priority = Priority::all();
        return view('event.edit', compact('event', 'priority'));
    }

    public function update(Event $event)
    {

        $attr = request()->validate([
            'title' => 'required|min:3',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048',
            'priority_id' => 'required',
            'event' => 'required',
            'publish' => 'required',
            'tgl_mulai' => 'required',
            'waktu_mulai' => 'required',
            'tgl_selesai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        if (request()->file('foto')) {
            \Storage::delete($event->foto);
            $foto = request()->file('foto');
            $fotoUrl = $foto->storeAs("image/event", "{$event->slug}.{$foto->extension()}");
            $attr['foto'] = $fotoUrl;
        } else {
            $foto = $event->foto;
        }

        $event->update($attr);
        // session()->flash('success', 'Event Baru Berhasil Diedit');
        $notification = array(
            'message' => 'Event Berhasil Diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->to('/inkubator/event')->with($notification);
    }

    public function destroy(Event $event)
    {
        \Storage::delete($event->foto);
        $event->delete();
        // session()->flash('error', 'Event Berhasil Dihapus');
        $notification = array(
            'message' => 'Event telah Dihapus',
            'alert-type' => 'error'
        );
        return redirect()->to('/inkubator/event')->with($notification);
    }

    public function search(Request $request)
    {
        $priority = Priority::get();
        $title = request('title');
        $priority_id = request('priority');
        $publish = request('publish');

        $event = Event::where('title', 'like', "%$title%")->where('priority_id', '=', $priority_id)->where('publish', '=', $publish)->paginate(10);
        return view('/event/index', compact('event', 'priority'));
    }
}
