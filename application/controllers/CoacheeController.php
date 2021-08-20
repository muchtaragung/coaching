<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoacheeController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CoacheeModel');
		if ($this->session->userdata('login') != 'coachee') {
			echo '<script>alert("Silahkan Login Untuk Mengakses Halaman ini")</script>';
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		$data['page_name'] = 'coachee dashboard';
		$data['sessions'] = $this->CoacheeModel->allSessionsByID($this->session->userdata('id'));
		$this->load->view('coachee/index', $data, FALSE);
	}

	public function allGoals()
	{
		$data['page_name'] = 'coachee dashboard';
		$data['goals'] = $this->CoacheeModel->allGoalsByID($this->session->userdata('id'));
		$this->load->view('coachee/goals', $data, FALSE);
	}

	public function addgoal()
	{
		$data['page_name'] = 'Goal Baru';
		$goal['goal'] = $this->input->post('goal');
		$goal['due_date'] = $this->input->post('due_date');
		$goal['coachee_id'] = $this->session->userdata('id');

		$this->CoacheeModel->storeGoal($goal);
		redirect('coachee/goals');
	}

	public function showGoal($id)
	{
		$data['page_name'] = 'Your Goals';
		$data['goal'] = $this->CoacheeModel->goalByID($id);
		$data['actions'] = $this->CoacheeModel->actionPlanByGoalID($id);

		$criteriaCheck = $this->CoacheeModel->checkCriteria($id);

		if ($criteriaCheck > 0) {
			$data['criteria'] = $this->CoacheeModel->getCriteria($id);
		}

		$this->load->view('coachee/show_goal', $data, FALSE);
	}

	public function addActionPlan()
	{
		$action_plan['action'] = $this->input->post('action');
		$action_plan['result']  = null;
		$action_plan['goals_id'] = $this->input->post('goals_id');

		$this->CoacheeModel->storeAction($action_plan);
		$this->session->set_flashdata('action_plan', 'Berhasil Menambahkan Action Plan');
		redirect('coachee/goal/' . $action_plan['goals_id'], 'refresh');
	}

	public function addCriteria()
	{
		$criteria['criteria'] = $this->input->post('criteria');
		$criteria['goals_id'] = $this->input->post('goals_id');

		$this->CoacheeModel->storeCriteria($criteria);
		$this->session->set_flashdata('criteria', 'Berhasil Menambahkan Success Criteria');
		redirect('coachee/goal/' . $criteria['goals_id'], 'refresh');
	}

	public function updateResult()
	{
		$id = $this->input->post('id');
		$goalsID = $this->input->post('goals_id');
		$action['result'] = $this->input->post('result');

		$this->CoacheeModel->saveResult($action, $id);
		redirect('coachee/goal/' . $goalsID, 'refresh');
	}
}

/* End of file CoacheeController.php */
/* Location: ./application/controllers/CoacheeController.php */
