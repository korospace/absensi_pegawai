<?php

class Login_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

    function getLoginUser($username, $password)
    {
		$this->db->select('u.userId,u.username,u.password,ul.name AS userLevel');
		$this->db->from('users u');
		$this->db->join('user_levels ul', 'u.userLevelId = ul.userLevelId');
        $this->db->where('u.username =', $username);
        $this->db->where('u.status   =', '1');

        $query = $this->db->get('users');
		$query = $query->result();

        return [
			'status' => count($query) > 0 ? true      : false,
			'data'   => count($query) > 0 ? $query[0] : [],
		];
    }

}
