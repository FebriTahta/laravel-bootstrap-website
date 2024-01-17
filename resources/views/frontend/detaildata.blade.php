@extends('layouts_fe.raw')

@section('content')
@include('frontend.component.css')
<div class="rbt-overlay-page-wrapper">
    <div class="breadcrumb-image-container breadcrumb-style-max-width">
        <div class="breadcrumb-image-wrapper">
            <img src="{{asset('assets_fe/images/bg/bg-image-10.jpg')}}" alt="Education Images">
        </div>
        <div class="breadcrumb-content-top text-center">
            <ul class="meta-list justify-content-center mb--10">
                <li class="list-item">
                    <i class="feather-clock"></i>
                    <span>{{Carbon\Carbon::parse($post->created_at)->format('l / d F Y')}}</span>
                </li>
            </ul>
            <h1 class="title text-capitalize" style="font-size: 35px">{{$post->post_title}}</h1>
            @foreach ($post->kategori as $item)
                <span class="badge badge-sm badge-info">{{$item->kategori_name}}</span>
            @endforeach
            
        </div>
    </div>

    <div class="rbt-blog-details-area rbt-section-gapBottom breadcrumb-style-max-width">
        <div class="blog-content-wrapper rbt-article-content-wrapper">
            <div class="content">
                <div class="post-thumbnail mb--30 position-relative wp-block-image alignwide">
                    <figure>
                        <img src="{{asset('images_thumbnail/'.$post->post_thumb)}}" alt="Blog Images">
                        <figcaption>Business and core management app are for enterprise.</figcaption>
                    </figure>
                </div>
                <p>{!!$post->post_desc!!}</p>

                
                @if ($post->image_count > 0)
                    @if ($post->image_count % 3 == 0)
                        <div class="row">
                            @foreach ($post->image as $img)
                                <div class="col-md-4">
                                    <img src="{{asset('images_another/'.$img->image_name)}}" style="height: 350px;max-width: 100%; object-fit: contain"  alt="{{$img->img_name}}">
                                </div>
                            @endforeach
                        </div>
                    @elseif($post->image_count % 2 == 0)
                    <div class="row">
                        @foreach ($post->image as $img)
                            <div class="col-md-6">
                                <img src="{{asset('images_another/'.$img->image_name)}}" style="height: 250px;max-width: 100%; object-fit: contain" alt="{{$img->img_name}}">
                            </div>
                        @endforeach
                    </div>
                    @else
                        @foreach ($post->image as $img)
                            <div class="col-md-12">
                                <img src="{{asset('images_another/'.$img->image_name)}}" style="max-width: 100%" alt="{{$img->img_name}}">
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

@endsection