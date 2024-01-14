@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-menus','text'=>'BACK'])

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">EDIT SUB-MENU</p>
            </div>
          </div>
          <form action="/admin-submenu-update/{{$submenu->id}}" method="POST">@csrf
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Sub Menu Name</label>
                      <input class="form-control" name="submenu_name" type="text" placeholder="input sub-menu name" value="{{$submenu->submenu_name}}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Menu Status</label>
                      <select name="submenu_status" class="form-control" id="submenu_status" required>
                        <option value="1" @if ($submenu->submenu_status == 1)
                            selected
                        @endif>Active</option>
                        <option value="0" @if ($submenu->submenu_status == 0)
                            selected
                        @endif>InActive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Parent Menu</label>
                      <select name="menu_id" class="form-control text-capitalize" id="menu_id" required>
                        <option value="">Choose Parent Menu</option>
                        @foreach ($menu as $item)
                            <option value="{{$item->id}}" @if ($item->id == $submenu->menu_id)
                                selected
                            @endif>{{$item->menu_name}}</option>
                        @endforeach
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