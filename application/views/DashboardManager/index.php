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

		<!-- Main Body -->
		<div class="content mt-2">

			<!-- Activity -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card card-secondary card-outline">
							<div class="card-header">
								<h3 class="card-title">
								<i class="fas fa-edit"></i>
									Activity
								</h3>
							</div>

							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="card card-secondary card-outline card-outline-tabs">
											<div class="card-header p-0 border-bottom-0">
												<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
													<li class="nav-item">
														<a class="nav-link text-secondary active" id="today_task_tab" data-toggle="pill" href="#today_task" role="tab" aria-controls="today_task" aria-selected="true">Today Task</a>
													</li>
													<li class="nav-item">
														<a class="nav-link text-secondary" id="all_task_tab" data-toggle="pill" href="#all_task" role="tab" aria-controls="all_task" aria-selected="false">All Task</a>
													</li>
													<li class="nav-item">
														<a class="nav-link text-secondary" id="today_attendance_tab" data-toggle="pill" href="#today_attendance" role="tab" aria-controls="today_attendance" aria-selected="true">Today attendance</a>
													</li>
													<li class="nav-item">
														<a class="nav-link text-secondary" id="all_attendance_tab" data-toggle="pill" href="#all_attendance" role="tab" aria-controls="all_attendance" aria-selected="true">All attendance</a>
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
														</div>
														<div class="row mt-4">
															<div class="col-md-2">
																<a href="compose.html" class="btn btn-info btn-block mb-3">Status</a>

																<div class="card">
																	<div class="card-body p-0">
																		<ul class="nav nav-pills flex-column">
																			<li class="nav-item active">
																				<a href="#" class="nav-link">
																					<i class="fas fa-clock mr-2"></i> On Progres
																					<span id="status_onprogres" class="badge bg-secondary float-right">0</span>
																				</a>
																			</li>
																			<li class="nav-item">
																				<a href="#" class="nav-link">
																					<i class="text-warning fa fa-exclamation-triangle mr-2"></i> must check
																					<span id="status_checking" class="badge bg-warning float-right">0</span>
																				</a>
																			</li>
																			<li class="nav-item">
																				<a href="#" class="nav-link">
																					<i class="text-success fa fa-calendar-check" style="font-size: 18px;margin-right: 12px;"></i> Accepted
																					<span id="status_accepted" class="badge bg-success float-right">0</span>
																				</a>
																			</li>
																			<li class="nav-item">
																				<a href="#" class="nav-link">
																					<i class="text-danger fa fa-wrench" style="font-size: 17px;margin-right: 10px;"></i> Revision
																					<span id="status_revision" class="badge bg-danger float-right">0</span>
																				</a>
																			</li>
																		</ul>
																	</div>
																	<!-- /.card-body -->
																</div>
															</div>

													        <div class="col-md-10">
    	      													<div class="card card-secondary card-outline">
																	<div class="card-body">
																		<table class="table table-bordered table-hover" id="table_today_task">
																			<thead>
																				<tr>
																					<th class="text-center">
																						#
																					</th>
																					<th>
																						Employee
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
														</div>
													</div>
													<div class="tab-pane fade" id="all_task" role="tabpanel" aria-labelledby="all_task_tab">
														All
													</div>
													<div class="tab-pane fade" id="today_attendance" role="tabpanel" aria-labelledby="today_attendance_tab">
														today attendance
													</div>
													<div class="tab-pane fade" id="all_attendance" role="tabpanel" aria-labelledby="all_attendance_tab">
														All attendance
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
				<form class="modal-content" id="formAddTask" autocomplete="off">
					<div class="modal-header">
						<h4 class="modal-title">New Task</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body pt-4 pb-3">
						<div class="row">
							<!-- employee -->
							<div class="col-12">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="employee">Employee:</label>
										<input type="hidden" class="form-control" id="employeeId" name="employeeId">
										<input type="text" class="form-control" id="employee" name="employee" placeholder="Employee:">
									</div>
								</div>
							</div>
							<!-- title -->
							<div class="col-12">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="title">Title:</label>
										<input type="text" class="form-control" id="title" name="title" placeholder="Title:">
									</div>
								</div>
							</div>
							<!-- instruction -->
							<div class="col-12">
								<div class="form-group">
									<textarea id="instruction" name="instruction" class="form-control" style="height: 300px">
										
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
							<!-- Employee -->
							<div class="col-12 mt-3">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="employee">Employee:</label>
										<input type="hidden" class="form-control" id="employeeId" name="employeeId">
										<input type="text" class="form-control" id="employee" name="employee" disabled>
									</div>
								</div>
							</div>
							<!-- title -->
							<div class="col-md-6">
								<div class="form-group">
									<label for="title">Title:</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="Title:">
								</div>
							</div>
							<!-- description -->
							<div class="col-12 mt-2" id="description">
								<div class="card card-secondary card-outline" style="min-height: 250px;">
									<div class="card-header">
										<h3 class="card-title">Submission</h3>
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
							<!-- instruction -->
							<div class="col-12">
								<div class="mt-3 mb-4">
									<div class="dropdown-divider"></div>
								</div>
								<div class="form-group">
									<label for="">Instruction:</label>
									<textarea id="instruction" name="instruction" class="form-control" style="height: 300px">
										
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
						<div class="d-flex">
							<button type="submit" class="btn btn-danger mr-2" onclick="saveEdit('revision')">Revisi</button>
							<button type="submit" class="btn btn-success" onclick="saveEdit('accepted')">Accept</button>
						</div>
					</div>
				</form>
			</div>
		</div>

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
	<!-- Auto Complete -->
	<script src="<?= base_url('assets/js/plugins/bootstrap-autocomplete.min.js') ?>"></script>
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
					let totOnprogres = 0;
					let totChecking  = 0;
					let totRevision  = 0;
					let totAccepted  = 0;

					/* remap data */
					tasks.map(function (data,i) {
						data.no = i+1;

						let statusClass = "";

						if (data.status == "onprogres") {
							statusClass = "secondary";
							totOnprogres++;
						} 
						else if (data.status == "checking") {
							statusClass = "warning";
							totChecking++;
						}
						else if (data.status == "accepted") {
							statusClass = "success";
							totAccepted++;
						}
						else if (data.status == "revision") {
							statusClass = "danger";
							totRevision++;
						}

						data.action = "";

						if (data.managerId) {
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

					$('#status_onprogress').html(totOnprogres);
					$('#status_checking').html(totChecking);
					$('#status_accepted').html(totAccepted);
					$('#status_revision').html(totRevision);

					/* update data table */
					$('#table_today_task').DataTable({
						"bDestroy": true,
						data   	  : tasks,
						columns	  : [
							{ data: 'no' },
							{ data: 'name' },
							{ data: 'title' },
							{ data: 'created_at' },
							{ data: 'status' },
							{ data: 'action' },
						], 
						columnDefs: [
							{
								"targets": [0,2,3,4,5],
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
		$('#modalAddTask #instruction').summernote({
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
		$('#modalEditTask #instruction').summernote({
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
		 * Remove Error Class
		 */
		function clearErrForm(parentId) {
			$(`${parentId} .is-invalid`).removeClass('is-invalid');
		}
		function clearInputForm(parentId) {
			clearErrForm(parentId);
			$(`${parentId} input`).val(null);
			$(`${parentId} #instruction`).summernote("code",null);
			$(`${parentId} #attachments_wraper li`).remove();
		}

		/**
		 * Autocomplete
		 */
		$("#formAddTask #employee").autoComplete({
			resolver: 'ajax',
			noResultsText:'No results',
			events: {
				search: function (qry, callback) {
					$.ajax(
						{
							url: "<?php echo base_url() . 'index.php/DashboardListEmployee/getEmployeeByName'?>",
							data: { 'name': qry},
							headers: {
								'token': $.cookie("_jwttoken"),
							},
						}
					).done(function (res) {
						callback(res)
					});
				},
			},
		});

		$('#formAddTask #employee').on('keyup', function () {
			$('#formAddTask #employeeId').val('')
		});

		$('#formAddTask #employee').on('autocomplete.select', function (evt, item) {
			$('#formAddTask #employeeId').val(item.employeeId)
		});

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
		 * Add Task
		 */
		$('#formAddTask')
			.submit(function(e) {
				e.preventDefault();
			})
			.validate({
				rules: {
					employee: {
						required: true,
					},
					title: {
						required: true,
					},
				},
				messages: {
					employee: {
						required: "employee required",
					},
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
					if ($('#formAddTask #employeeId').val() == "") {
						showToast("choose <b>employee</b> first", "warning");				
					}
					else {
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

				}
			})

		/**
		 * Edit Task
		 */
		$('#formEditTask #description').hide();

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
					$('#formEditTask #employeeId').val(datas.data.employeeId);
					$('#formEditTask #employee').val(datas.data.employeeName);
					$('#formEditTask #title').val(datas.data.title);
					$('#modalEditTask #instruction').summernote("code",datas.data.instruction);

					if (datas.data.description) {
						$('#formEditTask #description').show();
						$('#formEditTask #description .mailbox-read-message').html(datas.data.description);
					}
					else {
						$('#formEditTask #description').hide();
						$('#formEditTask #description .mailbox-read-message').html('');
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
				}
			})
		
		function saveEdit(statusFromManager) {
			if ($('#formEditTask').valid()) {
				let status = $("#status_wraper span").html().trim();
					
				if (status == "onprogres") {
					showToast("please wait, this task under <b>progres</b>",'info');
					return 0;
				}
	
				showLoadingSpinner();
				clearErrForm("#formEditTask");
	
				let form = new FormData(document.querySelector('#formEditTask')); 
				form.set("status", statusFromManager);

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
		}

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
