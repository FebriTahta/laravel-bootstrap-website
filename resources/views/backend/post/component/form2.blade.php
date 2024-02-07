<div class="col-md-12">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
            <p class="mb-0">{{$title}}</p>
            </div>
        </div>
     
        @if ($action == 'create')
        <form id="form_store" method="POST" enctype="multipart/form-data">@csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" value="{{$konten->id}}" name="konten_id" required>
                        <input type="hidden" class="form-control" value="{{$konten->konten_model}}" name="konten_model" required>
                    </div>
                    <div class="col-md-6">
                        <label>Post Thumbnail <span class="text-danger">Max : 1MB</span> </label>
                        <input type="file" name="post_thumb" id="post_thumb" accept="image/*" class="form-control" required>
                        <img id="imagePreview" style="margin-top: 20px; max-width:300px; margin-bottom:20px" src="{{asset('assets\img\illustrations\icon-documentation.svg')}}" style="max-width: 300px; max-height: 300px;" alt="Image Preview">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Post Title</label>
                            <input class="form-control" name="post_title" type="text" placeholder="input post title"  value="{{ old('input.post_title') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Post Status</label>
                            <select name="post_status" class="form-control" id="post_status" required>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Pilih Jenis Kategori <span class="text-danger">Max : 3</span></label>
                        <br>
                        @foreach ($kategori as $item)
                            <input type="checkbox" name="kategori_id[]" value="{{$item->id}}"> <label style="margin-right:10px">{{$item->kategori_name}}</label>
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">Post Desc</label>
                            <textarea name="post_desc" class="form-control" id="summernote" cols="30" rows="5" required></textarea>
                        </div>
                    </div>

                    {{-- multi image --}}
                    @if ($konten->konten_model == 2 || $konten->konten_model == 5) 
                        <div class="col-md-6">
                            <label>Another Image <span class="text-danger">Max : 2MB (boleh kosong) </span> </label>
                            <div class="row">
                                <div class="col-md-10" style="margin-bottom:5px">
                                    <input type="file" name="images[]" id="images" accept="image/*" class="form-control">
                                </div>
                                <div class="col-md-2 text-center" style="margin-bottom:5px">
                                    <button class="btn btn-md btn-primary add_images w-100" type="button"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row images_wrapp"></div>
                        </div>
                    @endif
                    
                    {{-- multi file --}}
                    @if ($konten->konten_model == 4)
                        <div class="col-md-12">
                            <label>Source File</label>
                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 5px">
                                    <input type="file" name="file" class="form-control" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,.pdf">
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-md-6">
                        <label>Another File </label>
                        <div class="row">
                            <div class="col-md-10" style="margin-bottom:5px">
                                <input type="file" name="file[]" id="file"  accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,.pdf" class="form-control">
                            </div>
                            <div class="col-md-2 text-center" style="margin-bottom:5px">
                                <button class="btn btn-md btn-primary add_file w-100" type="button"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row file_wrapp"></div>
                    </div>
                    @endif
                </div>
              </div>
              <div class="card-footer" style="padding-bottom:130px">
                <button type="submit" class="btn btn-primary btn-sm ms-auto" style="margin-top:20px;float:right">SUBMIT</button>
              </div>
        </form>
        @endif

        {{-- ########################################### EDIT ################################################### --}}

        @if ($action == 'edit')
            <form id="form_update" method="POST" enctype="multipart/form-data">@csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" class="form-control" value="{{$data->id}}" name="id" required>
                            <input type="hidden" class="form-control" value="{{$konten->id}}" name="konten_id" required>
                            <input type="hidden" class="form-control" value="{{$konten->konten_model}}" name="konten_model" required>
                        </div>
                        <div class="col-md-6">
                            <label>Post Thumbnail <span class="text-danger">Max : 1MB</span> </label>
                            <input type="file" name="post_thumb" id="post_thumb" accept="image/*" class="form-control">
                            <img id="imagePreview" style="margin-top: 20px; max-width:300px; margin-bottom:20px" src="{!! asset('images_thumbnail/' . $data->post_thumb) !!}" style="max-width: 300px; max-height: 300px;" alt="Image Preview">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Post Title</label>
                                <input class="form-control" name="post_title" type="text" placeholder="input post title"  value="{{ $data->post_title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Post Status</label>
                                <select name="post_status" class="form-control" id="post_status" required>
                                    <option value="1" @if ($data->post_status == 1)
                                        selected
                                    @endif>Active</option>
                                    <option value="0" @if ($data->post_status == 0)
                                        selected
                                    @endif>InActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <label>Pilih Jenis Kategori <span class="text-danger">Max : 3</span></label>
                            <br>
                            @foreach ($kategori as $item)
                                <input type="checkbox" name="kategori_id[]" value="{{$item->id}}" {{ in_array($item->id, $selectedCategories) ? 'checked' : '' }}> 
                                <label style="margin-right:10px">{{$item->kategori_name}}</label>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Desc </label>
                                <textarea name="post_desc" class="form-control" id="summernote" cols="30" rows="8" required>{!! $data->post_desc !!}</textarea>
                            </div>
                        </div>

                        @if ($konten->konten_model == 2 || $konten->konten_model ==5)
                            <div class="col-md-12"></div>
                            <div class="col-md-6">
                                <label>Another Image <span class="text-danger">Max : 2MB (boleh kosong) </span> </label>
                                <div class="row">
                                    <div class="col-md-10" style="margin-bottom:5px">
                                        <input type="file" name="images[]" id="images" accept="image/*" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-center" style="margin-bottom:5px">
                                        <button class="btn btn-md btn-primary add_images w-100" type="button"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="row images_wrapp">
                                    {{-- multi image --}}
                                </div>
                            </div>
                        @endif

                        @if ($konten->konten_model == 4)
                            <div class="col-md-12">
                                <label>Source File Tersimpan : 
                                    @if (count($data->file) > 0)
                                        <span class="text-primary">{{substr($data->file[0]->file_name,11)}}</span>        
                                    @else
                                        <span class="text-danger">Kosong...</span>
                                    @endif
                                    
                                </label>
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom: 5px">
                                        <input type="file" name="file" class="form-control" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="col-md-6">
                            <label>Another File <span class="text-danger"> </span> </label>
                            <div class="row">
                                <div class="col-md-10" style="margin-bottom:5px">
                                    <input type="file" name="file[]" id="file" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="form-control">
                                </div>
                                <div class="col-md-2 text-center" style="margin-bottom:5px">
                                    <button class="btn btn-md btn-primary add_file w-100" type="button"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row file_wrapp">
                                {{-- multi image --}}
                            </div>
                        </div>
                        @endif
                    
                    </div>
                </div>
                <div class="card-footer" style="padding-bottom:130px">
                    <button type="submit" class="btn btn-primary btn-sm ms-auto" style="margin-top:20px;float:right">SUBMIT</button>
                </div>
            </form>

            @if ($konten->konten_model ==2 || $konten->konten_model ==5)
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-md-12">
                            <p>List images yang sudah ditambahkan sebelumnya...</p>
                        </div>
                        @foreach ($data->image as $key => $item)
                            <div class="col-md-4 image-container" id="imageContainer_{{ $item->id }}">
                                <img src="{{ asset($item->image_link) }}" id="image_{{ $item->id }}" style="max-width: 100%; width:100%; margin-bottom:10px; max-height:400px; object-fit: cover" alt="">
                                <label>{{$item->image_name}}</label>
                                <button type="button" class="btn btn-md btn-danger remove-image" data-key="{{ $item->id }}" style="max-width:100%;width: 100%">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
       
            @if ($konten->konten_model !== 4)
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-12">
                        <p>List File yang sudah ditambahkan sebelumnya...</p>
                    </div>
                    @foreach ($data->file as $key => $item)
                        <div class="col-md-4 file-container" id="fileContainer_{{ $item->id }}">
                            <label>{{$item->file_name}}</label>
                            <button type="button" class="btn btn-md btn-danger remove-file" data-key="{{ $item->id }}" style="max-width:100%;width: 100%">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endif
    </div>
</div>

