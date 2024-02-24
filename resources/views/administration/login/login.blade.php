<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" class="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
  <!-- icheck bootstrap -->
  <!-- <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> -->





<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="adminlte3/plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"><!-- linea que reemplaza a la de arriba -->

  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <link rel="stylesheet" href="adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="adminlte3/plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="adminlte3/dist/css/adminlte.min.css"> -->
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="adminlte3/plugins/daterangepicker/daterangepicker.css"> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="adminlte3/plugins/summernote/summernote-bs4.min.css"> -->

    <!-- TODOS LOS ESTILOS -->
        <link rel="stylesheet" href="{{asset("css./administration/administration_all.css")}}">
        <link rel="stylesheet" href="{{asset("css./administration/datatables.css")}}">
        <link rel="stylesheet" href="{{asset("css./iziToast/iziToast.css")}}">

        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
        
    <!-- \.TODOS LOS ESTILOS -->

</head>


<!-- BODY ORIGINAL -->
<!-- <body class="hold-transition login-page"> -->

<body class="hold-transition sidebar-mini layout-fixed" style='background-color:#e9ecef;'>
<div class="wrapper d-flex align-items-center justify-content-center" style='height: 100vh !important;'>


<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
		<div class="logo pb-sm-30 pb-xs-30">
				<a href="#">
					<img src="/images/logo-DIPOLO.png" alt="logo_dipolo" height=50px>
					<span class="h3 font-weight-bold text-dark align-middle">
						DIPOLO
					</span>  
				</a>
		</div>
      <!-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> -->
	  	
    </div>
    <div class="card-body">
        <!-- <p class="login-box-msg">Sign in to start your session</p> -->

      <form action="#" method="post">
        <div class="input-group mb-3">
          	<input 	type="email" 
					class="form-control text-bold" 
					name="login_usuario"
					placeholder="Usuario" 
					autocomplete="off">
			<div class="input-group-append">
				<div class="input-group-text">
					<!-- <span class="fas fa-envelope"></span> -->
					<i class="fas fa-user"></i>
				</div>
			</div>
        </div>
        <div class="input-group mb-3">
          	<input 	type="password" 
					class="form-control text-bold" 
					name="login_password"
					placeholder="Contraseña">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fa fa-key"></span>
				</div>
			</div>
        </div>
        <div class="row d-flex justify-content-center align-items-center py-2">
            <!-- <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                    Remember Me
                </label>
                </div>
            </div> -->
            <!-- /.col -->
            <div class="col-6">
                <button type="button" 
						class="	btn btn-primary btn-block 
								text-bold text-uppercase"
						id="boton_login">Login</button>
            </div>
            <!-- /.col-4-->
        </div>
        <!-- /.row-->
      </form>

      <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <!-- <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->





</div>
<!-- jQuery -->
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="../../dist/js/adminlte.min.js"></script> -->





<!-- Todos los archivos JS -->
	<!-- El archivo administration_all.js genera conflictos (comportamientos dinamicos) al cohexistir con datatables.js, por eso sólo se usa datatables.js -->
		<!-- <script src="{{asset("js./administration/administration_all.js")}}"></script> -->

  <script src="{{asset("js./administration/datatables.js")}}"></script>
  <script src="{{asset("js./iziToast/iziToast.js")}}"></script>


  <script src="{{asset("js./sweetalert2/sweetalert2_emergent_messages.js")}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

  <script src="../../js/administration/login/login_behaviors.js"></script>    <!-- scrip propio de la vista -->

<!-- \.Todos los archivos JS -->





</body>
</html>
