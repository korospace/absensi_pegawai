<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardManagerConfig extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 */
	
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(['url','form','my_helper']);
		$this->load->library(['form_validation']);
		$this->load->model('DashboardManagerConfig_model');
	}

	/**
	 * View Config
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

			$this->load->view('DashboardManager/ManagerConfig'); 
		}
	}

	/**
	 * API - Get Config
	 * =====================
	 */
	public function getConfig()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardManagerConfig_model->getConfig($dataToken['data']->userId);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * API - Edit Config
	 * =====================
	 */
	public function editConfig()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$this->form_validation->set_rules(
			'meet_link','Link Meeting',
			'max_length[500]',
			array(
				'max_length'=> '%s maxinal 500 char',
			)
		);
		$this->form_validation->set_rules(
			'meet_time_show','Waktu muncul meeting',
			'max_length[8]',
			array(
				'max_length'  => '%s maxinal 8 char',
			)
		);
		$this->form_validation->set_rules(
			'meet_time_hide','Waktu sembunyikan meeting',
			'max_length[8]',
			array(
				'max_length'  => '%s maxinal 8 char',
			)
		);
		$this->form_validation->set_rules(
			'meet_days_show','Hari meeting',
			'max_length[60]',
			array(
				'max_length'  => '%s maxinal 60 char',
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

		/* Validate start more than end */
		$configTimeShowUnix = strtotime(date("d-m-Y", time()) . " " . $this->input->post('meet_time_show') . ":00");
		$configTimeHideUnix = strtotime(date("d-m-Y", time()) . " " . $this->input->post('meet_time_hide') . ":00");

		if ($configTimeShowUnix > $configTimeHideUnix) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode([
					'meet_time_show' => "<b>waktu mulai</b> tidak boleh lebih dari <b>waktu berakhir</b>",
					'meet_time_hide' => "<b>waktu berakhir</b> tidak boleh kurang dari <b>waktu mulai</b>"
				]));
		}

		$dbResponse = $this->DashboardManagerConfig_model->editConfig($this->input,$dataToken['data']->userId);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}

	/**
	 * API - Get Meet Link
	 * =====================
	 */
	public function getMeetLink()
	{
		$token     = isset($this->input->request_headers()['token']) ? $this->input->request_headers()['token'] : null;
        $dataToken = checkToken($token, true);

		$dbResponse = $this->DashboardManagerConfig_model->getMeetLink($dataToken['data']->userId);

		return $this->output
			->set_content_type('application/json')
			->set_status_header($dbResponse['code'])
			->set_output(json_encode($dbResponse));
	}
}
