<!DOCTYPE html>
<html lang="en">

<head>
	 <!-- PAGE TITLE HERE -->
	<title>SleekCare</title>

    <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="SleekCare">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('doctor/vendors/images/logobg.png')}}">

    <link href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

  
            
</head>

<body id="page-top">

    @includeIf('admin.header')
        
    @includeIf('admin.sidebar')
    


            
              @if (session()->has('success'))
                <div class="col-md-5"> <div class="msg-success"> {{session()->get('success')}}</div></div>
            @endif     

   @yield('admin')
            
     





    <!-- Required vendors -->
    <script src="{{asset('vendor/global/global.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/deznav-init.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/plugins-init/datatables.init.js')}}" type="text/javascript"></script>

<script>
$(".fa.fa-star").click(function () {
$(this).toggleClass("yellow");
});
</script>

</body>

</html>
