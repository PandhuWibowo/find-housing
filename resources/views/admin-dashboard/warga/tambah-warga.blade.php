<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cari Alamat</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    #map {
      height: 700px;
      width: 100%
    }

    #autocomplete {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 800px;
      margin-top: 10px;
    }

    #autocomplete:focus {
      border-color: #4d90fe;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="{{ Session::get('id_user') }}">
        </div>
        <div class="info">
          <a class="d-block">{{ Session::get('nama') }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/users" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/warga" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Warga</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/peta/cari-alamat" class="nav-link">
              <i class="nav-icon fas fa-street-view"></i>
              <p>Cari Alamat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/reports" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/signout">
              <button type="button" class="btn btn-block btn-outline-danger btn-flat">Sign Out</button>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Warga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Warga</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="no_kk">No. Kartu Keluarga</label>
                    <input type="text" class="form-control" id="no_kk" placeholder="No. Kartu Keluarga">
                  </div>
                  <div class="form-group">
                    <label for="nik_kepala_keluarga">NIK Kepala Keluarga</label>
                    <input type="text" class="form-control" id="nik_kepala_keluarga" placeholder="NIK Kepala Keluarga">
                  </div>
                  <div class="form-group">
                    <label for="domisili_kartu_keluarga">Domisili</label>
                    <input type="text" class="form-control" id="domisili_kartu_keluarga" placeholder="Domisili">
                  </div>
                  <div class="form-group">
                    <label for="status_tempat_tinggal">Status Tempat Tinggal</label>
                    <input type="text" class="form-control" id="status_tempat_tinggal" placeholder="Status Tempat Tinggal">
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" placeholder="NIK">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" rows="3" placeholder="Alamat" id="alamat"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" value="2011-08-19" placeholder="Tanggal Lahir">
                  </div>
                  <div class="form-group">
                    <label for="no_telp">No. Telpon</label>
                    <input type="text" class="form-control" id="no_telp" placeholder="No. Telpon">
                  </div>
                  <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <input type="text" class="form-control" id="pendidikan" placeholder="Pendidikan">
                  </div>
                  <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" placeholder="Pekerjaan">
                  </div>
                  <div class="form-group">
                    <label for="status_keluarga">Status Keluarga</label>
                    <input type="text" class="form-control" id="status_keluarga" placeholder="Status Keluarga">
                  </div>
                  <div class="form-group">
                    <label for="domisili">Domisili</label>
                    <input type="text" class="form-control" id="domisili" placeholder="Domisili">
                  </div>
                  <div class="form-group">
                    <label for="status_pernikahan">Status Pernikahan</label>
                    <select class="form-control" id="status_pernikahan">
                      <option>Kawin</option>
                      <option>Belum Kawin</option>
                      <option>Cerai Hidup</option>
                      <option>Cerai Mati</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="maps">Maps</label>
                    <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
                    <div id="map"></div>
                  </div>
                  <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control" id="latitude" placeholder="Latitude" readonly>
                  </div>
                  <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" class="form-control" id="longitude" placeholder="Longitude" readonly>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDwuNWNWNttuPVWT-TKQGniO4tXPN2kGU&libraries=places&callback=initMap">
</script>
<script src="{!! asset('assets/app-maps.js') !!}"></script>
<script>
  function csrfProtection() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  }

  $(document).ready(function() {
    $("#btn-save").on('click', function(e) {
      e.preventDefault()

      const noKK = $('#no_kk').val()
      const nikKepalaKeluarga = $('#nik_kepala_keluarga').val()
      const statusTempatTinggal = $('#status_tempat_tinggal').val()
      const nik = $('#nik').val()
      const nama = $("#nama").val()
      const noTelp = $("#no_telp").val()
      const alamat = $("textarea#alamat").val()
      const tanggalLahir = $('#tanggal_lahir').val()
      const pendidikan = $('#pendidikan').val()
      const pekerjaan = $("#pekerjaan").val()
      const statusKeluarga = $('#status_keluarga').val()
      const statusPernikahan = $('#status_pernikahan').val()
      const domisiliKartuKeluarga = $('#domisili_kartu_keluarga').val()
      const domisili = $('#domisili').val()
      const latitude = $('#latitude').val()
      const longitude = $('#longitude').val()
      try {
        csrfProtection()
        if (!noKK || typeof noKK !== 'string') {
          alert('No. Kartu Keluarga harus tidak boleh string kosong')
          return
        }
        if (!nikKepalaKeluarga || typeof nikKepalaKeluarga !== 'string') {
          alert('NIK Kepala Keluarga harus tidak boleh string kosong')
          return
        }
        if (!domisiliKartuKeluarga || typeof domisiliKartuKeluarga !== 'string') {
          alert('Domisili Kartu Keluarga harus tidak boleh string kosong')
          return
        }
        if (!domisili || typeof domisili !== 'string') {
          alert('Domisili Warga harus tidak boleh string kosong')
          return
        }
        if (!statusTempatTinggal || typeof statusTempatTinggal !== 'string') {
          alert('Status Tempat Tinggal harus tidak boleh string kosong')
          return
        }
        if (!nik || typeof nik !== 'string') {
          alert('NIK harus tidak boleh string kosong')
          return
        }
        if (!nama || typeof nama !== 'string') {
          alert('Nama harus tidak boleh string kosong')
          return
        }
        if (!noTelp || typeof noTelp !== 'string') {
          alert('No Telepon harus tidak boleh string kosong')
          return
        }
        if (!alamat || typeof alamat !== 'string') {
          alert('Alamat harus tidak boleh string kosong')
          return
        }
        if (!tanggalLahir || typeof tanggalLahir !== 'string') {
          alert('Tanggal Lahir harus tidak boleh string kosong')
          return
        }
        if (!pendidikan || typeof pendidikan !== 'string') {
          alert('Pendidikan harus tidak boleh string kosong')
          return
        }
        if (!pekerjaan || typeof pekerjaan !== 'string') {
          alert('Pekerjaan harus tidak boleh string kosong')
          return
        }
        if (!statusKeluarga || typeof statusKeluarga !== 'string') {
          alert('Status Keluarga harus tidak boleh string kosong')
          return
        }
        if (!statusPernikahan || typeof statusPernikahan !== 'string') {
          alert('Status Pernikahan harus tidak boleh string kosong')
          return
        }
        if (!latitude) {
          alert('Latitude harus diisi')
          return
        }
        if (!longitude) {
          alert('Longitude harus diisi')
          return
        }

        $.ajax({
            url: '/warga',
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {
              nama,
              no_telp: noTelp,
              alamat,
              id_kk: noKK,
              nik_kepala_keluarga: nikKepalaKeluarga,
              status_tempat_tinggal: statusTempatTinggal,
              nik,
              status_keluarga: statusKeluarga,
              pendidikan,
              pekerjaan,
              tanggal_lahir: tanggalLahir,
              status_pernikahan: statusPernikahan,
              domisili_kartu_keluarga: domisiliKartuKeluarga,
              domisili,
              latitude,
              longitude
            },
            error: function (err) {
              console.error(err)
              alert(err)
              return
            },
            success: function (response) {
              console.log(response)
              if (response.status === 201) {
                alert(response.message)
                window.location.href="/warga"
              } else alert(response.message)
              return
            }
          })
      } catch (error) {
        console.error(error)
        alert(error)
        return
      }
    })
  })
</script>
</body>
</html>
