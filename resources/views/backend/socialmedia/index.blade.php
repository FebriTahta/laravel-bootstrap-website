@extends('layouts.raw')

@section('content')
<div class="row">

    @include('backend.component.block-informasi',[
      'text' => 'total socialmedia',
      'id' => 'total-informasi-socialmedia',
      'keterangan' => '- ?',
      'icon' => 'ni ni-paper-diploma',
      'color' => 'success'
    ])

<div class="container-fluid py-4">
  <div class="row mt-4">

    @include('backend.component.message_block')
 
    <div class="col-12">
         @include('backend.component.button-add',['link'=>'/admin-socialmedia-create','text'=>'ADD NEW SOCIALMEDIA'])
    </div>
 
     <div class="col-12">
       <div class="card mb-4">
         <div class="card-header pb-0">
           <h6>SOCIAL MEDIA TABLE</h6>
         </div>
         <div class="card-body px-0 pt-0 pb-2">
           <div class="table-responsive p-0">
             <table class="table align-items-center mb-0">
               <thead>
                 <tr>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SOCIAL MEDIA</th>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SOCIAL MEDIA LINK</th>
                   <th class="text-secondary text-center opacity-7">...</th>
                 </tr>
               </thead>
               <tbody id="socialmedia_table"></tbody>
             </table>
            @include('layouts.null-data',['class'=>'null-data-socialmedia'])
           </div>
         </div>
         <div class="card-footer px-0 pt-2 pb-0 border-top">
           <div class="pagination-socialmedia" style="margin-left: 20px;">
             {{--  --}}
           </div>
         </div>
       </div>
     </div>
   </div>
