@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <div class="container">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> title </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td> <a href="postEvents/{{$event->id}}">{{$event-> title}} </a></td>
                                        <td> <a href="{{ route('postEvents.edit',$event->id) }}" class="btn btn-outline-dark"> Edit </a></td>
                                        <td><form  method="POST" action="{{ route('postEvents.destroy',$event->id)}}" class="float-right">
                                                <input name="_method" type="hidden" value="DELETE">
                                                @csrf
                                                <button type="submit" class="btn btn-red">
                                                    {{ __('Delete')}}
                                                </button>
                                            </form> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
