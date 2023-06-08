<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>

	<style>
		/* #modalTakeAttendancePhoto .modal-dialog {
			max-width: 100% !important;
		}

		#modalTakeAttendancePhoto .modal-content {
			max-width: 100% !important;
		} */
	</style>
</head>
<body>

	<!-- Page title -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>My Profile</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#" class="text-secondary">Dashboard</a></li>
						<li class="breadcrumb-item active">My Profile</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<!-- Page Body -->
	<div class="content mt-2">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-secondary card-outline">
						<form class="form-horizontal" id="formEditProfile" autocomplete="off">
							<div class="card-header">
								<h3 class="card-title">
									<i class="fas fa-edit"></i>
									Biodata
								</h3>
							</div>
							<div class="card-body p-sm-5">
								<div class="form-group row">
									<div id="thumb-wraper" class="col-sm-4 col-md-2">
										<img class="img-thumbnail" width="100%" max-height="300px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOn8NttvA6tqm6qneoTylDrit08oB005q18Q&usqp=CAU"/>
									</div>
								</div>
								<div class="form-group row">
									<label for="img_profile" class="col-sm-2 col-form-label">Profile Image</label>
									<div class="col-md-4">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="img_profile" name="img_profile" onchange="imgProfileCheck(this)">
											<label class="custom-file-label" for="img_profile">Choose file</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="name" class="col-sm-2 col-form-label">Full Name</label>
									<div class="col-md-4">
										<input type="text" class="form-control" id="name" name="name">
									</div>
								</div>
								<div class="form-group row">
									<label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
									<div class="col-md-4">
										<input type="text" class="form-control" id="phone" name="phone">
									</div>
								</div>
								<div class="form-group row">
									<label for="username" class="col-sm-2 col-form-label">Username</label>
									<div class="col-md-4">
										<input type="text" class="form-control" id="username" name="username">
									</div>
								</div>
								<div class="form-group row">
									<label for="password" class="col-sm-2 col-form-label">
										Password
										<small><i>(optional)</i></small>
									</label>
									<div class="col-md-4">
										<input type="password" class="form-control" id="password" name="password">
									</div>
								</div>
							</div>
							<div class="card-footer bg-white pl-sm-5 pb-sm-5">
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ==================
			Modals
	=================== -->
	<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalTakeAttendancePhoto">
		<div class="modal-dialog modal-xl">
			<form class="modal-content" id="formTakeAttendancePhoto">
				<div class="modal-header">
					<h4 class="modal-title">Take Your Photo</h4>
				</div>
				<div class="modal-body pt-4 pb-3">
					<div class="row">
						<div class="col-12 d-flex justify-content-center">
							<div class="image-capture"></div>
						</div>
						<div class="col-12 mt-3 mb-3 px-3">
							<div class="dropdown-divider"></div>
						</div>
						<div class="col-12">
							<!-- <h4 class="text-secondary pl-1">Example: </h4> -->
						</div>
						<div class="col-12 d-flex">
							<?php for ($i=1; $i < 6; $i++) { ?>
								<div id="wraper_file_name<?= $i ?>" style="flex: 1;position: relative;">
									<input type="file" name="file_name[<?= $i ?>]" id="file_name[<?= $i ?>]" style="position: absolute;z-index: -100;opacity: 0;">
									<div class="p-2 d-flex justify-content-center align-items-center" style="position: relative;width: 100%;height: 100%;">
										<h5 class="text-secondary" style="position: absolute;opacity: 0.6;">
											<b><?= $i ?></b>
										</h5>
										<div class="bg-secondary" style="width: 100%;height: 100%;overflow: hidden;border-radius: 4px;opacity: 0.5;">
											<img class="img-thumbnail" src="<?= base_url("assets/img/attendance_photo/example/example$i.jpeg") ?>" style="max-width: 100%;height: 100%;opacity: 0.5;">
										</div> 
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" >
						<i class="fas fa-edit"></i>
						Retake
					</button>
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</form>
		</div>
	</div>

	<script>

		/**
		 * Image Profile Preview
		 */
		function imgProfileCheck(el) {
			let imgType = el.files[0].type.split('/');

			// If file is not image
			if(!/image/.test(imgType[0])){
				showToast('foto tidak sesuai ketentuan','warning');

				el.value = "";
				return false;
			}
			// If image not in format
			else if(!["jpg","jpeg","png","webp"].includes(imgType[1])) {
				showToast('foto tidak sesuai ketentuan','warning');

				$('#formEditProfile #thumb-wraper img').attr('src','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOn8NttvA6tqm6qneoTylDrit08oB005q18Q&usqp=CAU')
				el.value = "";
				return false;
			}
			else if(el.files[0].size > 5000000) {
				showToast('ukuran dokumen tidak boleh lebih dari 5 mb','warning');

				$('#formEditProfile #thumb-wraper img').attr('src','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOn8NttvA6tqm6qneoTylDrit08oB005q18Q&usqp=CAU')
				el.value = "";
				return false;
			}
			else {
				var thumbnail = document.querySelector('#formEditProfile #thumb-wraper img');
				thumbnail.src = URL.createObjectURL(el.files[0]);
			}
		}

		/*
			Get Data Profile
		*/
		function getDataProfile() {
			showLoadingSpinner();

			$.ajax({
				type: "GET",
				url: "<?php echo base_url() . 'index.php/DashboardProfile/getDataProfileEmployee'?>",
				headers: {
					'token': $.cookie("_jwttoken"),
				},
				success:function(datas) {
					hideLoadingSpinner();

					if (datas.data.img_profile) {
						$('#formEditProfile #thumb-wraper img').attr('src',`${datas.data.original_url}${datas.data.img_profile}`)
					}
					$(`#formEditProfile input[name=name]`).val(datas.data.name);
					$(`#formEditProfile input[name=phone]`).val(datas.data.phone);
					$(`#formEditProfile input[name=username]`).val(datas.data.username);

					enableImgViewer(".img-thumbnail");
				},
				error:function(data) {
					hideLoadingSpinner();
					
					showErrorServer(data);
				}
			})
		}

		getDataProfile();

		/**
		 * Remove Error Class
		 */
		function clearErrForm(parentId) {
			$(`${parentId} .is-invalid`).removeClass('is-invalid');
		}

		/*
			Update Profile
		*/
		$('#formEditProfile')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				rules: {
					name: {
						required: true,
					},
					phone: {
						required: true,
					},
					username: {
						required: true,
					},
				},
				messages: {
					name: {
						required: "name required",
					},
					phone: {
						required: "phone required",
					},
					username: {
						required: "username required",
					},
				},
				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
					error.insertAfter(element);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				},
				submitHandler: function () {
					showLoadingSpinner();
					clearErrForm("#formEditProfile");

					let form = new FormData(document.querySelector('#formEditProfile')); 

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/DashboardProfile/editProfileEmployee'?>",
						data: form,
						cache: false,
						processData:false,
						contentType: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();

							showToast("profile successfully <b>updated..!</b>",'success');
							$(`#formEditProfile input[name=password]`).val('');
							getDataProfile();
						},
						error:function(data) {
							hideLoadingSpinner();

							if (data.status != 400) {
								showErrorServer(data);
							}
							else if (data.status == 400) {
								for (const key in data.responseJSON) {
									$(`#formEditProfile input[name=${key}]`).addClass('is-invalid');
									showToast(`${data.responseJSON[key]}`,'warning');
								}
							}
						}
					});
				}
			});

		/**
		 * Web Cam Initialization
		 */
		$('#modalTakeAttendancePhoto .image-capture').customWebCam({
			videoClass: ['face-capture-video'],
			canvasClass: ['face-capture-canvas'],
			facingMode: "user",
			captureTimeoutInSeconds: 0,
			callbackFunction: 'setCapturedImage',
		});

		function setCapturedImage(imageBase64) {
			$('body').append($('<img>', {src: imageBase64}));
		}

		/**
		 * Get Attendaces Photo
		 */
		$.ajax({
			type: "GET",
			url: "<?php echo base_url() . 'index.php/DashboardProfile/getEmployeeAttendancePhotos'?>",
			headers		: {
				'token': $.cookie("_jwttoken"),
			},
			success:function(data) {
				if (data.data == null) {
					// $('#modalTakeAttendancePhoto').modal('show');
				}
			},
			error:function(data) {
				hideLoadingSpinner();
				
				showErrorServer(data);
			}
		})
	</script>
</body>
</html>
