@if(count($errors)>0)
  @foreach($error->() as $error)
      <div class="alert alert-danger">
        {{$error}}
      </div>
  @endforeach
@endif
@if(session('success'))
  <div class="alert alert-success">
    {{sesion('success')}}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger">
    {{session('error')}}
    
  </div>
@endif