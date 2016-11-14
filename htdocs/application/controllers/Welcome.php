<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Front_Controller {

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

	public function index()
	{
		$catgory_id = 3;	//公司动态
		$data['company_news'] = $this->db
									->where(array('catgory_id' => $catgory_id, 'status' => 1))
                                    ->order_by('addtime desc')
                                    ->limit(3)
                                    ->get('study')
                                    ->result_array();
		$data['webTitle'] = '豆来网';

		//判断是否为手机登录
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()) {
			$this->load->view('mobile/index', $data);
		} else {
			$this->load->view('pc/index', $data);
		}
	}

}
