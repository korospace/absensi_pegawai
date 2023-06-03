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
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/adminlte.min.css'); ?>">
	<!-- summernote -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/summernote/summernote-bs4.min.css'); ?>">
	<!-- Toastify style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/plugins/toastify.min.css'); ?>">
	<!-- Loading Spinner style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/showLoadingSpinner.css'); ?>">
	<!-- Img Viewer -->
	<link rel="stylesheet" href="<?= base_url('assets/css/imgViewer.css'); ?>">

	<style>
		#modalAddTask .modal-dialog, #modalEditTask .modal-dialog {
			max-width: 100% !important;
		}

		#modalAddTask .modal-content, #modalEditTask .modal-content {
			max-width: 100% !important;
		}
	</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">

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
			<div class="user-panel mt-3 pb-3 d-flex justify-content-center">
				<!-- <div class="image">
					<img src="<?= base_url() ?>assets/img/user-default.jpeg" class="img-circle elevation-2" alt="User Image">
				</div> -->
				<div class="info">
					<a href="#" class="d-block"><?= generateSalam(); ?>, <b><?= $name ?></b>!</a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="user-panel mt-3 pb-3">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="" class="nav-link">
							<i class="nav-icon fa fa-home"></i>
							<p>Dashboard</p>
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

		<!-- Main Body -->
		<div class="content mt-2">
			<!-- Meeting Link -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="alert alert-secondary">
							<h5 class="d-flex align-items-center mb-4">
								<span>Online Meeting</span>
							</h5>
							<span>
								<i class="fa fa-arrow-right mr-2" aria-hidden="true" style="font-size: 14px;"></i>
							</span> 
							<b id="link-wraper" style="font-size: 18px;">_ _ _ _</b>
						</div>
					</div>
				</div>
			</div>

			<!-- Tasks -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card card-secondary card-outline">
							<div class="card-header">
								<h3 class="card-title">
								<i class="fas fa-edit"></i>
									Task
								</h3>
							</div>

							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="card card-secondary card-outline card-outline-tabs">
											<div class="card-header p-0 border-bottom-0">
												<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
													<li class="nav-item">
														<a class="nav-link text-secondary active" id="today_task_tab" data-toggle="pill" href="#today_task" role="tab" aria-controls="today_task" aria-selected="true">Today</a>
													</li>
													<li class="nav-item">
														<a class="nav-link text-secondary" id="all_task_tab" data-toggle="pill" href="#all_task" role="tab" aria-controls="all_task" aria-selected="false">All</a>
													</li>
												</ul>
											</div>
											<div class="card-body">
												<div class="tab-content" id="custom-tabs-four-tabContent">
													<div class="tab-pane fade show active" id="today_task" role="tabpanel" aria-labelledby="today_task_tab">
														<div class="row">
															<div class="col-12 d-flex justify-content-end">
																<button type="button" class="btn btn-secondary btn-md" style="width: max-content;" data-toggle="modal" data-target="#modalAddTask" onclick="clearInputForm('#formAddTask')">
																	<i class="fa fa-plus"></i> &nbsp; ADD
																</button>
															</div>

															<div class="col-12 mt-4">
																<table class="table table-bordered table-hover" id="table_today_task">
																	<thead>
																		<tr>
																			<th class="text-center">
																				#
																			</th>
																			<th>
																				Title
																			</th>
																			<th class="text-center">
																				Created At
																			</th>
																			<th class="text-center">
																				Status
																			</th>
																			<th class="text-center">
																				Action
																			</th>
																		</tr>
																	</thead>
																	<tbody>

																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="tab-pane fade" id="all_task" role="tabpanel" aria-labelledby="all_task_tab">
														All
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- ==================
			Modals
	=================== -->
	<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalAddTask">
		<div class="modal-dialog modal-xl">
			<form class="modal-content" id="formAddTask">
				<div class="modal-header">
					<h4 class="modal-title">New Task</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-4 pb-3">
					<div class="row">
						<!-- title -->
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" id="title" name="title" placeholder="Title:">
							</div>
						</div>
						<!-- description -->
						<div class="col-12">
							<div class="form-group">
								<textarea id="description" name="description" class="form-control" style="height: 300px">
									
								</textarea>
							</div>
						</div>
						<!-- Files -->
						<div class="col-12 mt-3 mb-4">
							<div class="dropdown-divider"></div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<div class="btn btn-default btn-file">
									<i class="fas fa-paperclip"></i> Attachment
									<input type="file" name="attachment" id="attachment_input_leader" onchange="dokUploadCheck(this, '#formAddTask')">
								</div>
								<p class="help-block">Max. 5MB</p>
							</div>
						</div>
						<div class="col-12">
							<ul id="attachments_wraper" class="mailbox-attachments d-flex align-items-stretch clearfix">
								
							</ul>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Save changes</button>
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalEditTask">
		<div class="modal-dialog modal-xl">
			<form class="modal-content" id="formEditTask">
				<div class="modal-header">
					<h4 class="modal-title">Edit Task</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-4 pb-3">
					<div class="row">
						<input type="hidden" id="taskId" name="taskId">

						<!-- status -->
						<div class="col-12" id="status_wraper">
						</div>
						<!-- title -->
						<div class="col-md-6 mt-3">
							<div class="form-group">
								<label for="title">Title:</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Title:">
							</div>
						</div>
						<!-- instruction -->
						<div class="col-12 mt-2" id="instruction">
							<div class="card card-secondary card-outline" style="min-height: 250px;">
								<div class="card-header">
									<h3 class="card-title">Instruction</h3>
								</div>

								<div class="card-body p-0">
									<div class="mailbox-read-message">
										
									</div>
								</div>
							</div>
						</div>
						<!-- Old Files -->
						<div class="col-12 mt-3 mb-4">
							<div class="dropdown-divider"></div>
						</div>
						<div class="col-12">
							<ul id="attachments_wraper_old" class="mailbox-attachments d-flex align-items-stretch clearfix">
								<div class="text-center text-muted" style="width: 100%;">
									<small>No Files Available</small>
								</div>
							</ul>
						</div>
						<!-- description -->
						<div class="col-12">
							<div class="mt-3 mb-4">
								<div class="dropdown-divider"></div>
							</div>
							<div class="form-group">
								<label for="">Submission:</label>
								<textarea id="description" name="description" class="form-control" style="height: 300px">
									
								</textarea>
							</div>
						</div>
						<!-- New Files -->
						<div class="col-12 mt-3 mb-4">
							<div class="dropdown-divider"></div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<div class="btn btn-default btn-file">
									<i class="fas fa-paperclip"></i> New Attachment
									<input type="file" name="attachment" id="attachment_input_leader" onchange="dokUploadCheck(this, '#formEditTask')">
								</div>
								<p class="help-block">Max. 5MB</p>
							</div>
						</div>
						<div class="col-12">
							<ul id="attachments_wraper" class="mailbox-attachments d-flex align-items-stretch clearfix">
								
							</ul>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-warning">Request check</button>
				</div>
			</form>
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
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets/js/plugins/adminlte.min.js') ?>"></script>
	<!-- Summernote -->
	<script src="<?= base_url('assets/js/plugins/summernote/summernote-bs4.min.js') ?>"></script>
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
					clearInterval(intervalGetMeetLink);
					
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

		/**
		 * Get Meet Link
		 */
		let intervalGetMeetLink = null;

		let getMeetLink = function() { 
			$.ajax({
				type: "GET",
				url: "<?php echo base_url() . 'index.php/DashboardManagerConfig/getMeetLink'?>",
				headers: {
					'token': $.cookie("_jwttoken"),
				},
				success:function(res) {
					$('#link-wraper').html(res.data ? `<a href="${res.data}" target="_blank">${res.data}</a>` : "_ _ _ _" );
				},
				error:function(res) {
					// nothing
				}
			});
		}

		intervalGetMeetLink = setInterval(getMeetLink, 4000);

		/**
		 * Initial Table Task (today)
		 */
		$("#table_today_task").DataTable({
			"paging"    	: true,
			"searching" 	: true,
			"ordering"  	: true,
			"retrieve"		: true,
			"lengthChange"	: false,
			"info"			: true,
			"autoWidth"		: false,
			"responsive"	: true,
		}).buttons().container().appendTo('#table_today_task_wrapper .col-md-6:eq(0)');

		/**
		 * Get List Of Task
		 */
		function fn_get_task() {
			showLoadingSpinner();

			$.ajax({
				type: "GET",
				url: "<?php echo base_url() . 'index.php/EmployeeTasks/getListTask'?>",
				headers		: {
					'token': $.cookie("_jwttoken"),
				},
				success:function(datas) {
					hideLoadingSpinner();

					let tasks = datas.data;

					/* remap data */
					tasks.map(function (data,i) {
						data.no = i+1;

						let statusClass = "";

						if (data.status == "onprogres") {
							statusClass = "secondary";
						} 
						else if (data.status == "checking") {
							statusClass = "warning";
						}
						else if (data.status == "accepted") {
							statusClass = "success";
						}
						else if (data.status == "revision") {
							statusClass = "danger";
						}

						data.action = "";

						if (data.managerId == null) {
							data.action += `<span class="btn_delete btn btn-sm bg-secondary mr-2" onclick="removeTask('${data.taskId}')">
									<i class="fas fa-trash"></i>
								</span>`;
						}

						data.action += `<span class="btn_edit_task btn btn-sm bg-secondary" data-toggle="modal" data-target="#modalEditTask" onclick="editTask('${data.taskId}')">
							<i class="fas fa-edit"></i>
						</span>`;

						data.status = `<span class="btn btn-outline-${statusClass} btn-sm" style="width: max-content;">
							${data.status}
						</span>`;
					})

					/* update data table */
					$('#table_today_task').DataTable({
						"bDestroy": true,
						data   	  : tasks,
						columns	  : [
							{ data: 'no' },
							{ data: 'title' },
							{ data: 'created_at' },
							{ data: 'status' },
							{ data: 'action' },
						], 
						columnDefs: [
							{
								"targets": [0,2,3,4],
								"className": "text-center",
							},
						]
					});
				},
				error:function(data) {
					hideLoadingSpinner();
					
					showErrorServer(data);
				}
			});
		}

		fn_get_task();

		/**
		 * Initial Text Editor
		 */
		$('#modalAddTask #description').summernote({
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['fontname', ['fontname']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture']],
			],
			minHeight: 200
		})
		$('#modalEditTask #description').summernote({
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['fontname', ['fontname']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture']],
			],
			minHeight: 200
		})

		/**
		 * Document Checked
		 */
		function dokUploadCheck(el,formTarget) {

			if(el.files[0].size > 5000000) {
				showToast('ukuran dokumen tidak boleh lebih dari 5 mb','warning');

				el.value = "";
				return false;
			}
			else if(/video/.test(el.files[0].type)){
				showToast('file video tidak diperbolehkan','warning');

				el.value = "";
				return false;
			}
			else {
				let newAttachment = "";
				let filesize	  = parseFloat(el.files[0].size/1000000).toFixed(6);
				let docType		  = el.files[0].type.split('/');
				let counterAttachmentFile = $('.attachment_input').length;

                if(/image/.test(docType[0])){
					newAttachment = `<li id="li_attachment_input_${counterAttachmentFile+1}" style="display: flex;flex-direction: column;">
						<input type="file" name="attachment_input[${counterAttachmentFile+1}]" class="attachment_input" id="attachment_input_${counterAttachmentFile+1}" style="position: absolute;z-index: -100;opacity: 0;max-width:2px;">

						<span class="mailbox-attachment-icon has-img">
							<img src="${URL.createObjectURL(el.files[0])}" alt="Attachment" style="min-height: 132.5px;max-height: 132.5px;">
						</span>

						<div class="mailbox-attachment-info" style="flex: 1;display: flex;flex-direction: column;justify-content: space-between;">
							<a href="#" class="mailbox-attachment-name" style="word-break: break-all;"><i class="fas fa-camera"></i> ${el.files[0].name}</a>
							<span class="mailbox-attachment-size clearfix mt-3">
								<span>${filesize} MB</span>
								<a href="#" class="btn btn-default btn-sm float-right" onclick="removeEl('#li_attachment_input_${counterAttachmentFile+1}')">
									<i class="fas fa-trash"></i>
								</a>
							</span>
						</div>
					</li>`;
				}
				else {
					newAttachment = `<li id="li_attachment_input_${counterAttachmentFile+1}" style="display: flex;flex-direction: column;">
						<input type="file" name="attachment_input[${counterAttachmentFile+1}]" class="attachment_input" id="attachment_input_${counterAttachmentFile+1}" style="position: absolute;z-index: -100;opacity: 0;max-width:2px;">

						<span class="mailbox-attachment-icon"><i class="far fa-file"></i></span>
	
						<div class="mailbox-attachment-info" style="flex: 1;display: flex;flex-direction: column;justify-content: space-between;">
							<a href="#" class="mailbox-attachment-name" style="word-break: break-all;"><i class="fas fa-paperclip"></i> ${el.files[0].name}</a>
							<span class="mailbox-attachment-size clearfix mt-3">
								<span>${filesize} MB</span>
								<a href="#" class="btn btn-default btn-sm float-right" onclick="removeEl('#li_attachment_input_${counterAttachmentFile+1}')">
									<i class="fas fa-trash"></i>
								</a>
							</span>
						</div>
					</li>`;
				}

				$(`${formTarget} #attachments_wraper`).append(newAttachment);
				document.querySelector(`${formTarget} #attachment_input_${counterAttachmentFile+1}`).files = el.files;
			}
		}

		/**
		 * Remove Element
		 */
		function removeEl(targetIdentifier) {
			$(targetIdentifier).remove();
		}

		/**
		 * Remove Error Class
		 */
		function clearErrForm(parentId) {
			$(`${parentId} .is-invalid`).removeClass('is-invalid');
		}
		function clearInputForm(parentId) {
			clearErrForm(parentId);
			$(`${parentId} input`).val(null);
			$(`${parentId} #description`).summernote("code",null);
			$(`${parentId} #attachments_wraper li`).remove();
		}

		/**
		 * Add Task
		 */
		$('#formAddTask')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				rules: {
					title: {
						required: true,
					},
				},
				messages: {
					title: {
						required: "title required",
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
					clearErrForm("#formAddTask");

					let form = new FormData(document.querySelector('#formAddTask')); 

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/EmployeeTasks/AddTask'?>",
						data: form,
						cache: false,
						processData:false,
						contentType: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();

							showToast("task successfully <b>added..!</b>",'success');
							$('#modalAddTask').modal('hide');
							fn_get_task();
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
			})

		/**
		 * Edit Task
		 */
		$('#formEditTask #instruction').hide();

		function editTask(taskId) {
			clearInputForm('#formEditTask');
			getDetilTask(taskId);
		}
		
		function getDetilTask(taskId) {
			showLoadingSpinner();

			$.ajax({
				type: "GET",
				url: "<?php echo base_url() . 'index.php/EmployeeTasks/getDetilTask?taskId='?>"+taskId,
				headers		: {
					'token': $.cookie("_jwttoken"),
				},
				success:function(datas) {
					hideLoadingSpinner();
	
					// data task
					let statusClass = "";
	
					if (datas.data.status == "onprogres") {
						statusClass = "secondary";
					} 
					else if (datas.data.status == "checking") {
						statusClass = "warning";
					}
					else if (datas.data.status == "accepted") {
						statusClass = "success";
					}
					else if (datas.data.status == "revision") {
						statusClass = "danger";
					}
	
					$('#formEditTask #status_wraper').html(`<span class="btn btn-outline-${statusClass} btn-sm" style="width: max-content;">
						${datas.data.status}
					</span>`);
	
					$('#formEditTask #taskId').val(datas.data.taskId);
					$('#formEditTask #title').val(datas.data.title);
					$('#modalEditTask #description').summernote("code",datas.data.description);

					if (datas.data.instruction) {
						$('#formEditTask #instruction').show();
						$('#formEditTask #instruction .mailbox-read-message').html(datas.data.instruction);
					}
					else {
						$('#formEditTask #instruction').hide();
						$('#formEditTask #instruction .mailbox-read-message').html('');
					}
	
					// task documents
					let liEl = "";
	
					datas.data.documents.forEach(doc => {
						if (doc.file_type == "image") {
							liEl += `<li>
								<span class="mailbox-attachment-icon has-img">
									<img src="${doc.file_url}" alt="Attachment" style="min-height: 132.5px;max-height: 132.5px;">
								</span>
	
								<div class="mailbox-attachment-info">
									<a href="#" class="mailbox-attachment-name" style="word-break: break-all;"><i class="fas fa-camera"></i> ${doc.file_name}</a>
									<span class="mailbox-attachment-size clearfix mt-3">
										<a href="${doc.file_url}" target="_blank" class="btn btn-default btn-sm float-right ml-2">
											<i class="fas fa-cloud-download-alt"></i>
										</a>
										<a href="#" class="btn btn-default btn-sm float-right" onclick="removeDoc('${doc.docId}','${datas.data.taskId}')">
											<i class="fas fa-trash"></i>
										</a>
									</span>
								</div>
							</li>`;
						} else {
							liEl += `<li>
								<span class="mailbox-attachment-icon"><i class="far fa-file"></i></span>
			
								<div class="mailbox-attachment-info">
									<a href="#" class="mailbox-attachment-name" style="word-break: break-all;"><i class="fas fa-paperclip"></i> ${doc.file_name}</a>
									<span class="mailbox-attachment-size clearfix mt-3">
										<a href="${doc.file_url}" target="_blank" class="btn btn-default btn-sm float-right ml-2">
											<i class="fas fa-cloud-download-alt"></i>
										</a>
										<a href="#" class="btn btn-default btn-sm float-right" onclick="removeDoc('${doc.docId}','${datas.data.taskId}')">
											<i class="fas fa-trash"></i>
										</a>
									</span>
								</div>
							</li>`;
						}
					});
	
					if (liEl != "") {
						$("#attachments_wraper_old").html(liEl);
					} else {
						$("#attachments_wraper_old").html(`<div class="text-center text-muted" style="width: 100%;">
							<small>No Files Available</small>
						</div>`);
					}
				},
				error:function(data) {
					hideLoadingSpinner();
					
					showErrorServer(data);
				}
			});
		}

		$('#formEditTask')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				rules: {
					title: {
						required: true,
					},
				},
				messages: {
					title: {
						required: "title required",
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
					let status = $("#status_wraper span").html().trim();
					
					if (status == "checking") {
						showToast("please wait, this task is under <b>CHECKING</b>",'info');
						return 0;
					}
					else if (status == "accepted") {
						showToast("Congrats, this task has been <b>ACCEPTED</b>",'success');
						return 0;
					}

					showLoadingSpinner();
					clearErrForm("#formEditTask");

					let form = new FormData(document.querySelector('#formEditTask')); 

					$.ajax({
						type: "POST",
						url: "<?php echo base_url() . 'index.php/EmployeeTasks/EditTask'?>",
						data: form,
						cache: false,
						processData:false,
						contentType: false,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success:function(data) {
							hideLoadingSpinner();

							showToast("task successfully <b>updated..!</b>",'success');
							$(`#formEditTask #attachments_wraper li`).remove();
							getDetilTask(form.get("taskId"));
							fn_get_task();
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
			})

		/**
		 * Remove Doc
		 */
		function removeDoc(docId,taskId) {
			Swal.fire({
				title: `Are you sure?`,
				text: "This document will be permanent deleted",
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
						url: "<?php echo base_url() . 'index.php/EmployeeTasks/deleteDoc?docId='?>"+docId,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success: function (data) {
							hideLoadingSpinner();
							showToast('document successfully <b>deleted..!</b>','success');
							getDetilTask(taskId);
						},
						error: function (data) {
							hideLoadingSpinner();
							showErrorServer(data);
						},
					});
				}
			})
		}

		/**
		 * Remove Task
		 */
		function removeTask(taskId) {
			Swal.fire({
				title: `Are you sure?`,
				text: "Data and all documents will be permanent deleted",
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
						url: "<?php echo base_url() . 'index.php/EmployeeTasks/deleteTask?taskId='?>"+taskId,
						headers		: {
							'token': $.cookie("_jwttoken"),
						},
						success: function (data) {
							hideLoadingSpinner();
							showToast('task successfully <b>deleted..!</b>','success');
							fn_get_task();
						},
						error: function (data) {
							hideLoadingSpinner();
							showErrorServer(data);
						},
					});
				}
			})
		}
	</script>
</body>
</html>
