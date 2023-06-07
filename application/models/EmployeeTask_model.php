<?php

class EmployeeTask_model extends CI_Model 
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

	## Get Employee ID
    protected function getEmployeeID($userId)
    {
		$this->db->select('employeeId');
        $this->db->where('userId =', $userId);

        $query = $this->db->get('employees');
		return $query->first_row()->employeeId;
    }

	/**
	 * Get Task
	 */
	public function getListTask($input,$dataToken)
	{
		$this->db->select('et.taskId,et.employeeId,et.managerId,et.title,et.status,et.created_at,e.name');
		$this->db->from('employee_tasks et');
		$this->db->join('employees e', 'e.employeeId = et.employeeId');
		
		if ($dataToken->privilege == 'employee') {
			$this->db->where('e.userId =', $dataToken->userId);
		} 
		elseif ($dataToken->privilege == 'manager') {
			$this->db->join('managers m', 'e.managerId = m.managerId');
			$this->db->where('m.userId =', $dataToken->userId);
		}

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

		$this->db->where('et.created_at >=', $startDate);
		$this->db->where('et.created_at <=', $endDate);
		$this->db->order_by("et.created_at",'desc');
        $query = $this->db->get();
        $query = $query->result();

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $query
		];
	}

	/**
	 * Get Detil Task
	 */
	public function getDetilTask($input,$dataToken)
	{
		// get task
		$this->db->select('et.taskId,et.employeeId,et.title,et.description,et.instruction,et.status,et.created_at,e.name AS employeeName');
		$this->db->from('employee_tasks et');
		$this->db->join('employees e', 'e.employeeId = et.employeeId');
		$this->db->where('et.taskId =', $input->get('taskId'));
		
		if ($dataToken->privilege == 'employee') {
			$this->db->where('e.userId =', $dataToken->userId);
		} 
		elseif ($dataToken->privilege == 'manager') {
			$this->db->join('managers m', 'e.managerId = m.managerId');
			$this->db->where('m.userId =', $dataToken->userId);
		}

        $query = $this->db->get();
        $task  = $query->first_row();

		// get task documents
		$this->db->select('docId,taskId,file_name');
		$this->db->where('taskId =', $input->get('taskId'));
        $query    = $this->db->get('employee_task_documents');
        $taskDocs = $query->result();

		foreach ($taskDocs as $tD) {
			$ext = explode(".",$tD->file_name);
			$ext = end($ext);

			$tD->file_url = getTaskDocPath()['original'] . $tD->file_name;
			$tD->file_type= in_array($ext,['png','jpeg','jpg','webp','gif']) ? 'image' : 'doc';
		}

		$task->documents = $taskDocs;

		return [
			'code'    => 200,
			'status'  => true,
			'data'    => $task
		];
	}

	/**
	 * Add Task
	 */
	public function AddTask($input,$dataToken)
	{		
		if ($dataToken->privilege == 'employee') {
			$description = $input->post('description');
			$this->db->set('description', $description);
			$this->db->set('employeeId', $this->getEmployeeID($dataToken->userId));
		}
		elseif ($dataToken->privilege == 'manager') {
			$instruction = $input->post('instruction');
			$this->db->set('instruction', $instruction);
			$this->db->set('employeeId', $input->post('employeeId'));
			$this->db->set('managerId', $this->getManagerId($dataToken->userId));
		}

		// insert task
		$title = $input->post('title');
		$this->db->set('title', $title);
		$this->db->insert('employee_tasks');
		$taskId = $this->db->insert_id();

		// insert task document
		if (isset($_FILES['attachment_input'])) {
			for ($i=1; $i <= count($_FILES['attachment_input']['error']) ; $i++) { 
				if ($_FILES['attachment_input']['error'][$i] == 0) {
					$ext     = explode('.',$_FILES['attachment_input']['name'][$i]);
					$imageNm = uniqid().".".end($ext);

					move_uploaded_file($_FILES['attachment_input']['tmp_name'][$i], getTaskDocPath()['base'] . $imageNm);
					$this->db->set('taskId',$taskId);
					$this->db->set('file_name',$imageNm);
					$this->db->insert('employee_task_documents');
				}
			}
		}

		return [
			'code'    => 201,
			'status'  => true,
			'message' => "task successfully created",
		];
	}

	/**
	 * Edit Task
	 */
	public function editTask($input,$dataToken)
	{
		$taskId      = $input->post('taskId');
		$title       = $input->post('title');
		
		// update task
		$affectedRows = 0;
		$this->db->set('title', $title);
		
		if ($dataToken->privilege == 'employee') {
			$description = $input->post('description');
			$this->db->set('description', $description);
			$this->db->set('status', "checking");
			$this->db->where('employeeId', $this->getEmployeeID($dataToken->userId));
			$this->db->where('taskId', $taskId);
		} 
		elseif ($dataToken->privilege == 'manager') {
			$instruction = $input->post('instruction');
			$this->db->set('instruction', $instruction);
			$this->db->set('status', $input->post('status'));
			$this->db->where('employeeId', $input->post('employeeId'));
			$this->db->where('taskId', $taskId);
		}

		$this->db->update('employee_tasks');

		$affectedRows = $this->db->affected_rows();

		// update task document
		if (isset($_FILES['attachment_input'])) {
			for ($i=1; $i <= count($_FILES['attachment_input']['error']) ; $i++) { 
				if ($_FILES['attachment_input']['error'][$i] == 0) {
					$ext     = explode('.',$_FILES['attachment_input']['name'][$i]);
					$imageNm = uniqid().".".end($ext);

					move_uploaded_file($_FILES['attachment_input']['tmp_name'][$i], getTaskDocPath()['base'] . $imageNm);
					$this->db->set('taskId',$taskId);
					$this->db->set('file_name',$imageNm);
					$this->db->insert('employee_task_documents');
				}

				$affectedRows = $affectedRows+1;
			}
		}

		return [
			'code'    => $affectedRows > 0 ? 200  : 404,
			'status'  => $affectedRows > 0 ? true : false,
			'message' => $affectedRows > 0 ? "task successfully updated" : "nothing update",
		];

	}

	/**
	 * Delete Task
	 */
	public function deleteTask($input,$dataToken)
	{
		// get task documents
		$this->db->select('file_name');
		$this->db->where('taskId =', $input->get('taskId'));
        $query    = $this->db->get('employee_task_documents');
        $taskDocs = $query->result();

		// delete file in directory
		foreach ($taskDocs as $tD) {
			unlink(getTaskDocPath()['base'] . $tD->file_name);
		}

		// delete task
		$this->db->where('taskId =', $input->get('taskId'));
		$this->db->delete('employee_tasks');

		return [
			'code'    => 200,
			'status'  => true,
			'message' => "task successfully deleted",
		];
	}

	/**
	 * Delete Document
	 */
	public function deleteDoc($input,$dataToken)
	{
		// get file_name
		$this->db->select('file_name');
		$this->db->where('docId', $input->get('docId'));
		$query 	   = $this->db->get('employee_task_documents');
        $file_name = $query->first_row()->file_name;

		// delete in table
		$this->db->where('docId', $input->get('docId'));
		$this->db->delete('employee_task_documents');
		
		// delete file in directory
		unlink(getTaskDocPath()['base'] . $file_name);

		return [
			'code'    => 200,
			'status'  => true,
			'message' => "document successfully deleted",
		];
	}
}
