@extends('layouts_fe.raw')

@section('page_title')
    <title style="text-transform: uppercase">Daftar {{$data->konten_name}}</title>
@endsection

@if ($data->konten_model == 1)
    @section('meta_tag')
    <meta property="og:title" content="{{$post->post_title}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('images_thumbnail/'.$post->post_thumb)}}" />
    <meta property="og:description" content="{{ substr(strip_tags($post->post_desc), 0, 250) }}" />
    <meta property="og:url" content="http://smkkrian1.sch.id/post/{{$post->konten->konten_slug}}/{{$post->post_slug}}" />
    <meta name="theme-color" content="#FF0000">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" content="summary_large_image">
    <meta property='og:image:width' content='1200' />
    <meta property='og:image:height' content='627' />

    {{-- <link href="{{ asset('/assets3/css/detail-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets3/css/blog.css')}}" rel="stylesheet"> --}}
    @endsection
@endif

@section('content')

@include('frontend.component.css')

@if ($data->konten_model == 1)
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
@else
    <div class="rbt-page-banner-wrapper">
        <div class="rbt-banner-image"></div>
        <div class="rbt-banner-content">
            <div class="rbt-banner-content-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="page-list">
                                <li class="rbt-breadcrumb-item"><a href="/">Home</a></li>
                                <li>
                                    <div class="icon-right"><i class="feather-chevron-right"></i></div>
                                </li>
                                <li class="rbt-breadcrumb-item active text-capitalize">{{$data->konten_name ?? '...'}}</li>
                            </ul>
                            <div class=" title-wrapper">
                                <h1 class="title mb--0 text-capitalize">{{$data->konten_name ?? '...'}}</h1>
                                <a href="{{'/post/'.$data->konten_slug ?? '#'}}" class="rbt-badge-2">
                                    <div class="image">🎉</div> {{$data->post_count ?? '...'}} {{$data->konten_name ?? '...'}}
                                </a>
                            </div>
                            @if ($search)
                                <p class="description">{{'Menampilkan Pencarian : '.$search ?? null}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="rbt-course-top-wrapper mt--40 mt_sm--20">
                <div class="container">
                    <div class="row g-5 align-items-center">

                        <div class="col-lg-5 col-md-12">
                            <div class="rbt-sorting-list d-flex flex-wrap align-items-center">
                                <div class="rbt-short-item switch-layout-container">
                                    <ul class="course-switch-layout">
                                        <li class="course-switch-item"><button class="rbt-grid-view active" title="Grid Layout"><i class="feather-grid"></i> <span class="text">Grid</span></button></li>
                                        @if ($data->konten_model != 4)
                                            <li class="course-switch-item"><button class="rbt-list-view" title="List Layout"><i class="feather-list"></i> <span class="text">List</span></button></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="rbt-short-item">
                                    <span class="course-index">Showing 1-12 of {{$post->total()}} results</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-12">
                            <div class="rbt-sorting-list d-flex flex-wrap align-items-center justify-content-start justify-content-lg-end">
                                <div class="rbt-short-item">
                                    <form action="{{route('post.search', ['konten_slug' => $data->konten_slug ?? ''])}}" method="GET" class="rbt-search-style me-0">
                                        <input type="text" placeholder="Search Your {{$data->konten_name ?? '...'}}.." class="text-capitalize" name="search">
                                        <button type="submit" class="rbt-search-btn rbt-round-btn">
                                            <i class="feather-search"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="rbt-short-item">
                                    <div class="view-more-btn text-start text-sm-end">
                                        <button class="discover-filter-button discover-filter-activation rbt-btn btn-white btn-md radius-round">Filter<i class="feather-filter"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($kategori)
                    <div class="default-exp-wrapper default-exp-expand">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="rbt-sidebar-widget-wrapper filter-top-2 mt--60">
                                    <div class="row g-5">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="rbt-single-widget rbt-widget-categories">
                                                <div class="inner">
                                                    <h4 class="rbt-widget-title-2">Categories</h4>
                                                    <div class="row">
                                                        @foreach ($kategori as $key => $item)
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                                                            <input id="cat-list-{{$key}}" type="checkbox" name="cat-list{{$key}}">
                                                            <label for="cat-list-{{$key}}">{{$item->kategori_name}} &nbsp; <span class="badge badge-secondary">{{$item->post_count}}</span></label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @if ($data->konten_model == 2)
        @include('frontend.component.konten_model2',['post' => $post,'konten'=>$data])
    @endif

    @if ($data->konten_model == 3)
        @include('frontend.component.konten_model3',['post' => $post,'konten'=>$data])
    @endif

    @if ($data->konten_model == 4)
        @include('frontend.component.konten_model4',['post' => $post,'konten'=>$data])
    @endif

    @if ($data->konten_model == 5)
        @include('frontend.component.konten_model5',['post' => $post,'konten'=>$data])
    @endif
@endif

@endsection