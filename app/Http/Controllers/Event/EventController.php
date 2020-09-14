<?php

namespace App\Http\Controllers\Event;

use App\Event;
use App\Http\Controllers\Controller;
use App\Priority;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Auth;

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
        $event = Event::latest()->paginate(5);
        $priority = Priority::orderBy('name', 'ASC')->get();
        return view('event.index', compact('event', 'priority'));
    }

    public function calendar()
    {
        return view('event.calendar');
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
        $fotoUrl = $foto->storeAs("image/event", "{$slug}.{$foto->extension()}");

        $attr['foto'] = $fotoUrl;

        Event::create($attr);
        return redirect()->to('/inkubator/event');
        // // session()->flash('success', 'The Post was created');


        // $this->validate($request, [
        //     'title' => 'required|min:3',
        //     'foto' => 'required',
        //     'priority_id' => 'required',
        //     'event' => 'required',
        //     'publish' => 'required'
        // ]);


        // $event = $request->all();
        // $event['slug'] = \Str::slug($request->title);
        // Event::create($event);

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
            // 'foto' => 'required',
            'priority_id' => 'required',
            'event' => 'required',
            'publish' => 'required',
        ]);

        if (request()->file('foto')) {
            \Storage::delete($event->foto);
            $foto = request()->file('foto');
            $fotoUrl = $foto->store("image/event");
        } else {
            $foto = $event->foto;
        }

        $foto = request()->file('foto');
        $fotoUrl = $foto->store("image/event");

        $attr['foto'] = $fotoUrl;

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
        
    }
}
