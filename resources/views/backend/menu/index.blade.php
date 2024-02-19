@extends('layouts.raw')

@section('content')
<div class="row">

    @include('backend.component.block-informasi',[
      'text' => 'total menu',
      'id' => 'total-informasi-menu',
      'keterangan' => '- ?',
      'icon' => 'ni ni-paper-diploma',
      'color' => 'success'
    ])

  @include('backend.component.block-informasi',[
    'text' => 'total submenu',
    'id' => 'total-informasi-submenu',
    'keterangan' => '- ?',
    'icon' => 'fas fa-code-branch',
    'color' => 'info'
  ])

<div class="container-fluid py-4">
  <div class="row mt-4">

    @include('backend.component.message_block')
 
    <div class="col-12">
     @include('backend.component.button-add',['link'=>'/admin-menu-create','text'=>'ADD NEW MENU'])
     @include('backend.component.button-add',['link'=>'/admin-submenu-create','text'=>'ADD NEW SUBMENU'])
    </div>
 
     <div class="col-12">
       <div class="card mb-4">
         <div class="card-header pb-0">
           <h6>MENU TABLE</h6>
         </div>
         <div class="card-body px-0 pt-0 pb-2">
           <div class="table-responsive p-0">
             <table class="table align-items-center mb-0">
               <thead>
                 <tr>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Menu</th>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Submenu</th>
                   <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                   <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Dibuat</th>
                   <th class="text-secondary text-center opacity-7">...</th>
                 </tr>
               </thead>
               <tbody id="menu_table"></tbody>
             </table>
            @include('layouts.null-data',['class'=>'null-data-menu'])
           </div>
         </div>
         <div class="card-footer px-0 pt-2 pb-0 border-top">
           <div class="pagination-menu" style="margin-left: 20px;">
             {{--  --}}
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="row">
     <div class="col-12">
       <div class="card mb-4">
         <div class="card-header pb-0">
           <h6>SUB-MENU TABLE</h6>
         </div>
         <div class="card-body px-0 pt-0 pb-2">
           <div class="table-responsive p-0">
             <table class="table align-items-center justify-content-center mb-0">
               <thead>
                 <tr>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Submenu</th>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">From Menu</th>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                   <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">...</th>
                 </tr>
               </thead>
               <tbody id="submenu_table"></tbody>
             </table>
             @include('layouts.null-data',['class'=>'null-data-submenu'])
           </div>
         </div>
         <div class="card-footer px-0 pt-2 pb-0 border-top">
           <div class="pagination-submenu" style="margin-left: 20px;">
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
        url: '/admin-menus',
        method: 'GET',
        data:{
          tipe: 'menu'
        },
        success: function (data) {
          Swal.close();
          $('#total-informasi-menu').html(data.data_menu.total + ' menu')
          if (data.data_menu.data.length !== 0) {
            $('.null-data-menu').addClass('d-none');
            load_menu(data.data_menu.data)
            pagination_menu(1,data.data_menu.last_page)
          }else{
            $('#menu_table').addClass('d-none');
          }
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });

    $.ajax({
        url: '/admin-submenus',
        method: 'GET',
        data:{
          tipe: 'submenu'
        },
        success: function (data) {
          $('#total-informasi-submenu').html(data.data_submenu.total + ' sub menu')
          if (data.data_submenu.data.length !== 0) {
            $('.null-data-submenu').addClass('d-none');
            load_submenu(data.data_submenu.data)
            pagination_submenu(1,data.data_submenu.last_page)
          }else{
            $('#submenu_table').addClass('d-none');
          }
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });
  })

