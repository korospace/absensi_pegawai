<?php

class DashboardListEmployee_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

	/* Get List Of Employee */
    function getListEmployee($userId)
    {
		$this->db->select('u.userId,u.username,u.status,e.name,e.phone');
		$this->db->from('users u');
		$this->db->join('employees e', 'u.userId = e.userId');
        $this->db->where('e.managerId =', $userId);

        $query = $this->db->get();
		return $query->result();
    }
}
