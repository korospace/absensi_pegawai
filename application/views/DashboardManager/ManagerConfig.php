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
					<h1>Config</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#" class="text-secondary">Dashboard</a></li>
						<li class="breadcrumb-item active">Config</li>
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
						<div class="card-header">
							<h3 class="card-title">
							<i class="fas fa-video text-secondary mr-2"></i>
								Online Meet
							</h3>
						</div>
						<form class="form-horizontal" id="formEditConfigOnlineMeet" autocomplete="off">
							<div class="card-body">
								<div class="form-group row">
									<label for="meet_link" class="col-12 col-form-label">Meet Link</label>
									<div class="col-md-8 pr-3">
										<input type="text" class="form-control" id="meet_link" name="meet_link">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4 pl-0">
										<label for="" class="col-12 col-form-label">Time Show</label>
										<div class="input-group date col-12">
											<input type="text" id="meet_time_show" class="form-control" name="meet_time_show" placeholder="HH:mm" pattern="(([01][0-9]|2[0-3]):[0-5][0-9])?" maxlength="5" data-format="HH:mm" />
											<div class="input-group-append">
												<button type="button" id="" class="btn btn-outline-secondary" onclick="clearInputTime('#meet_time_show')">
													<i class="far fa-times-circle"></i>
												</button>
											</div>
										</div>
									</div>
									<div class="col-md-4 pl-0 mt-3 mt-md-0">
										<label for="" class="col-12 col-form-label">Time Hide</label>
										<div class="input-group date col-12">
											<input type="text" id="meet_time_hide" class="form-control" name="meet_time_hide" placeholder="HH:mm" pattern="(([01][0-9]|2[0-3]):[0-5][0-9])?" maxlength="5" data-format="HH:mm" />
											<div class="input-group-append">
												<button type="button" id="" class="btn btn-outline-secondary" onclick="clearInputTime('#meet_time_hide')">
													<i class="far fa-times-circle"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-12 col-form-label mt-3 mb-3">Meet Days</label>
									<?php 
									$arrDays = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
									for ($i=0; $i < count($arrDays); $i++) { ?> 
										<div class="col-sm-5 col-md-3 d-flex align-items-center">
											<div class="icheck-secondary d-inline">
												<input type="checkbox" id="meet_<?= $arrDays[$i] ?>" data-day="<?= $arrDays[$i] ?>" class="check_day">
												<label for="meet_<?= $arrDays[$i] ?>"><?= $arrDays[$i] ?></label>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-success">Save</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-12 mt-3 mb-5">
					<div class="card card-secondary card-outline">
						<div class="card-header">
							<h3 class="card-title">
							<i class="fas fa-calendar-check text-secondary mr-2"></i>
								Attendance
							</h3>
						</div>
						<form class="form-horizontal" id="formEditConfigAttendance" autocomplete="off">
							<div class="card-body">
								<div class="form-group row">
									<div class="col-md-3 pl-0 pr-3">
										<label for="max_distance_attendance" class="col-12 col-form-label">Max Distance <small><i>(meters)</i></small></label>
										<div class="input-group col-12">
											<input type="number" class="form-control" id="max_distance_attendance" name="max_distance_attendance">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-3 pl-0">
										<label for="latitude_attendance" class="col-12 col-form-label">Latitude</label>
										<div class="input-group col-12">
											<input type="number" id="latitude_attendance" class="form-control" name="latitude_attendance" />
											<!-- <div class="input-group-append">
												<button type="button" class="btn btn-info mr-2" onclick="turnOnLocation('latitude')">
													<i class="fa fa-map-pin"></i>
												</button>
											</div> -->
										</div>
									</div>
									<div class="col-md-3 pl-0 mt-3 mt-md-0">
										<label for="latitude_attendance" class="col-12 col-form-label">Longitude</label>
										<div class="input-group col-12">
											<input type="number" id="longitude_attendance" class="form-control" name="longitude_attendance" />
											<!-- <div class="input-group-append">
												<button type="button" class="btn btn-info mr-2" onclick="turnOnLocation('longitude')">
													<i class="fa fa-map-pin"></i>
												</button>
											</div> -->
										</div>
									</div>
									<div class="col-12 mt-2">
										<a href="" target="_blank" onclick="showMapCoordinate(this,event)">additional tools</a>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-12 col-form-label mt-3 mb-3">Attendance Days</label>
									<?php 
									$arrDays = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
									for ($i=0; $i < count($arrDays); $i++) { ?> 
										<div class="col-sm-5 col-md-3 d-flex align-items-center">
											<div class="icheck-secondary d-inline">
												<input type="checkbox" id="attendance_<?= $arrDays[$i] ?>" data-day="<?= $arrDays[$i] ?>" class="check_day">
												<label for="attendance_<?= $arrDays[$i] ?>"><?= $arrDays[$i] ?></label>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-success">Save</button>
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
	<div class="modal fade" id="modalMapCoordinate">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Map</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-4 pb-3">
					<!-- <input type="text" id="pac-input" class="form-control controls mb-4" placeholder="Search Box" /> -->

					<div id="mapCoordinate" style="height: 400px;"></div>

					<form action="" id="formMapCoordinate">
						<div class="form-group row mt-4">
							<div class="col-md-6 pl-0">
								<label for="latitude" class="col-12 col-form-label">Latitude</label>
								<div class="input-group col-12">
									<input type="number" id="latitude" class="form-control" name="latitude" />
								</div>
							</div>
							<div class="col-md-6 pl-0 mt-3 mt-md-0">
								<label for="longitude" class="col-12 col-form-label">Longitude</label>
								<div class="input-group col-12">
									<input type="number" id="longitude" class="form-control" name="longitude" />
								</div>
							</div>
						</div>
						<div class="form-group row mt-4">
							<button type="submit" class="btn btn-info w-100">
								<b>SIMPAN</b>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		/* 
			Time Picker
		*/
		jQuery('#meet_time_show, #meet_time_hide').timepicker();

		function clearInputTime(targetEl) {
			$(targetEl).val('');
			$(targetEl).focus();
		}

		function clearErrForm(parentId) {
			$(`${parentId} .is-invalid`).removeClass('is-invalid');
		}

		/*
			Get All Config Data
		*/
		function getConfig() {
			showLoadingSpinner();
			
			$.ajax({
				type: "GET",
				url: "<?php echo base_url() . 'index.php/DashboardManagerConfig/getConfig'?>",
				headers: {
					'token': $.cookie("_jwttoken"),
				},
				success:function(datas) {
					hideLoadingSpinner();

					$(`#formEditConfigOnlineMeet input[name=meet_link]`).val(datas.data.meet_link);
					$(`#formEditConfigOnlineMeet input[name=meet_time_show]`).val(datas.data.meet_time_show);
					$(`#formEditConfigOnlineMeet input[name=meet_time_hide]`).val(datas.data.meet_time_hide);
					$(`#formEditConfigAttendance input[name=latitude_attendance]`).val(datas.data.latitude_attendance);
					$(`#formEditConfigAttendance input[name=longitude_attendance]`).val(datas.data.longitude_attendance);
					$(`#formEditConfigAttendance input[name=max_distance_attendance]`).val(datas.data.max_distance_attendance);

					if (datas.data.meet_days_show) {
						datas.data.meet_days_show.split(',').forEach(day => {
							$(`input[type=checkbox]#meet_${day}`).prop("checked", true);
						});
					}

					if (datas.data.days_attendance) {
						datas.data.days_attendance.split(',').forEach(day => {
							$(`input[type=checkbox]#attendance_${day}`).prop("checked", true);
						});
					}
				},
				error:function(data) {
					hideLoadingSpinner();
					
					showErrorServer(data);
				}
			})
		}

		getConfig();

		/*
			Edit Config Online Meet
		*/
		$('#formEditConfigOnlineMeet')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				submitHandler: function () {
					showLoadingSpinner();
					clearErrForm('#formEditConfigOnlineMeet');

					let form = new FormData(document.querySelector('#formEditConfigOnlineMeet'));

					let dayValue = "";
					$('#formEditConfigOnlineMeet .check_day').each(function () {
						if ($(this).prop("checked") == true) {
							dayValue += $(this).attr("data-day") + ",";
						}
					})

					form.set("meet_days_show", dayValue.slice(0, -1));

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/DashboardManagerConfig/editConfigMeeting'?>",
						data: form,
						cache: false,
						processData:false,
						contentType: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();
							showToast("config successfully <b>updated..!</b>",'success');
						},
						error:function(data) {
							hideLoadingSpinner();

							if (data.status != 400) {
								showErrorServer(data);
							}
							else if (data.status == 400) {
								for (const key in data.responseJSON) {
									$(`#formEditConfigOnlineMeet input[name=${key}]`).addClass('is-invalid');
									showToast(`${data.responseJSON[key]}`,'warning');
								}
							}
						}
					});
				}
			})

		/**
		 * Show Map Coordinate
		 */
		var markers = {};

		function showMapCoordinate(el,event) {
			event.preventDefault();

			$('#modalMapCoordinate').modal('show');

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(
					function (data) {
						initialMapCoordinate(data.coords.latitude,data.coords.longitude);
					}, 
					function (err) {
						showToast("Please turn on your location", "warning");
						console.log(err.message);
					}
				);
			} else {
				showToast("Browser not suport location", "warning");
			}
		}

		async function initialMapCoordinate(latitude,longitude) {

			$('#formMapCoordinate #latitude').val(latitude);
			$('#formMapCoordinate #longitude').val(longitude);

			const { Map } = await google.maps.importLibrary("maps");

			var map = new google.maps.Map(document.getElementById('mapCoordinate'), {
				zoom: 18,
				center: { lat: latitude, lng: longitude },
				streetViewControl: false,
			});

			// marker
			var myMarker = new google.maps.Marker({
				position: { lat: latitude, lng: longitude },
				draggable: true,
				map,
			});

			google.maps.event.addListener(myMarker, 'dragend', function(evt) {
				$('#formMapCoordinate #latitude').val(evt.latLng.lat().toFixed(7));
				$('#formMapCoordinate #longitude').val(evt.latLng.lng().toFixed(7));
				new google.maps.Circle({
					center: { lat: 0, lng: 0 },
					map
				});
			});
		}

		/*
			Input Coordinate From Map
		*/
		$('#formMapCoordinate')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				rules: {
					latitude: {
						required: true,
					},
					longitude: {
						required: true,
					},
				},
				messages: {
					latitude: {
						required: "",
					},
					longitude: {
						required: "",
					},
				},
				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.input-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				},
				submitHandler: function () {
					$('#formEditConfigAttendance #latitude_attendance').val($('#formMapCoordinate #latitude').val());
					$('#formEditConfigAttendance #longitude_attendance').val($('#formMapCoordinate #longitude').val());
					$('#modalMapCoordinate').modal('hide');
				}
			})

		/**
		 * Get Coordinate
		 */
		function turnOnLocation(type) {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(
					function (data) {
						if (type == 'latitude') {
							$('#latitude_attendance').val(data.coords.latitude);
						} 
						else if (type == 'longitude') {
							$('#longitude_attendance').val(data.coords.longitude);
						}
					}, 
					function (err) {
						showToast("Please turn on your location", "warning");
						console.log(err.message);
					}
				);
			} else {
				showToast("Browser not suport location", "warning");
			}
		}

		/*
			Edit Config Attendance
		*/
		$('#formEditConfigAttendance')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				rules: {
					latitude_attendance: {
						required: true,
					},
					longitude_attendance: {
						required: true,
					},
					max_distance_attendance: {
						required: true,
					},
				},
				messages: {
					latitude_attendance: {
						required: "latitude is required",
					},
					longitude_attendance: {
						required: "longitude is required",
					},
					max_distance_attendance: {
						required: "max distance is required",
					},
				},
				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.input-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				},
				submitHandler: function () {
					showLoadingSpinner();
					clearErrForm('#formEditConfigAttendance');

					let form = new FormData(document.querySelector('#formEditConfigAttendance'));

					let dayValue = "";
					$('#formEditConfigAttendance .check_day').each(function () {
						if ($(this).prop("checked") == true) {
							dayValue += $(this).attr("data-day") + ",";
						}
					})

					form.set("days_attendance", dayValue.slice(0, -1));

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/DashboardManagerConfig/editConfigAttendance'?>",
						data: form,
						cache: false,
						processData:false,
						contentType: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();
							showToast("config successfully <b>updated..!</b>",'success');
						},
						error:function(data) {
							hideLoadingSpinner();

							if (data.status != 400) {
								showErrorServer(data);
							}
							else if (data.status == 400) {
								for (const key in data.responseJSON) {
									$(`#formEditConfigAttendance input[name=${key}]`).addClass('is-invalid');
									showToast(`${data.responseJSON[key]}`,'warning');
								}
							}
						}
					});
				}
			})
	</script>
	
</body>
</html>
