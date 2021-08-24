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
		$this->load->library('pdf');
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

		$this->session->set_flashdata('goal', 'berhasil');
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
		$this->session->set_flashdata('action_plan', 'berhasil');
		redirect('coachee/goal/' . $action_plan['goals_id'], 'refresh');
	}

	public function addCriteria()
	{
		$criteria['criteria'] = $this->input->post('criteria');
		$criteria['goals_id'] = $this->input->post('goals_id');

		$this->CoacheeModel->storeCriteria($criteria);
		$this->session->set_flashdata('criteria', 'berhasil');
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

	public function endGoal($goalID)
	{
		$goal['status'] = 'selesai';

		$this->CoacheeModel->endGoal($goal, $goalID);
		redirect('coachee/goals/', 'refresh');
	}

	public function showReport($sessionID)
	{
		$data['checkReport'] = $this->CoacheeModel->checkReport($sessionID);

		if ($data['checkReport'] == 0) {
			$this->session->set_flashdata('report', 'belum ada');
			redirect('coachee');
		}

		$report = $this->CoacheeModel->getReportBySessionID($sessionID);

		$data['coach'] = json_decode($report[0]->coach, true);
		$data['coachee'] = json_decode($report[0]->coachee, true);
		$data['session'] = json_decode($report[0]->session, true);
		$data['penilaian_sesi'] = json_decode($report[0]->penilaian_sesi, true);
		$data['goals'] = json_decode($report[0]->goals, true);
		$data['success_criteria'] = json_decode($report[0]->success_criteria, true);
		$data['action_plan'] = json_decode($report[0]->action_plan, true);
		$data['notes'] = json_decode($report[0]->notes, true);
		$data['milestone'] = json_decode($report[0]->milestone, true);
		$data['session_id'] = json_decode($report[0]->session_id, true);

		// var_dump($data);
		// die();
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->load_view('laporan_coachee', $data, "laporan-coaching-" . $sessionID);
	}
}

/* End of file CoacheeController.php */
/* Location: ./application/controllers/CoacheeController.php */
