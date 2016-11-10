<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribution extends MY_Controller {

	public function index()
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
