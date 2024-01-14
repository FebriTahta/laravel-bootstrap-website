@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-konten','text'=>'BACK'])

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">CREATE KONTEN</p>
            </div>
          </div>
          <form action="/admin-konten-store" method="POST">@csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <code style="font-size:12px">Konten hanya dapat dikaitkan dengan menu yang tidak memiliki submenu atau ke submenu</code>
                    </div>
                    <div class="col-md-9 row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Konten Name</label>
                                <input class="form-control" name="konten_name" type="text" placeholder="input konten name"  value="{{ old('input.konten_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Konten Status</label>
                                <select name="konten_status" class="form-control" id="konten_status" required>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Konten Model</label>
                                <select name="konten_model" class="form-control" id="konten_model" required>
                                    <option value="1">Single (diambil data terbaru)</option>
                                    <option value="2">Multi (list data seperti berita)</option>
                                    <option value="3">Multi (list image seperti guru)</option>
                                    <option value="4">Multi (list item e-comm seperti ebook)</option>
                                    <option value="5">Multi (list data seperti artikel)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Pilih menu dan submenu (1.</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="radio" name="parent_option" id="menu_parent" value="menu"> <label>Menu</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="radio" name="parent_option" id="submenu_parent" value="submenu"> <label>Submenu</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Pilih parent menu dan submenu (2.</label>
                            <select class="form-control" id="menu_id">
                                @foreach ($menu as $item)
                                    <option value="{{$item->id}}">{{$item->menu_name}}</option>
                                @endforeach
                            </select>
                            <select class="form-control" id="submenu_id">
                                @foreach ($submenu as $item)
                                    <option value="{{$item->id}}">{{$item->submenu_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="parent_value" id="parent_value" class="form-control">
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


@section('script')
  <script>
     $(document).ready(function () {
        // Sembunyikan submenu_id secara default
        $("#submenu_id").hide();
        $("#menu_id").hide();

        // Tangani perubahan pada radio button
        $('input[type="radio"]').change(function () {
            if (this.id === "menu_parent") {
                console.log(this.id);
                $("#menu_id").show();
                $("#submenu_id").hide();
                
                var default_menu_value = $("#menu_id").val();
                console.log(default_menu_value);
                $("#parent_value").val(default_menu_value)

            } else if (this.id === "submenu_parent") {
                console.log(this.id);
                $("#menu_id").hide();
                $("#submenu_id").show();

                var default_submenu_value = $("#submenu_id").val();
                $("#parent_value").val(default_submenu_value)
            }
        });

        $('#menu_id').on('change',function () {
            $("#parent_value").val(this.value)
        })

        $('#submenu_id').on('change',function () {
            $("#parent_value").val(this.value)
        })
    });
  </script>
@endsection