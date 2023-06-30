<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeAttendance extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 */
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(['url','form','my_helper']);
		$this->load->library(['form_validation']);
		$this->load->model('EmployeeAttendance_model');
	}

	/**
	 * Api - Get List Of Attendance
	 * ============================
	 */
	public function getAttendance()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		if ($dataToken['data']->privilege == "manager") {
			$dbResponse = $this->EmployeeAttendance_model->getAttendanceForManager($this->input,$dataToken['data']);
		}
		else {
			$dbResponse = $this->EmployeeAttendance_model->getAttendanceForEmployee($this->input,$dataToken['data']);
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Insert Attendance
	 * ===================
	 */
	public function insertAttendace()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		if ($this->input->post('latitude') && $this->input->post('longitude') && isset($_FILES['photo']))
		{
			$dbResponse = $this->EmployeeAttendance_model->insertAttendace($this->input, $_FILES['photo'], $dataToken['data']);

			return $this->output
				->set_content_type('application/json')
				->set_status_header($dbResponse['code'])
				->set_output(json_encode($dbResponse));
		}
		else {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(401)
				->set_output(json_encode("Bad Request"));
		}
	}
	
}
