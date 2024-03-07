@extends('layouts_fe.raw')

@section('page_title')
    <title style="text-transform: capitalize">Alumni</title>
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
                            <li class="rbt-breadcrumb-item active text-capitalize">Daftar Alumni Terdata</li>
                        </ul>
                        <div class=" title-wrapper">
                            <h1 class="title mb--0 text-capitalize">Daftar Alumni Terdata</h1>
                            <a href="#" class="rbt-badge-2">
                                <div class="image">🎉</div> ({{$alumni->total()}}) Alumni
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
                                   
                                </ul>
                            </div>
                            <div class="rbt-short-item">
                                <span class="course-index">Showing 1-12 of Alumni results</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-12">
                        <div class="rbt-sorting-list d-flex flex-wrap align-items-center justify-content-start justify-content-lg-end">
                            <div class="rbt-short-item">
                                <form action="{{route('alumni.search')}}" method="GET" class="rbt-search-style me-0">
                                    <input type="text" placeholder="Cari Nama Alumni / Prestasi.." class="text-capitalize" name="search">
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
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                        <input id="cat-list-{{$key}}" type="checkbox" name="cat-list{{$key}}">
                                                        <label for="cat-list-{{$key}}">{{$item->kategori_name}} &nbsp; <span class="badge badge-primary" style="color: blue;">({{$item->total}})</span></label>
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

<div class="rbt-section-overlayping-top rbt-section-gapBottom" style="padding-top: 30px">
    <div class="container">
        <div class="row">
            @if ($alumni->total() > 0)
                @foreach ($alumni as $item)
                <div class="col-lg-4 col-12 col-sm-12" style="padding-bottom: 50px; max-width:100%">
                    <div class="mx-3" style="width: 100%">
                        <div class="rbt-course-grid-column">
                            <div class="single-column-20">
                                <div class="rbt-testimonial-box">
                                    <div class="inner">
                                        <div class="clint-info-wrapper">
                                            <div class="thumb">
                                                <img src="{{asset('alumni_image/'.$item->alumni_image)}}" style="max-width: 60px" alt="Clint Images">
                                            </div>
                                            <div class="client-info">
                                                <h5 class="title">{{$item->alumni_name}}</h5>
                                                @if ($item->alumni_jurusan == 'TITL')
                                                    <span>Teknik Instalasi Tenaga Listrik <i>"{{$item->alumni_tahun_ajaran2}}"</i></span>
                                                @elseif($item->alumni_jurusan == 'RPL')
                                                    <span>Rekayasa Perangkat Lunak <i>"{{$item->alumni_tahun_ajaran2}}"</i></span>
                                                @elseif($item->alumni_jurusan == 'WD')
                                                    <span>Teknik Pengelasan <i>"{{$item->alumni_tahun_ajaran2}}"</i></span>
                                                @elseif($item->alumni_jurusan == 'TPM')
                                                    <span>Teknik Permesinan <i>"{{$item->alumni_tahun_ajaran2}}"</i></span>
                                                @elseif($item->alumni_jurusan == 'TL')
                                                    <span>Teknik Logistik <i>"{{$item->alumni_tahun_ajaran2}}"</i></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="description">
                                            <p class="subtitle-3 text-capitalize">{{$item->alumni_kegiatan}}</p>
                                            <p class="subtitle" style="font-size: 14px">{{$item->alumni_keterangan}}</p>
                                            @if ($item->ulasan)
                                            <div class="rating mt--20">
                                                @if ($item->ulasan->rating_ulasan == 5)
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                @elseif($item->ulasan->rating_ulasan == 4)
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                @elseif($item->ulasan->rating_ulasan == 3)
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                @elseif($item->ulasan->rating_ulasan == 2)
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                @elseif($item->ulasan->rating_ulasan == 1)
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                    <a href="#"><i class="fa fa-star" style="color: gray"></i></a>
                                                @endif

                                                <p href="javascript:void(0)" style="float: right; font-size: 14px" class="subtitle"
                                                data-alumni_name = "{{$item->alumni_name}}"
                                                data-alumni_jurusan="{{ $item->alumni_jurusan }}"
                                                data-alumni_tahun = "{{$item->alumni_tahun_ajaran2}}"
                                                data-alumni_kegiatan = "{{$item->alumni_kegiatan}}"
                                                data-alumni_keterangan = "{{$item->alumni_keterangan}}"
                                                data-alumni_rating_ulasan = "{{$item->ulasan->rating_ulasan}}"
                                                data-alumni_deskripsi_ulasan = "{{$item->ulasan->deskripsi_ulasan}}"
                                                data-alumni_image="{{asset('alumni_image/'.$item->alumni_image)}}"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                >Baca ulasan</p></u>
                                            </div>
                                            @else
                                            <div class="rating mt--20">
                                                <a href="#">?</a>
                                                <a href="#">?</a>
                                                <a href="#">?</a>
                                                <a href="#">?</a>
                                                <a href="#">?</a>
                                                <p href="javascript:void(0)" style="float: right; font-size: 14px" class="subtitle">Belum ada ulasan</p></u>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                    
                @include('frontend.component.pagination',['post'=>$alumni])

            @else
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="conteiner" style="background: white; text-align: center; border-radius: 15px">
                        @include('layouts.null-data',['class'=>'background-white'])
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
            @endif
        </div>
    </div>
