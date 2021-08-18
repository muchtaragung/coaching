<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoachModel extends CI_Model {

	public function allCoachee()
	{
		return $this->db->get('coachee')->result();
	}

	public function getCoaches()
	{
		return $this->db->get('coach')->result();
	}	

	public function storeCoachee($coachee)
	{
		$this->db->insert('coachee', $coachee);
	}

	public function getCoacheeSession($coacheeID)
	{
		return $this->db->where('coachee_id', $coacheeID)->get('session')->result();
	}

	public function getTotalSession($coacheeID,$coachID)
	{
		$where = array(
			'coachee_id' => $coacheeID,
			'coach_id' => $coachID
		);

		return $this->db->where($where)->get('session')->num_rows();
	}

	public function newSession($session)
	{
		return $this->db->insert('session', $session);
	}

	public function startSession($sessionID,$session)
	{
		
		return $this->db->where('id',$sessionID)->update('session', $session);
	}

	public function endSession($sessionID,$session)
	{
		return $this->db->where('id',$sessionID)->update('session', $session);
	}

	public function getCoacheeName($coacheeID)
	{
		return $this->db->where('id' , $coacheeID)->get('coachee')->row();
	}

	public function allGoalsByID($id)
	{
		return $this->db->where('coachee_id', $id)->get('goals')->result();
	}
}

/* End of file CoachModel.php */
/* Location: ./application/models/CoachModel.php */
