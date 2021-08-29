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

	public function updateCriteria()
	{
		$criteria['criteria'] = $this->input->post('criteria');
		$id = $this->input->post('criteria_id');
		$goalID = $this->input->post('goals_id');

		$this->session->set_flashdata('criteria', 'update');
		$this->CoacheeModel->updateCriteria($id, $criteria);
		redirect('coachee/goal/' . $goalID, 'refresh');
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

	public function resetAction($actionID, $goalID)
	{
		$action['result'] = null;
		$this->session->set_flashdata('action', 'Berhasil Mereset Action');
		$this->CoacheeModel->resetAction($actionID, $action);
		redirect('coachee/goal/' . $goalID);
	}

	/**
	 * Menggedit data action PLan
	 *
	 * @param [int] $actionID
	 * @return void
	 */
	public function editAction($actionID)
	{
		$data['action'] = $this->CoacheeModel->getActionByID($actionID);

		$this->load->view('coachee/edit-action', $data);
	}

	/**
	 * mengupdate data aksi
	 *
	 * @return void
	 */
	public function updateAction()
	{
		$ActionID = $this->input->post('id');
		$goalID   = $this->input->post('goal_id');

		$action['action'] = $this->input->post('action');
		$action['result'] = $this->input->post('result');

		$this->session->set_flashdata('action', 'Action Plan Berhasil Di Hapus');
		$this->CoacheeModel->updateAction($ActionID, $action);
		redirect('coachee/goal/' . $goalID);
	}

	public function deleteAction($actionID, $goalID)
	{
		$this->session->set_flashdata('action', 'Berhasil Menghapus Action');
		$this->CoacheeModel->deleteAction($actionID);

		redirect('coachee/goal/' . $goalID);
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
		$file_name = 'Laporan Coaching-' . $data['session']->tanggal_mulai . '-' . $data['coachee']->name;
		$this->pdf->load_view('laporan_coachee', $data, $file_name);
	}

	//profile
	public function profile()
	{
		$data['page_name'] = 'Profile Coachee';
		// $data['coachs']     = $this->AdminModel->getAllCoach();

		$this->load->view('coachee/profile/profile', $data);
	}
	public function update_password()
	{
		$this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Password tidak boleh kosong!'));
		$this->form_validation->set_rules('password_baru', 'Password', 'required', array('required' => 'Password tidak boleh kosong!'));
		$this->form_validation->set_rules('repassword', 'Password', 'required|matches[password_baru]', array(
			'required' => 'Password tidak boleh kosong!',
			'matches'     => 'Password tidak sama'
		));
		$this->form_validation->set_error_delimiters('<span style="font-size: 10px;color:red">', '</span>');
		if ($this->form_validation->run() == FALSE) {
			$this->profile();
		} else {
			$pass = htmlspecialchars($this->input->post('password', true));
			$id = $this->session->userdata('id');
			$cek_password = $this->CoacheeModel->cek_password();

			if (password_verify($pass, $cek_password->password)) {
				$pb = password_hash($this->input->post('password_baru', true), PASSWORD_DEFAULT);
				$data = array(
					'password' => $pb,
				);
				$this->CoacheeModel->update_password($data, $id);
				$this->session->set_flashdata('pro', 'Password berhasil diubah.');
				redirect('coachee/profile');
			} else {
				$this->session->set_flashdata('error', 'Password yang Anda masukan salah.');
				redirect('coachee/profile');
			}
		}
	}
}

/* End of file CoacheeController.php */
/* Location: ./application/controllers/CoacheeController.php */
