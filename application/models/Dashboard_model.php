<?php

class Dashboard_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

	/* Get Name */
    function getManagerName($userId)
    {
		$this->db->select('name');
        $this->db->where('userId', $userId);

        $query = $this->db->get('managers');
		return strtoupper(explode(" ",$query->first_row()->name)[0]);
    }

	function getEmployeeName($userId)
    {
		$this->db->select('name');
        $this->db->where('userId', $userId);

        $query = $this->db->get('employees');
		return strtoupper(explode(" ",$query->first_row()->name)[0]);
    }
}