function load_submenu(data) {
  var submenu_table = $('#submenu_table');
  submenu_table.empty();
  $.each(data, function (index, item) {
  var submenu_status = (item.submenu_status == 1) ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">InActive</span>';
  var submenu_text = (item.konten_count > 0) ? `${item.konten_count} konten` : `belum ada konten`;
  var row = `<tr>
    <td>
      <div class="d-flex px-2">
        <div>
          <img src="{{asset("assets/img/small-logos/logo-atlassian.svg")}}" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
        </div>
        <div class="d-flex flex-column justify-content-center">
            <h6 class="mb-0 text-sm text-capitalize">${item.submenu_name}</h6>
            <p class="text-xs text-secondary mb-0">${submenu_text}</p>
        </div>
      </div>
    </td>
    <td>
      <p class="text-sm font-weight-bold mb-0 text-capitalize">${item.menu.menu_name}</p>
    </td>
    <td>
      <span class="text-xs font-weight-bold">${submenu_status}</span>
    </td>
    <td class="text-center">
      <a href="/admin-submenu-edit/${encryptBase64(item.id)}" style="margin-right:5px" class="btn btn-xs btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
          <i class="fa fa-pencil"></i>
        </a>
        <a href="javascript:;" onclick="deleteSubmenuConfirmation(${item.id})" style="margin-right:5px" class="btn btn-xs btn-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
          <i class="fa fa-trash"></i>
        </a>
    </td>
  </tr>`;
  submenu_table.append(row);
  });
}

function load_menu(data) {
  var menu_table = $('#menu_table');
  menu_table.empty();

  $.each(data, function (index, item) {
    var menu_status = (item.menu_status == 1) ? '<span class="badge badge-sm bg-gradient-success">Active</span>' : '<span class="badge badge-sm bg-gradient-danger">InActive</span>';
    var menu_text = (item.submenu_count > 0) ? `submenu action` : `menu action ${item.konten_count} konten`;
    
    var row = `<tr>
      <td>
        <div class="d-flex px-2 py-1">
          <div>
            <img src="{{asset("assets/img/small-logos/logo-jira.svg")}}" class="avatar avatar-sm me-3" alt="menu_image">
          </div>
          <div class="d-flex flex-column justify-content-center">
            <h6 class="mb-0 text-sm text-capitalize">${item.menu_name}</h6>
            <p class="text-xs text-secondary mb-0">${menu_text}</p>
          </div>
        </div>
      </td>
      <td>
        <p class="text-xs font-weight-bold mb-0">Submenu</p>
        <p class="text-xs text-secondary mb-0">${item.submenu_count} Submenu</p>
      </td>
      <td class="align-middle text-center text-sm">
        ${menu_status}
      </td>
      <td class="align-middle text-center">
        <span class="text-secondary text-xs font-weight-bold">${moment(item.created_at).format('YYYY-MM-DD HH:mm:ss')}</span>
      </td>
      <td class="text-center">
        <a href="/admin-menu-edit/${encryptBase64(item.id)}" style="margin-right:5px" class="btn btn-xs btn-info font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
          <i class="fa fa-pencil"></i>
        </a>
        <a href="javascript:;" onclick="deleteMenuConfirmation(${item.id})" style="margin-right:5px" class="btn btn-xs btn-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
          <i class="fa fa-trash"></i>
        </a>
      </td>
    </tr>`;

    menu_table.append(row);
  });
}

