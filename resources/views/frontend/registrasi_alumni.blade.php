@extends('layouts_fe.raw')

@section('page_title')
    <title style="text-transform: capitalize">Registrasi Alumni</title>
@endsection

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    .frame {
      width: 100%;
      height: 0;
      padding-top: 100%; /* Mengatur frame agar selalu menjadi lingkaran */
      position: relative; /* Diperlukan untuk mengatur posisi absolut gambar */
      border-radius: 50%; /* Membuat frame menjadi lingkaran */
      overflow: hidden; /* Mengatur agar gambar tetap dalam frame */
      border: 5px solid #ccc; /* Warna dan ketebalan border frame */
    }
    .frame img {
      position: absolute; /* Mengatur posisi absolut agar gambar berada di tengah */
      top: 50%; /* Mengatur posisi vertikal ke tengah */
      left: 50%; /* Mengatur posisi horizontal ke tengah */
      transform: translate(-50%, -50%); /* Menggeser gambar ke tengah */
      max-width: 100%; /* Mengatur lebar gambar agar tidak melebihi frame */
      max-height: 100%; /* Mengatur tinggi gambar agar tidak melebihi frame */
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
                            <h2 class="title theme-gradient">Form Pendataan Alumni SMK Krian 1 Sidoarjo</h2>

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
                            {{-- <div class="col-lg-6 col-md-6 col-12">
                                <div class="pricing-left">
                                    <div class="pricing-offer">
                                        <div class="single-list">
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <div class="frame">
                                                        <img src="{{asset('thankyou.png')}}" alt="Gambar" id="previewImage"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer" style="margin-top: 50px">
                                                <small class="subtitle" style="font-size: 12px; color: red">
                                                    pastikan menggunakan email yang valid.<br>verifikasi dikirim melalui email untuk mengisi ulasan
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pricing-badge"><span>Preview</span></div>
                                </div>
                            </div> --}}
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="pricing-right position-relative">
                                    <div class="pricing-offer">
                                        <div class="single-list">
                                            <form id="form-pendaftaran" method="POST" enctype="multipart/form-data"> @csrf
                                                <div class="form-group">
                                                    <label for="nama" class="placeholder">Nama lengkap</label>
                                                    <input type="text" class="form-control" id="nama" name="alumni_name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumni_telp" class="placeholder">Nomor Telephone (Hp)</label>
                                                    <input type="number" class="form-control" id="alumni_telp" name="alumni_telp" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumni_alamat" class="placeholder">Alamat Tempat Tinggal</label>
                                                    <textarea name="alumni_alamat" class="form-control" id="alumni_alamat" cols="30" rows="5"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label for="alumni_tahun_ajaran1" class="placeholder" style="margin-left: 15px">Awal tahun ajaran</label>
                                                        <input type="number" class="form-control" name="alumni_tahun_ajaran1">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="alumni_tahun_ajaran2" class="placeholder" style="margin-left: 15px">Akhir tahun ajaran</label>
                                                        <input type="number" class="form-control" name="alumni_tahun_ajaran2">
                                                    </div>
                                                </div>
                                                <div class="radiooption" style="margin-bottom: 20px">
                                                    <label class="placeholder" style="width: 100%">Jurusan</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_jurusan" id="titl" value="TITL" required>
                                                        <label class="form-check-label" for="titl">Teknik Instalasi Tenaga Listrik</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_jurusan" id="rpl" value="RPL" required>
                                                        <label class="form-check-label" for="rpl">Rekayasa Perangkat Lunak</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_jurusan" id="wd" value="WD" required>
                                                        <label class="form-check-label" for="wd">Teknik Pengelasan</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_jurusan" id="tpm" value="TPM" required>
                                                        <label class="form-check-label" for="tpm">Teknik Permesinan</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_jurusan" id="tl" value="TL" required>
                                                        <label class="form-check-label" for="tl">Teknik Logistik</label>
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="email" class="placeholder">Email valid (periksa notifikasi email)</label>
                                                    <input type="email" class="form-control" id="email" name="alumni_email" required>
                                                </div>
                                                <div class="radiooption" style="margin-bottom: 20px">
                                                    <label class="placeholder" style="width: 100%">Kegiatan Terakhir</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_kegiatan" id="bekerja" value="bekerja" required>
                                                        <label class="form-check-label" for="bekerja">Bekerja</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_kegiatan" id="kuliah" value="kuliah" required>
                                                        <label class="form-check-label" for="kuliah">Melanjutkan Kuliah</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input radio" type="radio" name="alumni_kegiatan" id="wirausaha" value="wirausaha" required>
                                                        <label class="form-check-label" for="wirausaha">Wirausaha</label>
                                                    </div>
                                                    <div class="form-group" style="margin-top: 30px">
                                                        <label for="keterangan_kegiatan" id="label_keterangan_kegiatan_terakhir" class="placeholder">Keterangan Kegiatan Terakhir</label>
                                                        <input type="text" name="alumni_keterangan" id="keterangan_kegiatan">
                                                    </div>
                                                </div>

                                                <label class="placeholder" style="width: 100%">Foto Alumni (Max 2mb)</label>
                                                <div class="form-group">
                                                    <input type="file" class="form-control" accept="image/*" name="alumni_image" id="alumni_image" placeholder="Pilih file gambar...">
                                                    <br>
                                                    <div class="card-body" style="max-width: 150px">
                                                        <div class="frame">
                                                            <img src="{{asset('thankyou.png')}}" alt="Gambar" id="previewImage"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label class="placeholder" style="width: 100%">Sertifikat Keterampilan Yang dimiliki Alumni</label>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <input type="file" class="form-control" accept="image/*" name="alumni_image" id="alumni_image" placeholder="Pilih file gambar...">
                                                        </div>
                                                        <div class="col-3">
                                                            <button class="rbt-btn btn-sm btn-gradient w-100"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="rbt-btn btn-gradient w-100" id="daftar">Submit Form</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="pricing-badge"><span>Pendataan</span></div>
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
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.radio').on('click', function (e) {
        if (this.value == 'bekerja') {
            $('#label_keterangan_kegiatan_terakhir').html('Baigan pekerjaan & nama pekerjaan');
        }else if (this.value == 'kuliah') {
            $('#label_keterangan_kegiatan_terakhir').html('Jurusan & nama perguruan tinggi');
        }else if (this.value == 'wirausaha') {
            $('#label_keterangan_kegiatan_terakhir').html('Jenis wirausaha yang dijalankan');
        }
        else {
            $('#label_keterangan_kegiatan_terakhir').html('Keterangan Kegiatan Terakhir'); // Jika tidak ada yang dipilih, kembalikan label ke nilai asal
        }
    })

    // Ambil elemen input file
    const fileInput = document.getElementById('alumni_image');
    // Ambil elemen img untuk preview gambar
    const previewImage = document.getElementById('previewImage');

    // Ketika pengguna memilih file
    fileInput.addEventListener('change', function() {
        // Pastikan ada file yang dipilih
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            // Membaca file sebagai URL data
            reader.readAsDataURL(fileInput.files[0]);

            // Ketika file selesai dibaca
            reader.onload = function(e) {
                // Tampilkan gambar yang dipilih dalam elemen img
                previewImage.src = e.target.result;
            }
        }
    });

    $('#form-pendaftaran').submit(function (e) {
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
            url: "registrasi/alumni",
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
                    $('#form-pendaftaran')[0].reset();
                    previewImage.src = "{{asset('thankyou.png')}}";
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