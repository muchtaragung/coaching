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

	public function addgoal()
	{
		$data['page_name'] = 'Goal Baru';
		$goal['goal'] = $this->input->post('goal');
		$goal['due_date'] = $this->input->post('due_date');
		$goal['students_id'] = $this->input->post('students_id');

		$this->StudentModel->storeGoal($goal);
		redirect('student');
	}

	public function showGoal($id)
	{
		$data['page_name'] = 'Your Goals';
		$data['goal'] = $this->StudentModel->goalByID($id);
		$data['actions'] = $this->StudentModel->actionPlanByGoalID($id);

		$criteriaCheck = $this->StudentModel->checkCriteria($id);

		if($criteriaCheck > 0)
		{
			$data['criteria'] = $this->StudentModel->getCriteria($id);
		}

		$this->load->view('student/show_goal', $data, FALSE);
	}

	public function addActionPlan()
	{
		$action_plan['action'] = $this->input->post('action');
		$action_plan['nilai']  = 0;
		$action_plan['goals_id'] = $this->input->post('goals_id');

		$this->StudentModel->storeAction($action_plan);
		redirect('student/goal/'.$action_plan['goals_id']);
	}

	public function addCriteria()
	{
		$criteria['criteria'] = $this->input->post('criteria');
		$criteria['goals_id'] = $this->input->post('goals_id');
	
		$this->StudentModel->storeCriteria($criteria);
		redirect('student/goal/'.$criteria['goals_id']);
	}
}

/* End of file StudentController.php */
/* Location: ./application/controllers/StudentController.php */