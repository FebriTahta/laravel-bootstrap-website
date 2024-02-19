@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-alumni','text'=>'BACK'])

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">{{$title}}</p>
            </div>
          </div>
          <form id="form-audit_ulasan" method="POST">@csrf
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nama Alumni</label>
                      <input class="form-control" name="alumni_name" type="text" placeholder="input alumni name" value="{{$alumni->alumni_name}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Email Alumni</label>
                      <input class="form-control" name="alumni_email" type="email" placeholder="input alumni email" value="{{$alumni->alumni_email}}">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Awal Tahun Ajaran</label>
                        <input class="form-control" name="alumni_tahun_ajaran1" type="number" placeholder="input alumni email" value="{{$alumni->alumni_tahun_ajaran1}}">
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Akhir Tahun Ajaran</label>
                        <input class="form-control" name="alumni_tahun_ajaran2" type="number" placeholder="input alumni email" value="{{$alumni->alumni_tahun_ajaran2}}">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Jurusan</label>
                        <select name="alumni_jurusan" class="form-control" id="alumni_jurusan">
                            <option value="TITL"
                            @if ($alumni->alumni_jurusan == 'TITL')
                               selected
                            @endif
                            >Teknik Instalasi Tenaga Listrik</option>
                            <option value="RPL"
                            @if ($alumni->alumni_jurusan == 'RPL')
                               selected
                            @endif
                            >Rekayasa Perangkat Lunak</option>
                            <option value="WD"
                            @if ($alumni->alumni_jurusan == 'WD')
                               selected
                            @endif
                            >Teknik Pengelasan</option>
                            <option value="TPM"
                            @if ($alumni->alumni_jurusan == 'TPM')
                               selected
                            @endif
                            >Teknik Permesinan</option>
                            <option value="TL"
                            @if ($alumni->alumni_jurusan == 'TL')
                               selected
                            @endif
                            >Teknik Logistik</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Kegiatan Terakhir</label>
                        <input type="text" class="form-control" name="alumni_kegiatan" value="{{$alumni->alumni_kegiatan}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Keterangan Kegiatan</label>
                        <input type="text" class="form-control" name="alumni_keterangan" value="{{$alumni->alumni_keterangan}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Passpharse</label>
                        <input type="text" class="form-control" name="alumni_passpharse" value="{{$alumni->alumni_passpharse}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Alumni Status</label>
                      <select name="alumni_status" class="form-control" id="alumni_status" required>
                        <option value="1" @if ($alumni->alumni_status == 1)
                            selected
                        @endif>Active</option>
                        <option value="0" value="1" @if ($alumni->alumni_status == 0)
                            selected
                        @endif>InActive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                    <label>Image <span class="text-danger">Max : 5MB</span> </label>
                    <input type="file" name="alumni_image" id="post_thumb" accept="image/*" class="form-control">
                    <img id="imagePreview" style="margin-top: 20px; max-width:300px; margin-bottom:20px" src="{{asset('alumni_image/'.$alumni->alumni_image)}}" style="max-width: 300px; max-height: 300px;" alt="Image Preview">
                </div>

                <hr>
                @if ($alumni->ulasan == null)
                    <p class="alert alert-danger text-white" style="font-size: 12px">
                        Belum ada ulasan...
                        <br>
                        Tambahkan ulasan sendiri ?
                    </p>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="alumni_id" value="{{$alumni->id}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Rating Ulasan</label>
                        <select name="stars" class="form-control" id="rating_ulasan">
                            <option value="1">1 Stars</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Deskripsi Ulasan</label>
                        <textarea name="deskripsi_ulasan" class="form-control" id="deskripsi_ulasan" cols="30" rows="5"
                        placeholder="Maksimal 120 karakter"></textarea>
                    </div>
                </div>

                @else
                <hr>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="alumni_id" value="{{$alumni->id}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Rating Ulasan</label>
                        <select name="stars" class="form-control" id="rating_ulasan">
                            <option value="1"
                            @if ($alumni->ulasan->rating_ulasan == 1)
                                selected
                            @endif
                            >1 Stars</option>
                            <option value="2"
                            @if ($alumni->ulasan->rating_ulasan == 2)
                                selected
                            @endif
                            >2 Stars</option>
                            <option value="3"
                            @if ($alumni->ulasan->rating_ulasan == 3)
                                selected
                            @endif>3 Stars</option>
                            <option value="4"
                            @if ($alumni->ulasan->rating_ulasan == 4)
                                selected
                            @endif>4 Stars</option>
                            <option value="5"
                            @if ($alumni->ulasan->rating_ulasan == 5)
                                selected
                            @endif>5 Stars</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Deskripsi Ulasan</label>
                        <textarea name="deskripsi_ulasan" class="form-control" id="deskripsi_ulasan" cols="30" rows="5"
                        placeholder="Maksimal 150 karakter">{!!$alumni->ulasan->deskripsi_ulasan!!}</textarea>
                    </div>
                </div>
                @endif
                <button type="submit" class="btn btn-primary btn-sm ms-auto">SUBMIT</button>
              </div>
          </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>

    // Mendapatkan referensi elemen input dan elemen pratinjau
    var imageInput = document.getElementById('post_thumb');
    var imagePreview = document.getElementById('imagePreview');
    
    // Menambahkan event listener untuk mendeteksi perubahan pada input file
    $('#post_thumb').on('change',function () {
         // Mendapatkan file yang dipilih
         var selectedFile = imageInput.files[0];
    
        // Mengecek apakah file yang dipilih adalah gambar
        if (selectedFile && selectedFile.type.startsWith('image/')) {
            // Membuat objek URL untuk pratinjau gambar
            var imageURL = URL.createObjectURL(selectedFile);

            // Menetapkan pratinjau gambar
            imagePreview.src = imageURL;
        } else {
            // Jika bukan gambar, menampilkan pesan kesalahan (opsional)
            alert('Please select a valid image file.');
            // Mengosongkan input file dan pratinjau
            imageInput.value = null;
            imagePreview.src = '';
        }
    })

    $('#form-audit_ulasan').submit(function (e) {
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
            url: "{{route('admin.audit_ulasan')}}",
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
                   
                    var base_url = window.location.origin;
                    // Memberikan jeda waktu 3 detik sebelum berpindah halaman
                    setTimeout(function() {
                        // Pengalihan halaman dilakukan setelah 3 detik
                        window.location.href = base_url + '/admin-alumni';
                    }, 3000);

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