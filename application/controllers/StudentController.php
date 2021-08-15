<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('StudentModel');
		if ($this->session->userdata('login') != 'student') {
            echo '<script>alert("Silahkan Login Untuk Mengakses Halaman ini")</script>';
            redirect('login','refresh');
        }
	}

	public function index()
	{
		$data['page_name'] = 'student dashboard';
		$data['goals'] = $this->StudentModel->allGoalsByID($this->session->userdata('id'));
		$this->load->view('student/index', $data, FALSE);
	}

}

/* End of file StudentController.php */
/* Location: ./application/controllers/StudentController.php */