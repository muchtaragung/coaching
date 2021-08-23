<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
	}

	public function index()
	{
		$data['page_name'] = 'login';
		$this->load->view('login', $data);
	}

	public function auth()
	{
		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		$where = array(
			'email' => $email,
		);

		$coachAuth      = $this->AuthModel->getCoach($where)->num_rows();
		$coacheeAuth    = $this->AuthModel->getCoachee($where)->num_rows();

		$coach          = $this->AuthModel->getCoach($where)->row();
		$coachee        = $this->AuthModel->getCoachee($where)->row();

		if ($coachAuth > 0 && password_verify($password, $coach->password)) {

			$sessionData = array(
				'login'    => 'coach',
				'id'       => $coach->id,
				'name'     => $coach->name,
				'email'    => $coach->email,
				'password' => $coach->password,
			);

			$this->session->set_userdata($sessionData);
			$this->session->set_flashdata('status', 'login');
			redirect(site_url('coach'));
		} elseif ($coacheeAuth > 0 && password_verify($password, $coachee->password)) {


			$data_session = array(
				'login'    => 'coachee',
				'id'       => $coachee->id,
				'name'     => $coachee->name,
				'email'    => $coachee->email,
				'password' => $coachee->password,
			);

			$this->session->set_userdata($data_session);
			$this->session->set_flashdata('status', 'login');
			redirect(site_url('coachee'));
		} else {
			$this->session->set_flashdata('login', 'wrong');
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('login', 'logout');
		redirect('login');
	}
}

/* End of file AuthController.php */
/* Location: ./application/controllers/AuthController.php */
