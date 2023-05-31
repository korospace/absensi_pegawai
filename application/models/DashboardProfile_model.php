<?php

class DashboardProfile_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

	## Get Profle - Manager
    function getDataProfileManager($userId)
    {
		$this->db->select('u.userId,u.username,u.status,e.managerId,e.name,e.phone,e.img_profile');
		$this->db->from('users u');
		$this->db->join('managers e', 'u.userId = e.userId');
        $this->db->where('u.userId =', $userId);

        $query = $this->db->get();
		$query = $query->first_row();
		$query->original_url = getProfilePath()['original'];

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $query
		];
    }

	## Get Profle - Employee
    function getDataProfileEmployee($userId)
    {
		$this->db->select('u.userId,u.username,u.status,e.employeeId,e.name,e.phone,e.img_profile');
		$this->db->from('users u');
		$this->db->join('employees e', 'u.userId = e.userId');
        $this->db->where('u.userId =', $userId);

        $query = $this->db->get();
		$query = $query->first_row();
		$query->original_url = getProfilePath()['original'];

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $query
		];
    }

	## Edit Profile - Manager
	public function editProfileManager($input,$userId,$controller)
	{
		$affectedRows = 0;
		$name     = $input->post('name');
		$phone    = $input->post('phone');
		$username = $input->post('username');

		## if password not empty
		if ($input->post('password') != "") {
			$password = $controller->encryption->encrypt($input->post('password'));
			$this->db->set('password', $password);
		}

		$this->db->set('username', $username);
		$this->db->where('userId', $userId);
		$this->db->update('users');
		$affectedRows = $affectedRows+$this->db->affected_rows();

		## if img_profile not empty
		if ($_FILES['img_profile']['error'] == 0) {
			$imgProfileOld = $this->getOldProfileImg('managers', $userId);
			$ext     = explode('.',$_FILES['img_profile']['name']);
			$imageNm = uniqid().".".end($ext);

			move_uploaded_file($_FILES['img_profile']['tmp_name'], getProfilePath()['base'] . $imageNm);
			$this->db->set('img_profile',$imageNm);

			if ($imgProfileOld) {
				unlink(getProfilePath()['base'] . $imgProfileOld);
			}
		}

		$this->db->set('name', $name);
		$this->db->set('phone', $phone);
		$this->db->where('userId', $userId);
		$this->db->update('managers');
		$affectedRows = $affectedRows+$this->db->affected_rows();

		return [
			'code'    => $affectedRows > 0 ? 200  : 404,
			'status'  => $affectedRows > 0 ? true : false,
			'message' => $affectedRows > 0 ? "profile successfully updated" : "nothing update",
		];
	}

	## Edit Profile - Employee
	public function editProfileEmployee($input,$userId,$controller)
	{
		$affectedRows = 0;
		$name     = $input->post('name');
		$phone    = $input->post('phone');
		$username = $input->post('username');

		## if password not empty
		if ($input->post('password') != "") {
			$password = $controller->encryption->encrypt($input->post('password'));
			$this->db->set('password', $password);
		}

		$this->db->set('username', $username);
		$this->db->where('userId', $userId);
		$this->db->update('users');
		$affectedRows = $affectedRows+$this->db->affected_rows();

		## if img_profile not empty
		if ($_FILES['img_profile']['error'] == 0) {
			$imgProfileOld = $this->getOldProfileImg('employees', $userId);
			$ext     = explode('.',$_FILES['img_profile']['name']);
			$imageNm = uniqid().".".end($ext);

			move_uploaded_file($_FILES['img_profile']['tmp_name'], getProfilePath()['base'] . $imageNm);
			$this->db->set('img_profile',$imageNm);

			if ($imgProfileOld) {
				unlink(getProfilePath()['base'] . $imgProfileOld);
			}
		}

		$this->db->set('name', $name);
		$this->db->set('phone', $phone);
		$this->db->where('userId', $userId);
		$this->db->update('employees');
		$affectedRows = $affectedRows+$this->db->affected_rows();

		return [
			'code'    => $affectedRows > 0 ? 200  : 404,
			'status'  => $affectedRows > 0 ? true : false,
			'message' => $affectedRows > 0 ? "profile successfully updated" : "nothing update",
		];
	}

	protected function getOldProfileImg($tableName,$userId)
	{
		$this->db->select('img_profile');
        $this->db->where('userId =', $userId);
        $query = $this->db->get($tableName);

		return $query->first_row()->img_profile;
	}
}
