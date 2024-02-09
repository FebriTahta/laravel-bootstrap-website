<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from rainbowit.net/html/histudy/01-main-demo.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Sep 2023 16:40:25 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$profile->profile_name ?? null}}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('LOGO.png')}}">

    <!-- CSS
	============================================ -->
    <link rel="stylesheet" href="{{asset('assets_fe/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/vendor/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/sal.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/euclid-circulara.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/swiper.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/magnify.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/animation.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/magnigy-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/plugins/plyr.css')}}">
    <link rel="stylesheet" href="{{asset('assets_fe/css/style.css')}}">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MNQDMNN9');</script>
    <!-- End Google Tag Manager -->
</head>

<body class="rbt-header-sticky">

    <!-- Start Header Area -->
    <header class="rbt-header rbt-header-10">
        <div class="rbt-sticky-placeholder"></div>
        <!-- Start Header Top  -->
        <div class="rbt-header-top rbt-header-top-1 header-space-betwween bg-not-transparent bg-color-darker top-expended-activation">
            <div class="container-fluid">
                <div class="top-expended-wrapper">
                    <div class="top-expended-inner rbt-header-sec align-items-center ">
                        <div class="rbt-header-sec-col rbt-header-left d-none d-xl-block">
                            <div class="rbt-header-content">
                                <!-- Start Header Information List  -->
                                <div class="header-info">
                                    <ul class="rbt-information-list">
                                        <li>
                                            <a href="#"><i class="feather-phone"></i>Kontak : {{$profile->profile_contactnumber ?? '+1-202-555-0174'}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Header Information List  -->
                            </div>
                        </div>
                        <div class="rbt-header-sec-col rbt-header-center">
                            <div class="rbt-header-content justify-content-start justify-content-xl-center">
                                <div class="header-info">
                                    <div class="rbt-header-top-news">
                                        <div class="inner">
                                            <div class="content">
                                                <span class="rbt-badge variation-02 bg-color-primary color-white radius-round">Hi</span>
                                                <span class="news-text"><img src="{{asset('assets_fe/images/icons/hand-emojji.svg')}}" alt="Hand Emojji Images"> Welcome to {{$profile->profile_name ?? 'my website.'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rbt-header-sec-col rbt-header-right mt_md--10 mt_sm--10">
                            <div class="rbt-header-content justify-content-start justify-content-lg-end">
                                

                                <div class="rbt-separator d-none d-xl-block"></div>
                                <div class="header-info d-none d-xl-block">
                                    <ul class="social-share-transparent">
                                        <li>
                                            @auth
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                            @else
                                            <a href="/login"> Login</a>
                                            @endauth
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="header-info">
                        <div class="top-bar-expended d-block d-lg-none">
                            <button class="topbar-expend-button rbt-round-btn"><i class="feather-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top  -->
        <div class="rbt-header-wrapper header-space-betwween header-sticky">
            <div class="container-fluid">
                <div class="mainbar-row rbt-navigation-center align-items-center">
                    <div class="header-left rbt-header-content">
                        <div class="header-info">
                            <div class="logo">
                                <a href="/">
                                    <img 
                                    @if ($profile)
                                    src="{{asset('images_profile/'.$profile->profile_logo)}}"    
                                    @else
                                    src="{{asset('assets_fe/images/logo/logo.png')}}" 
                                    @endif
                                    alt="Education Logo Images">
                                </a>
                            </div>
                        </div>
                    </div>

                    @include('layouts_fe.menu')

                    <div class="header-right">

                        <!-- Navbar Icons -->
                        <ul class="quick-access">
                            <li class="access-icon">
                                <a class="search-trigger-active rbt-round-btn" href="#">
                                    <i class="feather-search"></i>
                                </a>
                            </li>
                            <li class="account-access rbt-user-wrapper d-none d-xl-block">
                                {{-- <a href="https://pembayaran.smkkrian1.sch.id" target="_blank">PPDB</a> --}}
                                {{-- <a href="{{route('login')}}"><i class="feather-lock"></i>Login</a> --}}
                                <a class="rbt-btn btn-gradient hover-icon-reverse" target="_blank" href="https://pembayaran.smkkrian1.sch.id">
                                    <span class="icon-reverse-wrapper">
                                        <span class="btn-text">Pendaftaran</span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                    </span>
                                </a>
                            </li>
                        </ul>

                       

                        <!-- Start Mobile-Menu-Bar -->
                        <div class="mobile-menu-bar d-block d-xl-none">
                            <div class="hamberger">
                                <button class="hamberger-button rbt-round-btn">
                                    <i class="feather-menu"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Start Mobile-Menu-Bar -->

                    </div>
                </div>
            </div>
            <!-- Start Search Dropdown  -->
            <div class="rbt-search-dropdown">
                <div class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('global_post.search')}}" method="GET">
                                <input type="text" name="search" placeholder="What are you looking for?">
                                <div class="submit-btn">
                                    <a class="rbt-btn btn-gradient btn-md" type="submit" href="javascript:void(0);">Search</a>
                                  
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="rbt-separator-mid">
                        <hr class="rbt-separator m-0">
                    </div>
                </div>
            </div>
            <!-- End Search Dropdown  -->
        </div>
        <!-- Start Side Vav -->
        <div class="rbt-offcanvas-side-menu rbt-category-sidemenu">
            <div class="inner-wrapper">
                <div class="inner-top">
                    <div class="inner-title">
                        <h4 class="title">Course Category</h4>
                    </div>
                    <div class="rbt-btn-close">
                        <button class="rbt-close-offcanvas rbt-round-btn"><i class="feather-x"></i></button>
                    </div>
                </div>
                <nav class="side-nav w-100">
                    <ul class="rbt-vertical-nav-list-wrapper vertical-nav-menu">
                        <li class="vertical-nav-item">
                            <a href="#">Course School</a>
                            <div class="vartical-nav-content-menu-wrapper">
                                <div class="vartical-nav-content-menu">
                                    <h3 class="rbt-short-title">Course Title</h3>
                                    <ul class="rbt-vertical-nav-list-wrapper">
                                        <li><a href="#">Web Design</a></li>
                                        <li><a href="#">Art</a></li>
                                        <li><a href="#">Figma</a></li>
                                        <li><a href="#">Adobe</a></li>
                                    </ul>
                                </div>
                                <div class="vartical-nav-content-menu">
                                    <h3 class="rbt-short-title">Course Title</h3>
                                    <ul class="rbt-vertical-nav-list-wrapper">
                                        <li><a href="#">Photo</a></li>
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">Math</a></li>
                                        <li><a href="#">Read</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="vertical-nav-item">
                            <a href="#">Online School</a>
                            <div class="vartical-nav-content-menu-wrapper">
                                <div class="vartical-nav-content-menu">
                                    <h3 class="rbt-short-title">Course Title</h3>
                                    <ul class="rbt-vertical-nav-list-wrapper">
                                        <li><a href="#">Photo</a></li>
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">Math</a></li>
                                        <li><a href="#">Read</a></li>
                                    </ul>
                                </div>
                                <div class="vartical-nav-content-menu">
                                    <h3 class="rbt-short-title">Course Title</h3>
                                    <ul class="rbt-vertical-nav-list-wrapper">
                                        <li><a href="#">Web Design</a></li>
                                        <li><a href="#">Art</a></li>
                                        <li><a href="#">Figma</a></li>
                                        <li><a href="#">Adobe</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="vertical-nav-item">
                            <a href="#">kindergarten</a>
                            <div class="vartical-nav-content-menu-wrapper">
                                <div class="vartical-nav-content-menu">
                                    <h3 class="rbt-short-title">Course Title</h3>
                                    <ul class="rbt-vertical-nav-list-wrapper">
                                        <li><a href="#">Photo</a></li>
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">Math</a></li>
                                        <li><a href="#">Read</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="vertical-nav-item">
                            <a href="#">Classic LMS</a>
                            <div class="vartical-nav-content-menu-wrapper">
                                <div class="vartical-nav-content-menu">
                                    <h3 class="rbt-short-title">Course Title</h3>
                                    <ul class="rbt-vertical-nav-list-wrapper">
                                        <li><a href="#">Web Design</a></li>
                                        <li><a href="#">Art</a></li>
                                        <li><a href="#">Figma</a></li>
                                        <li><a href="#">Adobe</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="read-more-btn">
                        <div class="rbt-btn-wrapper mt--20">
                            <a class="rbt-btn btn-border-gradient radius-round btn-sm hover-transform-none w-100 justify-content-center text-center" href="#">
                                <span>Learn More</span>
                            </a>
                        </div>
                    </div>
                </nav>
                <div class="rbt-offcanvas-footer">

                </div>
            </div>
        </div>
        <!-- End Side Vav -->
        <a class="rbt-close_side_menu" href="javascript:void(0);"></a>
    </header>
    <!-- Mobile Menu Section -->
    <div class="popup-mobile-menu">
        <div class="inner-wrapper">
            <div class="inner-top">
                <div class="content">
                    <div class="logo">
                        <a href="/">
                            <img 
                            @if ($profile)
                                src="{{asset('images_profile/'.$profile->profile_logo)}}"  
                                @else
                                src="{{asset('assets_fe/images/logo/logo.png')}}"  
                            @endif
                            alt="Education Logo Images">
                        </a>
                    </div>
                    <div class="rbt-btn-close">
                        <button class="close-button rbt-round-btn"><i class="feather-x"></i></button>
                    </div>
                </div>
                <p class="description">Histudy is a education website template. You can customize all.</p>
                <ul class="navbar-top-left rbt-information-list justify-content-start">
                    @if ($profile)
                        @if ($profile->profile_email)
                            <li>
                                <a href="mailto:{{$profile->profile_email}}"><i class="feather-mail"></i>{{$profile->profile_email}}</a>
                            </li>
                        @endif
                    @endif
                   
                    <li>
                        <a href="#"><i class="feather-phone"></i>{{$profile->profile_contactnumber ?? '-'}}</a>
                    </li>
                </ul>
            </div>

            <nav class="mainmenu-nav">
                <ul class="mainmenu">
                    <li class="with-megamenu position-static">
                        <a href="/">Home <i class="feather-chevron-down"></i></a>
                    </li>
                    @foreach ($menus as $key => $menu)
                    <li 
                        @if ($menu->submenu_count > 0)
                            class="with-megamenu has-menu-child-item text-capitalize position-static"
                        @else
                            class="position-static text-capitalize"
                        @endif
                        >
                        <a
                        @if ($menu->konten)
                            href="/post/{{$menu->konten->konten_slug}}" 
                        @else
                            href="#"     
                        @endif 
                        >{{$menu->menu_name}} <i class="feather-chevron-down"></i></a>
                       
                        @if ($menu->submenu_count > 0)
                        <div class="rbt-megamenu grid-item-4">
                            <div class="wrapper">
                                <div class="row row--15">
                                    <div class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item">
                                        <h3 class="rbt-short-title">Sub Menu</h3>
                                        <ul class="mega-menu-item">
                                            @foreach ($menu->submenu as $item)
                                                <li><a
                                                    @if ($item->konten)
                                                        href="/post/{{$item->konten->konten_slug}}"
                                                    @else
                                                        href="#"
                                                    @endif 
                                                    class="text-capitalize">{{$item->submenu_name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </nav>

            <div class="mobile-menu-bottom">
                <div class="social-share-wrapper">
                    <span class="rbt-short-title d-block">Find With Us</span>
                    <ul class="social-icon social-default transparent-with-border justify-content-start mt--20">
                        <li><a href="https://www.facebook.com/">
                                <i class="feather-facebook"></i>
                            </a>
                        </li>
                        <li><a href="https://www.twitter.com/">
                                <i class="feather-twitter"></i>
                            </a>
                        </li>
                        <li><a href="https://www.instagram.com/">
                                <i class="feather-instagram"></i>
                            </a>
                        </li>
                        <li><a href="https://www.linkdin.com/">
                                <i class="feather-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a class="close_side_menu" href="javascript:void(0);"></a>


    <main class="rbt-main-wrapper">
        <!-- Start Banner Area -->
        @yield('content')
        
        <!-- End Footer aera -->
        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>
        <!-- Start Copyright Area  -->
        <div class="copyright-area copyright-style-1 ptb--20">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-12">
                        <p class="rbt-link-hover text-center text-lg-start">Copyright © 2023 <a href="https://themeforest.net/user/rbt-themes">Rainbow-Themes.</a> All Rights Reserved</p>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-12">
                        <ul class="copyright-link rbt-link-hover justify-content-center justify-content-lg-end mt_sm--10 mt_md--10">
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="privacy-policy.html">Privacy policy</a></li>
                            <li><a href="subscription.html">Subscription</a></li>
                            <li><a href="login.html">Login & Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area  -->

    </main>

    <!-- End Page Wrapper Area -->
    <div class="rbt-progress-parent">
        <svg class="rbt-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="{{asset('assets_fe/js/vendor/modernizr.min.js')}}"></script>
    <!-- jQuery JS -->
    <script src="{{asset('assets_fe/js/vendor/jquery.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('assets_fe/js/vendor/bootstrap.min.js')}}"></script>
    <!-- sal.js -->
    <script src="{{asset('assets_fe/js/vendor/sal.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/swiper.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/magnify.min.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/jquery-appear.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/odometer.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/backtotop.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/isotop.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/imageloaded.js')}}"></script>

    <script src="{{asset('assets_fe/js/vendor/wow.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/waypoint.min.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/easypie.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/text-type.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/jquery-one-page-nav.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/jquery-ui.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/magnify-popup.min.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/paralax-scroll.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/paralax.min.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/countdown.js')}}"></script>
    <script src="{{asset('assets_fe/js/vendor/plyr.js')}}"></script>
    <!-- Main JS -->
    <script src="{{asset('assets_fe/js/main.js')}}"></script>
    
    @yield('script')

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNQDMNN9"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>


<!-- Mirrored from rainbowit.net/html/histudy/01-main-demo.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Sep 2023 16:40:47 GMT -->
</html>