<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Login V3</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/fonts/iconic/css/material-design-iconic-font.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/vendor/animate/animate.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/vendor/css-hamburgers/hamburgers.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/vendor/animsition/css/animsition.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/vendor/select2/select2.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/vendor/daterangepicker/daterangepicker.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="frontend/css/util.css">
		<link rel="stylesheet" type="text/css" href="frontend/css/main.css">
		<!--===============================================================================================-->
	</head>

	<body>

		<div class="limiter">
			<div class="container-login100" style="background-image: url('frontend/images/bg-01.jpg');">
				<div class="wrap-login100">
					@if (Session::has('error'))
					<div class="alert alert-danger"> {{Session::get('error')}}</div>

					@endif
					@if(count($errors)>0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{$error}}
							<li>
								@endforeach
						</ul>
					</div>

					@endif
					<form action="{{url('/accessaccount')}}" method="POST" class="login100-form validate-form">
						{{csrf_field()}}
						<span class="login100-form-logo">
							<i class="zmdi zmdi-landscape"></i>
						</span>

						<span class="login100-form-title p-b-34 p-t-27">
							Log in
						</span>

						<div class="wrap-input100 validate-input" data-validate="Enter email">
							<input class="input100" type="text" name="email" placeholder="Email">
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate="Enter password">
							<input class="input100" type="password" name="password" placeholder="Password">
							<span class="focus-input100" data-placeholder="&#xf191;"></span>
						</div>

						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Login
							</button>
						</div>

						<div class="text-center p-t-50">
							<a class="txt1" href="#">
								Forgot Password?
							</a>

							<div class="text-center p-t-20">
								<a class="txt1" href="#">
									Dont Have an account? <br><a class="txt1" href="/signup">Sign Up </a>
								</a>
							</div>
					</form>
				</div>
			</div>
		</div>


		<div id="dropDownSelect1"></div>

		<!--===============================================================================================-->
		<script src="frontend/vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="frontend/vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script src="frontend/vendor/bootstrap/js/popper.js"></script>
		<script src="frontend/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="frontend/vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
		<script src="frontend/vendor/daterangepicker/moment.min.js"></script>
		<script src="frontend/vendor/daterangepicker/daterangepicker.js"></script>
		<!--===============================================================================================-->
		<script src="frontend/vendor/countdowntime/countdowntime.js"></script>
		<!--===============================================================================================-->
		<script src="frontend/js/main.js"></script>

	</body>

</html>