</div>
  
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    $(document).ready(function () {
      Swal.fire({
        title: 'Loading...',
        html: 'Sedang memproses permintaan.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
      $.ajax({
          url: '/admin-socialmedia',
          method: 'GET',
          data: {
            tipe: 'socialmedia'
          },
          success: function (response) {
            Swal.close();
            $('#total-informasi-socialmedia').html(response.data_socialmedia.total + ' socialmedia')
            if (response.data_socialmedia.data.length !== 0) {
              $('.null-data-socialmedia').addClass('d-none');
              load_socialmedia(response.data_socialmedia.data)
              pagination_socialmedia(1,response.data_socialmedia.last_page)
              
            }else{
              $('#socialmedia_table').addClass('d-none');
            }
          },
          error: function (error) {
              console.error('Error fetching data:', error);
          }
      });
    });

    function loadData(page)
    {
      Swal.fire({
        title: 'Loading...',
        html: 'Sedang memproses permintaan.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
      });
      $.ajax({
          url: '/admin-socialmedia?page='+page,
          method: 'GET',
          data:{
            tipe: 'socialmedia'
          },
          success: function (response) {
            Swal.close();
            $('#total-informasi-socialmedia').html(response.data_socialmedia.total + ' socialmedia')
            if (response.data_socialmedia.data.length !== 0) {
              $('.null-data-socialmedia').addClass('d-none');
              load_socialmedia(response.data_socialmedia.data);
              pagination_socialmedia(page,response.data_socialmedia.last_page)
              
            }else{
              $('#socialmedia_table').addClass('d-none');
            }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
      });
    }

    function load_socialmedia(data) {
        var socialmedia_table = $('#socialmedia_table');
        var socialmedia_icon  = null;
        socialmedia_table.empty();

        $.each(data, function (index, item) {
            var socialmedia_icon = '';

            if (item.socialmedia_name == 'tiktok') {
                socialmedia_icon = `Social Media * <img src="{{ asset('assets/icon-tiktok.png') }}" style="width:12px">`;
            } 
            else if (item.socialmedia_name == 'discord') {
                socialmedia_icon = `Social Media * <img src="{{ asset('assets/icon-discord.png') }}" style="width:12px">`;
            }
            else if (item.socialmedia_name == 'threads') {
                socialmedia_icon = `Social Media * <img src="{{ asset('assets/icon-thread.png') }}" style="width:12px">`;
            }
            else {
                socialmedia_icon = `Social Media * <i class="${item.socialmedia_icon}"></i>`;
            }

            var row = `<tr>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="{{ asset('assets/img/small-logos/logo-jira.svg') }}" class="avatar avatar-sm me-3" alt="socialmedia_image">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm text-capitalize">${item.socialmedia_name}</h6>
                            <p class="text-xs text-secondary mb-0">${socialmedia_icon}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0 text-capitalize">${item.socialmedia_source}</p>
                    <p class="text-xs text-secondary mb-0">${item.socialmedia_icon}</p>
                </td>
                <td class="text-center">
                  <a href="/admin-socialmedia-edit/${encryptBase64(item.id)}" style="margin-right:5px" class="btn btn-xs btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="javascript:;" onclick="deletesocialmediaConfirmation(${item.id})" style="margin-right:5px" class="btn btn-xs btn-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
            </tr>`;

            socialmedia_table.append(row);
        });
    }

    function pagination_socialmedia(currentPage, lastPage) {
      var pagination = $('.pagination-socialmedia');
      pagination.empty();
      var row = '';

      // Tombol "prev"
      if (currentPage > 1) {
          row += `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData(${currentPage - 1})">Prev</button>`;
      }

      // Tombol halaman
      var maxPagesToShow = 3; // Jumlah maksimal tombol halaman yang ditampilkan
      var halfMaxPagesToShow = Math.floor(maxPagesToShow / 3);
      var startPage = Math.max(1, currentPage - halfMaxPagesToShow);
      var endPage = Math.min(lastPage, startPage + maxPagesToShow - 1);

      // Tampilkan tombol dari startPage hingga endPage
      for (let i = startPage; i <= endPage; i++) {
        if (i == currentPage) {
          row += `<button class="btn btn-xs btn-success" style="margin-right:5px" onclick="loadData(${i})">${i}</button>`; 
        }else{
          row += `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData(${i})">${i}</button>`; 
        }
      }

      // Tampilkan gap jika ada halaman yang terlewat
      if (startPage > 1) {
          row = `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData(1)">1</button> <button class="btn btn-xs ntn-secondary" disabled>...</button> ` + row;
      }

      if (endPage < lastPage) {
          row += ` <button class="btn btn-xs ntn-secondary" disabled>...</button> <button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData(${lastPage})">${lastPage}</button>`;
      }

      // Tombol "next"
      if (currentPage < lastPage) {
          row += `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData(${currentPage + 1})">Next</button>`;
      }

      pagination.html(row);
  }

  function deletesocialmediaConfirmation(id) {
      Swal.fire({
          title: 'Konfirmasi Hapus',
          text: 'Anda yakin ingin menghapus data ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              deleteData(id)
          }
      });
  }

  function deleteData(id) {
      // Implementasi penghapusan data di sini
      $.ajax({
        url: `/admin-socialmedia-destroy/${id}`,
        method: 'GET',
        success: function (response) {
            Swal.fire(response.message, '', 'success');
            reload_table();
        },
        error: function (error) {
            Swal.fire('Error!', 'Gagal menghapus data.', 'error');
            console.error('Error deleting data:', error);
        }
    });
  }

  function reload_table() {
    Swal.fire({
        title: 'Loading...',
        html: 'Sedang memproses permintaan.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
      });
    $.ajax({
        url: '/admin-socialmedia',
        method: 'GET',
        data: {
          tipe: 'socialmedia'
        },
        success: function (response) {
          Swal.close();
          $('#total-informasi-socialmedia').html(response.data_socialmedia.total + ' socialmedia')
          if (response.data_socialmedia.data.length !== 0) {
            $('.null-data-socialmedia').addClass('d-none');
            load_socialmedia(response.data_socialmedia.data)
            pagination_socialmedia(1,response.data_socialmedia.last_page)
            
          }else{
            $('#socialmedia_table').addClass('d-none');
          }
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });
  }
  function encryptBase64(value) {
    return btoa(value); // Menggunakan btoa() untuk melakukan enkripsi Base64
}
  </script>
@endsection