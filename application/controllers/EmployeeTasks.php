<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeTasks extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 */
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(['url','form','my_helper']);
		$this->load->library(['form_validation']);
		$this->load->model('EmployeeTask_model');
	}

	/**
	 * Api - Get List Of Task
	 * ==========================
	 */
	public function getListTask()
	{
		$token     = isset($_COOKIE['_jwttoken']) ? $_COOKIE['_jwttoken'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->EmployeeTask_model->getListTask($dataToken['data']);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Get Detil Task
	 * ==========================
	 */
	public function getDetilTask()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->EmployeeTask_model->getDetilTask($this->input,$dataToken['data']);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Add Employe Task
	 * ==========================
	 */
	public function AddTask()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$this->form_validation->set_rules(
			'title','Title',
			'required|max_length[300]',
			array(
				'required'  => '%s harus diisi',
				'max_length'=> '%s maxinal 300 char',
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

		$dbResponse = $this->EmployeeTask_model->AddTask($this->input,$dataToken['data']);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * Api - Edit Employe Task
	 * ==========================
	 */
	public function editTask()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$this->form_validation->set_rules(
			'title','Title',
			'required|max_length[300]',
			array(
				'required'  => '%s harus diisi',
				'max_length'=> '%s maxinal 300 char',
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

		$dbResponse = $this->EmployeeTask_model->editTask($this->input,$dataToken['data']);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * API - Delete Document
	 */
	public function deleteDoc()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->EmployeeTask_model->deleteDoc($this->input,$dataToken['data']);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}
}
