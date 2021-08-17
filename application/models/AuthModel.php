<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	
	function getCoach($where)
    {
        return $this->db->get_where('coach',$where);
    }
    
    function getCoachee($where)
    {
        return $this->db->get_where('coachee',$where);
    }
}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
