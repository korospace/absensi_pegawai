<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 * - the encryption_key is in the config.php file
	 */

	public function __construct()
	{
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('my_helper');
		$this->load->library('encryption');
        $this->load->model('Login_model');
	}

	/**
	 * View Login
	 * ====================
	 */
	public function index()
	{
        $token     = isset($_COOKIE['_jwttoken']) ? $_COOKIE['_jwttoken'] : null;
        $dataToken = checkToken($token);

        if($dataToken['status'] == false)
        {
			$data = [
				'title' => 'Login'
			];

			$this->load->view('LoginView', $data); // to LoginView.php
        }
        else
        {
			redirect(base_url().'index.php/DashboardController'); // to dashboardController
        }
	}

	/**
	 * API Login
	 * ====================
	 */
	public function LoginCek()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$dbResponse = $this->Login_model->getLoginUser($username, $password);

		if ($dbResponse['status'] == false) {
			$code = 401;
			$data = [
				'message' => 'username atau password salah'
			];
		}
		else {
			$dataUser = $dbResponse['data'];

			if ($password != $this->encryption->decrypt($dataUser->password)) {
				$code = 401;
				$data = [
					'message' => 'username atau password salah'
				];
			}
			else {
				$newToken = generateToken($dataUser->userId,$dataUser->userLevel,false);
                setcookie('_jwttoken',$newToken['token'],$newToken['expired'],"/");

				$code = 200;
				$data = [
					'token' => $newToken['token']
				];
			}
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header($code)
			->set_output(json_encode($data));
	}
}
