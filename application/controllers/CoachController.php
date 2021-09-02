<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoachController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CoachModel');
		$this->load->library('form_validation');
		$this->load->library('pdf');
		date_default_timezone_set('Asia/Jakarta');
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
		$data['coachee'] = $this->CoachModel->getCoacheeByCompanyAndCoachID($CompanyID, $this->session->userdata('id'));
		$data['company_id'] = $CompanyID;
		$this->load->view('coach/coachee/list', $data, FALSE);
	}

	public function detailCoachee($coacheeID)
	{
		$data['page_name'] = 'Detail Coachee';
		$data['coachee'] = $this->CoachModel->getCoacheeByID($coacheeID);
		$data['company'] = $this->CoachModel->getCompanyByID($data['coachee']->company_id);
		// $data['session'] = $this->CoachModel->getSessionByCoacheeID($coacheeID);
		$data['history_penilaian'] = $this->CoachModel->getPenilaianByCoacheeID($coacheeID);
		$data['goals'] = $this->CoachModel->getGoalsByCoacheeID($coacheeID, 'array');

		foreach ($data['goals'] as $goal) {
			$data['history_milestone'][] = $this->CoachModel->getMilestoneByGoalID($goal['id']);
		}

		// var_dump($data);
		$this->load->view('coach/coachee/detail', $data);
	}

	public function addCoachee()
	{
		$id = $this->input->post('id');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[coachee.email]');
		$this->form_validation->set_error_delimiters('<span style="font-size: 10px;color:red">', '</span>');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Email sudah digunakan');
			redirect('coach/coachee/list/' . $id);
		} else {
			$coachee['name'] = $this->input->post('name');
			$coachee['email'] = $this->input->post('email');
			$coachee['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$coachee['coach_id'] = $this->session->userdata('id');
			$coachee['company_id'] = $this->input->post('company_id');

			$this->CoachModel->storeCoachee($coachee);
			$this->session->set_flashdata('add coach', 'berhasil');
			redirect('coach/coachee/list/' . $coachee['company_id']);
		}
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

	/**
	 * menampilkan data dari sesi 
	 * seperti penilaian dan juga untuk
	 * mencetak laporan coach
	 * 
	 * memiliki parameter id session
	 */
	public function showSessionData($sessionID, $coacheeID)
	{

		$data['page_name'] = 'Data Sesi';
		$data['session']   = $this->CoachModel->getSessionByID($sessionID);
		$data['penilaian'] = $this->CoachModel->getPenilaianBySessionID($sessionID);
		$data['report']    = $this->CoachModel->getReportBySessionID($sessionID);
		$data['coachee']   = $this->CoachModel->getCoacheeByID($data['session']->coachee_id);
		$data['goals']     = $this->CoachModel->getGoalsByCoacheeID($coacheeID);

		$this->load->view('coach/coachee/show_session', $data);
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

	public function cancelGoal($goalID)
	{
		$goal['status'] = 'belum selesai';
		$this->session->set_flashdata('goal', 'Berhasil Membatalkan status "Selesai" Goal');
		$this->CoachModel->cancelGoal($goalID, $goal);
		redirect('coach/coachee/goal/' . $goalID);
	}

	public function resetAction($actionID, $goalID)
	{
		$action['result'] = null;
		$this->session->set_flashdata('action', 'Berhasil Mereset Action');
		$this->CoachModel->resetAction($actionID, $action);
		redirect('coach/coachee/goal/' . $goalID);
	}

	/**
	 * Menggedit data action PLan
	 *
	 * @param [int] $actionID
	 * @return void
	 */
	public function editAction($actionID)
	{
		$data['action'] = $this->CoachModel->getActionByID($actionID);

		$this->load->view('coach/action/edit', $data);
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
		$this->CoachModel->updateAction($ActionID, $action);
		redirect('coach/coachee/goal/' . $goalID);
	}

	public function deleteAction($actionID, $goalID)
	{
		$this->session->set_flashdata('action', 'Berhasil Menghapus Action');
		$this->CoachModel->deleteAction($actionID);

		redirect('coachee/goal/' . $goalID);
	}

	public function addNotes()
	{
		$notes['comment']  = $this->input->post('comment');
		$notes['result']   = $this->input->post('result');
		$notes['goals_id'] = $this->input->post('goals_id');
		$this->CoachModel->saveGoalsNotes($notes);
		redirect('coach/coachee/goal/' . $notes['goals_id']);
	}

	public function deleteNotes($notesID, $goalID)
	{
		$this->session->set_flashdata('notes', 'Berhasil Menghapus Notes');
		$this->CoachModel->deleteNotes($notesID);
		redirect('coach/coachee/goal/' . $goalID);
	}

	public function editNotes($notesID)
	{
		$data['page_name'] = 'Edit Notes';
		$data['note']      = $this->CoachModel->getNotesByID($notesID);

		$this->load->view('coach/notes/edit', $data);
	}

	public function updateNotes()
	{
		$notes['comment'] = $this->input->post('comment');
		$notes['result']  = $this->input->post('result');

		$notesID = $this->input->post('id');
		$goalID  = $this->input->post('goals_id');

		$this->session->set_flashdata('notes', 'Notes Berhasil di ubah');
		$this->CoachModel->updateNotes($notesID, $notes);
		redirect('coach/coachee/goal/' . $goalID);
	}

	public function penilaianSesi($sessionID, $coacheeId)
	{
		$data['page_name'] = 'Penilaian Sesi';

		$coachID = $this->session->userdata('id');

		$data['session']         = $this->CoachModel->getSessionByID($sessionID);
		$data['coachee']         = $this->CoachModel->getCoacheeByID($coacheeId);
		$data['coach']           = $this->CoachModel->getCoachByID($coachID);



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

		$this->session->set_flashdata('penilaian', 'berhasil');
		$this->CoachModel->savePenilaian($penilaian);
		redirect('coach/coachee/session/show/' . $penilaian['session_id'] . '/' . $penilaian['coachee_id']);
	}

	public function addMilestone($goalID, $sessionID)
	{
		$data['page_name'] = 'Milestone';
		$data['goal'] = $this->CoachModel->goalByID($goalID);
		$data['coachee'] = $this->CoachModel->getCoacheeByID($data['goal']->coachee_id);
		$data['session'] = $this->CoachModel->getSessionByID($sessionID);

		// cek data milestone
		$where = ['goals_id' => $goalID, 'session_id' => $sessionID];
		$data['checkMilestone'] = $this->CoachModel->checkMilestone($where);


		$this->load->view('coach/milestone', $data);
	}

	public function saveMilestone()
	{

		$milestone['coach_id']    = $this->session->userdata('id');
		$milestone['coachee_id']  = $this->input->post('coachee_id');
		$milestone['session_id'] = $this->input->post('session_id');
		$milestone['goals_id']    = $this->input->post('goals_id');
		$milestone['milestone']   = $this->input->post('milestone');
		$milestone['keterangan']  = $this->input->post('keterangan');

		$this->CoachModel->saveMilestone($milestone);
		$this->session->set_flashdata('milestone', 'Berhasil Menambahkan Milestone');
		redirect('coach/coachee/session/milestone/detail/' . $milestone['goals_id'] . '/' . $milestone['session_id']);
	}

	public function detailMilestone($goalID, $sessionID)
	{
		$data['page_name']         = 'Detail Milestone';
		$data['goal']              = $this->CoachModel->goalByID($goalID);
		$data['session']           = $this->CoachModel->getSessionByID($sessionID);
		$data['history_milestone'] = $this->CoachModel->getMilestoneByGoalID($goalID);

		$where = ['goals_id' => $goalID, 'session_id' => $sessionID];
		$data['milestone']         = $this->CoachModel->getMilestoneWhere($where);

		// var_dump($data);
		$this->load->view('coach/milestone/detail', $data);
	}

	public function createReport($sessionID, $coacheeID)
	{
		$data['checkReport'] = $this->CoachModel->checkReport($sessionID);

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
			$where = ['session_id' => $data['session']->id, 'goals_id' => $data['goals'][$i]->id];
			$data['milestone'][$i] = $this->CoachModel->getMilestoneWhere($where);
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

		// var_dump($data);
		// var_dump($report);
		// die();
		$this->session->set_flashdata('report', 'berhasil');
		$this->CoachModel->saveReport($report);
		redirect('coach/coachee/session/show/' . $report['session_id'] . '/' . $coacheeID);
	}


	public function showReport($sessionID, $coacheeID)
	{
		$data['checkReport'] = $this->CoachModel->checkReport($sessionID);

		if ($data['checkReport'] == 0) {
			$this->session->set_flashdata('report', 'belum ada');
			redirect('coach/coachee/session/' . $coacheeID);
		}

		$report = $this->CoachModel->getReportBySessionID($sessionID);

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
		$file_name = 'Laporan Coaching-' . $data['coachee']['name'] . '-' .  $data['session']['start_time'];
		$this->pdf->load_view('laporan_coach', $data, $file_name);
	}

	//profile
	public function profile()
	{
		$data['page_name'] = 'Profile Coach';
		// $data['coachs']     = $this->AdminModel->getAllCoach();

		$this->load->view('coach/profile/profile', $data);
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
			$cek_password = $this->CoachModel->cek_password();

			if (password_verify($pass, $cek_password->password)) {
				$pb = password_hash($this->input->post('password_baru', true), PASSWORD_DEFAULT);
				$data = array(
					'password' => $pb,
				);
				$this->CoachModel->update_password($data, $id);
				$this->session->set_flashdata('pro', 'Password berhasil diubah.');
				redirect('coach/profile');
			} else {
				$this->session->set_flashdata('error', 'Password yang Anda masukan salah.');
				redirect('coach/profile');
			}
		}
	}
}

/* End of file CoachController.php */
/* Location: ./application/controllers/CoachController.php */
