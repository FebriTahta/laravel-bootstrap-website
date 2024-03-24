@extends('layouts.raw')

@section('content')
<div class="col-md-12">
    @if(session('success'))
            <div class="alert alert-success text-white">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-white">
                {{ session('error') }}
            </div>
        @endif
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
            <p class="mb-0">{{$title}}</p>
            </div>
        </div>

        <form action="/admin-users-update" method="POST" enctype="multipart/form-data">@csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Username</label>
                        <input type="hidden" class="form-control" name="id" value="{{auth()->user()->id}}" required>
                        <input type="text" class="form-control" name="username" value="{{auth()->user()->name}}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" value="" required>
                    </div>
                </div>
              </div>
              <div class="card-footer" style="padding-bottom:130px">
                <button type="submit" class="btn btn-primary btn-sm ms-auto" style="margin-top:20px;float:right">SUBMIT</button>
              </div>
        </form>
    </div>
    
</div>
@endsection

@section('script')
    <script>

    </script>
@endsection