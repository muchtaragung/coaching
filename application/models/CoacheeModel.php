<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoacheeModel extends CI_Model
{

	public function allGoalsByID($id)
	{
		return $this->db->where('coachee_id', $id)->get('goals')->result();
	}
	public function cek_password()
	{
		$hasil = $this->db->where('id', $this->session->userdata('id'))->get('coachee');
		if ($hasil->num_rows() > 0) {
			return $hasil->row();
		} else {
			return array();
		}
	}
	public function update_password($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('coachee', $data);
		return $this->db->affected_rows();
	}
	public function storeGoal($goal)
	{
		$this->db->insert('goals', $goal);
	}

	public function goalByID($id)
	{
		return $this->db->where('id', $id)->get('goals')->row();
	}

	public function actionPlanByGoalID($id)
	{
		return $this->db->where('goals_id', $id)->get('action_plan')->result();
	}

	public function storeAction($action_plan)
	{
		$this->db->insert('action_plan', $action_plan);
	}

	public function checkCriteria($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('criteria')->num_rows();
	}

	public function getCriteria($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('criteria')->row();
	}

	public function storeCriteria($criteria)
	{
		return $this->db->insert('criteria', $criteria);
	}

	public function updateCriteria($criteriaID, $criteria)
	{
		return $this->db->where('id', $criteriaID)->update('criteria', $criteria);
	}

	public function allSessionsByID($id)
	{
		return $this->db->where('coachee_id', $id)->get('session')->result();
	}

	public function saveResult($action_plan, $id)
	{
		return $this->db->where('id', $id)->update('action_plan', $action_plan);
	}

	public function endGoal($goal, $goalID)
	{
		return $this->db->where('id', $goalID)->update('goals', $goal);
	}

	public function checkReport($sessionID)
	{
		return $this->db->where('session_id', $sessionID)->get('report')->num_rows();
	}

	public function getReportBySessionID($sessionID)
	{
		return $this->db->where('session_id', $sessionID)->get('report')->result();
	}
}

/* End of file CoacheeModel.php */
/* Location: ./application/models/CoacheeModel.php */
