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
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
