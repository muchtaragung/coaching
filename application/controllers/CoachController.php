<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoachController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CoachModel');
        if ($this->session->userdata('login') != 'coach') {
            echo '<script>alert("Silahkan Login Untuk Mengakses Halaman ini")</script>';
            redirect('login','refresh');
        }
    }

    public function index()
    {
        $data['page_name'] = "Dashboard Coach";
        $data['students'] = $this->CoachModel->allStudents();
        $data['coaches'] = $this->CoachModel->getCoaches();
        $this->load->view('coach/index', $data, FALSE);
    }

    public function addStudent()
    {
        $student['name'] = $this->input->post('name');
        $student['email'] = $this->input->post('email');
        $student['password'] = $this->input->post('password');
        $student['coach_id'] = $this->input->post('coach');

        $this->CoachModel->storeStudent($student);
        redirect('coach');
    }

    public function showStudentSessions($studentID)
    {
        $data['sessions'] = $this->CoachModel->getStudentSession($studentID);
		$data['page_name'] = "Student Session";
		$data['student_id'] = $studentID;
        $this->load->view('coach/student_sessions', $data, FALSE);
	}

	public function addSession($studentID)
	{
		$coachID      = $this->session->userdata('id');
		$totalSession = $this->CoachModel->getTotalSession($studentID,$coachID);

		$sess['session']     = $totalSession + 1;
		$sess['students_id'] = $studentID;
		$sess['coach_id']    = $coachID;

		$this->CoachModel->newSession($sess);
		redirect('coach/student/sessions'.$studentID);
	}

}

/* End of file CoachController.php */
/* Location: ./application/controllers/CoachController.php */
