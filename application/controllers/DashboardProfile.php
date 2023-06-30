<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardProfile extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 */
	
	public function __construct()
	{
		parent::__construct();
 
		$this->load->helper(['url','form','my_helper']);
		$this->load->library(['form_validation','encryption']);
		$this->load->model('DashboardProfile_model');
	}

	/**
	 * View Profile
	 * =====================
	 */
	public function index()
	{
		$token     = isset($_COOKIE['_jwttoken']) ? $_COOKIE['_jwttoken'] : null;
        $dataToken = checkToken($token);

		if($dataToken['status'] == false)
        {
			echo "<script>
				window.location.replace('" . base_url() . "index.php/Logout');
			</script>";
        }
		else {
			$privilege = $dataToken['data']->privilege;
			
			if ($privilege == 'manager') {
				$this->load->view('DashboardManager/Profile'); 
			} 
			elseif ($privilege == 'employee') {
				$this->load->view('DashboardEmployee/Profile'); 
			}
		}
	}

	/**
	 * API - Get Data Profile - Manager
	 * ======================
	 */
	public function getDataProfileManager()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardProfile_model->getDataProfileManager($dataToken['data']->userId);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * API - Get Data Profile - Employee
	 * ======================
	 */
	public function getDataProfileEmployee()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardProfile_model->getDataProfileEmployee($dataToken['data']->userId);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Edit Profile - Manager
	 * ===================
	 */
	public function editProfileManager()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		/* Set validation rules */
		// if (empty($_FILES['img_profile']['name']))
		// {
		// 	$this->form_validation->set_rules('img_profile', 'Profile Image', 'required');
		// }
		$this->form_validation->set_rules(
			'name','Nama',
			'required|max_length[200]',
			array(
				'required'  => '%s harus diisi',
				'max_length'=> '%s melebihi batas maxinal',
			)
		);
		$this->form_validation->set_rules(
			'phone','No.telp',
			'numeric|required|max_length[20]',
			array(
				'required'    => '%s harus diisi',
				'max_length'  => '%s maxinal 20 char',
				'numeric'     => '%s harus angka',
			)
		);
		$this->form_validation->set_rules(
			'username','Username',
			'required|min_length[8]|max_length[20]',
			array(
				'required'  => '%s harus diisi',
				'min_length'=> '%s minimun 8 character',
				'max_length'=> '%s maxinal 20 character',
			)
		);
		$this->form_validation->set_rules(
			'password','Password',
			'min_length[8]|max_length[20]',
			array(
				'min_length'=> '%s minimun 8 character',
				'max_length'=> '%s maxinal 20 character',
			)
		);

		/* Set validation get error */
		if ($this->form_validation->run() == FALSE)
		{
			return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode($this->form_validation->error_array()));
		}

		$dbResponse = $this->DashboardProfile_model->editProfileManager($this->input,$dataToken['data']->userId,$this);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Edit Profile - Employee
	 * ===================
	 */
	public function editProfileEmployee()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		/* Set validation rules */
		$this->form_validation->set_rules(
			'name','Nama',
			'required|max_length[200]',
			array(
				'required'  => '%s harus diisi',
				'max_length'=> '%s melebihi batas maxinal',
			)
		);
		$this->form_validation->set_rules(
			'phone','No.telp',
			'numeric|required|max_length[20]',
			array(
				'required'    => '%s harus diisi',
				'max_length'  => '%s maxinal 20 char',
				'numeric'     => '%s harus angka',
			)
		);
		$this->form_validation->set_rules(
			'username','Username',
			'required|min_length[8]|max_length[20]',
			array(
				'required'  => '%s harus diisi',
				'min_length'=> '%s minimun 8 character',
				'max_length'=> '%s maxinal 20 character',
			)
		);
		$this->form_validation->set_rules(
			'password','Password',
			'min_length[8]|max_length[20]',
			array(
				'min_length'=> '%s minimun 8 character',
				'max_length'=> '%s maxinal 20 character',
			)
		);

		/* Set validation get error */
		if ($this->form_validation->run() == FALSE)
		{
			return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode($this->form_validation->error_array()));
		}

		$dbResponse = $this->DashboardProfile_model->editProfileEmployee($this->input,$dataToken['data']->userId,$this);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * API - Get Attendance Photos
	 * ======================
	 */
	public function getEmployeeAttendancePhotos()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardProfile_model->getEmployeeAttendancePhotos($dataToken['data']->userId);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * API - Save Attendance Photos
	 * ===================
	 */
	public function saveAttendancePhotos() 
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardProfile_model->saveAttendancePhotos($dataToken['data']->userId,$_FILES['photo']);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}
}
