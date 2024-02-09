@extends('layouts_fe.raw')

@section('content')

<div class="rbt-conatct-area bg-gradient-11 rbt-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center mb--60">
                    <span class="subtitle bg-secondary-opacity">Selamat Datang</span>
                    <h2 class="title">Form Pendataan Alumni. <br> SMK KRIAN 1</h2>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                <div class="rbt-address">
                    <div class="icon">
                        <i class="feather-headphones"></i>
                    </div>
                    <div class="inner">
                        <h4 class="title">Contact Phone Number</h4>
                        <p><a href="tel:+444555666777">+444 555 666 777</a></p>
                        <p><a href="tel:+222222222333">+222 222 222 333</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate" data-sal="slide-up" data-sal-delay="200" data-sal-duration="800">
                <div class="rbt-address">
                    <div class="icon">
                        <i class="feather-mail"></i>
                    </div>
                    <div class="inner">
                        <h4 class="title">Our Email Address</h4>
                        <p><a href="mailto:admin@gmail.com">admin@gmail.com</a></p>
                        <p><a href="mailto:example@gmail.com">example@gmail.com</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 sal-animate" data-sal="slide-up" data-sal-delay="250" data-sal-duration="800">
                <div class="rbt-address">
                    <div class="icon">
                        <i class="feather-map-pin"></i>
                    </div>
                    <div class="inner">
                        <h4 class="title">Our Location</h4>
                        <p>5678 Bangla Main Road, cities 580 <br> GBnagla, example 54786</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection