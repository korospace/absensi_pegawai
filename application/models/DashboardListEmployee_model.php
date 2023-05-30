<?php

class DashboardListEmployee_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

	/* Get List Of Employee */
    public function getListEmployee($userId)
    {
		$this->db->select('u.userId,u.username,u.status,e.employeeId,e.name,e.phone');
		$this->db->from('users u');
		$this->db->join('employees e', 'u.userId = e.userId');
        $this->db->where('e.NA =', "N");
        $this->db->where('e.managerId =', $userId);
		$this->db->order_by("employeeId", "DESC");

        $query = $this->db->get();
		return $query->result();
    }

	/* Get Detil Employee */
	public function getDetilEmployee($input,$dataToken)
	{
		
		$this->db->select('u.userId,u.username,u.status,e.employeeId,e.name,e.phone');
		$this->db->from('users u');
		$this->db->join('employees e', 'u.userId = e.userId');
        $this->db->where('e.NA =', "N");
        $this->db->where('u.userId =', $input->get('userId'));
        $this->db->where('e.managerId =', $dataToken['data']->userId);

        $query = $this->db->get();

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $query->first_row()
		];
	}

	/* Add New Employee */
	public function AddEmployee($input,$dataToken,$controller)
	{
		$name     = $input->post('name');
		$phone    = $input->post('phone');
		$username = strtolower(explode(' ',$name)[0]) . generateOTP(4);
		$password = $controller->encryption->encrypt($username);

		$this->db->set('username', $username);
		$this->db->set('password', $password);
		$this->db->set('userLevelId', 2); // employee
		$this->db->insert('users');

		$this->db->set('name', $name);
		$this->db->set('phone', $phone);
		$this->db->set('userId', $this->db->insert_id());
		$this->db->set('managerId', $dataToken['data']->userId);
		$this->db->insert('employees');
	}

	/* Edit Employee */
	public function editEmployee($input,$dataToken,$controller)
	{
		$affectedRows = 0;
		$name     = $input->post('name');
		$phone    = $input->post('phone');
		$username = $input->post('username');

		if ($input->post('password') != "") {
			$password = $controller->encryption->encrypt($input->post('password'));
			$this->db->set('password', $password);
		}

		$this->db->set('username', $username);
		$this->db->where('userId', $input->post('userId'));
		$this->db->update('users');
		$affectedRows = $affectedRows+$this->db->affected_rows();

		$this->db->set('name', $name);
		$this->db->set('phone', $phone);
		$this->db->where('employeeId', $input->post('employeeId'));
		$this->db->where('managerId', $dataToken['data']->userId);
		$this->db->update('employees');
		$affectedRows = $affectedRows+$this->db->affected_rows();

		return [
			'code'    => $affectedRows > 0 ? 200  : 404,
			'status'  => $affectedRows > 0 ? true : false,
			'message' => $affectedRows > 0 ? "employee successfully updated" : "employee not updated",
		];
	}

	/* Delete Employee */
	public function deleteEmployee($input,$dataToken)
	{
		$this->db->set('NA', "Y");
        $this->db->where('employeeId =', $input->get('employeeId'));
        $this->db->where('managerId =', $dataToken['data']->userId);
		$this->db->update('employees');
		
		return [
			'code'    => $this->db->affected_rows() > 0 ? 200  : 404,
			'status'  => $this->db->affected_rows() > 0 ? true : false,
			'message' => $this->db->affected_rows() > 0 ? "employee successfully deleted" : "employee not deleted",
		];
	}

}
