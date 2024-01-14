@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-kategori','text'=>'BACK'])

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">CREATE KATEGORI</p>
            </div>
          </div>
          <form action="/admin-kategori-store" method="POST">@csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <code style="font-size:12px">Hanya kategori aktif yang dapat dikaitkan dengan post</code>
                    </div>
                    <div class="col-md-9 row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Kategori Name</label>
                                <input class="form-control" name="kategori_name" type="text" placeholder="input kategori name"  value="{{ old('input.kategori_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">kategori Status</label>
                                <select name="kategori_status" class="form-control" id="kategori_status" required>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
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