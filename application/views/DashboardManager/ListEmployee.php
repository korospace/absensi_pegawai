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
					<h1>Employees</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
						<li class="breadcrumb-item active">Employees</li>
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
					<div class="card">
						<div class="card-header d-flex justify-content-end">
							<button type="button" class="btn btn-block btn-outline-success btn-md" style="width: max-content;" data-toggle="modal" data-target="#modalAddEmployee" onclick="clearForm('#formAddEmployee')">
								<i class="fa fa-plus"></i> &nbsp; ADD
							</button>
						</div>

						<div class="card-header">
							<table id="tableEmployees" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Photo</th>
										<th>Username</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ==================
			Modals
	=================== -->
	<div class="modal fade" id="modalAddEmployee">
        <div class="modal-dialog">
			<form class="modal-content" id="formAddEmployee" autocomplete="off">
				<div class="modal-header">
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div>
									<div class="card-body">
										<div class="form-group">
											<label for="name">Nama Lengkap</label>
											<input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama lengkap">
										</div>
										<div class="form-group">
											<label for="phone">No. Telp</label>
											<input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor telepon">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</form>
        </div>
	</div>
	<div class="modal fade" id="modalEditEmployee">
        <div class="modal-dialog">
			<form class="modal-content" id="formEditEmployee" autocomplete="off">
				<div class="modal-header">
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div>
									<div class="card-body">
										<input type="hidden" name="userId">
										<input type="hidden" name="employeeId">

										<div class="form-group">
											<label for="name">Nama Lengkap</label>
											<input type="text" class="form-control" id="name" name="name">
										</div>
										<div class="form-group">
											<label for="phone">No. Telp</label>
											<input type="text" class="form-control" id="phone" name="phone">
										</div>
										<div class="form-group">
											<label for="username">Username</label>
											<input type="text" class="form-control" id="username" name="username">
										</div>
										<div class="form-group">
											<label for="password">
												Password
												<small><i>(optional)</i></small>
											</label>
											<input type="password" class="form-control" id="password" name="password">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</form>
        </div>
	</div>
	
	<script>
		/**
		 * Initial Tables
		 */
		$("#tableEmployees").DataTable({
			"paging"    	: true,
			"searching" 	: true,
			"ordering"  	: true,
			"retrieve"		: true,
			"lengthChange"	: false,
			"info"			: true,
			"autoWidth"		: false,
			"responsive"	: true,
			"bDestroy"      : true,
		}).buttons().container().appendTo('#tableEmployees_wrapper .col-md-6:eq(0)');

		/**
		 * Get List Of Employee
		 */
		function fn_get_list_employee() {
			showLoadingSpinner();

			$.ajax({
				type: "GET",
				url: "<?php echo base_url() . 'index.php/DashboardListEmployee/getListEmployee'?>",
				success:function(datas) {
					hideLoadingSpinner();

					/* remap data */
					datas.map(function (data,i) {
						data.no     = i+1;
						data.phone  = data.phone ? data.phone : '----';

						data.photo  = `<img class="img-thumbnail" width="150px" min-height="150px" max-height="250px" src="${data.img_profile ? data.img_profile_full : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOn8NttvA6tqm6qneoTylDrit08oB005q18Q&usqp=CAU'}"/>`;

						data.status = `<span class="btn_status btn btn-sm btn-${data.status == 1 ? 'success' : 'danger'}" data-status="${data.status}" data-userId="${data.userId}">
								${data.status == 1 ? 'aktif' : 'tidak aktif'}
							</span>`;

						data.action = `<a class="btn_delete btn btn-sm bg-danger" data-employeeId="${data.employeeId}">
								<i class="fas fa-trash"></i>
							</a>
							<a class="btn_edit btn btn-sm bg-warning" data-userId="${data.userId}">
								<i class="fas fa-edit"></i>
							</a>`;
					})

					/* update data table */
					$('#tableEmployees').DataTable({
						"bDestroy": true,
						data   	  : datas,
						columns	  : [
							{ data: 'no' },
							{ data: 'photo' },
							{ data: 'username' },
							{ data: 'name' },
							{ data: 'phone' },
							{ data: 'status' },
							{ data: 'action' },
						],
					});

					/* enable btn */
					enableImgViewer(".img-thumbnail");
					enableBtnStatus();
					enableBtnDelete();
					enableBtnEdit();
				},
				error:function(data) {
					hideLoadingSpinner();
					
					showErrorServer(data);
				}
			});
		}

		fn_get_list_employee();

		/**
		 * Edit Status Employee
		 */
		function enableBtnStatus() {
			$('.btn_status').each(function () {
				$(this).on('click', function () {
					showLoadingSpinner();
					let selectedBtn = $(this);

					/* get data from html attribute */
					let status = $(this).attr('data-status');
					let userId = $(this).attr('data-userId');

					/* create form */
					let form = new FormData();
					form.set('status', status == 1 ? 0 : 1);
					form.set('userId', userId);

					/* send to API */
					$.ajax({
						type		: "POST",
						url			: "<?php echo base_url() . 'index.php/DashboardListEmployee/changeEmployeeStatus'?>",
						data		: form,
						cache		: false,
						processData	: false,
						contentType	: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();
							showToast("employee successfully <b>updated..!</b>",'success');

							setTimeout(() => {
								selectedBtn.attr('data-status', form.get('status'));
								selectedBtn.html(form.get('status') == 1 ? 'aktif' : 'tidak aktif');
								selectedBtn.addClass(form.get('status') == 1 ? 'btn-success' : 'btn-danger');
								selectedBtn.removeClass(form.get('status') == 1 ? 'btn-danger' : 'btn-success');
							}, 500);
						},
						error:function(data) {
							hideLoadingSpinner();

							if (data.status == 400) {
								console.log(data.responseJSON);
							}
							else {
								showErrorServer(data);
							}
						}
					});
				})
			})
		}

		/**
		 * Delete Employee
		 */
		function enableBtnDelete() {
			$('.btn_delete').each(function () {
				$(this).on('click', function () {
					let employeeId = $(this).attr('data-employeeId');

					Swal.fire({
						title: `Are you sure?`,
						text: "This employee will be deleted",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#6E7881',
						confirmButtonText: 'yes',
						cancelButtonText: 'close',
					}).then((result) => {
						if (result.isConfirmed) {
							showLoadingSpinner();

							$.ajax(
							{
								type: "GET",
								url: "<?php echo base_url() . 'index.php/DashboardListEmployee/deleteEmployee?employeeId='?>"+employeeId,
								headers		: {
									'token': $.cookie("_jwttoken"),
								},
								success: function (data) {
									hideLoadingSpinner();
									fn_get_list_employee();
									showToast('employee successfully <b>deleted..!</b>','success');
								},
								error: function (data) {
									hideLoadingSpinner();
									showErrorServer(data);
								},
							});
						}
					})
				})
			})
		}

		/**
		 * Remove Error Class
		 */
		function clearForm(parentId) {
			$(`${parentId} .is-invalid`).removeClass('is-invalid');
			$(`${parentId} input`).val('');
		}
		function clearErrForm(parentId) {
			$(`${parentId} .is-invalid`).removeClass('is-invalid');
		}

		/**
		 * Add Employee
		 */
		$('#formAddEmployee')
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
				},
				messages: {
					name: {
						required: "name required",
					},
					phone: {
						required: "phone required",
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
					clearErrForm("#formAddEmployee");

					let form = new FormData(document.querySelector('#formAddEmployee')); 

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/DashboardListEmployee/AddEmployee'?>",
						data: form,
						cache: false,
						processData:false,
						contentType: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();

							showToast("employee successfully <b>added..!</b>",'success');
							$('#modalAddEmployee').modal('hide');
							fn_get_list_employee();
						},
						error:function(data) {
							hideLoadingSpinner();

							if (data.status != 400) {
								showErrorServer(data);
							}
							else if (data.status == 400) {
								for (const key in data.responseJSON) {
									$(`input[name=${key}]`).addClass('is-invalid');
									showToast(`${data.responseJSON[key]}`,'warning');
								}
							}
						}
					});
				}
			});

		
		/**
		 * Edit Employee
		 */
		
		// get detil
		function enableBtnEdit() {
			$('.btn_edit').each(function () {
				$(this).on('click', function () {
					let userId = $(this).attr('data-userId');

					showLoadingSpinner();
					clearForm("#formEditEmployee");
					$('#modalEditEmployee').modal('show');

					$.ajax({
						type: "GET",
						url: "<?php echo base_url() . 'index.php/DashboardListEmployee/getDetilEmployee?userId='?>"+userId,
						headers: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(datas) {
							hideLoadingSpinner();

							$(`#formEditEmployee input[name=userId]`).val(datas.data.userId);
							$(`#formEditEmployee input[name=employeeId]`).val(datas.data.employeeId);
							$(`#formEditEmployee input[name=name]`).val(datas.data.name);
							$(`#formEditEmployee input[name=phone]`).val(datas.data.phone);
							$(`#formEditEmployee input[name=username]`).val(datas.data.username);
						},
						error:function(data) {
							hideLoadingSpinner();
							
							showErrorServer(data);
						}
					})
				})
			})
		}

		// update employe
		$('#formEditEmployee')
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
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				},
				submitHandler: function () {
					showLoadingSpinner();
					clearErrForm("#formEditEmployee");

					let form = new FormData(document.querySelector('#formEditEmployee')); 
					form.set("userId", $(`#formEditEmployee input[name=userId]`).val());

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/DashboardListEmployee/editEmployee'?>",
						data: form,
						cache: false,
						processData:false,
						contentType: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();

							showToast("employee successfully <b>updated..!</b>",'success');
							$(`#formEditEmployee input[name=password]`).val('');
							fn_get_list_employee();
						},
						error:function(data) {
							hideLoadingSpinner();

							if (data.status != 400) {
								showErrorServer(data);
							}
							else if (data.status == 400) {
								for (const key in data.responseJSON) {
									$(`#formEditEmployee input[name=${key}]`).addClass('is-invalid');
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
