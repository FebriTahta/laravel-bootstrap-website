@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-menus','text'=>'BACK'])

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">CREATE MENU</p>
            </div>
          </div>
          <form action="/admin-menu-store" method="POST">@csrf
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Menu Name</label>
                      <input class="form-control" name="menu_name" type="text" placeholder="input menu name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Menu Status</label>
                      <select name="menu_status" class="form-control" id="menu_status" required>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm ms-auto" style="margin-top:20px;float:right">SUBMIT</button>
              </div>
          </form>
        </div>
    </div>
</div>

@endsection