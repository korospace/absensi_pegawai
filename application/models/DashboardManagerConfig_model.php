<?php

class DashboardManagerConfig_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

	## Get Manager ID
    protected function getManagerId($userId)
    {
		$this->db->select('managerId');
        $this->db->where('userId =', $userId);

        $query = $this->db->get('managers');
		return $query->first_row()->managerId;
    }

	/**
	 * Get Config
	 */
    public function getConfig($userId)
    {
		$managerId = $this->getManagerId($userId);

		$this->db->select('meet_link,meet_time_show,meet_time_hide,meet_days_show,latitude_attendance,longitude_attendance,max_distance_attendance,days_attendance');
		$this->db->where('managerId', $managerId);

        $query = $this->db->get('manager_configs');
		$query = $query->first_row();
		
		if (is_null($query)) {
			$this->db->set('managerId', $managerId);
			$this->db->insert('manager_configs');
		}

		$this->db->select('meet_link,meet_time_show,meet_time_hide,meet_days_show,latitude_attendance,longitude_attendance,max_distance_attendance,days_attendance');
		$this->db->where('managerId', $managerId);

        $query = $this->db->get('manager_configs');
		$query = $query->first_row();

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $query
		];
    }

	/**
	 * Edit Config Meeting
	 */
	public function editConfigMeeting($input,$userId)
	{
		$managerId = $this->getManagerId($userId);

		$meet_link      = $input->post('meet_link');
		$meet_time_show = $input->post('meet_time_show');
		$meet_time_hide = $input->post('meet_time_hide');
		$meet_days_show = $input->post('meet_days_show');

		$this->db->set('meet_link', $meet_link);
		$this->db->set('meet_time_show', $meet_time_show);
		$this->db->set('meet_time_hide', $meet_time_hide);
		$this->db->set('meet_days_show', $meet_days_show);

		$this->db->where('managerId', $managerId);
		$this->db->update('manager_configs');
		$affectedRows = $this->db->affected_rows();

		return [
			'code'    => $affectedRows > 0 ? 200  : 404,
			'status'  => $affectedRows > 0 ? true : false,
			'message' => $affectedRows > 0 ? "config successfully updated" : "nothing update",
		];
	}

	/**
	 * Edit Config Attendance
	 */
	public function editConfigAttendance($input,$userId)
	{
		$managerId = $this->getManagerId($userId);

		$latitude_attendance     = $input->post('latitude_attendance');
		$longitude_attendance    = $input->post('longitude_attendance');
		$max_distance_attendance = $input->post('max_distance_attendance');
		$days_attendance		 = $input->post('days_attendance');

		$this->db->set('latitude_attendance', $latitude_attendance);
		$this->db->set('longitude_attendance', $longitude_attendance);
		$this->db->set('max_distance_attendance', $max_distance_attendance);
		$this->db->set('days_attendance', $days_attendance);

		$this->db->where('managerId', $managerId);
		$this->db->update('manager_configs');
		$affectedRows = $this->db->affected_rows();

		return [
			'code'    => $affectedRows > 0 ? 200  : 404,
			'status'  => $affectedRows > 0 ? true : false,
			'message' => $affectedRows > 0 ? "config successfully updated" : "nothing update",
		];
	}

	/**
	 * Get Meet Link
	 */
	public function getMeetLink($userId)
	{
		$this->db->select('managerId');
        $this->db->where('userId =', $userId);

        $query = $this->db->get('employees');
		$managerId = $query->first_row()->managerId;

		$this->db->select('meet_link,meet_time_show,meet_time_hide,meet_days_show');
		$this->db->where('managerId', $managerId);

        $query = $this->db->get('manager_configs');
		$query = $query->first_row();
		$link  = "";

		if ($query) {
			$today      = strtolower(date("l", time()));
			$configDays = explode(",", $query->meet_days_show);
			
			if (in_array($today,$configDays)) {
				$configTimeShowUnix = strtotime(date("d-m-Y", time()) . " " . $query->meet_time_show . ":00");
				$configTimeHideUnix = strtotime(date("d-m-Y", time()) . " " . $query->meet_time_hide . ":00");
				
				if (time() >= $configTimeShowUnix && time() <= $configTimeHideUnix) {
					$link = $query->meet_link;
				}
			}
		}

		return [
			'code'   => 200,
			'status' => true,
			'data'   => $link,
		];
	}

	/**
	 * Get Config Attendance Coordinate
	 */
	public function getConfAttendanceCoordinate($userId)
	{
		$this->db->select('managerId');
        $this->db->where('userId =', $userId);

        $query = $this->db->get('employees');
		$managerId = $query->first_row()->managerId;

		$this->db->select('latitude_attendance,longitude_attendance,max_distance_attendance');
		$this->db->where('managerId', $managerId);

        $query = $this->db->get('manager_configs');
		$query = $query->first_row();

		if ($query) {
			return [
				'code'   => 200,
				'status' => true,
				'data'   => $query,
			];
		} 
		else {
			return [
				'code'    => 404,
				'status'  => false,
				'message' => "configurasi absen belum diatur",
			];
		}
	}
}
