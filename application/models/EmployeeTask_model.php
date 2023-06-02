<?php

class EmployeeTask_model extends CI_Model 
{
	
	/**
	 * Get Task
	 */
	public function getListTask($dataToken)
	{
		$this->db->select('et.taskId,et.employeeId,et.title,et.status,et.created_at');
		$this->db->from('employee_tasks et');
		$this->db->join('employees e', 'e.employeeId = et.employeeId');
		
		if ($dataToken->privilege == 'employee') {
			$this->db->where('e.userId =', $dataToken->userId);
		} 
		elseif ($dataToken->privilege == 'manager') {
			$this->db->join('managers m', 'e.managerId = m.managerId');
			$this->db->where('m.userId =', $dataToken->userId);
		}

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
		$this->db->select('et.taskId,et.employeeId,et.title,et.description,et.status,et.created_at');
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
		$title       = $input->post('title');
		$description = $input->post('description');

		if ($dataToken->privilege == 'employee') {
			$this->db->set('employeeId', $this->getEmployeeID($dataToken->userId));
		}
		elseif ($dataToken->privilege == 'manager') {
			$this->db->set('employeeId', $this->post('employeeId'));
			$this->db->set('managerId', $this->getManagerId($dataToken->userId));
		}

		// insert task
		$this->db->set('title', $title);
		$this->db->set('description', $description);
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
		$description = $input->post('description');

		// update task
		$affectedRows = 0;
		$this->db->set('title', $title);
		$this->db->set('description', $description);

		if ($dataToken->privilege == 'employee') {
			$this->db->set('status', "checking");
			$this->db->where('taskId', $taskId);
			// $this->db->where('employeeId', $this->getEmployeeID($dataToken->userId));
		} 
		elseif ($dataToken->privilege == 'manager') {
			$this->db->set('status', $input->post('status'));
			$this->db->where('taskId', $taskId);
			$this->db->where('employeeId', $this->post('employeeId'));
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
}
