<?php

class EmployeeAttendance_model extends CI_Model 
{
	/**
	 * NOTES: 
	 * - make sure you have added the database library to the autoload.php
	 */

	/*
		Get Attendance - Manager Purpose
	*/
	public function getAttendanceForManager($input, $dataToken)
	{
		// tes
		// $noDay  = 0;
		// $startDate = "2023-06-01 08:05:00";
		// $arrDay = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

		// for ($i=0; $i < 30; $i++) {
		// 	if ($noDay == 7) {
		// 		$noDay = 0;
		// 	}
			
		// 	$this->db->set('employeeId',     1);
		// 	$this->db->set('day',		     strtolower(date("l", strtotime($startDate))));
		// 	$this->db->set('time_arrives',   "08:05:00");
		// 	$this->db->set('time_departure', "17:05:00");
		// 	$this->db->set('created_at',     $startDate);
		// 	$this->db->insert('employee_attendances');

		// 	if ($noDay%2 == 1) {
		// 		$this->db->set('employeeId',     3);
		// 		$this->db->set('day',		     strtolower(date("l", strtotime($startDate))));
		// 		$this->db->set('time_arrives',   "08:05:00");
		// 		$this->db->set('time_departure', "17:05:00");
		// 		$this->db->set('created_at',     $startDate);
		// 		$this->db->insert('employee_attendances');
		// 	}

		// 	if ($noDay%2 == 0) {
		// 		$this->db->set('employeeId',     4);
		// 		$this->db->set('day',		     strtolower(date("l", strtotime($startDate))));
		// 		$this->db->set('time_arrives',   "08:05:00");
		// 		$this->db->set('time_departure', "17:05:00");
		// 		$this->db->set('created_at',     $startDate);
		// 		$this->db->insert('employee_attendances');
		// 	}

		// 	$startDate = date("Y-m-d H:i:s", strtotime($startDate)+86400);
		// 	$noDay++;
		// }

		$data      = [];
		$managerId = $this->getManagerId($dataToken->userId);

		if ($input->get('startDate') && $input->get('endDate')) {
			$startDate = date("Y-m-d", strtotime($input->get('startDate'))) . " 00:00:00";
			$endDate   = date("Y-m-d", strtotime($input->get('endDate'))) . " 23:59:00";

			if (strtotime($endDate)-strtotime($startDate) > 2678400) {
				return [
					'code'    => 401,
					'status'  => true,
					'message' => "maksimal rentang adalah 31 hari"
				];
			}
			else {
				## get list employee
				$this->db->select('u.userId,u.username,u.status,e.employeeId,e.name,e.phone,e.img_profile');
				$this->db->from('users u');
				$this->db->join('employees e', 'u.userId = e.userId');
				$this->db->where('e.NA =', "N");
				$this->db->where('e.managerId =', $managerId);
				$this->db->order_by("employeeId", "DESC");
				$listEmployees = $this->db->get();
				$listEmployees = $listEmployees->result();

				## create list day
				$listDay = $this->groupDaysIntoWeeks($startDate,$endDate);

				## get attendance each employee
				$listWeekEachEmployee = [];

				foreach ($listEmployees as $employee) {
					$x = [];
					$listDayObject = $this->groupDaysIntoWeeksObject($startDate,$endDate);

					foreach ($listDayObject as $weekName => $week) {
						
						foreach ($week as $day) {
							$this->db->select('ea.day,ea.time_arrives,ea.time_departure,ea.created_at,e.name');
							$this->db->from('employee_attendances ea');
							$this->db->join('employees e', 'ea.employeeId = e.employeeId');
							$this->db->where('ea.employeeId', $employee->employeeId);
							$this->db->where('ea.created_at >=', date("Y-m-d H:i:s", $day['dayUnix']));
							$this->db->where('ea.created_at <=', date("Y-m-d H:i:s", $day['dayUnix']+86400));
		
							$listAttendance = $this->db->get();
							$x[$weekName][] = $listAttendance->first_row();
						}
					}
		
					$listWeekEachEmployee[$employee->name] = $x;
				}

				$data = [
					"listday" => $listDay,
					"listWeekEachEmployee" => $listWeekEachEmployee,
				];
			}
		} 
		else {
			$startDate = date("Y-m-d", time()) . " 00:00:00";
			$endDate   = date("Y-m-d", time()) . " 23:59:00";

			$this->db->select('ea.day,ea.time_arrives,ea.time_departure,ea.created_at,e.name');
			$this->db->from('employee_attendances ea');
			$this->db->join('employees e', 'e.employeeId = ea.employeeId');
			$this->db->where('e.managerId', $managerId);

			$this->db->where('ea.created_at >=', $startDate);
			$this->db->where('ea.created_at <=', $endDate);
			$this->db->order_by("ea.created_at",'asc');
	
			$listAttendance = $this->db->get();
			$data = $listAttendance->result();
		}

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $data
		];
	}

	/*
		Get Attendance - Employee Purpose
	*/
	public function getAttendanceForEmployee($input, $dataToken)
	{
		// tes
		// $noDay  = 0;
		// $startDate = "2023-06-01 08:05:00";
		// $arrDay = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

		// for ($i=0; $i < 30; $i++) {
		// 	if ($noDay == 7) {
		// 		$noDay = 0;
		// 	}
			
		// 	$this->db->set('employeeId',     1);
		// 	$this->db->set('day',		     strtolower(date("l", strtotime($startDate))));
		// 	$this->db->set('time_arrives',   "08:05:00");
		// 	$this->db->set('time_departure', "17:05:00");
		// 	$this->db->set('created_at',     $startDate);
		// 	$this->db->insert('employee_attendances');
		// 	$startDate = date("Y-m-d H:i:s", strtotime($startDate)+86400);
		// 	$noDay++;
		// }

		$employeeData = $this->getEmployeeData($dataToken->userId);

		$this->db->select('ea.day,ea.time_arrives,ea.time_departure,ea.created_at,e.name');
		$this->db->from('employee_attendances ea');
		$this->db->join('employees e', 'e.employeeId = ea.employeeId');
		$this->db->where('e.employeeId', $employeeData->employeeId);

		$startDate = "";
		$endDate   = "";

		if ($input->get('startDate') && $input->get('endDate')) {
			$startDate = date("Y-m-d", strtotime($input->get('startDate'))) . " 00:00:00";
			$endDate   = date("Y-m-d", strtotime($input->get('endDate'))) . " 23:59:00";

			if (strtotime($endDate)-strtotime($startDate) > 2678400) {
				return [
					'code'    => 401,
					'status'  => true,
					'message' => "maksimal rentang adalah 31 hari"
				];
			}
		}
		else {
			$startDate = date("Y-m-d", time()) . " 00:00:00";
			$endDate   = date("Y-m-d", time()) . " 23:59:00";
		}

		$this->db->where('ea.created_at >=', $startDate);
		$this->db->where('ea.created_at <=', $endDate);
		$this->db->order_by("ea.created_at",'asc');

		$data = $this->db->get();
        $data = $data->result();

		$weekCounter = 1;
		$newData = [];

		foreach ($data as $row) {
			$newData['week-'.$weekCounter][] = $row;

			if ($row->day == "sunday") {
				$weekCounter++;
			}
		}

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $newData
		];
	}

	/*
		Insert Attendace
	*/
	public function insertAttendace($input, $dataToken)
	{
		$employeeData = $this->getEmployeeData($dataToken->userId);

		// get attendance config
		$this->db->select('latitude_attendance,longitude_attendance,max_distance_attendance,days_attendance');
		$this->db->where('managerId', $employeeData->managerId);
		$dataConfAttendance = $this->db->get('manager_configs');
		$dataConfAttendance = $dataConfAttendance->first_row();

		if ($dataConfAttendance) {
			$today      = strtolower(date("l", time()));
			$configDays = explode(",", $dataConfAttendance->days_attendance);

			if (in_array($today,$configDays) == false) {
				return [
					'code'   => 401,
					'status' => false,
					'message'=> "tidak ada absensi untuk hari ini",
				];
			} 
			else {
				// get employee today attendance
				$startDate = date("Y-m-d", time()) . " 00:00:00";
				$endDate   = date("Y-m-d", time()) . " 23:59:00";
				$this->db->select('attendanceId,time_arrives,time_departure');
				$this->db->where('day', $today);
				$this->db->where('created_at >=', $startDate);
				$this->db->where('created_at <=', $endDate);
				$this->db->where('employeeId', $employeeData->employeeId);
				$todayAttend = $this->db->get('employee_attendances');
				$todayAttend = $todayAttend->first_row();

				if (isset($todayAttend->time_arrives) && $todayAttend->time_arrives && isset($todayAttend->time_departure) && $todayAttend->time_departure) {
					return [
						'code'   => 401,
						'status' => false,
						'message'=> "absen <b>datang</b> dan <b>pulang</b> sudah disi",
					];
				} 
				else {
					$R = 6371000; // meter
					$latFrom = deg2rad((float)$dataConfAttendance->latitude_attendance);
					$lonFrom = deg2rad((float)$dataConfAttendance->longitude_attendance);
					$latTo   = deg2rad((float)$input->post('latitude'));
					$lonTo   = deg2rad((float)$input->post('longitude'));
					$lonDelta = $lonTo-$lonFrom;
		
					$a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
					$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
	
					$angle = atan2(sqrt($a), $b);
					$result= $angle * $R;
	
					if ($result > $dataConfAttendance->max_distance_attendance) {
						return [
							'code'   => 401,
							'status' => false,
							'message'=> "anda <b>diluar</b> wilayah absensi",
						];
					}
					else {
						$msg = "";
						$this->db->set('employeeId',     $employeeData->employeeId);
						$this->db->set('day',		     $today);
						
						if (is_null($todayAttend)) {
							$msg = "absensi <b>datang</b> berhasil..!";
							$this->db->set('time_arrives',   date("H:i:s",  time()));
							$this->db->set('time_departure', null);
							$this->db->insert('employee_attendances');
						}
						elseif ($todayAttend->time_arrives && is_null($todayAttend->time_departure)) {
							$msg = "absensi <b>pulang</b> berhasil..!";
							$this->db->set('time_departure', date("H:i:s",  time()));
							$this->db->where('attendanceId', $todayAttend->attendanceId);
							$this->db->update('employee_attendances');
						}
	
						return [
							'code'   => 200,
							'status' => true,
							'message'=> $msg,
						];
					}
				}
			}

		} 
		else {
			return [
				'code'   => 404,
				'status' => false,
				'message'=> "configurasi absen belum diatur",
			];
		}
		
	}

	## Get Manager ID
	protected function getManagerId($userId)
	{
		$this->db->select('managerId');
		$this->db->where('userId =', $userId);

		$query = $this->db->get('managers');
		return $query->first_row()->managerId;
	}

	## Get Employee
	protected function getEmployeeData($userId)
	{
		$this->db->select('employeeId,managerId');
		$this->db->where('userId =', $userId);

		$query = $this->db->get('employees');
		return $query->first_row();
	}

	## grouping days (string)
	protected function groupDaysIntoWeeks($startDate, $endDate)
	{
		$startDate = strtotime($startDate);
		$endDate   = strtotime($endDate);
		
		$data = [];
		$weekCounter = 1;

		while ($startDate < $endDate) {
			$data['week-' . $weekCounter][] = strtolower(date("l", $startDate));

			if (strtolower(date("l", $startDate)) == "sunday") {
				$weekCounter++;
			}

			$startDate = $startDate + 86400;
		}

		return $data;
	}

	## grouping days (Object)
	protected function groupDaysIntoWeeksObject($startDate, $endDate)
	{
		$startDate = strtotime($startDate);
		$endDate   = strtotime($endDate);
		
		$data = [];
		$weekCounter = 1;

		while ($startDate < $endDate) {
			$data['week-' . $weekCounter][] = [
				'day'     => strtolower(date("l", $startDate)),
				'dayUnix' => strtotime(date("l", $startDate) . "00:00:00"),
			];

			if (strtolower(date("l", $startDate)) == "sunday") {
				$weekCounter++;
			}

			$startDate = $startDate + 86400;
		}

		return $data;
	}
}
