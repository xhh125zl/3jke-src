<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends Front_Controller {

	public function index()
	{
		//获取公司发展历史
		$data['company_history'] = $this->db->order_by('history_time')->get('company_history')->result_array();

		//获取招聘信息
		$data['company_recruit'] = $this->db->order_by('order desc, recruit_id')->get('company_recruit')->result_array();

		//判断是否为手机登录
        $this->load->library('user_agent');
        if ($this->agent->is_mobile()) {
        	//获取公司动态
			$data['company_news'] = $this->db->where(array('catgory_id' => 3, 'status' => 1))->order_by('click desc, addtime desc')->limit(3)->get('study')->result_array();
			//获取产品升级日志
			$data['update_logs'] = $this->db->from('update_log')->join('product', 'update_log.product_id = product.product_id')->order_by('update_log.log_time desc, update_log.update_log_id desc')->limit(4)->get()->result_array();
			$data['webtitle'] = '联系我们_网中网';
           	$this->load->view('mobile/aboutus', $data);
        } else {
        	$data['webtitle'] = '联系我们_网中网';
            $this->load->view('pc/aboutus', $data);
        }
	}

}