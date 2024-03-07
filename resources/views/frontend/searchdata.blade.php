@extends('layouts_fe.raw')

@section('page_title')
    <title style="text-transform: capitalize">Pencarian Data {{$search ?? 'Default'}}</title>
@endsection

@section('content')

@include('frontend.component.css')

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
                            <li class="rbt-breadcrumb-item active text-capitalize">Search</li>
                        </ul>
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
                                    <li class="course-switch-item"><button class="rbt-grid-view active" title="Grid Layout"><i class="feather-grid"></i> <span class="text">
                                        {{$post->total()}} hasil ditemukan
                                    </span></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.component.global_search',['post'=>$post])

@endsection