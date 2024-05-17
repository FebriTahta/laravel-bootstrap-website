@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-socialmedia','text'=>'BACK'])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                <p class="mb-0">CREATE NEW {{$title}}</p>
                </div>
            </div>
            <form action="/admin-socialmedia-store" method="POST">@csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <code style="font-size:12px">Hanya dapat membuat {{$title}} yang belum pernah dibuat sebelumnya</code>
                        </div>
                        <div class="col-md-9 row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Social Media Name</label>
                                    <select name="socialmedia_name" class="form-control" id="kategori_name" required>
                                        @foreach ($sosmed as $item)
                                            <option value="{{$item['name']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Social Media Source</label> <small class="text-danger" id="socialmedia_link_err" class="error"></small>
                                    <input class="form-control" id="socialmedia_source" name="socialmedia_source" type="text" placeholder="input socialmedia source" value="{{ old('input.socialmedia_source') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="button_submit" class="btn btn-primary btn-sm ms-auto" style="margin-top:20px;float:right">SUBMIT</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const socialMediaSourceInput = document.getElementById('socialmedia_source');
            const errorElement = document.getElementById('socialmedia_link_err');

            socialMediaSourceInput.addEventListener('input', function() {
                const input = this.value;

                // Reset error message
                errorElement.textContent = '';

                // Check if input starts with https://
                if (!input.startsWith('https://')) {
                    errorElement.textContent = ' * diawali https:// ';
                    document.getElementById('button_submit').disabled = true;
                }else{
                    document.getElementById('button_submit').disabled = false;
                }
            });
        });
    </script>
@endsection