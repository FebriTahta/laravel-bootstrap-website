@extends('layouts_fe.raw')

@section('content')

<style>
    .badge {
        display: inline-block;
        padding: 1em 1.5em;
        font-size: 10px;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 25px;
        margin-bottom: 10px;
        margin-right: 5px;
    }

    .badge-sm {
        font-size: 75%;
        padding: 0.3em 0.9em;
    }

    .badge-info {
        background-color: #5bc0de;
    }
</style>

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
                            <h1 class="title mb--0 text-capitalize">{{'All '.$data->konten_name ?? '...'}}</h1>
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
                                    <li class="course-switch-item"><button class="rbt-list-view" title="List Layout"><i class="feather-list"></i> <span class="text">List</span></button></li>
                                </ul>
                            </div>
                            <div class="rbt-short-item">
                                <span class="course-index">Showing 1-6 of {{$post->total()}} results</span>
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
                                                    <div class="col-lg-1 col-md-2 col-sm-6 col-6">
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
    @include('frontend.component.konten_model2',['post' => $post])
@endif

@endsection