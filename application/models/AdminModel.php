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
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
