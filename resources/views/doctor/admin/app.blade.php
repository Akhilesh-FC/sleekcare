<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>SleekCare</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('doctor/vendors/images/logobg.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('doctor/vendors/images/logobg.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('doctor/vendors/images/logobg.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('doctor/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('doctor/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('doctor/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('doctor/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('doctor/vendors/styles/style.css')}}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body id="page-top" style="background-color:#070C19">

    @includeIf('doctor.admin.header')
        
    @includeIf('doctor.admin.sidebar')
    


            
              @if (session()->has('success'))
                <div class="col-md-5"> <div class="msg-success"> {{session()->get('success')}}</div></div>
              @endif     

   @yield('doctor')
            
     





   <script src="{{asset('doctor/vendors/scripts/core.js')}}"></script>
   <script src="{{asset('doctor/vendors/scripts/script.min.js')}}"></script>
   <script src="{{asset('doctor/vendors/scripts/process.js')}}"></script>
   <script src="{{asset('doctor/vendors/scripts/layout-settings.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
   <script src="{{asset('doctor/vendors/scripts/dashboard.js')}}"></script>


   <!-- buttons for Export datatable -->
   <script src="{{asset('doctor/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
   <script src="{{asset('doctor/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
   <!-- Datatable Setting js -->
   <script src="{{asset('doctor/vendors/scripts/datatable-setting.js')}}"></script>

</body>
</html>
