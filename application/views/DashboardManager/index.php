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
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/datatable/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/datatable/responsive.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/datatable/buttons.bootstrap4.min.css') ?>">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/icheck-bootstrap.min.css') ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/adminlte.min.css'); ?>">
	<!-- Toastify style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/toastify.min.css'); ?>">
	<!-- Loading Spinner style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/showLoadingSpinner.css'); ?>">
	<!-- Img Viewer -->
	<link rel="stylesheet" href="<?= base_url('assets/css/imgViewer.css'); ?>">

	<style>
		
	</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Nav burger -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
		</ul>

		<!-- Full screen button -->
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
			<h4 class="brand-text font-weight-bold">MANAGER</h4>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Name of user -->
			<div class="user-panel pb-3 mt-3 d-flex justify-content-center">
				<div class="info">
					<a href="#" class="d-block"><?= generateSalam(); ?>, <b><?= $name ?></b>!</a>
				</div>
			</div>

			<!-- List of Menu -->
			<nav class="user-panel pb-3 mt-3">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="" class="nav-link">
							<i class="nav-icon fa fa-home"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link" onclick="loadPage(this,event,'DashboardListEmployee')">
							<i class="nav-icon fa fa-users"></i>
							<p>Employees</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link" onclick="loadPage(this,event,'DashboardManagerConfig')">
							<i class="nav-icon fa fa-cog"></i>
							<p>Config</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link" onclick="loadPage(this,event,'DashboardProfile')">
							<i class="nav-icon fa fa-user"></i>
							<p>My Profile</p>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->

			<nav class="mt-4">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="" class="w-100 text-center p-4 btn btn-danger" onclick="logout(this,event)">
							<i class="fa fa-power-off" style="font-size: 30px;"></i>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<!-- /.sidebar -->
	</aside>

	<div class="content-wrapper">

		<!-- Page title -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Dashboard</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#" class="text-secondary">Dashboard</a></li>
							<li class="breadcrumb-item active">Main</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

	</div>
</div>

	<!-- ====================== JS ====================== -->
	<!-- GLOBAL VARIABLE -->
	<script>
		const BASEURL = "<?= base_url() ?>"
	</script>

	<!-- jQuery -->
	<script src="<?= base_url('assets/js/plugins/jquery.min.js') ?>"></script>
	<!-- jQuery Cookie -->
	<script src="<?= base_url('assets/js/plugins/jquery.cookie.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets/js/plugins/bootstrap.bundle.min.js') ?>"></script>
	<!-- jquery-validation -->
	<script src="<?= base_url('assets/js/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
	<!-- Datatable -->
	<script src="<?= base_url('assets/js/plugins/datatable/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/datatable/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/datatable/dataTables.buttons.min.js') ?>"></script>
	<!-- Time Picker -->
	<script src="<?= base_url('assets/js/plugins/dayjs.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/plugins/timepicker-bs4.js') ?>"></script>
	<!-- Bootstrap Switch -->
	<script src="<?= base_url('assets/js/plugins/bootstrap-switch.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets/js/plugins/adminlte.min.js') ?>"></script>
	<!-- Sweet Alert -->
    <script src="<?= base_url('assets/js/plugins/sweetalert2.min.js');?>"></script>
	<!-- Toastify -->
	<script src="<?= base_url('assets/js/showToastify.js') ?>"></script>
	<!-- Loading Spinner -->
	<script src="<?= base_url('assets/js/showLoadingSpinner.js') ?>"></script>
	<!-- Img Viewer -->
	<script src="<?= base_url('assets/js/imgViewer.js') ?>"></script>
	<!-- Error Server -->
	<script src="<?= base_url('assets/js/showErrorServer.js') ?>"></script>

	<script>

		/**
		 * Session Check
		 */
		let intervalCheckExp = null;

		let checkExpired = function() { 
			$.ajax({
				type: "GET",
				url: "<?php echo base_url() . 'index.php/Dashboard/sessionCheck'?>",
				success:function(data) {
					return true;
				},
				error:function(data) {
					clearInterval(intervalCheckExp);
					
					showErrorServer(data);
				}
			});
		}

		intervalCheckExp = setInterval(checkExpired, 4000);

		/**
		 * Load Page
		 */
		function loadPage(el,event,controller)
        {
			event.preventDefault();
			
            showLoadingSpinner();
            $('.content-wrapper').load(controller);

            $(document).ajaxStop(function () {
                hideLoadingSpinner();
            });
        }

		/**
		 * Logout
		 */
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
                    window.location.replace("<?php echo base_url() . 'index.php/Logout'?>");
                }
            })
        }
	</script>
</body>
</html>