</div>


<div class="rbt-team-modal modal fade rbt-modal-default" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="feather-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="inner">
                    <div class="row g-5 row--30 align-items-center">
                        <div class="col-lg-4">
                            <div class="rbt-team-thumbnail">
                                <div class="thumb">
                                    <img class="w-100" src="" id="img" alt="Images">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="rbt-team-details">
                                <div class="author-info">
                                    <h4 class="title" id="alumni_name">_nama_alumni_</h4>
                                    <span id="alumni_jurusan"></span>"<span id="alumni_tahun"></span>" 
                                    <span class="subtitle text-capitalize" id="alumni_kegiatan"></span>
                                    <p class="subtitle" id="alumni_keterangan"></p>
                                    <hr>
                                    <p class="subtitle" id="deskripsi_ulasan"></p>
                            </div>
                        </div>
                    </div>
                    <div class="top-circle-shape"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var alumni_name = button.data('alumni_name')
            var alumni_jurusan = button.data('alumni_jurusan')
            var alumni_image = button.data('alumni_image')
            var alumni_tahun = button.data('alumni_tahun')
            var alumni_kegiatan = button.data('alumni_kegiatan')
            var alumni_keterangan = button.data('alumni_keterangan')
            var alumni_deskripsi_ulasan = button.data('alumni_deskripsi_ulasan')
            var modal = $(this)

            if (alumni_jurusan == "TITL") {
                alumni_jurusan = "Teknik Instalasi Tenaga Listrik";
            }else if (alumni_jurusan == "RPL") {
                alumni_jurusan = "Rekayasa Perangkat Lunak";
            }else if (alumni_jurusan == "WD") {
                alumni_jurusan = "Teknik Pengelasan";
            }else if (alumni_jurusan == "TPM") {
                alumni_jurusan = "Teknik Permesinan";
            }else if (alumni_jurusan == "TL") {
                alumni_jurusan = "Teknik Logistik"
            }

            modal.find('.modal-body #alumni_name').html(alumni_name);
            modal.find('.modal-body #alumni_jurusan').html(alumni_jurusan);
            modal.find('.modal-body #alumni_tahun').html(alumni_tahun);
            modal.find('.modal-body #alumni_kegiatan').html(alumni_kegiatan);
            modal.find('.modal-body #alumni_keterangan').html(alumni_keterangan);
            modal.find('.modal-body #deskripsi_ulasan').html(alumni_deskripsi_ulasan);
            modal.find('.modal-body #img').attr('src',alumni_image);
        })
    </script>
@endsection