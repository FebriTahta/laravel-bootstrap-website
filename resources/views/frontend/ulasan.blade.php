@extends('layouts_fe.raw')

@section('page_title')
    <title style="text-transform: capitalize">Ulasan</title>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .placeholder {
        font-size: 13px !important;
    }
    input {
        font-size: 14px !important;
    }
    .form-check-label {
        font-size: 14px !important;
    }
    .form-group {
        margin-bottom: 30px !important;
    }
    .form-check {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 50px;
        font-size: 50px;
        }

        .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
        }

        .rating label:last-child {
        position: static;
        }

        .rating label:nth-child(1) {
        z-index: 5;
        }

        .rating label:nth-child(2) {
        z-index: 4;
        }

        .rating label:nth-child(3) {
        z-index: 3;
        }

        .rating label:nth-child(4) {
        z-index: 2;
        }

        .rating label:nth-child(5) {
        z-index: 1;
        }

        .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        }

        .rating label .icon {
        float: left;
        color: transparent;
        }

        .rating label:last-child .icon {
        color: #000;
        }

        .rating:not(:hover) label input:checked ~ .icon,
        .rating:hover label:hover input ~ .icon {
        color: rgb(255, 208, 0);
        }

        .rating label input:focus:not(:checked) ~ .icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #09f;
        }
        .icon {
            font-size: 75px !important;
        }
</style>
@endsection

@section('content')
<div class="rbt-page-banner-wrapper">
    <!-- Start Banner BG Image  -->
    <div class="rbt-banner-image"></div>
    <!-- End Banner BG Image  -->
    <div class="rbt-banner-content">
        <!-- Start Banner Content Top  -->
        <div class="rbt-banner-content-top rbt-breadcrumb-style-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="content text-center">
                            <h2 class="title theme-gradient">Formulir Pengisian Ulasan</h2>

                            <div class="rbt-author-meta mb--20 justify-content-center">
                                <div class="rbt-author-info">
                                    By <a href="profile.html">SMK</a> KRIAN 1 <a href="#">Sidoarjo</a>
                                </div>
                            </div>

                            <ul class="rbt-meta">
                                <li><i class="fa fa-calendar"></i>{{date('Y - m - d')}}</li>
                                <li><i class="fa fa-globe"></i>Jawa Timur</li>
                                <li><i class="fa fa-award"></i>SMK Krian 1 Sidoarjo</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Content Top  -->
    </div>
</div>
<div class="rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container rbt-banner-content" style="max-width: 1200px;">
        <div class="row" style="padding-top: 50px; padding-bottom:50px">
            <div class="col-lg-8 offset-lg-2">
                <div class="advance-pricing">
                    <div class="inner">
                        <div class="row row--0" style="background-color: transparent">
                            
                        </div>
                        <div class="row row--0">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="pricing-right position-relative">
                                    <div class="pricing-offer">
                                        <div class="single-list">
                                            <form id="form-ulasan" method="POST"> @csrf
                                                <div class="row">
                                                    <div class="form-group col-lg-6 col-12 col-md-12">
                                                        <label for="alumni_email" class="placeholder" style="margin-left: 10px">Email valid ( yang sudah terdaftar )</label>
                                                        <input type="email" class="form-control" id="email" name="alumni_email" required>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-12 col-md-12">
                                                        <label for="kode" class="placeholder"  style="margin-left: 10px">Kode Ulasan ( periksa kode pada email)</label>
                                                        <input type="number" class="form-control" id="alumni_passpharse" name="alumni_passpharse" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="rating" >
                                                    <label>
                                                    <input type="radio" name="stars" value="1" />
                                                    <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                    <input type="radio" name="stars" value="2" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                    <input type="radio" name="stars" value="3" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>   
                                                    </label>
                                                    <label>
                                                    <input type="radio" name="stars" value="4" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    </label>
                                                    <label>
                                                    <input type="radio" name="stars" value="5" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="margin-top: 30px">
                                                    <label for="deskripsi_ulasan" class="placeholder">Deskripsi Ulasan</label>
                                                    <textarea name="deskripsi_ulasan" class="form-control" id="deskripsi_ulasan" cols="30" rows="5"></textarea>
                                                </div>
                                                <button class="rbt-btn btn-gradient w-100" id="submit">Submit Ulasan</button>
                                              </form>
                                        </div>
                                    </div>
                                    <div class="pricing-badge"><span>Form Ulasan</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(':radio').change(function() {
        console.log('New star rating: ' + this.value);
    });

    $('#form-ulasan').submit(function (e) {
        e.preventDefault(); // Menghentikan pengiriman formulir default
        
        // Menampilkan modal loading saat pengguna menekan tombol submit
        Swal.fire({
            title: 'Loading...',
            html: 'Sedang memproses permintaan.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        var formData = new FormData(this);
        $.ajax({
            url: "{{route('submit_ulasan')}}",
            type: "POST",
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting contentType
            success: function (response) {
                if (response.status == 200) {
                    // Tampilkan pesan sukses
                    Swal.fire({
                        title: 'Sukses!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    $('#form-ulasan')[0].reset();
                   
                } else {
                    // Tampilkan pesan kesalahan validasi
                    Swal.fire({
                        title: 'Oops...',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText); // Tampilkan pesan kesalahan jika ada
                Swal.fire({
                    title: 'Oops...',
                    text: xhr.responseText,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

</script>
@endsection