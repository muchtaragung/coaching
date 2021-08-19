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
		$auth['username'] = $this->input->post('username');
		$auth['password'] = $this->input->post('password');

		$checkAuth = $this->AdminModel->getAdmin($auth)->num_rows();

		if ($checkAuth > 0) {
			$adminData = $this->AdminModel->getAdmin($auth)->row();

			$sessionData['login']    = 'admin';
			$sessionData['username'] = $adminData->username;
			$sessionData['password'] = $adminData->password;

			$this->session->set_userdata($sessionData);
			redirect('admin');
		} else {
			$this->session->set_flashdata('login failed', 'Username Atau Password Salah');
			redirect('admin/login');
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
		$coach['password'] = $this->input->post('password');

		$this->AdminModel->saveCoach($coach);
		redirect('admin/coach/list');
	}
}
