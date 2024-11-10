<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from omah.dexignzone.com/laravel/demo/page-login by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Oct 2024 12:44:06 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Square | Login</title>
    <meta name="description" content="Some description for the page"/>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/brand/logo5.png">
    <link href="public/css/style.css" rel="stylesheet">

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
                        <a href="{{ url('/') }}"><img width="100" src="public/images/brand/logo6.png" alt=""></a>
                      </div>
                      <h4 class="text-center mb-4">Sign in your account</h4>


                      <x-validation-errors class="mb-4" />

                      @if (session('status'))
                          <div class="mb-4 font-medium text-sm text-green-600">
                              {{ session('status') }}
                          </div>
                      @endif

                      <form  method="POST" action="{{ route('login') }}">
                        @csrf
                          <div class="form-group">
                              <label class="mb-1"><strong>Email</strong></label>
                              <input type="email" name="email" class="form-control">
                          </div>
                          <div class="form-group">
                              <label class="mb-1"><strong>Password</strong></label>
                              <input type="password" name="password" class="form-control">
                          </div>
                          <div class="form-row d-flex justify-content-between mt-4 mb-2">
                              <div class="form-group">
                                 <div class="custom-control custom-checkbox ml-1">
                                    <input type="checkbox" name="remember_me" class="custom-control-input" id="basic_checkbox_1">
                                    <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
                                </div>
                              </div>
                              <div class="form-group">
                                  <a href="page-forgot-password.html">Forgot Password?</a>
                              </div>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                          </div>
                      </form>

                      <div class="new-account mt-3">
                          <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
            </div>
        </div>
    </div>
<script src="public/vendor/global/global.min.js" type="text/javascript"></script>
					<script src="public/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
				<script src="public/js/custom.min.js" type="text/javascript"></script>
				<script src="public/js/deznav-init.js" type="text/javascript"></script>
		<!--		<script src="https://omah.dexignzone.com/laravel/demo/js/custom.min.js" type="text/javascript"></script>
			<script src="https://omah.dexignzone.com/laravel/demo/js/deznav-init.js" type="text/javascript"></script> -->
<!--
 	--></body>


<!-- Mirrored from omah.dexignzone.com/laravel/demo/page-login by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Oct 2024 12:44:07 GMT -->
</html>