function pagination_menu(currentPage, lastPage) {
    var pagination = $('.pagination-menu');
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

function pagination_submenu(currentPage, lastPage) {
    var pagination = $('.pagination-submenu');
    pagination.empty();
    var row = '';

    // Tombol "prev"
    if (currentPage > 1) {
        row += `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData2(${currentPage - 1})">Prev</button>`;
    }

    // Tombol halaman
    var maxPagesToShow = 3; // Jumlah maksimal tombol halaman yang ditampilkan
    var halfMaxPagesToShow = Math.floor(maxPagesToShow / 3);
    var startPage = Math.max(1, currentPage - halfMaxPagesToShow);
    var endPage = Math.min(lastPage, startPage + maxPagesToShow - 1);

    // Tampilkan tombol dari startPage hingga endPage
    for (let i = startPage; i <= endPage; i++) {
      if (i == currentPage) {
        row += `<button class="btn btn-xs btn-success" style="margin-right:5px" onclick="loadData2(${i})">${i}</button>`; 
      }else{
        row += `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData2(${i})">${i}</button>`; 
      }
    }

    // Tampilkan gap jika ada halaman yang terlewat
    if (startPage > 1) {
        row = `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData2(1)">1</button> <button class="btn btn-xs ntn-secondary" disabled>...</button> ` + row;
    }

    if (endPage < lastPage) {
        row += ` <button class="btn btn-xs ntn-secondary" disabled>...</button> <button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData2(${lastPage})">${lastPage}</button>`;
    }

    // Tombol "next"
    if (currentPage < lastPage) {
        row += `<button class="btn btn-xs btn-primary" style="margin-right:5px" onclick="loadData2(${currentPage + 1})">Next</button>`;
    }

    pagination.html(row);
}

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
      url: '/admin-menus?page='+page,
      method: 'GET',
      data:{
        tipe: 'menu'
      },
      success: function (data) {
        Swal.close();
        console.log(data);
        load_menu(data.data_menu.data)
        pagination_menu(data.data_menu.current_page,data.data_menu.last_page)
      },
      error: function (error) {
          console.error('Error fetching data:', error);
      }
  });
}

function loadData2(page)
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
      url: '/admin-submenus?page='+page,
      method: 'GET',
      data:{
        tipe: 'submenu'
      },
      success: function (data) {
        Swal.close();
        console.log(data);
        load_submenu(data.data_submenu.data)
        pagination_submenu(data.data_submenu.current_page,data.data_submenu.last_page)
      },
      error: function (error) {
          console.error('Error fetching data:', error);
      }
  });
}

function deleteMenuConfirmation(id) {
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

function deleteSubmenuConfirmation(id) {
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
            deleteData2(id)
            console.log(id);
        }
    });
}

function deleteData(id) {
    // Implementasi penghapusan data di sini
    $.ajax({
      url: `/admin-menu-destroy/${id}`,
      method: 'GET',
      success: function (response) {
        if (response.status == 200) {
          Swal.fire(response.message, '', 'success');
          reload_table();
        }else{
          Swal.fire(response.message, '', 'error');
        }
      },
      error: function (error) {
          Swal.fire('Error!', 'Gagal menghapus data.', 'error');
          console.error('Error deleting data:', error);
      }
  });
}


function deleteData2(id) {
    // Implementasi penghapusan data di sini
    $.ajax({
      url: `/admin-submenu-destroy/${id}`,
      method: 'GET',
      success: function (response) {
        if (response.status == 200) {
          Swal.fire(response.message, '', 'success');
          reload_table();
        }else{
          Swal.fire(response.message, '', 'error');
        }
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
      url: '/admin-menus',
      method: 'GET',
      data:{
        tipe: 'menu'
      },
      success: function (data) {
        Swal.close();
        $('#total-informasi-menu').html(data.data_menu.total + ' menu')
        if (data.data_menu.data.length !== 0) {
          $('.null-data-menu').addClass('d-none');
          load_menu(data.data_menu.data)
          pagination_menu(1,data.data_menu.last_page)
        }else{
          $('#menu_table').addClass('d-none');
          $('.null-data-menu').removeClass('d-none');
        }
      },
      error: function (error) {
          console.error('Error fetching data:', error);
      }
  });

  $.ajax({
      url: '/admin-submenus',
      method: 'GET',
      data:{
        tipe: 'submenu'
      },
      success: function (data) {
        $('#total-informasi-submenu').html(data.data_submenu.total + ' sub menu')
        if (data.data_submenu.data.length !== 0) {
          $('.null-data-submenu').addClass('d-none');
          load_submenu(data.data_submenu.data)
          pagination_submenu(1,data.data_submenu.last_page)
        }else{
          $('#submenu_table').addClass('d-none');
          $('.null-data-submenu').removeClass('d-none');
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