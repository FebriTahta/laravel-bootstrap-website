@extends('layouts.raw')

@section('content')
<div class="row">

    @include('backend.component.block-informasi',[
      'text' => 'total konten',
      'id' => 'total-informasi-konten',
      'keterangan' => '- ?',
      'icon' => 'ni ni-paper-diploma',
      'color' => 'success'
    ])

  <div class="row mt-4">

   @include('backend.component.message_block')

   <div class="col-12">
        @include('backend.component.button-add',['link'=>'/admin-konten-create','text'=>'ADD NEW KONTEN'])
   </div>

    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>KONTEN TABLE</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Konten</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Parent</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Dibuat</th>
                  <th class="text-secondary text-center opacity-7">...</th>
                </tr>
              </thead>
              <tbody id="konten_table"></tbody>
            </table>
           @include('layouts.null-data',['class'=>'null-data-konten'])
          </div>
        </div>
        <div class="card-footer px-0 pt-2 pb-0 border-top">
          <div class="pagination-konten" style="margin-left: 20px;">
            {{--  --}}
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
      $.ajax({
          url: '/admin-konten',
          method: 'GET',
          data: {
            tipe: 'konten'
          },
          success: function (response) {
            $('#total-informasi-konten').html(response.data_konten.total + ' konten')
            if (response.data_konten.data.length !== 0) {
              $('.null-data-konten').addClass('d-none');
              load_konten(response.data_konten.data)
              pagination_konten(1,response.data_konten.last_page)
              
            }else{
              $('#konten_table').addClass('d-none');
            }
          },
          error: function (error) {
              console.error('Error fetching data:', error);
          }
      });
    });

    function loadData(page)
    {
      $.ajax({
          url: '/admin-konten?page='+page,
          method: 'GET',
          data:{
            tipe: 'konten'
          },
          success: function (response) {
            $('#total-informasi-konten').html(response.data_konten.total + ' konten')
            if (response.data_konten.data.length !== 0) {
              $('.null-data-konten').addClass('d-none');
              load_konten(response.data_konten.data)
              pagination_konten(page,response.data_konten.last_page)
              
            }else{
              $('#konten_table').addClass('d-none');
            }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
      });
    }

    function load_konten(data) {
      var konten_table = $('#konten_table');
      konten_table.empty();

      $.each(data, function (index, item) {
        var konten_status = (item.konten_status == 1) ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">InActive</span>';
        var kontentable = (item.kontentable_type == 'App\\Models\\Submenu') ? item.kontentable.submenu_name : item.kontentable.menu_name;
        
        var row = `<tr>
          <td>
            <div class="d-flex px-2 py-1">
              <div>
                <img src="{{asset("assets/img/small-logos/logo-jira.svg")}}" class="avatar avatar-sm me-3" alt="konten_image">
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm text-capitalize">${item.konten_name}</h6>
                <p class="text-xs text-secondary mb-0">konten</p>
              </div>
            </div>
          </td>
          <td>
            <p class="text-xs font-weight-bold mb-0 text-capitalize">${kontentable}</p>
            <p class="text-xs text-secondary mb-0">${item.kontentable_type}</p>
          </td>
          <td class="align-middle text-center text-sm">
            ${konten_status}
          </td>
          <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">${moment(item.created_at).format('YYYY-MM-DD HH:mm:ss')}</span>
          </td>
          <td class="text-center">
            <a href="/admin-konten-edit/${item.id}" style="margin-right:5px" class="btn btn-xs btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
              <i class="fa fa-pencil"></i>
            </a>
            <a href="javascript:;" onclick="deleteKontenConfirmation(${item.id})" style="margin-right:5px" class="btn btn-xs btn-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
              <i class="fa fa-trash"></i>
            </a>
          </td>
        </tr>`;

        konten_table.append(row);
      });
    }

    function pagination_konten(currentPage, lastPage) {
      var pagination = $('.pagination-konten');
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

  function deleteKontenConfirmation(id) {
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
        url: `/admin-konten-destroy/${id}`,
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
    $.ajax({
        url: '/admin-konten',
        method: 'GET',
        data: {
          tipe: 'konten'
        },
        success: function (response) {
          $('#total-informasi-konten').html(response.data_konten.total + ' konten')
          if (response.data_konten.data.length !== 0) {
            $('.null-data-konten').addClass('d-none');
            load_konten(response.data_konten.data)
            pagination_konten(1,response.data_konten.last_page)
            
          }else{
            $('#konten_table').addClass('d-none');
          }
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });
  }
  </script>
@endsection