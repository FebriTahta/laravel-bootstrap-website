<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        // do something here
        $('#summernote').summernote({
            height:300
        });
    });
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


    var maxField    = 10; //Input fields increment limitation
    var addButton   = $('.add_images'); //Add button selector
    var addButtonFile   = $('.add_file'); //Add button selector
    var wrapper     = $('.images_wrapp'); //Input field wrapper
    var wrapperFile     = $('.file_wrapp'); //Input field wrapper
    var fieldHTML   =   '<div class="col-md-10" style="margin-bottom:5px">'
                            +'<input type="file" name="images[]" accept="image/*" class="form-control">'
                        +'</div>'
                        +'<div class="col-md-2 text-center" style="margin-bottom:5px">'
                            +'<button class="btn btn-md btn-danger dell_images w-100" type="button"><i class="fa fa-minus"></i></button>'
                        +'</div>';

    var fieldHTMLFile   =   '<div class="col-md-10" style="margin-bottom:5px">'
                            +'<input type="file" name="file[]" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,.pdf" class="form-control">'
                        +'</div>'
                        +'<div class="col-md-2 text-center" style="margin-bottom:5px">'
                            +'<button class="btn btn-md btn-danger dell_file w-100" type="button"><i class="fa fa-minus"></i></button>'
                        +'</div>';

    var x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    $(addButtonFile).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapperFile).append(fieldHTMLFile); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.dell_images', function () {
        $(this).parent('div').prev('div').remove(); //Remove field html
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $(wrapperFile).on('click', '.dell_file', function () {
        $(this).parent('div').prev('div').remove(); //Remove field html
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $('#form_store').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: "/admin-post-store",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.status == 200) {
                    // Tampilkan SweetAlert setelah sukses
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Redirect atau lakukan tindakan lain setelah menekan OK
                        if (result.isConfirmed) {
                            var baseUrl = window.location.origin;
                            window.location.href = baseUrl+'/admin-post';
                        }
                    });   
                }else{
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(error) {
                console.error('Error dalam pengecekan AJAX:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to submit the form',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    })




    // edit script
    $('.remove-image').on('click', function() {
        var key = $(this).data('key');
        
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus gambar ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Hapus elemen gambar dan tombol minus
                $.ajax({
                    method: 'GET',
                    url: "/admin-image-destroy/" + key,
                    success: function(response) {
                        if (response.status == 200) {
                            // Tampilkan SweetAlert setelah sukses
                            $('#imageContainer_' + key).remove();
                            Swal.fire(
                                'Berhasil!',
                                'Gambar telah dihapus.',
                                'success'
                            );
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(error) {
                        
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to deleting the image',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });

    $('.remove-file').on('click', function() {
        var key = $(this).data('key');
        
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus file ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Hapus elemen gambar dan tombol minus
                $.ajax({
                    method: 'GET',
                    url: "/admin-file-destroy/" + key,
                    success: function(response) {
                        if (response.status == 200) {
                            // Tampilkan SweetAlert setelah sukses
                            $('#fileContainer_' + key).remove();
                            Swal.fire(
                                'Berhasil!',
                                'File telah dihapus.',
                                'success'
                            );
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(error) {
                        
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to deleting the file',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });

    $('#form_update').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: "/admin-post-update/{{$data->id ?? null}}",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.status == 200) {
                    // Tampilkan SweetAlert setelah sukses
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Redirect atau lakukan tindakan lain setelah menekan OK
                        if (result.isConfirmed) {
                            var baseUrl = window.location.origin;
                            window.location.href = baseUrl+'/admin-post';
                        }
                    });   
                }else{
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(error) {
                console.error('Error dalam pengecekan AJAX:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to submit the form',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    })
</script>