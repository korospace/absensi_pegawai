<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>

	<!-- ====================== CSS ====================== -->
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/fontawesome-free/css/all.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/adminlte.min.css'); ?>">
	<!-- Toastify style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/toastify.min.css'); ?>">
		<!-- Loading Spinner style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/showLoadingSpinner.css'); ?>">

	<style>
		
	</style>

</head>
<body>

	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
		</ul>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" data-widget="fullscreen" href="#" role="button">
					<i class="fas fa-expand-arrows-alt"></i>
				</a>
			</li>
		</ul>
	</nav>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="../../index3.html" class="brand-link text-center pt-4">
			<h4 class="brand-text font-weight-bold">EMPLOYEE</h4>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
				<!-- <div class="image">
					<img src="<?= base_url() ?>assets/img/user-default.jpeg" class="img-circle elevation-2" alt="User Image">
				</div> -->
				<div class="info">
					<a href="#" class="d-block"><?= generateSalam(); ?>, <b><?= $name ?></b>!</a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
							<i class="right fas fa-angle-left"></i>
						</p>
						</a>
						<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="../../index.html" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Dashboard v1</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../../index2.html" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Dashboard v2</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../../index3.html" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Dashboard v3</p>
							</a>
						</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link" onclick="logout(this,event)">
							<i class="nav-icon fa fa-power-off"></i>
							<p>Logout</p>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>

	<!-- ====================== JS ====================== -->
	<!-- GLOBAL VARIABLE -->
	<script>
		const BASEURL = "<?= base_url() ?>"
	</script>

	<!-- jQuery -->
	<script src="<?= base_url('assets/js/plugins/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets/js/plugins/bootstrap.bundle.min.js') ?>"></script>
	<!-- jquery-validation -->
	<script src="<?= base_url('assets/js/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets/js/plugins/adminlte.min.js') ?>"></script>
	<!-- Sweet Alert -->
    <script src="<?= base_url('assets/js/plugins/sweetalert2.min.js');?>"></script>
	<!-- Toastify -->
	<script src="<?= base_url('assets/js/showToastify.js') ?>"></script>
	<!-- Loading Spinner -->
	<script src="<?= base_url('assets/js/showLoadingSpinner.js') ?>"></script>

	<script>
		function logout(el,event)
        {
			event.preventDefault();

            Swal.fire({
                title: `Apakah anda yakin keluar?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6E7881',
                confirmButtonText: 'Iya',
                cancelButtonText: 'tutup',
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoadingSpinner();
                    window.location.replace("<?php echo base_url() . 'index.php/LogoutController'?>");
                }
            })
        }
	</script>
</body>
</html>
