<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	/**
	 * NOTES: 
	 * - add parent::__construct(); to constructor for enabling load function
	 */
	
	public function __construct()
	{
		parent::__construct();
 
		$this->load->helper('url');
	}

	public function index()
	{
        setcookie('_jwttoken','',-1,'/');
        unset($_COOKIE['_jwttoken']);

		redirect(base_url().'index.php/Login');die; // to Login
	}

}
