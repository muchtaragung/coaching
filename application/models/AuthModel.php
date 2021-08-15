<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	
	function getCoach($where)
    {
        return $this->db->get_where('coach',$where);
    }
    
    function getStudent($where)
    {
        return $this->db->get_where('students',$where);
    }
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */