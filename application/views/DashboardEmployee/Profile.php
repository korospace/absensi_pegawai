<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>

	<style>
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
	<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalTakeAttendancePhotos">
		<div class="modal-dialog modal-xl">
			<form class="modal-content" id="formTakeAttendancePhotos">
				<div class="modal-header">
					<h4 class="modal-title">Take Your Photo</h4>
				</div>
				<div class="modal-body pt-4 pb-3">
					<div class="row">
						<div class="col-12 d-flex justify-content-center" style="position: relative;">
							<div id="my_camera" style=""></div>
							<button id="camera_btn" type="button" class="btn btn-primary " style="position: absolute; bottom: -20px;">
								<i class="fas fa-camera" style="font-size: 40px;"></i>
							</button>
						</div>
						<div class="col-12 mt-4 pt-1 px-3">
							<div class="dropdown-divider"></div>
						</div>
						<div class="col-12 d-flex">
							<?php for ($i=1; $i < 6; $i++) { ?>
								<div id="wraper_photo<?= $i ?>" class="wraper_file" style="flex: 1;position: relative;height: 92px;">
									<input type="file" name="photo[<?= $i ?>]" id="photo<?= $i ?>" style="position: absolute;z-index: -100;opacity: 0;">
									<div class="p-2" style="width: 100%;height: 100%;">
										<div class="place_photo d-flex justify-content-center align-items-center" style="width: 100%;height: 100%;overflow: hidden;border-radius: 4px;position: relative;z-index: 1;">
											<h5 class="text-primary" style="position: absolute;opacity: 0.6;z-index: 10;">
												<b><?= $i ?></b>
											</h5>
											<img class="img-thumbnail" src="<?= base_url("assets/img/attendance_photo/example/example$i.jpeg") ?>" style="width: 100%;height: 100%;opacity: 0.4;">
										</div> 
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button id="retake_foto" type="button" class="btn btn-default" >
						<i class="fas fa-edit"></i>
						Retake
					</button>
					<button id="submit_foto" type="submit" class="btn btn-success">
						Save
					</button>
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
		 * Show Camera to Take Attendance Photos
		 */
		$.ajax({
			type: "GET",
			url: "<?php echo base_url() . 'index.php/DashboardProfile/getEmployeeAttendancePhotos'?>",
			headers		: {
				'token': $.cookie("_jwttoken"),
			},
			success:function(data) {
				// nothing
			},
			error:function(data) {
				if (data.responseJSON.code == 404) {
					showOrHideBtnSubmitFoto();

					if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
						showLoadingSpinner();

						navigator.mediaDevices.getUserMedia({ video: true })
							.then(function(stream) {
								hideLoadingSpinner();

								const videoElement = document.createElement('video');
								videoElement.srcObject = stream;
								videoElement.autoplay = true;

								document.querySelector('#modalTakeAttendancePhotos #my_camera').appendChild(videoElement);
								$('#modalTakeAttendancePhotos').modal('show');
							})
							.catch(function(error) {
								hideLoadingSpinner();
								showToast("Please, enable your camera then refresh page!", "warning");
							});
					}
					else {
						showToast("Camera not supported in this browser.", "danger");
					}
				}
				else {
					showErrorServer(data);
				}
			}
		})

		// Capture Photo
		let counterPhoto = 0;

		$('#modalTakeAttendancePhotos #camera_btn').on('click', function () {
			
			let next = false;

			document.querySelectorAll("#modalTakeAttendancePhotos .wraper_file").forEach(e => {
				let inputFileX = e.querySelector('input[type=file]');
				
				if (inputFileX.files.length === 0 && !next) {
					const myCamera = document.querySelector('#modalTakeAttendancePhotos #my_camera video');
		
					const canvas  = document.createElement('canvas');
					const context = canvas.getContext('2d');
		
					canvas.width  = myCamera.videoWidth;
					canvas.height = myCamera.videoHeight;
					context.drawImage(myCamera, 0, 0, canvas.width, canvas.height);
		
					const photo = canvas.toDataURL('image/png');
					const file  = dataURLtoFile1(photo, `photo${++counterPhoto}.png`);
					
					const reader = new FileReader();

					reader.onload = function (event) {
						const imageSrc = event.target.result;
						const imgElement = document.createElement('img');
						imgElement.className = 'img-thumbnail img-preview';
						imgElement.src = imageSrc;
						imgElement.style = 'width: 100%; max-width: 100%; height: 100%; position: absolute; z-index: 20;';

						e.querySelector('.place_photo').appendChild(imgElement);
					};

					reader.readAsDataURL(file);

					// insert foto to input file
					const dataTransfer = new DataTransfer();
					dataTransfer.items.add(file);
					inputFileX.files = dataTransfer.files;

					// break looping
					next = true;
				}
			})

			showOrHideBtnSubmitFoto();
		})

		// Fungsi untuk mengubah data URL menjadi file
        function dataURLtoFile1(dataURL, filename) {
            const arr = dataURL.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, { type: mime });
        }

		// Fungsi untuk mengecek jika sudah 5 kali take foto maka munculkan button submit
		function showOrHideBtnSubmitFoto() {
			if (counterPhoto == 5) {
				$('#modalTakeAttendancePhotos #submit_foto').show();
			}
			else {
				$('#modalTakeAttendancePhotos #submit_foto').hide();
			}
		}

		// retake foto
		$('#modalTakeAttendancePhotos #retake_foto').on('click', function () {
			counterPhoto = 0;

			const wrapperFiles = document.querySelectorAll("#modalTakeAttendancePhotos .wraper_file");

			wrapperFiles.forEach(e => {
				const inputFileX = e.querySelector('input[type=file]');
				const placeFoto = e.querySelector('.place_photo');

				// Menghapus elemen gambar yang memiliki kelas .img-preview
				const imgElements = placeFoto.querySelectorAll('.img-preview');
				imgElements.forEach(imgElement => {
					imgElement.remove();
				});

				// Menghapus nilai file dari input file
				inputFileX.value = "";
				if (inputFileX.files) {
					inputFileX.files = null;
				}
			});

			showOrHideBtnSubmitFoto()
		})

		/*
			Submit attendance photos
		*/
		$('#formTakeAttendancePhotos')
			.submit(function(e) {
				e.preventDefault();
				showLoadingSpinner();

				let form = new FormData(e.target); 

				$.ajax({
					type: "POST",
					url: "<?php echo base_url() . 'index.php/DashboardProfile/saveAttendancePhotos'?>",
					data: form,
					cache: false,
					processData:false,
					contentType: false,
					headers		: {
						'token': $.cookie("_jwttoken"),
					},
					success:function(data) {
						hideLoadingSpinner();
						$('#modalTakeAttendancePhotos').modal('hide');
						showToast("photos successfully <b>saved..!</b>",'success');

						const myCamera = document.querySelector('#modalTakeAttendancePhotos #my_camera video');
						const videoTrack = myCamera.srcObject.getVideoTracks()[0];
						videoTrack.stop()
					},
					error:function(data) {
						hideLoadingSpinner();

						if (data.status == 400) {
							if (data.responseJSON.message == "no face") {
								showToast("Some of the photos <b>do not contain</b> any face",'warning');
							}
							else {
								showErrorServer(data);
							}
						}
						else {
							showErrorServer(data);
						}
					}
				});
			})
	</script>
</body>
</html>
