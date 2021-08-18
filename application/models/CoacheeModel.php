<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoacheeModel extends CI_Model {

	public function allGoalsByID($id)
	{
		return $this->db->where('coachee_id', $id)->get('goals')->result();
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

	public function allSessionsByID($id)
	{
		return $this->db->where('coachee_id', $id)->get('session')->result();
	}
}

/* End of file CoacheeModel.php */
/* Location: ./application/models/CoacheeModel.php */
