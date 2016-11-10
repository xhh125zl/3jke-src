<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Controller {

	public function index()
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

}
