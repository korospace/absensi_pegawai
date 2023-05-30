<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardListEmployee extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 */
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(['url','form','my_helper']);
		$this->load->library(['form_validation','encryption']);
	 	$this->load->model('DashboardListEmployee_model');
	}

	/**
	 * View List Of Employee
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
			if ($dataToken['data']->privilege != 'manager') {
				echo "<script>
					window.location.replace('" . base_url() . "index.php/notfound');
				</script>";
			}

			$this->load->view('DashboardManager/ListEmployee'); 
		}
	}

	/**
	 * Api - Get List Of Employee
	 * ==========================
	 */
	public function getListEmployee()
	{
		$token     = isset($_COOKIE['_jwttoken']) ? $_COOKIE['_jwttoken'] : null;
        $dataToken = checkToken($token, true);
		$userId    = $dataToken['data']->userId;

		$dbResponse = $this->DashboardListEmployee_model->getListEmployee($userId);

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Get Detil Employee
	 * ==========================
	 */
	public function getDetilEmployee()
	{
		$token     = isset($_COOKIE['_jwttoken']) ? $_COOKIE['_jwttoken'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardListEmployee_model->getDetilEmployee($this->input,$dataToken);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Change Employee Status
	 * ============================
	 */
	public function changeEmployeeStatus()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$this->db->set('status', $this->input->post('status'));
		$this->db->where('userId', $this->input->post('userId'));
		$this->db->update('users');

		echo true;
	}

	/**
	 * Api - Add Employee
	 * ===================
	 */
	public function AddEmployee()
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
			'numeric|required|max_length[20]|is_unique[employees.phone]',
			array(
				'required'  => '%s harus diisi',
				'max_length'=> '%s melebihi batas maxinal',
				'numeric'   => '%s harus angka',
				'is_unique' => '%s sudah terdaftar'
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

		$this->DashboardListEmployee_model->AddEmployee($this->input,$dataToken,$this);

		echo true;
	}

	/**
	 * Api - Edit Employee
	 * ===================
	 */
	public function editEmployee()
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

		$dbResponse = $this->DashboardListEmployee_model->editEmployee($this->input,$dataToken,$this);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * API - Delete Employee
	 */
	public function deleteEmployee()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardListEmployee_model->deleteEmployee($this->input,$dataToken);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

}
