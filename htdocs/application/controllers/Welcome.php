<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$data['action'] = $this->uri->segment(1);
		$data['method'] = $this->uri->segment(2);
		$this->load->vars($data);
	}

	public function index()
	{
		$data['webTitle'] = '豆来网';

		//判断是否为手机登录
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()) {
			$this->load->view('mobile/index', $data);
		} else {
			$this->load->view('pc/index', $data);
		}
	}

	public function shop()
	{
		$data['webTitle'] = '豆来开店';

		//判断是否为手机登录
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()) {
			$this->load->view('mobile/shop', $data);
		} else {
			$this->load->view('pc/shop', $data);
		}
	}

	public function distribution()
	{
		$data['webTitle'] = '豆来分销';

		//判断是否为手机登录
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()) {
			$this->load->view('mobile/distribution', $data);
		} else {
			$this->load->view('pc/distribution', $data);
		}
	}
}
