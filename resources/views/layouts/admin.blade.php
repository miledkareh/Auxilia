<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Auxilia') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <link href="{{ asset('fileupload/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    
  
    </ul>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item"  >
    <a class="nav-link"   href="{{ route('logout') }}"   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
          <i class="far fa-circle text-danger"></i> {{__('Logout')}}
          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </a>
    </li>
    </ul>
    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <a href="/home" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Auxilia') }} </span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        @auth
        <div class="info">
       
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
        @endauth
      
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link  Menu_1 Menu" id="Menu_1">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item " >
                <a href="{{ route('users.index')}}" id="menu_users" class="nav-link menu_users menu" target="iframe">
                  <i class="far fa-user nav-icon"></i>
                  <p>Employees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('currencies.index')}}" id="menu_currencies" class="nav-link menu_currencies menu" target="iframe">
                  <i class="fas fa-dollar-sign nav-icon"></i>
                  <p>Currencies</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('exchanges.index')}}" id="menu_exchanges" class="nav-link  menu_exchanges menu" target="iframe">
                  <i class="fa fa-exchange-alt nav-icon"></i>
                  <p>Currency Exchange</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('regions.index')}}" id="menu_regions" class="nav-link  menu_regions menu" target="iframe">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Regions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('periods.index')}}" id="menu_periods" class="nav-link  menu_periods menu" target="iframe">
                  <i class="far fa-clock nav-icon"></i>
                  <p>Periods</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('charges.index')}}" id="menu_charges" class="nav-link  menu_charges menu" target="iframe">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Charges</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('donations.index')}}" id="menu_donations" class="nav-link  menu_donations menu" target="iframe">
                  <i class="fa fa-hands nav-icon"></i>
                  <p>Donations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('changements.index')}}" id="menu_changements" class="nav-link  menu_changements menu" target="iframe">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Changements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('YearlySpecialSupports.index')}}" id="menu_YearlySpecialSupports" class="nav-link  menu_YearlySpecialSupports menu" target="iframe">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Yearly Special Supports</p>
                </a>
              </li>
            </ul>
          </li>
        
          <li class="nav-item">
                <a href="{{route('sponsors.index')}}" id="menu1_sponsors" class="nav-link  menu1_sponsors menu1" target="iframe">
                  <i class="fa fa-hands nav-icon"></i>
                  <p>Sponsors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('families.index')}}" id="menu1_families" class="nav-link  menu1_families menu1" target="iframe">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Families</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('accountreport.index')}}" id="menu1_accountreport" class="nav-link  menu1_accountreport menu1" target="iframe">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Sponsors Account Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('donationreport.index')}}" id="menu1_donationreport" class="nav-link  menu1_donationreport menu1" target="iframe">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Donation Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('membersreport.index')}}" id="menu1_membersreport" class="nav-link  menu1_membersreport menu1" target="iframe">
                  <i class="fa fa-file nav-icon"></i>
                  <p>Members Report</p>
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
     
       
  <iframe name="iframe" id="iframe" src="" width="100%" height="2000" frameborder="0" scrolling="0"> </iframe>

  </div>
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('fileupload/js/fileinput.js') }}" type="text/javascript"></script>




<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
  $(document).ready(function() {
  $(document).on('click',"[id^='Menu_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
      $('.Menu').removeClass('active');
		$('.Menu_'+ID).addClass('active');
	});
  $(document).on('click',"[id^='menu_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
      $('.menu').removeClass('active');
     $('.menu_'+ID).addClass('active');
     $('.menu1').removeClass('active');
    
	});
  $(document).on('click',"[id^='menu1_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
      $('.menu1').removeClass('active');
      $('.menu').removeClass('active');
     $('.menu1_'+ID).addClass('active');
		
     $('.Menu').removeClass('active');
	});
  });
</script>
</body>
</html>
