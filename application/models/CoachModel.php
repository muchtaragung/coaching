<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoachModel extends CI_Model
{

	public function allCoachee()
	{
		return $this->db->get('coachee')->result();
	}
	public function cek_password()
	{
		$hasil = $this->db->where('id', $this->session->userdata('id'))->get('coach');
		if ($hasil->num_rows() > 0) {
			return $hasil->row();
		} else {
			return array();
		}
	}
	public function update_password($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('coach', $data);
		return $this->db->affected_rows();
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

	public function getTotalSession($coacheeID, $coachID)
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

	public function startSession($sessionID, $session)
	{

		return $this->db->where('id', $sessionID)->update('session', $session);
	}

	public function endSession($sessionID, $session)
	{
		return $this->db->where('id', $sessionID)->update('session', $session);
	}

	public function getCoacheeName($coacheeID)
	{
		return $this->db->where('id', $coacheeID)->get('coachee')->row();
	}

	public function allGoalsByID($id)
	{
		return $this->db->where('coachee_id', $id)->get('goals')->result();
	}

	public function goalByID($id)
	{
		return $this->db->where('id', $id)->get('goals')->row();
	}

	public function actionPlanByGoalID($id)
	{
		return $this->db->where('goals_id', $id)->get('action_plan')->result();
	}

	public function getCriteria($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('criteria')->row();
	}

	public function getGoalsNotes($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('notes')->result();
	}

	public function saveGoalsNotes($notes)
	{
		return $this->db->insert('notes', $notes);
	}

	public function getSessionByID($sessionID)
	{
		return $this->db->where('id', $sessionID)->get('session')->row();
	}

	public function getCoacheeByID($coacheeID)
	{
		return $this->db->where('id', $coacheeID)->get('coachee')->row();
	}

	public function getCoachByID($coachID)
	{
		return $this->db->where('id', $coachID)->get('coach')->row();
	}

	public function savePenilaian($penilaian)
	{
		return $this->db->insert('penilaian_sesi', $penilaian);
	}

	public function checkPenilaianBySessionID($sessionID)
	{
		return $this->db->where('session_id', $sessionID)->get('penilaian_sesi')->num_rows();
	}

	public function saveMilestone($milestone)
	{
		return $this->db->insert('milestone', $milestone);
	}

	public function checkMilestone($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('milestone')->num_rows();
	}

	public function getCompany()
	{
		return $this->db->get('company')->result();
	}

	public function getCoacheeByCompanyID($CompanyID)
	{
		return $this->db->where('company_id', $CompanyID)->get('coachee')->result();
	}

	public function getCoacheeByCompanyAndCoachID($CompanyID,$coachID)
	{
		$where = array('company_id' => $CompanyID, 'coach_id' => $coachID);
		return $this->db->where($where)->get('coachee')->result();
	}

	
	public function getGoalsByCoacheeID($coacheeID)
	{
		return $this->db->where('coachee_id', $coacheeID)->get('goals')->result();
	}

	public function getActionByGoalsID($goalsID)
	{
		return $this->db->where('goals_id', $goalsID)->get('action_plan')->result();
	}

	public function getCriteriaByGoalsID($goalsID)
	{
		return $this->db->where('goals_id', $goalsID)->get('criteria')->result();
	}

	public function getNotesByGoalsID($goalsID)
	{
		return $this->db->where('goals_id', $goalsID)->get('notes')->result();
	}

	public function getMilestoneByGoalsID($goalsID)
	{
		return $this->db->where('goals_id', $goalsID)->get('milestone')->result();
	}

	public function getPenilaianBySessionID($sessionID)
	{
		return $this->db->where('session_id', $sessionID)->get('penilaian_sesi')->result();
	}

	public function saveReport($report)
	{
		return $this->db->insert('report', $report);
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

/* End of file CoachModel.php */
/* Location: ./application/models/CoachModel.php */
