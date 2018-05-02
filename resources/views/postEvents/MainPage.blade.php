@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="page-header">
     <h1>Events</h1>
    </div>

    <div class="card">
      <div class="card-header">
    <div class="row justify-content-lg-center">
      <div class="col-md">
        <a href="{{url('/')}}" class="btn btn-warning"> All Events</a>
      </div>
      <div class="col-md">
        <a href="{{url('list_culture')}}" class="btn btn-warning"> Culture</a>
      </div>
      <div class="col-md">
        <a href="{{url('list_sports')}}" class="btn btn-warning"> Sports</a>
      </div>
      <div class="col-md">
        <a href="{{url('list_other')}}" class="btn btn-warning"> Other</a>
      </div>

      <div class="col-md">
        <a href="{{route('postEvents.mostRecent')}}" class="btn btn-warning"> Most recent Date</a>
      </div>

      <div class="col-md">
        <a href="{{ route('postEvents.mostLiked')}}" class="btn btn-warning"> Most Likes</a>
      </div>

    </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row justify-content-lg-center" >
        <table class="table-bordered col-md-12">
          <thead>
          <tr>
            <th> Title </th>
            <th> Description </th>
            <th>Catalogue</th>
            <th> Date </th>
            <th>Likes</th>
            <th>Info</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($events as $event)
            <tr>
              <td> <a href="postEvents/{{$event->id}}">{{$event-> title}} </a></td>
              <td> {{$event-> description}}</td>
              <td>{{$event->catalogues}}</td>
              <td> {{$event-> date}} </td>
              <td> Likes:{{$event-> Likes}} </td>
              <td><a href="postEvents/{{$event->id}}" class="btn btn-warning">Detail</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
@endsection
