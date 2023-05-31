<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
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
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
						<li class="breadcrumb-item active">My Profile</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<!-- Page Body -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-secondary p-4">
						<form class="form-horizontal" id="formEditProfile" autocomplete="off">
							<div class="card-body">
								<div class="form-group row">
									<div id="thumb-wraper" class="col-12">
										<img class="img-thumbnail" width="240px" min-height="150px" max-height="240px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOn8NttvA6tqm6qneoTylDrit08oB005q18Q&usqp=CAU"/>
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
							<div class="card-footer">
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
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
				url: "<?php echo base_url() . 'index.php/DashboardProfile/getDataProfileManager'?>",
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
					// img_profile: {
					// 	required: true,
					// },
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
					// img_profile: {
					// 	required: "profile image required",
					// },
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
						url: "<?php echo base_url() . 'index.php/DashboardProfile/editProfileManager'?>",
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
	</script>
</body>
</html>
