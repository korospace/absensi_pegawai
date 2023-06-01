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
					<div class="card card-secondary p-4">
						<form class="form-horizontal" id="formEditConfig" autocomplete="off">
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
												<input type="checkbox" id="<?= $arrDays[$i] ?>" data-day="<?= $arrDays[$i] ?>" class="check_day">
												<label for="<?= $arrDays[$i] ?>"><?= $arrDays[$i] ?></label>
											</div>
										</div>
									<?php } ?>
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
			Get Data Profile
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

					$(`#formEditConfig input[name=meet_link]`).val(datas.data.meet_link);
					$(`#formEditConfig input[name=meet_time_show]`).val(datas.data.meet_time_show);
					$(`#formEditConfig input[name=meet_time_hide]`).val(datas.data.meet_time_hide);

					datas.data.meet_days_show.split(',').forEach(day => {
						$(`input[type=checkbox]#${day}`).prop("checked", true);
					});
				},
				error:function(data) {
					hideLoadingSpinner();
					
					showErrorServer(data);
				}
			})
		}

		getConfig();

		/*
			Edit Config
		*/
		$('#formEditConfig')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				submitHandler: function () {
					showLoadingSpinner();
					clearErrForm('#formEditConfig');

					let form = new FormData(document.querySelector('#formEditConfig'));

					let dayValue = "";
					$('.check_day').each(function () {
						if ($(this).prop("checked") == true) {
							dayValue += $(this).attr("data-day") + ",";
						}
					})

					form.set("meet_days_show", dayValue.slice(0, -1));

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/DashboardManagerConfig/editConfig'?>",
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
									$(`#formEditConfig input[name=${key}]`).addClass('is-invalid');
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
