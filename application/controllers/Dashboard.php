<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 */
	
	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('my_helper');
        $this->load->model('Dashboard_model');
	}

	/**
	 * View Dashboard
	 * ====================
	 */
	public function index()
	{
		$token     = isset($_COOKIE['_jwttoken']) ? $_COOKIE['_jwttoken'] : null;
        $dataToken = checkToken($token);

		if($dataToken['status'] == false)
        {
			redirect(base_url().'index.php/Logout');die; // to Logout
        }
		else {
			$userId    = $dataToken['data']->userId;
			$privilege = $dataToken['data']->privilege;
			
			if ($privilege == 'manager') {
				$data = [
					'title' => 'Dashboard Manager',
					'name'  => $this->Dashboard_model->getManagerName($userId),
				];
	
				$this->load->view('DashboardManager/index', $data); 
			} 
			elseif ($privilege == 'employee') {
				$data = [
					'title' => 'Dashboard Employee',
					'name'  => $this->Dashboard_model->getEmployeeName($userId),
				];
	
				$this->load->view('DashboardEmployee/index', $data); 
			}
		}
	}

	/**
	 * Api - Session Check
	 * ==========================
	 */
	public function sessionCheck()
	{
		$token = isset($_COOKIE['_jwttoken']) ? $_COOKIE['_jwttoken'] : null;
        checkToken($token, true);

		echo true;
	}
}
