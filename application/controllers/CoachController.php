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
		$data['companies'] = $this->CoachModel->getCompany();
		$this->load->view('coach/index', $data, FALSE);
	}

	public function showCoacheeByCompanyID($CompanyID)
	{
		$data['page_name'] = "Dashboard Coach";
		$data['coachee'] = $this->CoachModel->getCoacheeByCompanyID($CompanyID);
		$data['company_id'] = $CompanyID;
		$this->load->view('coach/coachee/list', $data, FALSE);
	}

	public function addCoachee()
	{
		$coachee['name'] = $this->input->post('name');
		$coachee['email'] = $this->input->post('email');
		$coachee['password'] = $this->input->post('password');
		$coachee['coach_id'] = $this->session->userdata('id');
		$coachee['company_id'] = $this->input->post('company_id');

		$this->CoachModel->storeCoachee($coachee);
		redirect('coach/coachee/list/' . $coachee['company_id']);
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

		$data['checkPenilaian']  = $this->CoachModel->checkPenilaianBySessionID($sessionID);
		$data['session']         = $this->CoachModel->getSessionByID($sessionID);
		$data['coachee']         = $this->CoachModel->getCoacheeByID($coacheeId);
		$data['coach']           = $this->CoachModel->getCoachByID($coachID);

		if ($data['checkPenilaian'] > 0) {
			$this->session->set_flashdata('penilaian', 'ada');
			redirect('coach/coachee/session/' . $coacheeId);
		}

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

	public function addMilestone($goalID)
	{
		$data['page_name'] = 'Milestone';
		$data['goal'] = $this->CoachModel->goalByID($goalID);
		$data['checkMilestone'] = $this->CoachModel->checkMilestone($goalID);

		$data['coachee'] = $this->CoachModel->getCoacheeByID($data['goal']->id);
		if ($data['checkMilestone'] > 0) {
			$this->session->set_flashdata('milestone', 'ada');
			redirect('coach/coachee/goal/' . $goalID);
		}
		$this->load->view('coach/milestone', $data);
	}

	public function saveMilestone()
	{
		$milestone['coach_id'] = $this->session->userdata('id');
		$milestone['coachee_id'] = $this->input->post('coachee_id');
		$milestone['goals_id'] = $this->input->post('goals_id');
		$milestone['milestone'] = $this->input->post('milestone');
		$milestone['keterangan'] = $this->input->post('keterangan');

		$this->CoachModel->saveMilestone($milestone);
		$this->session->set_flashdata('milestone', 'add');
		redirect('coach/coachee/goal/' . $milestone['goals_id']);
	}

	public function createReport($sessionID, $coacheeID)
	{
		$data['checkReport'] = $this->CoachModel->checkReport($sessionID);

		if ($data['checkReport'] > 0) {
			$this->session->set_flashdata('report', 'ada');
			redirect('coach/coachee/session/' . $coacheeID);
		}

		$data['session']    = $this->CoachModel->getSessionByID($sessionID);
		$data['penilaian_sesi']  = $this->CoachModel->getPenilaianBySessionID($sessionID);
		$data['coachee']    = $this->CoachModel->getCoacheeByID($coacheeID);
		$data['goals']      = $this->CoachModel->getGoalsByCoacheeID($coacheeID);
		$data['coach']      = $this->CoachModel->getCoachByID($this->session->userdata('id'));
		for ($i = 0; $i < count($data['goals']); $i++) {
			$data['action_plan'][$i] = $this->CoachModel->getActionByGoalsID($data['goals'][$i]->id);
		}
		for ($i = 0; $i < count($data['goals']); $i++) {
			$data['success_criteria'][$i] = $this->CoachModel->getCriteriaByGoalsID($data['goals'][$i]->id);
		}
		for ($i = 0; $i < count($data['goals']); $i++) {
			$data['notes'][$i] = $this->CoachModel->getNotesByGoalsID($data['goals'][$i]->id);
		}
		for ($i = 0; $i < count($data['goals']); $i++) {
			$data['milestone'][$i] = $this->CoachModel->getMilestoneByGoalsID($data['goals'][$i]->id);
		}

		$report['session'] = json_encode($data['session']);
		$report['penilaian_sesi'] = json_encode($data['penilaian_sesi']);
		$report['coach'] = json_encode($data['coach']);
		$report['coachee'] = json_encode($data['coachee']);
		$report['goals'] = json_encode($data['goals']);
		$report['action_plan'] = json_encode($data['action_plan']);
		$report['success_criteria'] = json_encode($data['success_criteria']);
		$report['notes'] = json_encode($data['notes']);
		$report['milestone'] = json_encode($data['milestone']);
		$report['session_id'] = $data['session']->id;

		$this->CoachModel->saveReport($report);
		return redirect('coach/coachee/session/' . $report['session_id']);
	}
}

/* End of file CoachController.php */
/* Location: ./application/controllers/CoachController.php */
