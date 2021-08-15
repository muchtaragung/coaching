<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoachController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CoachModel');
    }
    public function index()
    {
        $data['page_name'] = "Dashboard Coach";
        $data['students'] = $this->CoachModel->allStudents();
        
        $this->load->view('coach/index', $data, FALSE);
    }

}

/* End of file CoachController.php */
/* Location: ./application/controllers/CoachController.php */