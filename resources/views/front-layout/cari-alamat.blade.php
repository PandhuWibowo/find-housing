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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    #map {
      height: 700px;
      width: 100%
    }

    .select2-selection {
      -webkit-box-shadow: 0;
      box-shadow: 0;
      background-color: #fff;
      border: 0;
      border-radius: 0;
      color: #555555;
      font-size: 14px;
      outline: 0;
      min-height: 40px;
      text-align: left;
    }

    .select2-selection__rendered {
      margin: 10px;
    }

    .select2-selection__arrow {
      margin: 5px;
    }

    #autocomplete:focus {
      border-color: #4d90fe;
    }
  </style>
</head>
<body>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="">
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
                    <label for="search">Search Location</label>
                    <select name="autocomplete" id="autocomplete" class="form-control" style="width: 100%">
                      @foreach($warga as $row)
                        <option value=""></option>
                        <option value="{{ $row->latitude }}|{{ $row->longitude }}">{{ $row->alamat }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="maps">Maps</label>
                    <div id="map"></div>
                  </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDwuNWNWNttuPVWT-TKQGniO4tXPN2kGU&libraries=places&callback=initMap">
</script>
{{-- <script src="{!! asset('assets/app-searchAddressMap.js') !!}"></script> --}}
<script>
  $("#autocomplete").select2({
    placeholder: "Cari Alamat",
    selectOnClose: false
  })
  function csrfProtection() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  }

  let initMarkers = []
  // let map
  function initMap () {
    const warga = JSON.parse(`<?php echo $warga;?>`)
  
    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: new google.maps.LatLng(-6.2293867, 106.6894316),
      mapTypeId: 'roadmap'
    })

    // Init Window when marker is clicking
    const infoWindow = new google.maps.InfoWindow()

    let marker

    // Init Icon
    const initIcon = {
      url: 'https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png',
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(25, 25),
    };

    // Init markers
    for (const [key, alamatWarga] of warga.entries()) {
      marker = new google.maps.Marker({
        position: {
          lat: parseFloat(alamatWarga.latitude),
          lng: parseFloat(alamatWarga.longitude)
        },
        map,
        icon: initIcon
      })

      initMarkers.push(marker)
      google.maps.event.addListener(marker, 'click', (function(marker, key) {
        return function() {
          infoWindow.setContent(alamatWarga.alamat)
          infoWindow.open(map, marker)
        }
      })(marker, key))
    }

    $('#autocomplete').on('change', function() {
      if (this) {
        const split = $(this).val().split('|')
        const latitude = split[0]
        const longitude = split[1]
        
        for (let i = 0; i < initMarkers.length; i++) {
          initMarkers[i].setMap(null);
        }

        const filterResult = warga.filter(el => el.latitude === latitude && el.longitude === longitude)
        
        for (const [key, alamatWarga] of filterResult.entries()) {
          marker = new google.maps.Marker({
            position: {
              lat: parseFloat(alamatWarga.latitude),
              lng: parseFloat(alamatWarga.longitude)
            },
            map,
            icon: initIcon
          })

          initMarkers.push(marker)
          google.maps.event.addListener(marker, 'click', (function(marker, key) {
            return function() {
              infoWindow.setContent(alamatWarga.alamat)
              infoWindow.open(map, marker)
            }
          })(marker, key))
        }
      }
    })
  }
</script>
</body>
</html>
