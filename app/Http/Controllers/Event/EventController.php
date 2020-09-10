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
        return view('event.index');
    }

    public function calendar()
    {
        return view('event.calendar');
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

        // return 'success';
        // $event = new Event;
        // $event->title = $request->title;
        // $event->slug = \Str::slug($request->title);
        // $event->foto = $request->foto;
        // $event->priority_id = $request->priority_id;
        // $event->event = $request->event;
        // $event->publish = $request->publish;
        // $event->save();

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
}
