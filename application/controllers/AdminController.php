<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
	}

	public function checkAuth()
	{
		if ($this->session->userdata('login') != 'admin') {
			echo '<script>alert("Silahkan Login Untuk Mengakses Halaman ini")</script>';
			redirect('admin/login', 'refresh');
		}
	}

	public function login()
	{
		$data['page_name'] = "Admin Login";
		$this->load->view('admin/login', $data);
	}

	public function auth()
	{
		$username = htmlspecialchars($this->input->post('username'));
		$pass = htmlspecialchars($this->input->post('password'));
		$cek_login = $this->AdminModel->cek_login_admin($username);
		if ($cek_login == FALSE) {
			$this->session->set_flashdata('login failed', 'Username yang Anda masukan tidak terdaftar.');
			redirect('admin/login');
		} else {
			if (password_verify($pass, $cek_login->password)) {
				$this->session->set_userdata('id', $cek_login->id);
				$this->session->set_userdata('username', $cek_login->username);
				$this->session->set_userdata('login', 'admin');
				$this->session->set_userdata('name', 'admin');
				redirect('admin');
			} else {
				$this->session->set_flashdata('login failed', 'Username Atau Password Salah');
				redirect('admin/login');
			}
		}
	}

	public function index()
	{
		$this->checkAuth();
		$data['page_name'] = "Admin Dashboard";

		$this->load->view('admin/index.php', $data, FALSE);
	}

	public function coachList()
	{
		$this->checkAuth();
		$data['page_name'] = 'Coach List';
		$data['coachs']     = $this->AdminModel->getAllCoach();

		$this->load->view('admin/coach/list', $data);
	}

	public function addCoach()
	{
		$this->checkAuth();
		$coach['name'] = $this->input->post('name');
		$coach['email'] = $this->input->post('email');
		$coach['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$this->AdminModel->saveCoach($coach);
		redirect('admin/coach/list');
	}

	public function deleteCoach($id)
	{
		$this->AdminModel->deleteCoach($id);
		redirect('admin/coach/list');
	}

	public function editCoach($id)
	{
		$data['page_name'] = 'Edit Coach';
		$data['coach'] = $this->AdminModel->getCoachByID($id);

		$this->load->view('admin/coach/edit', $data);
	}

	public function updateCoach()
	{
		$id                = $this->input->post('id');
		$coach['name']     = $this->input->post('name');
		$coach['email']    = $this->input->post('email');
		$coach['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$this->AdminModel->updateCoach($id, $coach);
		return redirect('admin/coach/list');
	}


	public function companyList()
	{
		$data['page_name'] = 'Company List';
		$data['companies'] = $this->AdminModel->getAllCompany();

		$this->load->view('admin/company/list', $data);
	}

	public function saveCompany()
	{
		$company['name'] = $this->input->post('name');

		$this->session->set_flashdata('company', 'save');

		$this->AdminModel->saveCompany($company);
		redirect('admin/company/list');
	}

	public function deleteCompany($id)
	{
		$this->session->set_flashdata('company', 'delete');

		$this->AdminModel->deleteCompany($id);
		redirect('admin/company/list');
	}

	public function editCompany($id)
	{
		$data['page_name'] = 'Edit Company';
		$data['company'] = $this->AdminModel->getCompanyByID($id);

		$this->load->view('admin/company/edit', $data);
	}

	public function updateCompany()
	{
		$id                = $this->input->post('id');
		$company['name']     = $this->input->post('name');

		$this->session->set_flashdata('company', 'update');

		$this->AdminModel->updateCompany($id, $company);
		return redirect('admin/company/list');
	}

	public function coacheeList($companyID)
	{
		$this->checkAuth();
		$data['page_name'] = 'coachee List';
		$data['coachees']  = $this->AdminModel->getCoacheeByCompanyID($companyID);
		$data['company']   = $this->AdminModel->getCompanyByID($companyID);
		$data['companies'] = $this->AdminModel->getAllCompany();
		$data['coaches']   = $this->AdminModel->getAllCoach();

		$this->load->view('admin/coachee/list', $data);
	}

	public function saveCoachee()
	{
		$this->checkAuth();
		$coachee['name']       = $this->input->post('name');
		$coachee['email']      = $this->input->post('email');
		$coachee['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$coachee['company_id'] = $this->input->post('company_id');
		$coachee['coach_id']   = $this->input->post('coach_id');

		$this->AdminModel->saveCoachee($coachee);
		redirect('admin/coachee/list/' . $coachee['company_id']);
	}

	public function deleteCoachee($id)
	{
		$data['coachee'] = $this->AdminModel->getcoacheeByID($id);
		$this->AdminModel->deletecoachee($id);
		redirect('admin/coachee/list/' . $data['coachee']->company_id);
	}

	public function editCoachee($id)
	{
		$data['page_name'] = 'Edit coachee';
		$data['coachee'] = $this->AdminModel->getcoacheeByID($id);
		$data['companies'] = $this->AdminModel->getAllCompany();
		$data['coaches']   = $this->AdminModel->getAllCoach();

		$this->load->view('admin/coachee/edit', $data);
	}

	public function updateCoachee()
	{
		$id                    = $this->input->post('id');
		$coachee['name']       = $this->input->post('name');
		$coachee['email']      = $this->input->post('email');
		$coachee['password']   = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$coachee['company_id'] = $this->input->post('company_id');
		$coachee['coach_id']   = $this->input->post('coach_id');

		$this->AdminModel->updatecoachee($id, $coachee);
		return redirect('admin/coachee/list/' . $coachee['company_id']);
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
		$data['goal']    = $this->AdminModel->getGoalByID($goalID);
		$data['coachee'] = $this->AdminModel->getCoacheeByID($data['goal']->coachee_id);

		$this->session->set_flashdata('company', 'delete');
		$this->AdminModel->deleteGoal($goalID);
		redirect('admin/coachee/goal/list/' . $data['coachee']->id);
	}

	public function editGoal($goalID)
	{
		$data['page_name'] = 'Edit Goal';
		$data['goal']      = $this->AdminModel->getGoalByID($goalID);

		$this->load->view('admin/goal/edit', $data);
	}

	public function updateGoal()
	{
		$goalID           = $this->input->post('id');
		$coacheeID        = $this->input->post('coachee_id');
		$goal['goal']     = $this->input->post('goal');
		$goal['due_date'] = $this->input->post('due_date');
		$goal['status']   = $this->input->post('status');

		$this->session->set_flashdata('goal', 'update');
		$this->AdminModel->updateGoal($goalID, $goal);
		redirect('admin/coachee/goal/list/' . $coacheeID);
	}

	public function showGoal($goalID)
	{
		$data['page_name']   = 'Showing Goals';
		$data['goal']        = $this->AdminModel->getGoalByID($goalID);
		$data['criteria']    = $this->AdminModel->getCriteriaByGoalID($goalID);
		$data['actions']     = $this->AdminModel->getActionByGoalID($goalID);
		$data['notes']       = $this->AdminModel->getNotesByGoalsID($goalID);
		$this->load->view('admin/goal/show', $data);
	}

	public function saveCriteria()
	{
		$criteria['criteria'] = $this->input->post('criteria');
		$criteria['goals_id']  = $this->input->post('goals_id');

		$this->session->set_flashdata('criteria', 'Berhasil Menyimpan Criteria');
		$this->AdminModel->saveCriteria($criteria);
		redirect('admin/coachee/goal/show/' . $criteria['goals_id']);
	}

	public function updateCriteria()
	{
		$criteriaID = $this->input->post('id');
		$goalID     = $this->input->post('goals_id');
		$criteria['criteria'] = $this->input->post('criteria');

		$this->session->set_flashdata('criteria', 'Berhasil Mengupdate Criteria');
		$this->AdminModel->updateCriteria($criteriaID, $criteria);
		redirect('admin/coachee/goal/show/' . $goalID);
	}

	public function deleteCriteria($criteriaID, $goalID)
	{
		$this->session->set_flashdata('criteria', 'Berhasil Menghapus Criteria');
		$this->AdminModel->deleteCriteria($criteriaID);
		redirect('admin/coachee/goal/show/' . $goalID);
	}

	public function resetAction($actionID, $goalID)
	{
		$action['result'] = null;
		$this->session->set_flashdata('action', 'Berhasil Mereset Action');
		$this->AdminModel->resetAction($actionID, $action);
		redirect('admin/coachee/goal/show/' . $goalID);
	}

	public function deleteAction($actionID, $goalID)
	{
		$this->session->set_flashdata('action', 'Berhasil Menghapus Action');
		$this->AdminModel->deleteAction($actionID);
		redirect('admin/coachee/goal/show/' . $goalID);
	}

	//profile
	public function profile()
	{
		$this->checkAuth();
		$data['page_name'] = 'Profile Admin';
		// $data['coachs']     = $this->AdminModel->getAllCoach();

		$this->load->view('admin/profile/profile', $data);
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
			$cek_password = $this->AdminModel->cek_password();

			if (password_verify($pass, $cek_password->password)) {
				$pb = password_hash($this->input->post('password_baru', true), PASSWORD_DEFAULT);
				$data = array(
					'password' => $pb,
				);
				$this->AdminModel->update_password($data, $id);
				$this->session->set_flashdata('pro', 'Password berhasil diubah.');
				redirect('admin/profile');
			} else {
				$this->session->set_flashdata('error', 'Password yang Anda masukan salah.');
				redirect('admin/profile');
			}
		}
	}
}
