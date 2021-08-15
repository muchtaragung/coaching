<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoachModel extends CI_Model {

	public function allStudents()
	{
		return $this->db->get('students')->result();
	}	

}

/* End of file CoachModel.php */
/* Location: ./application/models/CoachModel.php */