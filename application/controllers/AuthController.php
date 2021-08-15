<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
    }

	public function index()
	{ 
        $data['page_name'] = 'login';
		$this->load->view('login',$data);
	}

    public function auth()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        $where = array(
            'email' => $email,
            'password' => $password
        );

        $coachAuth      = $this->AuthModel->getCoach($where)->num_rows();
        $studentAuth    = $this->AuthModel->getStudent($where)->num_rows();
        
        
        if($coachAuth > 0 ){
            $auth = $this->AuthModel->getCoach($where)->row_array();
        
            $sessionData = array(
                'login'    => 'coach',
                'id'       => $auth['id'],
                'name'     => $auth['name'],
                'email'    => $auth['email'],
                'password' => $auth['password']
            );

            $this->session->set_userdata($sessionData);
            $this->session->set_flashdata('status', 'login');
            redirect(site_url('coach'));
        }
        elseif($studentAuth > 0)
        {
            $auth = $this->AuthModel->getStudent($where)->row_array();
            
            $data_session = array(
                'login'    => 'student',
                'name'     => $auth['name'],
                'email'    => $auth['email'],
                'password' => $auth['password']
            );

            $this->session->set_userdata($data_session);
            $this->session->set_flashdata('status', 'login');
            redirect(site_url('student'));

        }else{
            echo 'salah password';
        }
    }

    public function logout()
    {
        $this->session->set_flashdata('status', 'logout');
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }

}

/* End of file AuthController.php */
/* Location: ./application/controllers/AuthController.php */