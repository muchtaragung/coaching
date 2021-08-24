<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	public function getAdmin($where)
	{
		return $this->db->get_where('admin', $where);
	}

	public function getAllCoach()
	{
		return $this->db->get('coach')->result();
	}

	public function saveCoach($coach)
	{
		return $this->db->insert('coach', $coach);
	}

	public function deleteCoach($id)
	{
		return $this->db->where('id', $id)->delete('coach');
	}

	public function getCoachByID($id)
	{
		return $this->db->where('id', $id)->get('coach')->row();
	}

	public function updateCoach($id, $coach)
	{
		return $this->db->where('id', $id)->update('coach', $coach);
	}

	public function getAllCompany()
	{
		return $this->db->get('company')->result();
	}

	public function saveCompany($company)
	{
		return $this->db->insert('company', $company);
	}

	public function deleteCompany($id)
	{
		return $this->db->where('id', $id)->delete('company');
	}

	public function getCompanyByID($id)
	{
		return $this->db->where('id', $id)->get('company')->row();
	}

	public function updateCompany($id, $company)
	{
		return $this->db->where('id', $id)->update('company', $company);
	}

	public function getCoacheeByCompanyID($companyID)
	{
		return $this->db->where('company_id', $companyID)->get('coachee')->result();
	}

	public function saveCoachee($coachee)
	{
		return $this->db->insert('coachee', $coachee);
	}

	public function deleteCoachee($id)
	{
		return $this->db->where('id', $id)->delete('coachee');
	}

	public function getCoacheeByID($id)
	{
		return $this->db->where('id', $id)->get('coachee')->row();
	}

	public function updateCoachee($id, $coachee)
	{
		return $this->db->where('id', $id)->update('coachee', $coachee);
	}

	public function getGoalByCoacheeID($coacheeID)
	{
		return $this->db->where('coachee_id', $coacheeID)->get('goals')->result();
	}

	public function getGoalByID($goalID)
	{
		return $this->db->where('id', $goalID)->get('goals')->row();
	}

	public function deleteGoal($goalID)
	{
		return $this->db->where('id', $goalID)->delete('goals');
	}

	public function updateGoal($goalID, $goal)
	{
		return $this->db->where('id', $goalID)->update('goals', $goal);
	}

	public function getCriteriaByGoalID($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('criteria')->row();
	}

	public function getActionByGoalID($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('action_plan')->result();
	}

	public function getNotesByGoalsID($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('notes')->result();
	}

	public function saveCriteria($criteria)
	{
		return $this->db->insert('criteria',$criteria);
	}

	public function updateCriteria($criteriaId,$criteria)
	{
		return $this->db->where('id', $criteriaId)->update('criteria',$criteria);
	}

	public function deleteCriteria($criteriaId)
	{
		return $this->db->where('id', $criteriaId)->delete('criteria');
	}

	public function resetAction($actionID,$action)
	{
		return $this->db->where('id', $actionID)->update('action_plan',$action);
	}

	public function deleteAction($actionID)
	{
		return $this->db->where('id', $actionID)->delete('action_plan');
	}
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
