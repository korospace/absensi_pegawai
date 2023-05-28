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
		body, html {
			height: 100%;
			background: gainsboro;
		}

		.content {
			height: 100vh;
		}

		.card {
			width: 100%;
			max-width: 400px;
			padding-bottom: 20px;
		}

		.card .card-title {
			text-align: center;
			width: 100%;
			font-size: 28px;
		}

		.card .card-footer button {
			width: 100%;
		}
	</style>

</head>
<body>

	<section class="content d-flex align-items-center">

		<div class="container-fluid">

			<div class="row">

					<div class="col-md-12 d-flex justify-content-center">

						<div class="card card-secondary">
							<div class="card-header">
								<h2 class="card-title">ABSENSI PEGAWAI</h2>
							</div>
							<form id="formLogin" autocomplete="off">
								<div class="card-body">
									<div class="form-group">
										<label for="username">Username</label>
										<input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
									</div>
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" name="password" class="form-control" id="password" placeholder="Password">
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">login</button>
								</div>
							</form>
						</div>

					</div>

			</div>

		</div>

	</section>

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
	<!-- Toastify -->
	<script src="<?= base_url('assets/js/showToastify.js') ?>"></script>
	<!-- Loading Spinner -->
	<script src="<?= base_url('assets/js/showLoadingSpinner.js') ?>"></script>

	<script>
	$(function () {

		/* vaidate from */
		$('#formLogin')
			.submit(function(e) {
					e.preventDefault();
			})
			.validate({
				rules: {
					username: {
						required: true,
					},
					password: {
						required: true,
					},
				},
				messages: {
					username: {
						required: "masukan username terlebih dahulu",
					},
					password: {
						required: "masukan password terlebih dahulu",
					},
				},
				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				},
				submitHandler: function () {
					showLoadingSpinner();

					let formLogin = new FormData(document.querySelector('#formLogin')); 

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/LoginController/LoginCek'?>",
						data: formLogin,
						cache: false,
						processData:false,
						contentType: false,
						success:function(data) {
							hideLoadingSpinner();

							showToast("login <b>berhasil..!</b>",'success');
							
							setTimeout(() => {
								window.location.href="<?php echo base_url() . 'index.php/DashboardController'?>";
							}, 400);
						},
						error:function(data) {
							hideLoadingSpinner();
							
							if (data.status == 401) {
								showToast(data.responseJSON.message,'warning');
							}
							else {
								showToast('kesalahan pada <b>server</b>','danger');
							}
						}
					});
				}
			});

	});
	</script>
</body>
</html>
