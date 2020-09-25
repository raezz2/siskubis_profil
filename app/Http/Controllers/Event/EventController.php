<?php

namespace App\Http\Controllers\Event;

use Auth;
use App\{Event, Priority};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
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
    public function index(Request $request)
    {
        $items = $request->items ?? 10;
        $priority = Priority::orderBy('name', 'ASC')->get();
        $event = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('priority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'),
                AllowedFilter::scope('between', 'dateBetween'),
            ])
            ->latest()->paginate($items);
        return view('event.index', compact('event', 'priority', 'items'));
    }

    public function indexMentor(Request $request)
    {
        $items = $request->items ?? 10;
        $priority = Priority::orderBy('name', 'ASC')->get();
        $event = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('priority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'),
                AllowedFilter::scope('between', 'dateBetween'),
            ])->where('inkubator_id', '=', Auth::user()->inkubator_id)
            ->latest()->paginate($items);
        return view('event.index', compact('event', 'priority', 'items'));
    }

    public function indexTenant(Request $request)
    {
        $items = $request->items ?? 10;
        $tenant = Auth::user()->tenants()->first();
        $event = Event::where([
            ['inkubator_id', '=', Auth::user()->inkubator_id],
            ['priority_id', '=', $tenant->priority],
            ['publish', '=', 1]
        ])->latest()->paginate($items);

        return view('/event/index', compact('event', 'items'));
    }

    public function calendar()
    {
        $event = Event::all();
        return view('event.calendar', compact('event'));
    }

    public function calendarMentor()
    {
        $event = Event::where('inkubator_id', '=', Auth::user()->inkubator_id)->get();
        return view('event.calendar', compact('event'));
    }

    public function calendarTenant()
    {
        $tenant = Auth::user()->tenants()->first();
        $event = Event::where([
            ['inkubator_id', '=', Auth::user()->inkubator_id],
            ['priority_id', '=', $tenant->priority],
            ['publish', '=', 1]
        ])->get();
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

    public function store(EventRequest $request)
    {
        $attr = $request->all();

        $slug = \Str::slug(request('title'));
        $attr['slug'] = $slug;
        $attr['inkubator_id'] = Auth::user()->inkubator_id;

        $foto = request()->file('foto');
        $fotoUrl = $foto->storeAs("/image/event", "{$slug}.{$foto->extension()}");
        $attr['foto'] = $fotoUrl;

        auth()->user()->events()->create($attr);

        $notification = array(
            'message' => 'Event Baru Berhasil Ditambah',
            'alert-type' => 'success'
        );

        return redirect()->to('/inkubator/event')->with($notification);
    }

    public function edit(Event $event)
    {
        $priority = Priority::all();
        return view('event.edit', compact('event', 'priority'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $attr = $request->all();

        if ($request->file('foto')) {
            \Storage::delete($event->foto);
            $foto = request()->file('foto');
            $fotoUrl = $foto->storeAs("image/event", "{$event->slug}.{$foto->extension()}");
            $attr['foto'] = $fotoUrl;
        } else {
            $foto = $event->foto;
        }

        $event->update($attr);
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
        $notification = array(
            'message' => 'Event telah Dihapus',
            'alert-type' => 'error'
        );
        return redirect()->to('/inkubator/event')->with($notification);
    }
}
