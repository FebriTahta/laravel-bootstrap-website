<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    
    var imageInput = document.getElementById('profile_logo');
    var imagePreview = document.getElementById('imagePreview');

    var imageInput2 = document.getElementById('profile_thumb');
    var imagePreview2 = document.getElementById('imagePreview2');

    var imageInput3 = document.getElementById('profile_heroimage');
    var imagePreview3 = document.getElementById('imagePreview3');
    
    $('#profile_logo').on('change',function () {
         
        var selectedFile = imageInput.files[0];
        if (selectedFile && selectedFile.type.startsWith('image/')) {
            var imageURL = URL.createObjectURL(selectedFile);
            imagePreview.src = imageURL;
        } else {
            alert('Please select a valid image file.');
            imageInput.value = null;
            imagePreview.src = '';
        }
    })

    $('#profile_thumb').on('change',function () {
         
        var selectedFile = imageInput2.files[0];
        if (selectedFile && selectedFile.type.startsWith('image/')) {
            var imageURL = URL.createObjectURL(selectedFile);
            imagePreview2.src = imageURL;
        } else {
            alert('Please select a valid image file.');
            imageInput2.value = null;
            imagePreview2.src = '';
        }
    })

    $('#profile_heroimage').on('change',function () {
         
        var selectedFile = imageInput3.files[0];
        if (selectedFile && selectedFile.type.startsWith('image/')) {
            var imageURL = URL.createObjectURL(selectedFile);
            imagePreview3.src = imageURL;
        } else {
            alert('Please select a valid image file.');
            imageInput3.value = null;
            imagePreview3.src = '';
        }
    })


    var maxField    = 10; //Input fields increment limitation
    var addButton   = $('.add_images'); //Add button selector
    var wrapper     = $('.images_wrapp'); //Input field wrapper
    var fieldHTML   =   '<div class="col-md-10" style="margin-bottom:5px">'
                            +'<input type="file" name="images[]" accept="image/*" class="form-control">'
                        +'</div>'
                        +'<div class="col-md-2 text-center" style="margin-bottom:5px">'
                            +'<button class="btn btn-md btn-danger dell_images w-100" type="button"><i class="fa fa-minus"></i></button>'
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

    //Once remove button is clicked
    $(wrapper).on('click', '.dell_images', function () {
        $(this).parent('div').prev('div').remove(); //Remove field html
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $('#form_store').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: "/admin-setting-store",
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
                            window.location.href = baseUrl+'/admin-setting';
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
</script>