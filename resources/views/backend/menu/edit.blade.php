@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-menus','text'=>'BACK'])

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">EDIT MENU</p>
            </div>
          </div>
          <form action="/admin-menu-update/{{$menu->id}}" method="POST">@csrf
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Menu Name</label>
                      <input class="form-control" name="menu_name" type="text" placeholder="input menu name" value="{{$menu->menu_name}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Menu Status</label>
                      <select name="menu_status" class="form-control" id="menu_status" required>
                        <option value="1" @if ($menu->menu_status == 1)
                            selected
                        @endif>Active</option>
                        <option value="0" value="1" @if ($menu->menu_status == 0)
                            selected
                        @endif>InActive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm ms-auto">SUBMIT</button>
              </div>
          </form>
        </div>
    </div>
</div>

@endsection