<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	function getAdmin($where)
	{
		return $this->db->get_where('admin', $where);
	}
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
