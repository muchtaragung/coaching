<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoachController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CoachModel');
		if ($this->session->userdata('login') != 'coach') {
			echo '<script>alert("Silahkan Login Untuk Mengakses Halaman ini")</script>';
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		$data['page_name'] = "Dashboard Coach";
		$data['coachee'] = $this->CoachModel->allCoachee();
		$data['coaches'] = $this->CoachModel->getCoaches();
		$this->load->view('coach/index', $data, FALSE);
	}

	public function addCoachee()
	{
		$coachee['name'] = $this->input->post('name');
		$coachee['email'] = $this->input->post('email');
		$coachee['password'] = $this->input->post('password');
		$coachee['coach_id'] = $this->session->userdata('id');

		$this->CoachModel->storeCoachee($coachee);
		redirect('coach');
	}

	public function showCoacheeSessions($coacheeID)
	{
		$data['sessions'] = $this->CoachModel->getCoacheeSession($coacheeID);
		$data['page_name'] = "Coachee Session";
		$data['coachee_id'] = $coacheeID;
		$this->load->view('coach/coachee/sessions', $data, FALSE);
	}

	public function addSession($coacheeID)
	{
		$coachID      = $this->session->userdata('id');
		$totalSession = $this->CoachModel->getTotalSession($coacheeID, $coachID);

		$sess['session']     = $totalSession + 1;
		$sess['coachee_id']  = $coacheeID;
		$sess['coach_id']    = $coachID;
		$sess['status']      = 'belum mulai';

		$this->CoachModel->newSession($sess);
		redirect('coach/coachee/session/' . $coacheeID);
	}

	public function startSession($sessionID, $coacheeID)
	{
		$sess['status'] = 'belum selesai';
		$sess['start_time'] = date('Y-m-d H:i:s');
		$this->CoachModel->startSession($sessionID, $sess);
		redirect('coach/coachee/session/' . $coacheeID);
	}

	public function endSession($sessionID, $coacheeID)
	{
		$sess['status'] = 'selesai';
		$sess['end_time'] = date('Y-m-d H:i:s');

		$this->CoachModel->endSession($sessionID, $sess);
		redirect('coach/coachee/session/' . $coacheeID);
	}

	public function showCoacheeGoals($coacheeID)
	{
		$data['page_name'] = 'coachee goals';
		$data['goals'] = $this->CoachModel->allGoalsByID($coacheeID);
		$data['coachee'] = $this->CoachModel->getCoacheeName($coacheeID);
		$this->load->view('coach/coachee/goals', $data, FALSE);
	}

	public function ShowCoacheGoal($goalID)
	{
		$data['page_name'] = 'Goal';
		$data['goal']      = $this->CoachModel->goalByID($goalID);
		$data['actions']   = $this->CoachModel->actionPlanByGoalID($goalID);
		$data['criteria']  = $this->CoachModel->getCriteria($goalID);
		$data['notes']     = $this->CoachModel->getGoalsNotes($data['goal']->id);

		$this->load->view('coach/coachee/goal', $data, FALSE);
	}

	public function addNotes()
	{
		$notes['comment']  = $this->input->post('comment');
		$notes['result']   = $this->input->post('result');
		$notes['goals_id'] = $this->input->post('goals_id');
		$this->CoachModel->saveGoalsNotes($notes);
		redirect('coach/coachee/goal/' . $notes['goals_id']);
	}

	public function penilaianSesi($sessionID, $coacheeId)
	{
		$coachID = $this->session->userdata('id');

		$data['session'] = $this->CoachModel->getSessionByID($sessionID);
		$data['coachee'] = $this->CoachModel->getCoacheeByID($coacheeId);
		$data['coach']   = $this->CoachModel->getCoachByID($coachID);

		var_dump($data);
		$this->load->view('coach/penilaian', $data, FALSE);
	}

	public function savePenilaian()
	{
		$penilaian['coach_id']   = $this->session->userdata['id'];
		$penilaian['coachee_id'] = $this->input->post('coachee_id');
		$penilaian['session_id'] = $this->input->post('session_id');
		$penilaian['komunikasi'] = $this->input->post('komunikasi');
		$penilaian['kehadiran']  = $this->input->post('kehadiran');
		$penilaian['effort']     = $this->input->post('effort');
		$penilaian['komitment']  = $this->input->post('komitment');

		$this->session->set_flashdata('penilaian', 'save');
		$this->CoachModel->savePenilaian($penilaian);
		redirect('coach/coachee/session/' . $penilaian['coachee_id']);
	}
}

/* End of file CoachController.php */
/* Location: ./application/controllers/CoachController.php */
