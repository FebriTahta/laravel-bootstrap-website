<div class="col-12">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong class="text-white" style="font-size:12px">{{$message}}</strong>
      </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <strong class="text-white" style="font-size:12px">{{$message}}</strong>
      </div>
    @endif
  </div>