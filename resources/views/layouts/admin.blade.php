
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>BKD Balangan</title>
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{Route('adminIndex')}}" class="brand-link">
      <img src="{{asset('img/logo.png')}}" alt="AdminLTE Logo" class="brand-image  elevation-3"
           style="opacity: .9">
      <span class="brand-text font-weight-light">SIMPEG BKD</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/img/user/'.Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->username}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{Route('kecamatanIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kecamatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{Route('kelurahanIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kelurahan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{Route('instansiIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Instansi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{Route('unitKerjaIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit Kerja</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-restroom"></i>
              <p>
                Kepegawaian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{Route('pangkatIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>pangkat / Golongan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{Route('jabatanIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{Route('diklatIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>program Diklat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('pegawaiIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{Route('pendidikanIndex')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Pendidikan Formal</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p> SKP</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{Route('beritaIndex')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Berita
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{Route('adminIndex')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  @yield('content')

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/sweetalert/sweetalert.all.min.js')}}"></script>
<script src="{{asset('admin/plugins/summernote/summernote.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


@yield('script')
</body>
</html>
