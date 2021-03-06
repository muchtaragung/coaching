<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoacheeModel extends CI_Model
{

	public function getCoacheeByID($coacheeID)
	{
		return $this->db->where('id', $coacheeID)->get('coachee')->row();
	}

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

	/**
	 * mengambil data goal sesuai id
	 * parameter pertama id dari goal
	 */
	public function getGoalByID($goalID)
	{
		return $this->db->where('id', $goalID)->get('goals')->row();
	}

	/**
	 * mengupdate goal
	 * parameter pertama id goal
	 * parameter kedua data goal dalam bentuk array
	 */
	public function updateGoal($goalID, $goal)
	{
		return $this->db->where('id', $goalID)->update('goals', $goal);
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

	/**
	 * mengambil data action plan sesuai id
	 *
	 * @param [int] $actionID
	 * @return row()
	 */
	public function getActionByID($actionID)
	{
		return $this->db->where('id', $actionID)->get('action_plan')->row();
	}

	/**
	 * mengupdate action plan
	 *
	 * @param [int] $actionID
	 * @param [int] $action
	 * @return void
	 */
	public function updateAction($actionID, $action)
	{
		return $this->db->where('id', $actionID)->update('action_plan', $action);
	}

	/**
	 * mereset result dari action plan
	 * parameter pertama adalah id action plan
	 * parameter kedua adalah data result dalam betuk array
	 */
	public function resetAction($actionID, $action)
	{
		return $this->db->where('id', $actionID)->update('action_plan', $action);
	}

	/**
	 * menghapus action plan
	 * parameter pertama adalah id action plan
	 */
	public function deleteAction($actionID)
	{
		return $this->db->where('id', $actionID)->delete('action_plan');
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

	public function prework ($role)
	{
		$coach_id = $this->db->select('coach_id')
			->where('id', $this->session->userdata('id'))
			->get('coachee')->row()->coach_id;

		return $this->db->where_in('to', [$role, 'all'])
			->where('company_id', $this->session->userdata('company_id'))
			->get('prework')
			->result();
	}

	public function filePrework($id)
	{
		return $this->db->where('prework_id', $id)->get('file_upload')->result();
	}

	 
}

/* End of file CoacheeModel.php */
/* Location: ./application/models/CoacheeModel.php */
