@extends('layouts.raw')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
            <p class="mb-0">{{$title}}</p>
            </div>
        </div>
     
        <form id="form_store" method="POST" enctype="multipart/form-data">@csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" name="id" value="{{$profile->id ?? null}}">
                    </div>
                    <div class="col-md-6">
                        <label>Profile Logo <span class="text-danger">Max : 1MB</span> </label>
                        <input type="file" name="profile_logo" id="profile_logo" accept="image/*" class="form-control" >
                        <img id="imagePreview" style="margin-top: 20px; max-width:300px; margin-bottom:20px" 
                        @if ($profile)
                            src="{{asset('images_profile/'.$profile->profile_logo)}}"    
                        @else 
                            src="{{asset('assets\img\illustrations\icon-documentation.svg')}}"
                        @endif style="max-width: 300px; max-height: 300px;" alt="Image Preview">
                    </div>
                    <div class="col-md-6">
                        <label>Profile Thumbnail <span class="text-danger">Max : 1MB</span> </label>
                        <input type="file" name="profile_thumb" id="profile_thumb" accept="image/*" class="form-control" >
                        <img id="imagePreview2" style="margin-top: 20px; max-width:300px; margin-bottom:20px" 
                        @if ($profile)
                            src="{{asset('images_profile/'.$profile->profile_thumb)}}"    
                        @else 
                            src="{{asset('assets\img\illustrations\icon-documentation.svg')}}"
                        @endif style="max-width: 300px; max-height: 300px;" alt="Image Preview">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Name</label>
                            <input class="form-control" name="profile_name" type="text" placeholder="input profile name"  value="{{ $profile->profile_name ?? null }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Title</label>
                            <input class="form-control" name="profile_title" type="text" placeholder="input profile title"  value="{{$profile->profile_title ?? null}}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Subtitle</label>
                            <input class="form-control" name="profile_subtitle" type="text" placeholder="input profile subtitle"  value="{{ $profile->profile_subtitle ?? null }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Badge</label>
                            <input class="form-control" name="profile_badge" type="text" placeholder="input profile badge"  value="{{ $profile->profile_badge ?? null }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Link 1</label>
                            <input class="form-control" name="profile_link1" type="text" placeholder="input profile link"  value="{{ $profile->profile_link1 ?? null }}" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Profile Hero Image <span class="text-danger">Max : 1MB</span> </label>
                        <input type="file" name="profile_heroimage" id="profile_heroimage" accept="image/*" class="form-control" >
                        <img id="imagePreview3" style="margin-top: 20px; max-width:300px; margin-bottom:20px"
                        @if ($profile)
                            src="{{asset('images_profile/'.$profile->profile_heroimage)}}"    
                        @else 
                            src="{{asset('assets\img\illustrations\icon-documentation.svg')}}"
                        @endif style="max-width: 300px; max-height: 300px;" alt="Image Preview">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Hero Title</label>
                            <input class="form-control" name="profile_herotitle" type="text" placeholder="input hero title"  value="{{$profile->profile_herotitle ?? null}}" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Hero Subtitle</label>
                            <input class="form-control" name="profile_herosubtitle" type="text" placeholder="input hero subtitle"  value="{{$profile->profile_herosubtitle}}" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Hero Desc</label>
                            <textarea name="profile_herodesc" id="profile_herodesc" cols="30" rows="3" class="form-control">{{$profile->profile_herodesc}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Contact Number</label>
                            <input class="form-control" name="profile_contactnumber" type="number" placeholder="input contact number"  value="{{ $profile->profile_contactnumber }}" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Feature Title</label>
                            <input class="form-control" name="profile_featuretitle" type="text" placeholder="input feature title"  value="{{$profile->profile_featuretitle}}" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Feature Desc</label>
                            <textarea name="profile_featuredesc" id="profile_featuredesc" cols="30" rows="3" class="form-control">{{$profile->profile_featuredesc}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Feature Link</label>
                            <input class="form-control" name="profile_featurelink" type="text" placeholder="input feature link"  value="{{$profile->profile_featurelink}}" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Address</label>
                            <textarea name="profile_address" id="profile_address" cols="30" rows="3" class="form-control">{{$profile->profile_address}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Profile Email</label>
                            <input class="form-control" name="profile_email" type="email" placeholder="input email"  value="{{$profile->profile_email}}" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Profile Map Longitude</label>
                            <input class="form-control" name="profile_maplong" type="text" placeholder="input longitude"  value="{{$profile->profile_maplong}}" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-control-label">Profile Map Latitude</label>
                            <input class="form-control" name="profile_maplat" type="text" placeholder="input latitude"  value="{{$profile->profile_maplat}}" >
                        </div>
                    </div>
                  
                   
                    <div class="col-md-6">
                        <label>Hero Slide Media <span class="text-danger">Max : 10MB (Minimal 1 Maksimal 3) </span> </label>
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
                </div>
              </div>
              <div class="card-footer" style="padding-bottom:130px">
                <button type="submit" class="btn btn-primary btn-sm ms-auto" style="margin-top:20px;float:right">SUBMIT</button>
              </div>
        </form>
    </div>
    <div class="card mt-5">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center">
            <p class="mb-0">{{$title}} IMAGE HEADER</p>
            </div>
        </div>
        <div class="card-body border-top">
            <div class="row">
                <div class="col-md-12">
                    <p>List images yang sudah ditambahkan sebelumnya...</p>
                    @if (count($profile->image) == 0)
                        <p class="text-danger">belum ada...</p>
                    @endif
                </div>
                @foreach ($profile->image as $key => $item)
                    <div class="col-md-4 image-container" id="imageContainer_{{ $item->id }}">
                        <img src="{{ asset($item->image_link) }}" id="image_{{ $item->id }}" style="max-width: 100%; width:100%; margin-bottom:10px; max-height:150px; object-fit: cover" alt="">
                        <label>{{$item->image_name}}</label>
                        <button type="button" class="btn btn-md btn-danger remove-image" data-key="{{ $item->id }}" style="max-width:100%;width: 100%">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('script')
    @include('backend.setting.js_form')
@endsection