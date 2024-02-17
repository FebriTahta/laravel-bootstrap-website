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
                        <p><a href="tel:{{$profile->profile_contactnumber}}">{{$profile->profile_contactnumber}}</a></p>
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
                        <p><a href="mailto:{{$profile->profile_email}}">{{$profile->profile_email}}</a></p>
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
                        <p>{!!$profile->profile_address!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rbt-contact-address">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="thumbnail">
                    <img class="w-100 radius-6" src="{{asset('assets_fe/images/about/contact.jpg')}}" alt="Contact Images">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="rbt-contact-form contact-form-style-1 max-width-auto">
                    <div class="section-title text-start">
                        <span class="subtitle bg-primary-opacity">Form Pendataan Alumni</span>
                    </div>
                    <h3 class="title">Kamu adalah kebanggaan kami</h3>
                    <form id="contact-form" method="POST" class="rainbow-dynamic-form max-width-auto"> @csrf
                        <div class="form-group">
                            <input name="alumni_name" id="alumni_name" type="text">
                            <label>Nama Lengkap</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="form-group">
                            <input name="alumni_jurusan" id="alumni_jurusan" type="text">
                            <label>Jurusan</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" id="alumni_tahun_ajar1" name="alumni_tahun_ajar1">
                                    <label>Tahun Ajaran Awal</label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" id="alumni_tahun_ajar1" name="alumni_tahun_ajar1">
                                    <label>Tahun Ajaran Akhir</label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <textarea name="alumni_deskripsi" id="alumni_deskripsi"></textarea>
                            <label>Deskripsi Pekerjaan / Kegiatan Terbaru</label>
                            <span class="focus-border"></span>
                        </div>
                       
                        <div class="form-group">
                            <input type="file" name="alumni_image" id="alumni_image">
                            <span class="focus-borderx`"></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="alumni_passpharse" name="alumni_passpharse" value="{{$phasparse}}" readonly>
                            <label class="d-none">PassPharse <small style="font-size: 11px">(untuk memberi ulasan & update data)</small></label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="form-submit-group">
                            <button name="submit" type="submit" id="submit" class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">SUBMIT</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#alumni_passpharse').trigger('click');
    })

    $('#contact-form').submit(function (e) {
        e.preventDefault(); // Menghentikan pengiriman formulir default

        var formData = $(this).serialize(); // Mengambil data formulir

        $.ajax({
            url: "registrasi/alumni",
            type: "POST",
            data: formData,
            success: function (response) {
                console.log(response); // Tampilkan respon dari server di konsol
                // Lakukan tindakan lain jika diperlukan
            },
            error: function (xhr) {
                console.log(xhr.responseText); // Tampilkan pesan kesalahan jika ada
            }
        });
    });
</script>
@endsection