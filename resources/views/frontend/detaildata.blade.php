@extends('layouts_fe.raw')

@section('page_title')
    <title style="text-transform: uppercase">{{$post->post_title}}</title>
@endsection

@section('meta_tag')
    <meta property="og:title" content="{{$post->post_title}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('images_thumbnail/'.$post->post_thumb)}}" />
    <meta property="og:description" content="{{substr($post->post_desc,0,250)}}" />
    <meta property="og:url" content="http://smkkrian1.sch.id/post/{{$post->konten->konten_slug}}/{{$post->post_slug}}" />
    <meta name="theme-color" content="#FF0000">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" content="summary_large_image">
    <meta property='og:image:width' content='1200' />
    <meta property='og:image:height' content='627' />

    <link href="{{ asset('/assets3/css/detail-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets3/css/blog.css')}}" rel="stylesheet">
@endsection

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
            <h1 class="title text-capitalize">{{$post->post_title}}</h1>
            @foreach ($post->kategori as $item)
                <span class="badge badge-sm badge-info">{{$item->kategori_name}}</span>
            @endforeach
            
        </div>
    </div>

    <div class="rbt-blog-details-area rbt-section-gapBottom breadcrumb-style-max-width" >
        <div class="blog-content-wrapper rbt-article-content-wrapper" >
            <div class="content" >
                <div class="post-thumbnail mb--30 position-relative wp-block-image alignwide" >
                    <figure>
                        <img src="{{asset('images_thumbnail/'.$post->post_thumb)}}" alt="Blog Images" style="max-width: 100%; width:100%">
                    </figure>
                </div>
                <p style="max-width: 100%">{!!$post->post_desc!!}</p>
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

                @if ($post->file_count > 0)
                    <div style="margin-top: 50px">
                        <div class="row">
                        @foreach ($post->file as $item)
                        
                            <div class="col-sm-12 col-lg-4 col-md-4 col-12" style="margin-bottom: 10px">
                                <a class="rbt-btn btn-gradient hover-icon-reverse btn-sm" style="max-width: 100%; width:100%" href="{{asset('file_ebook/'.$item->file_name)}}">
                                    <span class="icon-reverse-wrapper">
                                        <span class="btn-text">
                                            @if (strlen(substr($item->file_name,13)) > 22)
                                                {{ substr($item->file_name,13, 22) }} ..
                                            @else
                                                {{ substr($item->file_name,13) }}
                                            @endif
                                        </span>
                                    <span class="btn-icon"><i class="fa fa-download"></i></span>
                                    <span class="btn-icon"><i class="fa fa-download"></i></span>
                                    </span>
                                </a>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection