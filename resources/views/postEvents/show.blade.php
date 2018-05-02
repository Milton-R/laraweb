@extends('layouts.app')

@section('content')

   <a href="{{ url('/') }}" class="btn btn-black"> Go Back</a>
    <div class="container">
        <div class="card">
            <div class="card-header"> <h1>{{$event-> title}}</h1></div>
            <div class="card-body">
                <img class="card-img-top" style="width:50%" src="{{ asset('/storage/event_images/'.$event->event_image)}}"/></br>
                <h3>Description: {{$event->description}}</h3></br>
                <h3>Email: {{$event->user->email}}</h3></br>
                <h3>Date: {{$event->date}}</h3>
            </div>

            <div class="card-footer">
                <div>
                    <form  method="POST" action="{{ route('postEvents.like',$event->id)}}">
                        <input name="_method" type="hidden" value="PUT">
                        @csrf
                        <button name="Likes" type="submit" class="btn btn-red" >
                            {{ __('Like')}}
                        {</button>
                        {{$event->Likes}}
                    </form>
                </div>
                <small>Written:{{$event->timestamp}}</small>
            </div>


        @guest
            @else
      <a href="{{ route('postEvents.edit',$event->id) }}" class="btn btn-outline-dark"> Edit </a>

    </div>
@endguest
@endsection
