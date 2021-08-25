<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	/**
	 * mengambil seluruh data admin 
	 */
	public function getAdmin($where)
	{
		return $this->db->get_where('admin', $where);
	}

	public function cek_login_admin($username)
	{

		$hasil = $this->db->where('username', $username)->limit(1)->get('admin');
		if ($hasil->num_rows() > 0) {
			return $hasil->row();
		} else {
			return array();
		}
	}
	public function cek_password()
	{
		$hasil = $this->db->where('id', $this->session->userdata('id'))->get('admin');
		if ($hasil->num_rows() > 0) {
			return $hasil->row();
		} else {
			return array();
		}
	}
	public function update_password($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('admin', $data);
		return $this->db->affected_rows();
	}
	/**	
	 * mengambil seluruh data coach
	 * mengembalikan data dalam bentuk objek
	 */
	public function getAllCoach()
	{
		return $this->db->get('coach')->result();
	}

	/**
	 * menyimpan data coach
	 * memiliki parameter data coach yang akan dimasukan dalam bentuk array
	 */
	public function saveCoach($coach)
	{
		return $this->db->insert('coach', $coach);
	}

	/**
	 * menghapus data coach
	 * memiliki parameter id dari coach yang akan di hapus
	 */
	public function deleteCoach($id)
	{
		return $this->db->where('id', $id)->delete('coach');
	}

	/**
	 * mengambil data coach sesuai id
	 * memiliki parameter id dari coach yang akan di ambil
	 * mengembalikan data dalam bentuk object
	 */
	public function getCoachByID($id)
	{
		return $this->db->where('id', $id)->get('coach')->row();
	}

	/**
	 * mengupdate data coach
	 * parameter pertama id dari coach yang akan di update 
	 * parameter kedua adalah data coach yang akan di update dalam bentuk array
	 */
	public function updateCoach($id, $coach)
	{
		return $this->db->where('id', $id)->update('coach', $coach);
	}

	/**
	 * mengambil data perusahaan
	 * mengembalikan data dalam bentuk array dan object
	 */
	public function getAllCompany()
	{
		return $this->db->get('company')->result();
	}

	/**
	 * menyimpan data perusahaan
	 * memiliki parameter data yang akan dimasukan dalam bentuk array
	 */
	public function saveCompany($company)
	{
		return $this->db->insert('company', $company);
	}

	/**
	 * menghapus data perusahaan sesuai id
	 * memiliki parameter id perusahaan yang akan di hapus
	 */
	public function deleteCompany($id)
	{
		return $this->db->where('id', $id)->delete('company');
	}

	/** 
	 * mengambil data perusahaan sesuai id
	 * memiliki parameter id perusahaan yang akan di ambil
	 * mengembalikan nilai dalam bentuk object
	 */
	public function getCompanyByID($id)
	{
		return $this->db->where('id', $id)->get('company')->row();
	}

	/**
	 * mengupdate data Perusahaan
	 * parameter pertama adalah id dari perusahaan yang akan di update
	 * parameter kedua adalah data yang akan di update dalam bentuk array
	 */
	public function updateCompany($id, $company)
	{
		return $this->db->where('id', $id)->update('company', $company);
	}

	/**
	 * mengambil data peserta sesuai id Perusahaan
	 * memiliki parameter id perusahaan
	 */
	public function getCoacheeByCompanyID($companyID)
	{
		return $this->db->where('company_id', $companyID)->get('coachee')->result();
	}

	/**
	 * menyimpan data Peserta
	 * memiliki parameter data yang akan disimpan dalam bentuk array
	 */
	public function saveCoachee($coachee)
	{
		return $this->db->insert('coachee', $coachee);
	}

	/**
	 * menghapus data peserta
	 * memiliki parameter id dari peserta yang akan di hapus
	 */
	public function deleteCoachee($id)
	{
		return $this->db->where('id', $id)->delete('coachee');
	}

	/**	
	 * mengambil data peserta sesuai id
	 * memiliki parameter id dari peserta
	 * mengembalikan nilai dalam bentuk object
	 */
	public function getCoacheeByID($id)
	{
		return $this->db->where('id', $id)->get('coachee')->row();
	}

	/**
	 * mengupdate data Peserta
	 * parameter pertama id peserta yang akan di hapus
	 * parameter kedua data peserta dalam bentuk array
	 */
	public function updateCoachee($id, $coachee)
	{
		return $this->db->where('id', $id)->update('coachee', $coachee);
	}

	/**
	 * mengambil data goal sesuai id peserta
	 * parameter pertama id peserta
	 */
	public function getGoalByCoacheeID($coacheeID)
	{
		return $this->db->where('coachee_id', $coacheeID)->get('goals')->result();
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
	 * menghapus goal 
	 * parameter pertama id dari goal
	 */
	public function deleteGoal($goalID)
	{
		return $this->db->where('id', $goalID)->delete('goals');
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

	/**	
	 * mengambil criteria sesuai goal_id
	 * parameter pertama id goal
	 * mengembalikan data dalam bentuk object
	 */
	public function getCriteriaByGoalID($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('criteria')->row();
	}

	/**
	 * menyimpan criteria
	 * parameter satu adalah data dari criteria dalam bentuk array
	 */
	public function saveCriteria($criteria)
	{
		return $this->db->insert('criteria', $criteria);
	}

	/**
	 * mengupdate criteria
	 * parameter pertama adalah id criteria
	 * parameter kedua adalah data yang akan di update dalam bentuk array
	 */
	public function updateCriteria($criteriaId, $criteria)
	{
		return $this->db->where('id', $criteriaId)->update('criteria', $criteria);
	}

	/**
	 * menghapus criteria
	 * parameter pertama adalah id criteria yang akan di hapus
	 */
	public function deleteCriteria($criteriaId)
	{
		return $this->db->where('id', $criteriaId)->delete('criteria');
	}

	/**
	 * mengambil action_plan sesuai goal
	 * parameter pertama adalah id goal
	 * mengembalikan data dalam bentuk array dan object
	 */
	public function getActionByGoalID($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('action_plan')->result();
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

	/**
	 * mengambil notes (komentar, result) sesuai goal
	 * parameter kedua adalah id goal
	 */
	public function getNotesByGoalsID($goalID)
	{
		return $this->db->where('goals_id', $goalID)->get('notes')->result();
	}

	/**
	 * menghapus notes berdasarkan id
	 * parameter pertama adalah id notes 
	 */
	public function deleteNotes($notesID)
	{
		return $this->db->where('id',$notesID)->delete('notes');
	}

	/**
	 * mengambil data notes sesuai id
	 * parameter pertama adalah notes id
	 * mengembalikan data dalam bentuk object
	 */
	public function getNotesByID($notesID)
	{
		return $this->db->where('id',$notesID)->get('notes')->row();
	}

	/**
	 * mengupdate notes bedrasarkan notes id
	 * parameter pertama adalah notes id 
	 * parameter kedua data yang akan di masukkan dalam bentuk array
	 */
	public function updateNotes($notesID, $notes)
	{
		return $this->db->where('id', $notesID)->update('notes', $notes);
	}

	/**
	 * mengambill session bedrasarkan coachee id
	 * parameter pertama adalah coachee id 
	 * mengembalikan data dalam bentuk array dan object
	 */
	public function getSessionByCoacheeID($coacheeID)
	{
		return $this->db->where('coachee_id', $coacheeID)->get('session')->result();
	}
	
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
