<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$rules_arr = array(
			array('field'   => 'username', 'label'   => '用户名', 'rules'   => 'required'),
			array('field'   => 'password', 'label'   => '密码', 'rules'   => 'required')
		);
		$this->form_validation->set_rules($rules_arr);
	}

	public function index()
	{
		$this->load->model('adminuser_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if ($this->form_validation->run() === TRUE) {
			//比对管理员的信息
			$admin_info = $this->adminuser_model->get_field_values('admin', 'user_name, user_psw, id, login_nums', array('user_name' => $username));
			//比对用户的信息
			$user_info = $this->adminuser_model->get_field_values('user', 'user_id, user_name, user_psw, login_nums', array('user_name' => $username));
			
			if ($admin_info && $admin_info['user_psw'] == md5($password)) {	//管理员登陆
				
				$data['last_login_time'] = time();
				$data['login_nums'] = $admin_info['login_nums'] + 1;
				$data['last_login_ip'] = $this->input->ip_address();
				$this->db->where(array('id' => $admin_info['id']))->update('admin', $data); //设置最后登录时间

				$login_info = array(
					'loginname' => $admin_info['user_name'],
					'loginid' => $admin_info['id'],
					'role' 	=> 1
				);	//管理员
				$this->session->set_userdata($login_info);

				redirect(site_url('manageroot/home'));

			} else if($user_info && $user_info['user_psw'] == md5($password)) {		//用户登录
				$udata['last_login_time'] = time();
				$udata['login_nums'] = $user_info['login_nums'] + 1;
				$udata['last_login_ip'] = $this->input->ip_address();
				$this->db->where(array('user_id' => $user_info['user_id']))->update('user', $udata); //设置最后登录时间

				$login_info = array(
					'loginname' => $user_info['user_name'],
					'loginid' => $user_info['user_id'],
					'role' 	=> 0
				);	//用户
				$this->session->set_userdata($login_info);

				redirect(site_url('manageroot/home'));
			}
		}

		$this->load->view('manageroot/login');
	}

	public function login_out()
	{
		$this->session->unset_userdata('loginname');
		$this->session->unset_userdata('loginid');
		$this->session->unset_userdata('role');
		echo '<script>parent.location.reload();</script>';
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */