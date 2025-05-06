<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from welly.dexignzone.com/laravel/demo/page-login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Oct 2023 12:10:27 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	 <!-- PAGE TITLE HERE -->
	<title> SleekCare | Login</title>

    <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="SleekCare">
	

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">

    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
               <div class="col-md-6">
    <div class="authincation-content">
        <div class="row no-gutters">
            <div class="col-xl-12">
                <div class="auth-form">
                    <div class="text-center mb-3">
                        <a href="#"><img src="images/logobg.png" alt="" width="30%"></a>
                    </div>
                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                    <form action="{{route('auth.login')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Email</strong></label>
                            <input type="email" class="form-control" value="{{old('email')}}" name="email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Password</strong></label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row d-flex justify-content-between mt-4 mb-2">
                           
                            {{-- <div class="form-group">
                                <a class="text-white" href="page-forgot-password.html">Forgot Password?</a>
                            </div> --}}
                        </div>
                        <div class="text-center">
                            <button  type="submit"  class="btn bg-white text-primary btn-block">Sign Me In</button>
                        </div>
                    </form>
                    {{-- <div class="new-account mt-3">
                        <p class="text-white">Don't have an account? <a class="text-white" href="page-register.html">Sign up</a></p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</body>
	<!--**********************************
		Scripts
	***********************************-->
	<!-- Required vendors -->
				<script src="vendor/global/global.min.js" type="text/javascript"></script>
			<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
							<script src="js/custom.min.js" type="text/javascript"></script>
			<script src="js/deznav-init.js" type="text/javascript"></script>
		
	

<!-- Mirrored from welly.dexignzone.com/laravel/demo/page-login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Oct 2023 12:10:28 GMT -->
</html>