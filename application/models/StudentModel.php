<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {

	public function allGoalsByID($id)
	{
		return $this->db->where('students_id', $id)->get('goals')->result();
	}

}

/* End of file StudentModel.php */
/* Location: ./application/models/StudentModel.php */