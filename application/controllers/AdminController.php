<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class AdminController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->model('CoachModel');
		$this->load->library('pdf');
		$this->load->library('form_validation');
	}

	/**
	 * mengecek kondisi login admin
	 *
	 * @return void
	 */
	public function checkAuth()
	{
		if ($this->session->userdata('login') != 'admin') {
			echo '<script>alert("Silahkan Login Untuk Mengakses Halaman ini")</script>';
			redirect('admin/login', 'refresh');
		}
	}

	/**
	 * fungsi untuk login
	 * @return void
	 */
	public function login()
	{
		$data['page_name'] = "Admin Login";

		$this->load->view('admin/login', $data);
	}

	/**
	 * Fungsi untuk autententikasi login admin
	 *
	 * @return void
	 */
	public function auth()
	{
		$username = htmlspecialchars($this->input->post('username'));
		$pass = htmlspecialchars($this->input->post('password'));
		$cek_login = $this->AdminModel->cek_login_admin($username);
		if ($cek_login == FALSE) {
			$this->session->set_flashdata('login failed', 'Username yang Anda masukan tidak terdaftar.');
			redirect('admin/login', 'refresh');
		} else {
			if (password_verify($pass, $cek_login->password)) {
				$this->session->set_userdata('id', $cek_login->id);
				$this->session->set_userdata('username', $cek_login->username);
				$this->session->set_userdata('login', 'admin');
				$this->session->set_userdata('name', 'admin');
				redirect('admin', 'refresh');
			} else {
				$this->session->set_flashdata('login failed', 'Username Atau Password Salah');
				redirect('admin/login', 'refresh');
			}
		}
	}

	/**
	 * menampilkan dashboard untuk admin
	 * menampilkan data jumlah dari company, coach, dan coachee
	 *
	 * @return void
	 */
	public function index()
	{
		$this->checkAuth();
		$data['page_name'] = "Admin Dashboard";

		$data['company'] = $this->AdminModel->getNumCompany();
		$data['coach'] = $this->AdminModel->getNumCoach();
		$data['coachee'] = $this->AdminModel->getNumCoachee();

		$this->load->view('admin/index.php', $data, FALSE);
	}

	/**
	 * menampilkan list dari coach
	 *
	 * @return void
	 */
	public function coachList()
	{
		$this->checkAuth();
		$data['page_name'] = 'Coach List';
		$data['coachs']     = $this->AdminModel->getAllCoach();

		$this->load->view('admin/coach/list', $data);
	}

	/**
	 * fungsi untuk menambahkan coach
	 * form nya ada di halaman list coachee
	 *
	 * @return void
	 */
	public function addCoach()
	{
		$this->checkAuth();

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[coach.email]');
		$this->form_validation->set_error_delimiters('<span style="font-size: 10px;color:red">', '</span>');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Email sudah digunakan');
			redirect('admin/coach/list', 'refresh');
		} else {
			$this->checkAuth();
			$coach['name'] = $this->input->post('name');
			$coach['email'] = $this->input->post('email');
			$coach['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

			$this->session->set_flashdata('coach', 'Berhasil Menambahkan Coach');
			$this->AdminModel->saveCoach($coach);
			redirect('admin/coach/list', 'refresh');
		}
	}

	/**
	 * fungsi untuk menghapus coach
	 *
	 * @param [int] $id dari coach
	 * @return void
	 */
	public function deleteCoach($id)
	{
		$this->checkAuth();
		$this->session->set_flashdata('coach', 'Berhasil Menghapus Coach');
		$this->AdminModel->deleteCoach($id);
		redirect('admin/coach/list', 'refresh');
	}

	/**
	 * mengambil data coach untuk di edit
	 *
	 * @param [int] $id dari coach
	 * @return void
	 */
	public function editCoach($id)
	{
		$this->checkAuth();
		$data['page_name'] = 'Edit Coach';
		$data['coach'] = $this->AdminModel->getCoachByID($id);

		$this->load->view('admin/coach/edit', $data);
	}

	/**
	 * mengupdate data coach dari 
	 *
	 * @return void
	 */
	public function updateCoach()
	{
		$this->checkAuth();
		$id                = $this->input->post('id');
		$coach['name']     = $this->input->post('name');
		$coach['email']    = $this->input->post('email');
		if ($this->input->post('password') == null) {
			$coach['password'] = $this->input->post('old_password');
		} else {
			$coach['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		}

		$this->session->set_flashdata('coach', 'Berhasil Mengubah Data Coach');
		$this->AdminModel->updateCoach($id, $coach);
		return redirect('admin/coach/list', 'refresh');
	}

	/**
	 * mengampilkan list perusahan
	 *
	 * @return void
	 */
	public function companyList()
	{
		$this->checkAuth();
		$data['page_name'] = 'Company List';
		$data['companies'] = $this->AdminModel->getAllCompany();

		$this->load->view('admin/company/list', $data);
	}

	public function saveCompany()
	{
		$this->checkAuth();
		$company['name'] = $this->input->post('name');

		$this->session->set_flashdata('company', 'Berhasil Menyimpan Data Perusahaan');
		$this->AdminModel->saveCompany($company);

		echo true;
	}

	public function deleteCompany($id)
	{
		$this->checkAuth();
		// mengambil data yang di perlukan
		$data['company'] = $this->AdminModel->getCompanyByID($id);
		$data['coachee'] = $this->AdminModel->getCoacheeByCompanyID($data['company']->id);

		foreach ($data['coachee'] as $coachee) {
			$data['goals']   = $this->AdminModel->getGoalByCoacheeID($coachee->id);
			$data['sessions']  = $this->AdminModel->getSessionByCoacheeID($coachee->id);

			$this->AdminModel->deleteCoachee($coachee->id);
			// perulangan untuk menghapus semua goals dan turunannya
			foreach ($data['goals'] as $goal) {
				$this->AdminModel->deleteGoal($goal->id);
				$this->AdminModel->deleteCriteriaByGoalID($goal->id);
				$this->AdminModel->deleteActionByGoalId($goal->id);
				$this->AdminModel->deleteNotesByGoalID($goal->id);
				$this->AdminModel->deleteMilestoneByGoalID($goal->id);
			}

			// perulangan untuk mengahpus semua sesi dan turunannya
			foreach ($data['sessions'] as $sesi) {
				$this->AdminModel->deleteSession($sesi->id);
				$this->AdminModel->deletePenilaianBySessionID($sesi->id);
				$this->AdminModel->deleteReportBySessionID($sesi->id);
			}
		}

		$this->session->set_flashdata('company', 'Berhasil Menghapus Data Perusahaan');

		$this->AdminModel->deleteCompany($id);
		redirect('admin/company/list', 'refresh');
	}

	public function editCompany($id)
	{
		$this->checkAuth();
		$data['page_name'] = 'Edit Company';
		$data['company'] = $this->AdminModel->getCompanyByID($id);

		$this->load->view('admin/company/edit', $data);
	}

	public function updateCompany()
	{
		$this->checkAuth();
		$id                = $this->input->post('id');
		$company['name']     = $this->input->post('name');

		$this->session->set_flashdata('company', 'Berhasil Mengubah Data Perusahaan');
		$this->AdminModel->updateCompany($id, $company);
		return redirect('admin/company/list', 'refresh');
	}

	public function coacheeList($companyID)
	{
		$this->checkAuth();
		$data['page_name'] = 'coachee List';
		$data['coachees']  = $this->AdminModel->getCoacheeByCompanyID($companyID);
		$data['company']   = $this->AdminModel->getCompanyByID($companyID);
		$data['companies'] = $this->AdminModel->getAllCompany();

		
		$data['coaches']   = $this->AdminModel->getAllCoach($companyID);
		$data['coachKorpora']   = $this->AdminModel->getAllCoach();
		$this->load->view('admin/coachee/list', $data);
	}

	public function detailCoachee($coacheeID)
	{
		$data['page_name'] = 'Detail Coachee';
		$data['coachee'] = $this->AdminModel->getCoacheeByID($coacheeID);
		$data['company'] = $this->AdminModel->getCompanyByID($data['coachee']->company_id);
		// $data['session'] = $this->AdminModel->getSessionByCoacheeID($coacheeID);
		$data['history_penilaian'] = $this->AdminModel->getPenilaianByCoacheeID($coacheeID);
		$data['goals'] = $this->AdminModel->getGoalsByCoacheeID($coacheeID, 'array');

		foreach ($data['goals'] as $goal) {
			$data['history_milestone'][] = $this->AdminModel->getMilestoneByGoalID($goal['id']);
		}

		// var_dump($data);
		$this->load->view('admin/coachee/detail', $data);
	}

	public function saveCoachee()
	{
		$this->checkAuth();
		$id = $this->input->post('id');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[coachee.email]');
		$this->form_validation->set_error_delimiters('<span style="font-size: 10px;color:red">', '</span>');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Email sudah digunakan');
			redirect('admin/coachee/list/' . $id, 'refresh');
		} else {
			$this->checkAuth();
			$coachee['name']       = $this->input->post('name');
			$coachee['email']      = $this->input->post('email');
			$coachee['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$coachee['company_id'] = $this->input->post('id');
			$coachee['coach_id']   = $this->input->post('manager_coach_id');
			$coachee['role'] = 'staff';

			if($this->input->post('level') == 'manager'){
				$coachee['role'] = 'manager';
				$coachee['coach_id']   = $this->input->post('coach_id');
				$coach['name']       = $this->input->post('name');
				$coach['email']      = $this->input->post('email');
				$coach['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				$coach['company_id'] = $this->input->post('id');
				$this->AdminModel->saveCoach($coach);
			}

			$this->session->set_flashdata('coachee', 'Berhasil menambah peserta');
			$this->AdminModel->saveCoachee($coachee);
			redirect('admin/coachee/list/' . $coachee['company_id'], 'refresh');
		}
	}

	public function deleteCoachee($id)
	{
		$this->checkAuth();
		// mengambil data yang di perlukan
		$data['coachee'] = $this->AdminModel->getcoacheeByID($id);
		$data['goals']   = $this->AdminModel->getGoalByCoacheeID($id);
		$data['sessions']  = $this->AdminModel->getSessionByCoacheeID($id);

		$this->session->set_flashdata('coachee', 'Berhasil Menghapus Data Coachee');

		$this->AdminModel->deletecoachee($id);

		// perulangan untuk menghapus semua goals dan turunannya
		foreach ($data['goals'] as $goal) {
			$this->AdminModel->deleteGoal($goal->id);
			$this->AdminModel->deleteCriteriaByGoalID($goal->id);
			$this->AdminModel->deleteActionByGoalId($goal->id);
			$this->AdminModel->deleteNotesByGoalID($goal->id);
			$this->AdminModel->deleteMilestoneByGoalID($goal->id);
		}

		// perulangan untuk mengahpus semua sesi dan turunannya
		foreach ($data['sessions'] as $sesi) {
			$this->AdminModel->deleteSession($sesi->id);
			$this->AdminModel->deletePenilaianBySessionID($sesi->id);
			$this->AdminModel->deleteReportBySessionID($sesi->id);
		}

		redirect('admin/coachee/list/' . $data['coachee']->company_id, 'refresh');
	}

	public function editCoachee($id)
	{
		$this->checkAuth();
		$data['page_name'] = 'Edit coachee';
		$data['coachee'] = $this->AdminModel->getcoacheeByID($id);
		$data['companies'] = $this->AdminModel->getAllCompany();
		$data['coaches']   = $this->AdminModel->getAllCoach();

		$this->load->view('admin/coachee/edit', $data);
	}

	public function updateCoachee()
	{
		$this->checkAuth();
		$id                    = $this->input->post('id');
		$coachee['name']       = $this->input->post('name');
		$coachee['email']      = $this->input->post('email');
		if ($this->input->post('password') == null) {
			$coachee['password'] = $this->input->post('old_password');
		} else {
			$coachee['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		}
		$coachee['company_id'] = $this->input->post('company_id');
		$coachee['coach_id']   = $this->input->post('coach_id');

		$this->session->set_flashdata('coachee', 'Berhasil Mengubah Data Coachee');
		$this->AdminModel->updatecoachee($id, $coachee);
		return redirect('admin/coachee/list/' . $coachee['company_id'], 'refresh');
	}

	public function goalList($coacheeID)
	{
		$this->checkAuth();
		$data['page_name'] = 'Goal List';
		$data['coachee'] = $this->AdminModel->getcoacheeByID($coacheeID);
		$data['goals']   = $this->AdminModel->getGoalByCoacheeID($coacheeID);

		$this->load->view('admin/goal/list', $data);
	}

	public function deleteGoal($goalID)
	{
		$this->checkAuth();
		$data['goal']    = $this->AdminModel->getGoalByID($goalID);
		$data['coachee'] = $this->AdminModel->getCoacheeByID($data['goal']->coachee_id);

		$this->session->set_flashdata('goal', 'Berhasil Menghapus Goal');

		$this->AdminModel->deleteGoal($goalID);
		$this->AdminModel->deleteCriteriaByGoalID($goalID);
		$this->AdminModel->deleteActionByGoalId($goalID);
		$this->AdminModel->deleteNotesByGoalID($goalID);
		$this->AdminModel->deleteMilestoneByGoalID($goalID);

		redirect('admin/coachee/goal/list/' . $data['coachee']->id, 'refresh');
	}

	public function editGoal($goalID)
	{
		$this->checkAuth();
		$data['page_name'] = 'Edit Goal';
		$data['goal']      = $this->AdminModel->getGoalByID($goalID);

		$this->load->view('admin/goal/edit', $data);
	}

	public function updateGoal()
	{
		$this->checkAuth();
		$goalID           = $this->input->post('id');
		$coacheeID        = $this->input->post('coachee_id');
		$goal['goal']     = $this->input->post('goal');
		$goal['due_date'] = $this->input->post('due_date');
		$goal['status']   = $this->input->post('status');

		$this->session->set_flashdata('goal', 'Berhasil Mengupdate Goal');
		$this->AdminModel->updateGoal($goalID, $goal);
		redirect('admin/coachee/goal/list/' . $coacheeID, 'refresh');
	}

	public function showGoal($goalID)
	{
		$this->checkAuth();
		$data['page_name']   = 'Showing Goals';
		$data['goal']        = $this->AdminModel->getGoalByID($goalID);
		$data['criteria']    = $this->AdminModel->getCriteriaByGoalID($goalID);
		$data['actions']     = $this->AdminModel->getActionByGoalID($goalID);
		$data['notes']       = $this->AdminModel->getNotesByGoalsID($goalID);
		$this->load->view('admin/goal/show', $data);
	}

	public function saveCriteria()
	{
		$this->checkAuth();
		$criteria['criteria'] = $this->input->post('criteria');
		$criteria['goals_id']  = $this->input->post('goals_id');

		$this->session->set_flashdata('criteria', 'Berhasil Menyimpan Criteria');
		$this->AdminModel->saveCriteria($criteria);
		redirect('admin/coachee/goal/show/' . $criteria['goals_id'], 'refresh');
	}

	public function updateCriteria()
	{
		$this->checkAuth();
		$criteriaID = $this->input->post('id');
		$goalID     = $this->input->post('goals_id');
		$criteria['criteria'] = $this->input->post('criteria');

		$this->session->set_flashdata('criteria', 'Berhasil Mengupdate Criteria');
		$this->AdminModel->updateCriteria($criteriaID, $criteria);
		redirect('admin/coachee/goal/show/' . $goalID, 'refresh');
	}

	public function deleteCriteria($criteriaID, $goalID)
	{
		$this->checkAuth();
		$this->session->set_flashdata('criteria', 'Berhasil Menghapus Criteria');
		$this->AdminModel->deleteCriteria($criteriaID);
		redirect('admin/coachee/goal/show/' . $goalID, 'refresh');
	}

	public function resetAction($actionID, $goalID)
	{
		$this->checkAuth();
		$action['result'] = null;
		$this->session->set_flashdata('action', 'Berhasil Mereset Action');
		$this->AdminModel->resetAction($actionID, $action);
		redirect('admin/coachee/goal/show/' . $goalID, 'refresh');
	}

	/**
	 * Menggedit data action PLan
	 *
	 * @param [int] $actionID
	 * @return void
	 */
	public function editAction($actionID)
	{
		$this->checkAuth();
		$data['action'] = $this->AdminModel->getActionByID($actionID);

		$this->load->view('admin/action/edit', $data);
	}

	/**
	 * mengupdate data aksi
	 *
	 * @return void
	 */
	public function updateAction()
	{
		$this->checkAuth();

		$ActionID = $this->input->post('id');
		$goalID   = $this->input->post('goal_id');

		$action['action'] = $this->input->post('action');
		$action['result'] = $this->input->post('result');
		$action['keterangan'] = $this->input->post('keterangan');

		$this->session->set_flashdata('action', 'Action Plan Berhasil Di Hapus');
		$this->AdminModel->updateAction($ActionID, $action);
		redirect('admin/coachee/goal/show/' . $goalID, 'refresh');
	}

	public function deleteAction($actionID, $goalID)
	{
		$this->checkAuth();
		$this->session->set_flashdata('action', 'Berhasil Menghapus Action');
		$this->AdminModel->deleteAction($actionID);

		redirect('admin/coacshee/goal/show/' . $goalID, 'refresh');
	}

	public function deleteNotes($notesID, $goalID)
	{
		$this->checkAuth();
		$this->session->set_flashdata('notes', 'Berhasil Menghapus Notes');
		$this->AdminModel->deleteNotes($notesID);
		redirect('admin/coachee/goal/show/' . $goalID, 'refresh');
	}

	public function editNotes($notesID)
	{
		$this->checkAuth();
		$data['page_name'] = 'Edit Notes';
		$data['note']      = $this->AdminModel->getNotesByID($notesID);

		$this->load->view('admin/notes/edit', $data);
	}

	public function updateNotes()
	{
		$this->checkAuth();
		$notes['comment'] = $this->input->post('comment');
		$notes['result']  = $this->input->post('result');

		$notesID = $this->input->post('id');
		$goalID  = $this->input->post('goals_id');

		$this->session->set_flashdata('notes', 'Notes Berhasil di ubah');
		$this->AdminModel->updateNotes($notesID, $notes);
		redirect('admin/coachee/goal/show/' . $goalID, 'refresh');
	}

	public function showMilestone($goalID)
	{
		$this->checkAuth();
		$data['page_name'] = 'Milestone';
		$data['milestone'] = $this->AdminModel->getMilestoneGoalID($goalID);
		$data['goal']      = $this->AdminModel->getGoalByID($data['milestone']->goals_id);

		$this->load->view('admin/milestone/show', $data);
	}

	public function detailMilestone($goalID)
	{
		$this->checkAuth();
		$data['page_name']         = 'Detail Milestone';
		$data['goal']              = $this->AdminModel->getGoalByID($goalID);
		// $data['session']           = $this->AdminModel->getSessionByID($sessionID);
		$data['history_milestone'] = $this->AdminModel->getMilestoneByGoalID($goalID);

		// var_dump($data);
		$this->load->view('admin/milestone/detail', $data);
	}

	public function deleteMilestone($milestoneID, $goalID)
	{
		$this->checkAuth();
		$this->session->set_flashdata('milestone', 'Milestone Berhasil Dihapus');
		$this->AdminModel->deleteMilestone($milestoneID);
		redirect('admin/coachee/milestone/show/' . $goalID, 'refresh');
	}

	public function editMilestone($milestoneID)
	{
		$this->checkAuth();
		$data['page_name'] = 'edit milestone';
		$data['milestone'] = $this->AdminModel->getMilestoneByID($milestoneID);

		// var_dump($data);
		$this->load->view('admin/milestone/edit', $data);
	}

	public function updateMilestone()
	{
		$this->checkAuth();
		$milestoneID = $this->input->post('milestone_id');
		$goalID = $this->input->post('goals_id');
		$milestone['milestone'] = $this->input->post('milestone');
		$milestone['keterangan'] = $this->input->post('keterangan');

		$this->session->set_flashdata('milestone', 'Berhasil Mengupdate Milestone');
		$this->AdminModel->updateMilestone($milestoneID, $milestone);
		redirect('admin/coachee/milestone/detail/' . $goalID, 'refresh');
	}

	public function sessionList($coacheeID)
	{
		$this->checkAuth();
		$data['page_name'] = 'Sesi Peserta';
		$data['sessions']  = $this->AdminModel->getSessionByCoacheeID($coacheeID);

		$this->load->view('admin/session/list', $data);
	}

	public function editSession($sessionID)
	{
		$this->checkAuth();
		$data['page_name'] = 'Edit Sesi';

		$data['session'] = $this->AdminModel->getSessionByID($sessionID);
		$this->load->view('admin/session/edit', $data);
	}

	public function updateSession()
	{
		$this->checkAuth();

		$session['session'] = $this->input->post('session');
		$session['status']  = $this->input->post('status');
		$id = $this->input->post('id');
		$coachee_id = $this->input->post('coachee_id');

		$this->AdminModel->updateSession($session, $id);
		redirect('admin/coachee/session/list/' . $coachee_id);
	}

	public function deleteSession($sessionID, $coacheeID)
	{
		$this->checkAuth();
		$this->AdminModel->getSessionByID($sessionID);

		$this->session->set_flashdata('session', 'Di Hapus');
		$this->AdminModel->deleteSession($sessionID);
		redirect('admin/coachee/session/list/' . $coacheeID, 'refresh');
	}

	public function showSessionData($sessionID)
	{
		$this->checkAuth();
		$data['page_name'] = 'Data Sesi';
		$data['session']  = $this->AdminModel->getSessionByID($sessionID);
		$data['penilaian'] = $this->AdminModel->getPenilaianBySessionID($sessionID);
		$data['report']    = $this->AdminModel->getReportBySessionID($sessionID);
		$data['coachee']   = $this->AdminModel->getCoacheeByID($data['session']->coachee_id);

		$this->load->view('admin/session/show', $data);
	}

	/**
	 * menghapus report
	 */
	public function deleteReport($reportID, $sessionID)
	{
		$this->checkAuth();
		$this->session->set_flashdata('report', 'Laporan Berhasil Di Hapus');
		$this->AdminModel->deleteReport($reportID);
		redirect('admin/coachee/session/show/' . $sessionID, 'refresh');
	}

	/**
	 * menghapus penilaian
	 */
	public function deletePenilaian($id, $sessionID)
	{
		$this->session->set_flashdata('penilaian', 'Penilaian Berhasil Di Hapus');
		$this->AdminModel->deletePenilaian($id);
		redirect('admin/coachee/session/show/' . $sessionID, 'refresh');
	}

	public function showReport($sessionID)
	{
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

	public function report_csv($sessionID)
	{
		$report = $this->CoachModel->getReportBySessionID($sessionID);

		$coach = json_decode($report[0]->coach, true);
		$coachee = json_decode($report[0]->coachee, true);
		$company = $this->db->where('id', $coachee['company_id'])->get('company')->row_array();
		$session = json_decode($report[0]->session, true);
		$penilaian_sesi = json_decode($report[0]->penilaian_sesi, true);
		$goals = json_decode($report[0]->goals, true);
		$success_criteria = json_decode($report[0]->success_criteria, true);
		$action_plan = json_decode($report[0]->action_plan, true);
		$notes = json_decode($report[0]->notes, true);
		$milestone = json_decode($report[0]->milestone, true);
		$session_id = json_decode($report[0]->session_id, true);

		// var_dump($data);
		// die();

		// buat object spreadseet
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// bagian nama coachee
		$sheet->setCellValue('A2', 'Nama Coachee');
		$sheet->setCellValue('B2', $coachee['name']);
		$sheet->setCellValue('A3', 'Email Coachee');
		$sheet->setCellValue('B3', $coachee['email']);
		$sheet->setCellValue('A4', "Perusahaan");
		$sheet->setCellValue('B4', $company['name']);

		// bagian coach
		$sheet->setCellValue('A6', 'Nama Coach');
		$sheet->setCellValue('B6', $coach['name']);
		$sheet->setCellValue('A7', 'Email Coach');
		$sheet->setCellValue('B7', $coach['email']);

		// bagian sesi
		$sheet->setCellValue('A9', 'Sesi Ke');
		$sheet->setCellValue('B9', $session['session']);
		$sheet->setCellValue('A10', 'Waktu Mulai');
		$sheet->setCellValue('B10', $session['start_time']);
		$sheet->setCellValue('A11', 'Waktu Selesai');
		$sheet->setCellValue('B11', $session['end_time']);

		// bagian penilaian
		$sheet->setCellValue('A13', 'Komunikasi Dan Respon');
		$sheet->setCellValue('B13', $penilaian_sesi['komunikasi']);
		$sheet->setCellValue('A14', 'Kehadiran Tiap Sesi');
		$sheet->setCellValue('B14', $penilaian_sesi['kehadiran']);
		$sheet->setCellValue('A15', 'Effort Proses Coaching');
		$sheet->setCellValue('B15', $penilaian_sesi['effort']);
		$sheet->setCellValue('A16', 'Komitment Melakukan Action Plan');
		$sheet->setCellValue('B16', $penilaian_sesi['komitment']);
		if (isset($penilaian_sesi['keterangan'])) {
			$sheet->setCellValue('A17', 'Rangkuman Penilaian');
			$sheet->setCellValue('B17', $penilaian_sesi['keterangan']);
		}

		$row = 19;

		// bagian goals
		for ($i = 0; $i < count($goals); $i++) {
			// goals
			$sheet->setCellValue('A' . $row, 'Goal');
			$sheet->setCellValue('B' . $row, $goals[$i]['goal']);
			$row += 1;
			$sheet->setCellValue('A' . $row, 'Due Date');
			$sheet->setCellValue('B' . $row, $goals[$i]['due_date']);
			$row += 1;
			$sheet->setCellValue('A' . $row, 'Status Goal');
			$sheet->setCellValue('B' . $row, $goals[$i]['status']);
			$row += 1;
			$sheet->setCellValue('A' . $row, 'Success Criteria');
			if (isset($success_criteria[$i][0])) { // pengecekan status criteria
				$sheet->setCellValue('B' . $row, $success_criteria[$i][0]['criteria']);
			}
			$row += 2;
			$sheet->setCellValue('A' . $row, 'Action Plan');
			$sheet->setCellValue('B' . $row, 'Result');
			$sheet->setCellValue('C' . $row, 'Keterangan');
			$row += 1;
			// Bagian Action Plan
			if (isset($action_plan[$i])) {
				for ($j = 0; $j < count($action_plan[$i]); $j++) {
					$sheet->setCellValue('A' . $row, $action_plan[$i][$j]['action']);
					$sheet->setCellValue('B' . $row, $action_plan[$i][$j]['result']);
					$sheet->setCellValue('C' . $row, $action_plan[$i][$j]['keterangan']);
					$row += 1;
				}
			}
			// Bagian notes
			$row += 1;
			$sheet->setCellValue('A' . $row, 'Komentar');
			$sheet->setCellValue('B' . $row, 'Result');
			$row += 1;
			if (isset($notes[$i])) {
				for ($j = 0; $j < count($notes[$i]); $j++) {
					$sheet->setCellValue('A' . $row, $notes[$i][$j]['comment']);
					$sheet->setCellValue('B' . $row, $notes[$i][$j]['result']);
					$row += 1;
				}
			}

			// bagian Milestone dan Keterangan
			$row += 1;
			$sheet->setCellValue('A' . $row, 'Milestone');
			$sheet->setCellValue('B' . $row, $milestone[$i][0]['milestone']);
			$row += 1;
			$sheet->setCellValue('A' . $row, 'Keterangan');
			$sheet->setCellValue('B' . $row, $milestone[$i][0]['keterangan']);
			$row = $row + 2;
		}

		// set locale untuk filename dan waktu
		setlocale(LC_TIME, 'id_ID');
		date_default_timezone_set("Asia/Jakarta");

		$filename = $coachee['name'] . '-' . 'Sesi ' . $session['session'] . '-' . date('d M Y H:i:s') . '.csv';
		$foldername = 'csv' . DIRECTORY_SEPARATOR . $coach['name'] . DIRECTORY_SEPARATOR . $company['name'];

		mkdir(FCPATH . $foldername, 0755, true);
		$writer = new Csv($spreadsheet);
		$writer->save(FCPATH . $foldername . DIRECTORY_SEPARATOR . $filename);
		redirect($foldername . DIRECTORY_SEPARATOR . $filename);
	}

	//profile
	public function profile()
	{
		$this->checkAuth();
		$data['page_name'] = 'Profile Admin';
		$data['coachs']    = $this->AdminModel->getAllCoach();

		$this->load->view('admin/profile/profile', $data);
	}
	public function update_password()
	{
		$this->checkAuth();
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
			$cek_password = $this->AdminModel->cek_password();

			if (password_verify($pass, $cek_password->password)) {
				$pb = password_hash($this->input->post('password_baru', true), PASSWORD_DEFAULT);
				$data = array(
					'password' => $pb,
				);
				$this->AdminModel->update_password($data, $id);
				$this->session->set_flashdata('pro', 'Password berhasil diubah.');
				redirect('admin/profile', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Password yang Anda masukan salah.');
				redirect('admin/profile', 'refresh');
			}
		}
	}

	public function csvAddCoachee()
	{
		$file = $_FILES['csv']['tmp_name'];

		// Medapatkan ekstensi file csv yang akan diimport.
		$ekstensi  = explode('.', $_FILES['csv']['name']);

		// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
		if (empty($file)) {
			echo 'File tidak boleh kosong!';
		} else {
			// Validasi apakah file yang diupload benar-benar file csv.
			if (strtolower(end($ekstensi)) === 'csv' && $_FILES["csv"]["size"] > 0) {

				$i = 0;
				$handle = fopen($file, "r");
				while (($row = fgetcsv($handle, 2048))) {
					$i++;
					if ($i == 1) continue;

					// Data yang akan disimpan ke dalam databse
					$coachee['name'] = $row[1];
					$coachee['email'] = $row[2];
					$coachee['password'] = password_hash($row[3], PASSWORD_DEFAULT);
					$coachee['coach_id'] =  $row[4];
					$coachee['company_id'] = $this->input->post('company_id');

					// Simpan data ke database.
					$this->AdminModel->saveCoachee($coachee);
				}

				fclose($handle);
				$this->session->set_flashdata('coachee', 'Berhasil Menyimpan Data Coachee');
				redirect('admin/coachee/list/' . $coachee['company_id'], 'refresh');
			} else {
				echo 'Format file tidak valid!';
			}
		}
	}

	function preworkStore(){
		$path = "./assets/uploads/";
		$this->load->model('Prework');

		$prework['name'] = $this->input->post('name');
		$prework['company_id'] = $this->input->post('company_id');
		$prework['to'] = $this->input->post('to');
		$prework['user_id'] = $this->session->userdata('id');

		$prework = $this->Prework->insert_id($prework);

        $data = [];
   
		$count = count($_FILES['files']['name']);
		
		for($i=0;$i<$count;$i++){
		
			if(!empty($_FILES['files']['name'][$i])){
		
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
		
				$config['upload_path'] = $path; 
				$config['allowed_types'] = 'jpg|jpeg|png|gif|mp4|3gp|pdf|xls|csv';
				$config['max_size'] = '10000';
				$config['encrypt_name'] = TRUE; 
		
				$this->load->library('upload', $config); 
			
				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$data['totalFiles'][] = $filename;

					$file_upload['path'] = $path . $filename ;
					$file_upload['extension'] = pathinfo($filename, PATHINFO_EXTENSION);
					$file_upload['created_at'] = date('Y-m-d h:i:s');
					$file_upload['prework_id'] = $prework;

					$this->load->model('file_upload');
					$this->file_upload->insert($file_upload);
				}
			}
	
		}
		$this->session->set_flashdata('success', "Berhasil menambahkan materi ke coachee");
		echo true;
	}

	public function list_tugas_by_company($companyId)
	{	
		$data['users'] = $this->db
			->select('tugas.id, coachee.name, coachee.email, tugas.user_id, coachee.coach_id')
			->where('coachee.company_id', $companyId)
			->join('tugas', 'coachee.id = tugas.user_id')
			->get('coachee')
			->result();

		$this->load->view('admin/list_tugas', $data);
	}

	public function list_file($tugasId)
	{	
		$data['files'] = $this->db->join('file_upload', 'tugas.id = file_upload.prework_id',)
			->where('tugas.id', $tugasId)
			->get('tugas')
			->result();


		$this->load->view('admin/list_file', $data);
	}	
}
