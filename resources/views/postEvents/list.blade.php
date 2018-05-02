@extends('layouts.app')
@section('content')

@if(count($events)> 1)
<table>
  <thead>
    <tr>
      <th> eventID </th>
      <th> title </th>
      <th> description </th>
      <th> date </th>
      <th> created_at </th>
      <th> updated_at </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($events as $event)
      <tr>
        <td> {{$event-> id}} </td>
          <td> <a href="/list/{{$event-> id}}">{{$event-> title}} </a> </td>
            <td> {{$event-> description}} </td>
              <td> {{$event-> date}} </td>
                <td> {{$event-> created_at}} </td>
                  <td> {{$event-> updated_at}} </td>
      </tr>
    @endforeach
  </tbody>
</table>
@else
<p>No events found</p>
@endif
@endsection
