<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['page_name'] = 'login';

		$this->load->view('login', $data);
	}

	public function inputPassword()
	{
		$data['page_name'] = 'Password Baru';
		$this->load->view('reset_password', $data);
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


	//lupa password

	public function forget()
	{
		$data['page_name'] = 'Lupa password';
		$this->load->view('lupa_password', $data);
	}
	public function lupaPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_error_delimiters('<span style="font-size: 10px;color:red">', '</span>');
		if ($this->form_validation->run() == FALSE) {
			$this->forget();
		} else {
			$email = $this->input->post('email', true);
			$clean = $this->security->xss_clean($email);
			if ($userInfo = $this->AuthModel->getEmailCoach($clean) != null) {
				$userInfo = $this->AuthModel->getEmailCoach($clean);
			} else {
				$userInfo = $this->AuthModel->getEmailCoachee($clean);
			}

			if (!$userInfo) {
				$this->session->set_flashdata('error', 'Alamat email salah, silakan coba lagi.');
				redirect('auth/lupa_password');
			}

			//build token   
			$this->load->library('email'); //panggil library email codeigniter
			$config = [
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'mail',
				'smtp_host' => 'mail.korporaconsulting.com',
				'smtp_user' => 'demoaplikasi@korporaconsulting.com',  // Email gmail
				'smtp_pass'   => 'Demoaplikasi',  // Password gmail
				'smtp_port'   => 465,
				'crlf'    => "\r\n",
				'newline' => "\r\n"
			];
			$token = $this->AuthModel->insertToken($userInfo->email);
			$qstring = $this->base64url_encode($token);
			$url = site_url() . 'auth/password_baru/' . $qstring;
			$link = '<a href="' . $url . '">' . 'Reset Password' . '</a>';
			$message =  "
            <html>
            <head>
            <title>Reset Password</title>
            </head>
            <body>
            <h2>Reset Password Anda</h2>
            <p>Your Account:</p>
            <p>Email: " . $email . "</p>
            <p>klink link untuk reset password akun anda.</p>
            <h4>" . $link . "</h4>
            </body>
            </html>
            ";

			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($config['smtp_user']);
			$this->email->to($email);
			$this->email->subject('Email verifikasi'); //subjek email
			$this->email->message($message);
			if (!$this->email->send()) {
				$this->session->set_flashdata('error', 'Gagal mengirim email');
				redirect('auth/lupa_password');
			} else {
				$this->session->set_flashdata('msg', 'Silahkan cek email anda');
				redirect('auth/lupa_password');
			}
		}
	}
	public function reset_password()
	{
		$token = $this->input->post('token', true);
		$this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Password tidak boleh kosong!'));
		$this->form_validation->set_rules('repassword', 'Password', 'required|matches[password]', array(
			'required' => 'Password tidak boleh kosong!',
			'matches'     => 'Password tidak sama'
		));
		$this->form_validation->set_error_delimiters('<span style="font-size: 10px;color:red">', '</span>');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Password tidak sama');
			$link = "auth/password_baru/" . $token;
			redirect(str_replace(' ', '', $link));
		} else {
			$token = $this->base64url_decode($this->input->post('token', true));
			$cleanToken = $this->security->xss_clean($token);
			$user_info = $this->AuthModel->isTokenValid($cleanToken);

			if (!$user_info) {
				$this->session->set_flashdata('error', 'Token tidak valid atau kadaluarsa');
				redirect('auth/lupa_password');
			} else {
				$post = $this->input->post(NULL, TRUE);
				$cleanPost = $this->security->xss_clean($post);
				$hashed = password_hash($cleanPost['password'], PASSWORD_DEFAULT);
				$cleanPost['password'] = $hashed;
				$cleanPost['email'] = $user_info->email;
				unset($cleanPost['passconf']);
				if ($this->AuthModel->getEmailCoach($cleanPost['email']) != null) {
					if (!$this->AuthModel->updatePasswordCoach($cleanPost)) {
						$this->session->set_flashdata('error', 'Update password gagal.');
						redirect('auth/lupa_password');
					} else {
						$this->session->set_flashdata('regis', 'Password anda sudah diperbaharui. Silakan login.');
						redirect('login');
					}
				} else {
					if (!$this->AuthModel->updatePasswordCoachee($cleanPost)) {
						$this->session->set_flashdata('error', 'Update password gagal.');
						redirect('auth/lupa_password');
					} else {
						$this->session->set_flashdata('regis', 'Password anda sudah diperbaharui. Silakan login.');
						redirect('login');
					}
				}
			}
		}
	}
	public function base64url_encode($data)
	{
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	public function base64url_decode($data)
	{
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}
}

/* End of file AuthController.php */
/* Location: ./application/controllers/AuthController.php */
