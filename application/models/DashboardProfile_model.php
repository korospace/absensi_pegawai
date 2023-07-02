<?php

class DashboardProfile_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

	/**
	 * Get Profle - Manager
	 */
    public function getDataProfileManager($userId)
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

	/**
	 * Get Profle - Employee
	 */
    public function getDataProfileEmployee($userId)
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

	/**
	 * Edit Profile - Manager
	 */
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

	/**
	 * Edit Profile - Employee
	 */
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

	/**
	 * Get Attendance Photos
	 */
    public function getEmployeeAttendancePhotos($userId)
    {
        $url = "http://127.0.0.1:5000/api/check_employee_folder?employeeid=" . $this->getEmployeeID($userId);
		$curlInit = curl_init();

        curl_setopt($curlInit, CURLOPT_URL, $url);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curlInit);
		$result = json_decode($result);
        $result_code = curl_getinfo($curlInit, CURLINFO_HTTP_CODE);

		return [
			'code'    => $result_code,
			'status'  => $result_code==200 ? true : false,
			'message' => $result->message
		];
    }

	/**
	 * Save Attendance Photos
	 */
    public function saveAttendancePhotos($userId, $photo)
    {
		// ambil nama file foto
		$photoName = $photo['name'];
		// Menggabungkan $userId dan $files menjadi satu string dalam format multipart/form-data
		$postData = '';
		// Menambahkan nilai $userId ke dalam payload
		$postData .= "-----011000010111000001101001\r\n";
		$postData .= "Content-Disposition: form-data; name=\"employeeid\"\r\n\r\n";
		$postData .= $this->getEmployeeID($userId) . "\r\n";
		// Menambahkan file dari $files ke dalam payload
		$postData .= "-----011000010111000001101001\r\n";
		$postData .= "Content-Disposition: form-data; name=\"photo\"; filename=\"$photoName\"\r\n";
		$postData .= "Content-Type: " . $photo['type'] . "\r\n\r\n";
		$postData .= file_get_contents($photo['tmp_name']) . "\r\n";
		// Menambahkan penutup payload
		$postData .= "-----011000010111000001101001--\r\n";
		// Mendefinisikan URL endpoint Flask
		$url = "http://localhost:5000/api/create_model_file";
		// Membuat objek cURL
		$ch = curl_init();
		// Mengatur opsi cURL
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"content-type: multipart/form-data; boundary=---011000010111000001101001"
		]);
		// Menjalankan request cURL dan mendapatkan responsenya
		$result = curl_exec($ch);
		$result = json_decode($result);
        $result_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		return [
			'code'    => $result_code,
			'status'  => $result_code==200 ? true : false,
			'message' => $result->message
		];
	}

	## Get Employee ID
    protected function getEmployeeID($userId)
    {
		$this->db->select('employeeId');
        $this->db->where('userId =', $userId);

        $query = $this->db->get('employees');
		return $query->first_row()->employeeId;
    }

	## Get Old Profile Img
	protected function getOldProfileImg($tableName,$userId)
	{
		$this->db->select('img_profile');
        $this->db->where('userId =', $userId);
        $query = $this->db->get($tableName);

		return $query->first_row()->img_profile;
	}
}
