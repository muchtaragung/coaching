<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {

	public function allGoalsByID($id)
	{
		return $this->db->where('students_id', $id)->get('goals')->result();
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

}

/* End of file StudentModel.php */
/* Location: ./application/models/StudentModel.php */