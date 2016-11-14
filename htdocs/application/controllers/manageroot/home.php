<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 *
	 * index 默认控制
	 */
	public function index()
	{
		$this->load->view('manageroot/main');
	}

	/**
	 * 默认的后台登录显示页面
	 *
	 * 直接输出界面
	 */
	public function main_center()
	{
		//获取个人信息
		$loginid = $this->session->userdata('loginid');

		if ($loginid) {	//管理员
			$this->load->model('adminuser_model');
			$data['login_info'] = $this->adminuser_model->get_field_values('admin', 'user_name, last_login_time, last_login_ip, login_nums, addtime', array('id' => $loginid));
		} else {
			redirect(site_url('manageroot/login'));
		}

		$this->load->view('manageroot/main_center', $data);
	}

	public function main_top()
	{
		//获取个人信息
		$loginid = $this->session->userdata('loginid');

		if ($loginid) {	//管理员
			$this->load->model('adminuser_model');
			$data['login_info'] = $this->adminuser_model->get_field_values('admin', 'user_name', array('id' => $loginid));
		} else {
			redirect(site_url('manageroot/login'));
		}
		$this->load->view('manageroot/top', $data);
	}

	public function main_left()
	{
		$this->load->view('manageroot/left');
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */