@extends('layouts.raw')

@section('content')
<div class="row">

    @include('backend.component.block-informasi',[
      'text' => 'total posting',
      'id' => 'total-informasi-posting',
      'keterangan' => '- ?',
      'icon' => 'ni ni-paper-diploma',
      'color' => 'success'
    ])

  <div class="row mt-4">

   @include('backend.component.message_block')

   <div class="col-12">
        @include('backend.component.button-add',['text'=>'ADD NEW POSTING','onclick'=>'newPost()'])
   </div>

    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>POSTING TABLE</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">post</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Parent</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Dibuat</th>
                  <th class="text-secondary text-center opacity-7">...</th>
                </tr>
              </thead>
              <tbody id="post_table"></tbody>
              <tfoot>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                  <th class="text-secondary text-center opacity-7"></th>
                </tr>
              </tfoot>
            </table>
           @include('layouts.null-data',['class'=>'null-data-post'])
          </div>
        </div>
        <div class="card-footer px-0 pt-2 pb-0 border-top">
          <div class="pagination-post" style="margin-left: 20px;">
            {{--  --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="newPostModal" tabindex="-1" role="dialog" aria-labelledby="newPostModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <label for="konten_id">PILIH JENIS KONTEN</label>
          <select name="konten_id" class="form-control text-capitalize" id="konten_id">
            <option value="">...</option>
            @foreach ($konten as $item)
              <option value="{{$item->id}}">{{$item->konten_name}}</option>                
            @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="#" type="button" id="create_post" class="btn btn-primary">Ok</a>
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
        url: '/admin-post',
        method: 'GET',
        data: {
          tipe: 'posting'
        },
        success: function (response) {
          $('#total-informasi-posting').html(response.data_posting.total + ' posting')
          if (response.data_posting.data.length !== 0) {
            // console.log('wooo');
            $('.null-data-post').addClass('d-none');
            load_post(response.data_posting.data)
            pagination_post(1,response.data_posting.last_page)
            console.log(response);
          }else{
            $('#post_table').addClass('d-none');
          }
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });
  });

  function newPost() {
    console.log('oke');
    var myModal = new bootstrap.Modal(document.getElementById('newPostModal'));
    myModal.show();
  }

  konten_id     = null;
  $('#konten_id').on('change',function (e) {
    konten_id  = this.value;
    var baseUrl= window.location.protocol + "//" + window.location.host;
    // Mendapatkan elemen dengan ID 'myLink'
    var myLink = document.getElementById('create_post');
    // Menambahkan atribut href ke elemen
    myLink.href = baseUrl + '/admin-post-create/' +encryptBase64(konten_id);
  })


  function load_post(data) {
    var post_table = $('#post_table');
    post_table.empty();

    $.each(data, function (index, item) {
      var post_status = (item.post_status == 1) ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">InActive</span>';
      var kategories  = [];
      var thumbnail   = item.post_thumb;
      $.each(item.kategori, function (index2, item2) {
        kategories.push(item2.kategori_name);
      })

      var row = `<tr>
        <td>
          <div class="d-flex px-2 py-1">
            <div>
              <img src="{{asset("images_thumbnail/")}}/${thumbnail}" class="avatar avatar-sm me-3" alt="post_image">
            </div>
            <div class="d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm text-capitalize">${item.post_title.substring(0, 50)}..</h6>
              <p class="text-xs text-secondary mb-0">post</p>
            </div>
          </div>
        </td>
        <td>
          <p class="text-xs font-weight-bold mb-0 text-capitalize">${item.konten.konten_name}</p>
          <p class="text-xs text-secondary mb-0">${kategories}</p>
        </td>
        <td class="align-middle text-center text-sm">
          ${post_status}
        </td>
        <td class="align-middle text-center">
          <span class="text-secondary text-xs font-weight-bold">${moment(item.created_at).format('YYYY-MM-DD HH:mm:ss')}</span>
        </td>
        <td class="text-center">
          <a href="/admin-post-edit/${encryptBase64(item.id)}" style="margin-right:5px" class="btn btn-xs btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
            <i class="fa fa-pencil"></i>
          </a>
          <a href="javascript:;" onclick="deletepostConfirmation(${item.id})" style="margin-right:5px" class="btn btn-xs btn-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
            <i class="fa fa-trash"></i>
          </a>
        </td>
      </tr>`;

      post_table.append(row);
    });
  }

  function pagination_post(currentPage, lastPage) {
    var pagination = $('.pagination-post');
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

function loadData(page)
{
  $.ajax({
      url: '/admin-post?page='+page,
      method: 'GET',
      data:{
        tipe: 'posting'
      },
      success: function (response) {
          $('#total-informasi-posting').html(response.data_posting.total + ' posting')
          if (response.data_posting.data.length !== 0) {
            console.log('wooo');
            $('.null-data-post').addClass('d-none');
            load_post(response.data_posting.data)
            pagination_post(page,response.data_posting.last_page)
            console.log(response);
          }else{
            $('#post_table').addClass('d-none');
          }
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
  });
}

function deletepostConfirmation(id) {
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
      url: `/admin-post-destroy/${id}`,
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
      url: '/admin-post',
      method: 'GET',
      data: {
        tipe: 'posting'
      },
      success: function (response) {
        $('#total-informasi-posting').html(response.data_posting.total + ' posting')
          if (response.data_posting.data.length !== 0) {
           
            $('.null-data-post').addClass('d-none');
            load_post(response.data_posting.data)
            pagination_post(1,response.data_posting.last_page)
          }else{
            $('#post_table').addClass('d-none');
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