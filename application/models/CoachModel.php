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

	public function getStudentSession($studentID)
	{
		return $this->db->where('students_id', $studentID)->get('session')->result();
	}

	public function getTotalSession($studentID,$coachID)
	{
		$where = array(
			'students_id' => $studentID,
			'coach_id' => $coachID
		);

		return $this->db->where($where)->get('session')->num_rows();
	}

	public function newSession($session)
	{
		return $this->db->insert('session', $session);
	}
}

/* End of file CoachModel.php */
/* Location: ./application/models/CoachModel.php */
