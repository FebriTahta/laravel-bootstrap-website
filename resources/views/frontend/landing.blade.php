@extends('layouts_fe.raw')

@section('page_title')
    <title style="text-transform: capitalize">SMK KRIAN 1 SIDOARJO</title>
    <style>
        .edu_bounce_loop {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

@if ($profile)
<div class="rbt-slider-main-wrapper position-relative">
    <div class="swiper rbt-banner-activation rbt-slider-animation rbt-arrow-between">
        <div class="swiper-wrapper">
            @foreach ($profile->image as $item)
            <div class="swiper-slide">
                <div class="rbt-banner-area rbt-banner-6">
                    <img src="{{ asset('images_another/'.$item->image_name) }}" alt="Fallback Image" style="width: 100%;">
                </div>
            </div>
            @endforeach
        </div>
        <div class="rbt-swiper-arrow rbt-arrow-left">
            <div class="custom-overfolow">
                <i class="rbt-icon feather-arrow-left"></i>
                <i class="rbt-icon-top feather-arrow-left"></i>
            </div>
        </div>
        <div class="rbt-swiper-arrow rbt-arrow-right">
            <div class="custom-overfolow">
                <i class="rbt-icon feather-arrow-right"></i>
                <i class="rbt-icon-top feather-arrow-right"></i>
            </div>
        </div>
    </div>
    <div class="swiper rbt-swiper-thumb rbtmySwiperThumb">
        <div class="swiper-wrapper">
            @foreach ($profile->image as $item)
            <div class="swiper-slide">
                <img src="{{ asset('images_another/'.$item->image_name) }}" alt="Banner Images" />
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="rbt-banner-area rbt-banner-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pb--120 pt--70">
                <div class="content">
                    <div class="inner">
                        <div class="rbt-new-badge rbt-new-badge-one">
                            <span class="rbt-new-badge-icon">🏆</span> {{$profile->profile_badge ?? 'Sekolah Menengah Kejuruan' }}
                        </div>

                        <h1 class="title">
                            {{$profile->profile_title ?? 'SMK 1 Krian <br> Sidoarjo Jawa Timur.'}}
                        </h1>
                        <p class="description">
                            {{$profile->profile_subtitle ?? 'Sekolah kejuruan bergengsi yang menyuguhkan berbagai.
                            <strong>Program Unggulan.</strong>'}}
                        </p>
                        <div class="slider-btn">
                            <a class="rbt-btn btn-gradient hover-icon-reverse" href="{{$profile->profile_link1 ?? '#'}}">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">Baca Selengkapnya</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="shape-wrapper" id="scene">
                        {{-- @if ($profile && !empty($profile->profile_heroimage)) --}}
                                <img src="{{asset('images_profile/'.$profile->profile_heroimage)}}" alt="Hero Image">
                            {{-- @else
                                <img src="assets_fe/kepsek-removebg-preview.png" alt="Hero Image">
                        @endif --}}

                        <div class="hero-bg-shape-1 layer" data-depth="0.4">
                            <img src="{{asset('assets_fe/images/shape/shape-01.png')}}" alt="Hero Image Background Shape">
                        </div>
                        <div class="hero-bg-shape-2 layer" data-depth="0.4">
                            <img src="{{asset('assets_fe/images/shape/shape-02.png')}}" alt="Hero Image Background Shape">
                        </div>
                    </div>

                    <div class="banner-card pb--60 mb--50 swiper rbt-dot-bottom-center banner-swiper-active">
                        <div class="swiper-wrapper">
                            @foreach ($hot_news as $key => $item)
                                <div class="swiper-slide">
                                    <div class="rbt-card variation-01 rbt-hover">
                                        <div class="rbt-card-img">
                                            <a href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                                <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="Card image">
                                                <div class="rbt-badge-3 bg-white">
                                                    <span>Hot</span>
                                                    <span>News</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="rbt-card-body">
                                            <ul class="rbt-meta">
                                                <li><i class="feather-users"></i>{{$item->post_view}} Dibaca</li>
                                            </ul>
                                            <h4 class="rbt-card-title"><a href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}" class="text-capitalize">{{substr($item->post_title,0,45)}}
                                                @if (strlen($item->post_title) > 45)
                                                ...
                                                @endif
                                            </a>
                                            </h4>
                                            <p class="rbt-card-text">
                                                {!! substr(strip_tags($item->post_desc), 0, 60) !!}
                                                @if (strlen($item->post_desc) > 60)
                                                ...
                                                @endif
                                            </p>
                                            <div class="rbt-card-bottom">
                                                <a class="rbt-btn-link" href="/post/{{$item->konten->konten_slug}}">Read More<i
                                                        class="feather-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="rbt-swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-demo-area splash-masonary-wrapper-activation" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
    <div class="wrapper plr--120 plr_lg--30 plr_md--30 plr_sm--30 plr_mobile--15">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-xl-6 offset-xl-3">
                <div class="section-title text-center has-section-before-title mb--150 mt--50 mb_lg--100 mb_md--100 mb_sm--100">
                    <h2 class="rbt-display-1 theme-gradient">{{$profile->profile_herotitle ?? 'SMK dengan daftar Jurusan Populer'}}</h2>
                    <h3 class="title">
                        {{$profile->profile_herosubtitle ?? 'Hadir dengan daftar jurusan bergengsi. <span class="heading-opacity">Serta pengajar yang profesional & berkompeten di bidangnya.</span>'}}
                    </h3>
                    <div class="indicator-icon ">
                        <img class="edu_bounce_loop" onclick="scrollToJurusan()" src="{{asset('assets_fe/images/icons/arrow-down.png')}}" alt="arrow down icon">
                    </div>
                    <p class="description has-medium-font-size mt--20">{{$profile->profile_herodesc ?? 'Kami hadir untuk mendidik putra dan putri bangsa menjadi generasi terbaik yang siap untuk bersaing dengan dunia nyata'}}
                    </p>
                    <div class="section-before-title theme-gradient new-big-heading-gradient">#</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rbt-inner-page-layout-area bg-color-extra2 rbt-section-gap rbt-shape-bg-area top-circle-shape-top">
    <div class="wrapper position-relative overflow-hidden">
        <div class="rbt-splite-style">
            <div class="split-wrapper">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-12 col-xl-5 col-12" data-sal-delay="150" data-sal="slide-right" data-sal-duration="800">
                        <div class="swiper banner-splash-inner-layout-active rbt-arrow-between rbt-dot-bottom-center icon-bg-primary">
                            <div class="swiper-wrapper">
                                <!-- Start Single Slider  -->
                                <div class="swiper-slide">
                                    <div class="single-slide">
                                        <div class="rbt-splash-inner-layout-inner">
                                            <div class="thumbnail image-left-content">
                                                <img src="{{asset('images_thumbnail/'.$prestasi->post_thumb)}}" style="height: 420px; object-fit: cover" alt="split Images">
                                            </div>
                                            <div class="content text-center">
                                                <h4 class="title">Dokumentasi</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($prestasi->image as $item)
                                <div class="swiper-slide">
                                    <div class="single-slide">
                                        <div class="rbt-splash-inner-layout-inner">
                                            <div class="thumbnail image-left-content">
                                                <img src="{{asset('images_another/'.$item->image_name)}}" style="height: 420px; object-fit: cover" alt="split Images">
                                            </div>
                                            <div class="content text-center">
                                                <h4 class="title">Dokumentasi</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- End Single Slider  -->
                            </div>
                            <div class="rbt-swiper-pagination"></div>
                            <div class="rbt-swiper-arrow rbt-arrow-left">
                                <div class="custom-overfolow">
                                    <i class="rbt-icon feather-arrow-left"></i>
                                    <i class="rbt-icon-top feather-arrow-left"></i>
                                </div>
                            </div>
                            <div class="rbt-swiper-arrow rbt-arrow-right">
                                <div class="custom-overfolow">
                                    <i class="rbt-icon feather-arrow-right"></i>
                                    <i class="rbt-icon-top feather-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-xl-6 col-12"  data-sal-delay="200" data-sal="slide-right" data-sal-duration="800">
                        <div class="split-inner">
                            <span class="rbt-badge-6 bg-primary-opacity">Prestasi Terbaru</span>
                            <h4 class="title">{{$prestasi->post_title ?? 'Peraih Medali Emas Kanca International'}}.</h4>
                            <p class="description">
                                {!! substr(strip_tags($prestasi->post_desc), 0, 250) ?? 'Ali udin Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.'!!}
                                ...
                            </p>
                            <div class="veiw-more-btn mt--20">
                                <a class="rbt-btn btn-gradient rbt-marquee-btn marquee-text-y" href="/post/{{$prestasi->konten->konten_slug}}">
                                    <span data-text="Prestasi Kami">
                                        Lihat Daftar Prestasi Lainnya
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="top-circle-shape"></div>
    </div>
    <div class="rbt-shape-bg">
        <img src="assets_fe/images/splash/bg/left-right-line-small.svg" alt="Shape Images">
    </div>
</div>


<div class="rbt-event-area rbt-section-gap bg-gradient-3">
    <div class="container">
        <div class="row mb--55">
            <div class="section-title text-center">
                <span class="subtitle bg-white-opacity">SMK KRIAN 1 SIDOARJO</span>
                <h2 class="title color-white">Berita Terkini</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper event-activation-1 rbt-arrow-between rbt-dot-bottom-center pb--60 icon-bg-primary">
                    <div class="swiper-wrapper">
                        @foreach ($general as $item)
                            <!-- Start Single Slide  -->
                            <div class="swiper-slide">
                                <div class="single-slide">
                                    <div class="rbt-card event-grid-card variation-01 rbt-hover">
                                        <div class="rbt-card-img">
                                            <a href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                                <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" style="min-height: 220px; max-height:220px" alt="Card image">
                                                <div class="rbt-badge-3 bg-white">
                                                    <span>{{\Carbon\Carbon::parse($item->created_at)->format('d M')}}</span>
                                                    <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y')}}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="rbt-card-body">
                                            <ul class="rbt-meta">
                                                <li><i class="feather-map-pin"></i>Smk Krian</li>
                                                <li><i class="feather-clock"></i>{{\Carbon\Carbon::parse($item->created_at)->format('H:i:s')}}</li>
                                                <li><i class="feather-eye"></i>{{$item->post_view}} Dibaca</li>
                                            </ul>
                                            <h4 class="rbt-card-title">
                                                <a href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                                    @if (strlen($item->post_title) > 35)
                                                        {{substr($item->post_title, 0,35)}} ...
                                                        @else
                                                        {{substr($item->post_title, 0,35)}}
                                                            @if (strlen($item->post_title) > 20)
                                                                <br>
                                                            @else
                                                                <br><br>
                                                            @endif
                                                    @endif
                                                </a>
                                            </h4>

                                            <div class="read-more-btn">
                                                <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                                    <span class="icon-reverse-wrapper">
                                                        <span class="btn-text">Selengkapnya</span>
                                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slide  -->
                        @endforeach
                    </div>

                    <div class="rbt-swiper-arrow rbt-arrow-left">
                        <div class="custom-overfolow">
                            <i class="rbt-icon feather-arrow-left"></i>
                            <i class="rbt-icon-top feather-arrow-left"></i>
                        </div>
                    </div>

                    <div class="rbt-swiper-arrow rbt-arrow-right">
                        <div class="custom-overfolow">
                            <i class="rbt-icon feather-arrow-right"></i>
                            <i class="rbt-icon-top feather-arrow-right"></i>
                        </div>
                    </div>
                    <div class="rbt-swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="swiper event-activation-1 rbt-arrow-between rbt-dot-bottom-center pb--60 icon-bg-primary">
                    <div class="swiper-wrapper">
                        @foreach ($general2 as $item)
                            <!-- Start Single Slide  -->
                            <div class="swiper-slide">
                                <div class="single-slide">
                                    <div class="rbt-card event-grid-card variation-01 rbt-hover">
                                        <div class="rbt-card-img">
                                            <a href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                                <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" style="min-height: 220px; max-height:220px" alt="Card image">
                                                <div class="rbt-badge-3 bg-white">
                                                    <span>{{\Carbon\Carbon::parse($item->created_at)->format('d M')}}</span>
                                                    <span>{{\Carbon\Carbon::parse($item->created_at)->format('Y')}}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="rbt-card-body">
                                            <ul class="rbt-meta">
                                                <li><i class="feather-map-pin"></i>Smk Krian</li>
                                                <li><i class="feather-clock"></i>{{\Carbon\Carbon::parse($item->created_at)->format('H:i:s')}}</li>
                                                <li><i class="feather-eye"></i>{{$item->post_view}} Dibaca</li>
                                            </ul>
                                            <h4 class="rbt-card-title">
                                                <a href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                                    @if (strlen($item->post_title) > 35)
                                                        {{substr($item->post_title, 0,35)}} ...
                                                        @else
                                                        {{substr($item->post_title, 0,35)}}
                                                            @if (strlen($item->post_title) > 20)
                                                                <br>
                                                            @else
                                                                <br><br>
                                                            @endif
                                                    @endif
                                                </a>
                                            </h4>

                                            <div class="read-more-btn">
                                                <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                                    <span class="icon-reverse-wrapper">
                                                        <span class="btn-text">Selengkapnya</span>
                                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slide  -->
                        @endforeach
                    </div>

                    <div class="rbt-swiper-arrow rbt-arrow-left">
                        <div class="custom-overfolow">
                            <i class="rbt-icon feather-arrow-left"></i>
                            <i class="rbt-icon-top feather-arrow-left"></i>
                        </div>
                    </div>

                    <div class="rbt-swiper-arrow rbt-arrow-right">
                        <div class="custom-overfolow">
                            <i class="rbt-icon feather-arrow-right"></i>
                            <i class="rbt-icon-top feather-arrow-right"></i>
                        </div>
                    </div>
                    <div class="rbt-swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rbt-counterup-area rbt-section-gap">
    <div class="conter-style-2">
        <div class="container">
            <div class="row g-5 align-items-center">

                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="row row--30">
                        <!-- Start Single Counter  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="rbt-counterup rbt-hover-03">
                                <div class="inner">
                                    <div class="icon">
                                        <img src="{{asset('assets_fe/images/icons/counter-01.png')}}" alt="Icons Images">
                                    </div>
                                    <div class="content">
                                        <h3 class="counter"><span class="odometer" data-count="25000">00</span>
                                        </h3>
                                        <span class="subtitle">Alumni Berkompetensi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Counter  -->

                        <!-- Start Single Counter  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt--60" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                            <div class="rbt-counterup rbt-hover-03">
                                <div class="inner">
                                    <div class="icon">
                                        <img src="assets_fe/images/icons/counter-02.png" alt="Icons Images">
                                    </div>
                                    <div class="content">
                                        <h3 class="counter"><span class="odometer" data-count="5">00</span>
                                        </h3>
                                        <span class="subtitle">Jurusan & Ekstra Kulikuler</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Counter  -->

                        <!-- Start Single Counter  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--40" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                            <div class="rbt-counterup rbt-hover-03 transform-sm-none" data-parallax='{"x": 0, "y": -60}'>
                                <div class="inner">
                                    <div class="icon">
                                        <img src="assets_fe/images/icons/counter-03.png" alt="Icons Images">
                                    </div>
                                    <div class="content">
                                        <h3 class="counter"><span class="odometer" data-count="520">00</span>
                                        </h3>
                                        <span class="subtitle">Peraih Prestasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Counter  -->

                        <!-- Start Single Counter  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt--60 mt_mobile--40" data-sal-delay="300" data-sal="slide-up" data-sal-duration="800">
                            <div class="rbt-counterup rbt-hover-03 transform-sm-none" data-parallax='{"x": 0, "y": 60}'>
                                <div class="inner">
                                    <div class="icon">
                                        <img src="assets_fe/images/icons/counter-04.png" alt="Icons Images">
                                    </div>
                                    <div class="content">
                                        <h3 class="counter"><span class="odometer" data-count="2501">00</span>
                                        </h3>
                                        <span class="subtitle">Siswa Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Counter  -->
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                    <div class="inner pl--50 pl_sm--0 pl_md--0">
                        <div class="section-title text-start">
                            <span class="subtitle bg-pink-opacity">Why Choose Us</span>
                            <h2 class="title">{{$profile->profile_featuretitle}}</h2>
                            <p class="description has-medium-font-size mt--20 mb--0">
                                {!!$profile->profile_featuredesc!!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="rbt-course-area bg-color-extra2 rbt-section-gap">
    <div class="container">
        <div class="row mb--60" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle bg-secondary-opacity">Free E-Book</span>
                    <p class="description mt--20">Perluas wawasan dengan memperbanyak membaca informasi. Berikut adalah E-Book materi serta informasi yang dapat diakses oleh siapapun.</p>
                </div>
            </div>
        </div>
        <div class="row g-5">
            @foreach ($ebook as $item)
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                <div class="rbt-card variation-01 rbt-hover card-list-2">
                    <div class="rbt-card-img">
                        <a href="course-details.html">
                            <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="{{$item->post_name}}">
                        </a>
                    </div>
                    <div class="rbt-card-body">
                        <div class="rbt-card-top">
                            <div class="rbt-bookmark-btn">
                                <a class="rbt-round-btn" title="Bookmark" href="{{asset('file_ebook/'.$item->file[0]->file_name)}}"><i class="feather-bookmark"></i></a>
                            </div>
                        </div>
                        <h4 class="rbt-card-title text-capitalize"><a href="{{asset('file_ebook/'.$item->file[0]->file_name)}}">{{$item->post_title}}</a>
                        </h4>
                        <ul class="rbt-meta">
                            @if (count($item->file) > 0)
                                <li><i class="feather-download"></i>{{$item->file[0]->file_download ?? '0'}} diunduh</li>
                            @endif

                        </ul>
                        <p class="rbt-card-text">{!! substr(strip_tags($item->post_desc), 0, 100) !!}</p>
                        <div class="rbt-card-bottom">
                            <a class="rbt-btn-link" href="{{asset('file_ebook/'.$item->file[0]->file_name)}}">
                                Unduh <i class="feather-arrow-down"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="load-more-btn mt--60 text-center">
                    <a class="rbt-btn btn-gradient btn-lg hover-icon-reverse" href="/post/{{$ebook[0]->konten->konten_slug}}">
                        <span class="icon-reverse-wrapper">
                            <span class="btn-text">Lihat koleksi E-Book</span>
                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@if ($guru->count() > 0)
<div class="rbt-team-area bg-color-white rbt-section-gap">
    <div class="container">
        <div class="row mb--60"  data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle bg-primary-opacity">Our Teacher</span>
                    <h2 class="title">Whose Inspirations You</h2>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-7"  data-sal-delay="200" data-sal="slide-right" data-sal-duration="800">
                <div class="rbt-team-tab-content tab-content" id="myTabContent">

                    @foreach ($guru as $key => $item)
                    <div @if ($key+1 == 1)
                    class="tab-pane fade active show"
                    @else
                    class="tab-pane fade"
                    @endif
                    id="team-tab{{$key+1}}" role="tabpane{{$key+1}}" aria-labelledby="team-tab{{$key+1}}-tab">
                        <div class="inner">
                            <div class="rbt-team-thumbnail">
                                <div class="thumb">
                                    <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="Testimonial Images">
                                </div>
                            </div>
                            <div class="rbt-team-details">
                                <div class="author-info">
                                    <h4 class="title text-capitalize">{{$item->post_title}}</h4>
                                </div>
                                <p>
                                    {!! $item->post_desc !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach





                    <div class="top-circle-shape"></div>
                </div>
            </div>

            <div class="col-lg-5"  data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <ul class="rbt-team-tab-thumb nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($guru as $key => $item)
                    <li>
                        <a @if ($key+1 == 1)
                        class="active"
                        @endif  id="team-tab1-tab" data-bs-toggle="tab" data-bs-target="#team-tab{{$key+1}}" role="tab" aria-controls="team-tab{{$key+1}}" aria-selected="true">
                            <div class="rbt-team-thumbnail">
                                <div class="thumb">
                                    <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="{{$item->post_title}}">
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

@if ($profile)
<div class="rbt-call-to-action-area rbt-section-gap bg-gradient-8">
    <div class="rbt-callto-action rbt-cta-default style-6">
        <div class="container">
            <div class="row g-5 align-items-center content-wrapper">
                <div class="col-xxl-3 col-xl-3 col-lg-6">
                    <div class="inner">
                        <div class="content text-start">
                            <h2 class="title color-white mb--0">Anda bagian dari kami ?</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="inner-content text-start">
                        <p class="color-white">
                            Anda bisa membantu kami dengan mendaftarkan diri anda,
                            serta anda juga bisa melakukan ulasan atas segala kinerja maupun kegiatan kami sehingga
                            kami mampu untuk terus berkembang semakin baik
                        </p>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-6">
                    <div class="call-to-btn text-start text-xl-end">
                        <a class="rbt-btn btn-white hover-icon-reverse" href="{{$profile->profile_featurelink}}">
                            <span class="icon-reverse-wrapper">
                            <span class="btn-text">Registrasi Alumni</span>
                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="home-demo-area rbt-section-gap bg-gradient-6 splash-masonary-wrapper-activation" id="jurusanElement">
    <div class="wrapper plr--120 plr_lg--30 plr_md--30 plr_sm--30 plr_mobile--15">
        <div class="row">
            <div class="col-lg-12">
                <div class="demo-presentation-mesonry splash-mesonry-list grid-metro3" style="position: relative; height: 4861.78px;">
                    <div class="resizer" style="position: absolute; left: 0%; top: 0px;"></div>
                    @foreach ($jurusan as $item)
                        <!-- Start Single Demo  -->
                        <div class="maso-item marketplace career instructor" style="position: absolute; left: 0%; top: 0px;">
                            <div class="single-demo">
                                <a class="single-demo-link" href="/post/{{$item->konten->konten_slug}}/{{$item->post_slug}}">
                                    <div class="thumbnail">
                                        <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" style="height: 200px" alt="Jurusan Images">
                                        <div class="mobile-view">
                                            <div class="inner">
                                                <img src="{{asset('images_thumbnail/'.$item->post_thumb)}}" alt="Jurusan Images">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content" style="margin-top: 20px">
                                        <h3 class="title"><span class="label-new">{{$item->post_title}}</span></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Demo  -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rbt-testimonial-area bg-color-white ptb--100 overflow-hidden">
    <div class="container-fluid">
        <div class="row g-5 align-items-center">
            <div class="col-xl-3">
                <div class="section-title pl--100 pl_sm--30">
                    <h2 class="title">What My Learners <span class="theme-gradient">Say</span></h2>
                    <p class="description mt--20">Learning communicate to global world and build a bright future with our alumni.</p>
                    <div class="veiw-more-btn mt--20">
                        <a class="rbt-btn btn-gradient rbt-marquee-btn marquee-text-y" href="/alumni">
                            <span data-text="See Alumni List">
                                Alumni Kami
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="overflow-hidden">
                    <div class="scroll-animation-wrapper pt--50 pb--30">
                        <div class="scroll-animation scroll-right-left">
                            @foreach ($alumni as $item)
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
                                            @if ($item->ulasan)
                                            <div class="description">
                                                <p class="subtitle-3">{{$item->ulasan->deskripsi_ulasan}}</p>
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
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($alumni->count() < 6)
                                @for ($i = 0; $i < (6 - $alumni->count()); $i++)
                                    <div class="single-column-20">
                                        <div class="rbt-testimonial-box">
                                            <div class="inner">
                                                <div class="clint-info-wrapper">
                                                    <div class="thumb">
                                                        <img src="assets_fe/images/testimonial/client-01.png" alt="Clint Images">
                                                    </div>
                                                    <div class="client-info">
                                                        <h5 class="title">Martha Maldonado</h5>
                                                        <span>Executive Chairman <i>@ Google</i></span>
                                                    </div>
                                                </div>
                                                <div class="description">
                                                    <p class="subtitle-3">University managemnet, vulputate at sapien sit amet,
                                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus
                                                        velit.</p>
                                                    <div class="rating mt--20">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif

                        </div>
                    </div>
                    <div class="scroll-animation-wrapper pb--50">
                        <div class="scroll-animation scroll-left-right">
                            @foreach ($alumniLanjutan as $item)
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
                                            @if ($item->ulasan)
                                            <div class="description">
                                                <p class="subtitle-3">{{$item->ulasan->deskripsi_ulasan}}</p>
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
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($alumniLanjutan->count() < 6)
                                @for ($i = 0; $i < (6 - $alumniLanjutan->count()); $i++)
                                    <div class="single-column-20">
                                        <div class="rbt-testimonial-box">
                                            <div class="inner">
                                                <div class="clint-info-wrapper">
                                                    <div class="thumb">
                                                        <img src="assets_fe/images/testimonial/client-01.png" alt="Clint Images">
                                                    </div>
                                                    <div class="client-info">
                                                        <h5 class="title">Martha Maldonado</h5>
                                                        <span>Executive Chairman <i>@ Google</i></span>
                                                    </div>
                                                </div>
                                                <div class="description">
                                                    <p class="subtitle-3">University managemnet, vulputate at sapien sit amet,
                                                        auctor iaculis lorem. In vel hend rerit nisi. Vestibulum eget risus
                                                        velit.</p>
                                                    <div class="rating mt--20">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    function scrollToJurusan() {
        var targetElement = document.getElementById('jurusanElement');
        targetElement.scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection
