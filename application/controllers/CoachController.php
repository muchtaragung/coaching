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
        $data['coachee'] = $this->CoachModel->allCoachee();
        $data['coaches'] = $this->CoachModel->getCoaches();
        $this->load->view('coach/index', $data, FALSE);
    }

    public function addCoachee()
    {
        $coachee['name'] = $this->input->post('name');
        $coachee['email'] = $this->input->post('email');
        $coachee['password'] = $this->input->post('password');
        $coachee['coach_id'] = $this->input->post('coach');

        $this->CoachModel->storeCoachee($coachee);
        redirect('coach');
    }

    public function showCoacheeSessions($coacheeID)
    {
        $data['sessions'] = $this->CoachModel->getCoacheeSession($coacheeID);
		$data['page_name'] = "Coachee Session";
		$data['coachee_id'] = $coacheeID;
        $this->load->view('coach/coachee_sessions', $data, FALSE);
	}

	public function addSession($coacheeID)
	{
		$coachID      = $this->session->userdata('id');
		$totalSession = $this->CoachModel->getTotalSession($coacheeID,$coachID);

		$sess['session']     = $totalSession + 1;
		$sess['coachee_id'] = $coacheeID;
		$sess['coach_id']    = $coachID;

		$this->CoachModel->newSession($sess);
		redirect('coach/coachee/session/'.$coacheeID);
	}

	public function startSession($sessionID,$coacheeID)
	{
		$sess['status'] = 'belum selesai';
		
		$this->CoachModel->startSession($sessionID,$sess);
		redirect('coach/coachee/session/'.$coacheeID);
	}

	public function endSession($sessionID,$coacheeID)
	{
		$sess['status'] = 'selesai';
		
		$this->CoachModel->endSession($sessionID,$sess);
		redirect('coach/coachee/session/'.$coacheeID);
	}

	public function showCoacheeGoals($coacheeID)
	{
		$data['page_name'] = 'coachee goals';
		$data['goals'] = $this->CoachModel->allGoalsByID($this->session->userdata('id'));
		$data['coachee'] = $this->CoachModel->getCoacheeName($data['goals'][0]->coachee_id);
		$this->load->view('coach/coachee_goals', $data, FALSE);
	}

	public function ShowCoacheGoal($goalID)
	{
		$data['page_name'] = 'Goal';
		$data['goal'] = $this->CoachModel->goalByID($goalID);
		$data['actions'] = $this->CoachModel->actionPlanByGoalID($goalID);
		$data['criteria'] = $this->CoachModel->getCriteria($goalID);


		$this->load->view('coach/coachee_goal', $data, FALSE);
	}
}

/* End of file CoachController.php */
/* Location: ./application/controllers/CoachController.php */
