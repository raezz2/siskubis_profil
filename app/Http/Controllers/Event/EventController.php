<?php

namespace App\Http\Controllers\Event;

use Auth;
use Redirect;
use Response;
use App\Event;
use App\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

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
        // $event = Event::latest()->paginate(5);
        $priority = Priority::orderBy('name', 'ASC')->get();
        $event = QueryBuilder::for(Event::class)
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('priority', 'priority_id'),
                AllowedFilter::exact('publish', 'publish'), 
            ])
            ->latest()->paginate(10);
        return view('event.index', compact('event', 'priority'));
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
            'foto' => 'required',
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
        
        Event::create($attr);
        return redirect()->to('/inkubator/event');

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
            'priority_id' => 'required',
            'event' => 'required',
            'publish' => 'required',
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

        return redirect()->to('/inkubator/event');
    }

    public function destroy(Event $event)
    {
        \Storage::delete($event->foto);
        $event->delete();
        return redirect()->to('/inkubator/event');
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

    // // ? ini fungsi untuk fullcalendar
    // public function indexCalendar()
    // {
    //     if(request()->ajax())
    //     {
    //         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
    //         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            
    //         $data = Event::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['id', 'title', 'tgl_mulai', 'tgl_selesai']);
    //         return Response::json($data);
    //     }
    //     return view('event.calendar');
    // }

    // public function createCalendar(Request $request)
    // {
    //     $insertAttr = [
    //         'title' => $request->title,
    //         'tgl_mulai' => $request->start,
    //         'tgl_selesai' => $request->end
    //     ];
    //     $event = Event::insert($insertAttr);
    //     return Response::json($event);
    // }

    // public function updateCalendar(Request $request)
    // {
    //     $where = array('id' => $request->id);
    //     $updateAttr = [
    //         'title' => $request->title,
    //         'tgl_mulai' => $request->start,
    //         'tgl_selesai' => $request->end,
    //     ];
    //     $event = Event::where($where)->update($updateAttr);

    //     return Response::json($event);
    // }

    // public function destroyCalendar(Request $request)
    // {
    //     $event = Event::where('id', $request->id)->delete();

    //     return Response::json($event);
    // }
}
