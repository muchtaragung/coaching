<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoachModel extends CI_Model {

	public function allStudents()
	{
		return $this->db->get('students')->result();
	}

	public function getCoaches()
	{
		return $this->db->get('coach')->result();
	}	

	public function storeStudent($student)
	{
		$this->db->insert('students', $student);
	}	
}

/* End of file CoachModel.php */
/* Location: ./application/models/CoachModel.php */