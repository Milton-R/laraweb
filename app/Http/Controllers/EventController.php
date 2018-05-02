<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Event;
use Intervention\Image\Image;
Use DB;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['show','listculture','listsports','listother','index','mostLiked','mostRecent','like']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('postEvents.MainPage',array('events' => Event::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postEvents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'event_image'=>'image|nullable|max:1999',
            'catalogues'=>'required'
        ]);

        //handle file Upload
        if($request->hasFile('event_image')){
            $filenameWithExt = $request->file('event_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //GET JUST EXT
            $extension = $request->file('event_image')->getClientOriginalExtension();
            //filename to save
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path = $request->file('event_image')->storeAS('public/event_images', $fileNameToStore);

        } else{
            $fileNameToStore = 'noimage.jpg';
        }
        //create postEvents
        $event = new Event;
        $event-> title = $request->input('title');
        $event->description = $request->input('description');
        $event-> date = $request->input('date');
        $event-> user_id = auth()->user()->id;
        $event-> catalogues = $request->input('catalogues');
        $event-> event_image = $fileNameToStore;
        $event-> Likes = 0;
        $event->save();
        return redirect()->route('postEvents.index')->with('success', 'Event Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event=Event::find($id);
        return view('postEvents.show')->with('event', $event);
    }

    public function listculture()
    {
        $cultureEvents = Event::all();
        $cultevents = $cultureEvents->where('catalogues','Culture');

        return view('postEvents.MainPage',array('events' => $cultevents));
    }
    public function listsports()
    {
        $cultureEvents = Event::all();
        $cultevents = $cultureEvents->where('catalogues','Sports');

        return view('postEvents.MainPage',array('events' => $cultevents));
    }
    public function listother()
    {
        $cultureEvents = Event::all();
        $cultevents = $cultureEvents->where('catalogues','Other');

        return view('postEvents.MainPage',array('events' => $cultevents));
    }

    public function mostRecent()
    {
        $cultureEvents = Event::all();
        $cultevents = $cultureEvents->sortByDesc('date');

        return view('postEvents.MainPage',array('events' => $cultevents));
    }

    public function mostLiked()
    {
        $cultureEvents = Event::all();
        $cultevents = $cultureEvents->sortByDesc('Likes');

        return view('postEvents.MainPage',array('events' => $cultevents));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);
        if(auth()->user()->id !==$event->user_id){
            return redirect('postEvents')->with('error', 'Not authorised');
        }
        return view('postEvents.edit')->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'event_image' => 'image|nullable|max:1999',
            'catalogues'=>'required'
        ]);

        //handle file Upload
        if($request->hasFile('event_image')){
            $filenameWithExt = $request->file('event_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //GET JUST EXT
            $extension = $request->file('event_image')->getClientOriginalExtension();
            //filename to save
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path = $request->file('event_image')->storeAS('public/event_images', $fileNameToStore);

        }

        //create postEvents
        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event-> date = $request->input('date');
        $event->catalogues=$request->input('catalogues');
        if($request->hasFile('event_image')){
            $event->event_image =$fileNameToStore;
        }
        $event->save();
        return redirect('postEvents')->with('success', 'Event Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     * @param  int  $id
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if(auth()->user()->id !==$event->user_id){
            return redirect('postEvents')->with('error', 'Not authorised');
        }

        if($event->event_image != 'noimage.jpg'){

            Storage::delete('public/event_images/'.$event->event_image);

        }
        $event->delete();
        return redirect('postEvents')->with('success', 'Event Removed');
    }

    public function like(Request $request, $id)
    {
        //Event::find($id)->increment('Likes', 1);
        $event=Event::find($id);
        $event->increment('Likes', 1);
        $event->save();
        return redirect()->back()->with('success', 'Event Liked');
    }
}

