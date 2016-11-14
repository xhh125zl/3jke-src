<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MY_Controller {

	public function company_setting(){

		$this->load->helper('form');
		$this->load->library('form_validation');

		$log_rule = array(
            array(
                'field' => 'company_address',
                'label' => '公司地址',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_email',
                'label' => '公司邮箱',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_contactNum',
                'label' => '联系电话',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $data['company_address'] = $this->input->post('company_address');
            $data['company_email'] = $this->input->post('company_email');
            $data['company_contactNum'] = $this->input->post('company_contactNum');
            $data['company_saleNum'] = $this->input->post('company_saleNum');
			$data['company_afterSaleNum'] = $this->input->post('company_afterSaleNum');
            $data['company_desc'] = $this->input->post('company_desc');

			if ($this->db->where(array('company_id' => 1))->update('company_info', $data)) {
				$message_data = array('status' => 200, 'msg' => '公司设置修改成功', 'choice' => array('list' => array('title' => '返回查看公司设置项', 'url' => site_url('manageroot/setting/company_setting'))));
				$this->load->view('manageroot/message', $message_data);
			} else {
				$message_data = array('status' => 0, 'msg' => '公司设置修改成失败', 'choice' => array('list' => array('title' => '返回重新设置', 'url' => site_url('manageroot/setting/company_setting'))));
				$this->load->view('manageroot/message', $message_data);
			}
		} else {
			$data['company_info'] = $this->db->where(array('company_id' => 1))->get('company_info')->row_array();

			$this->load->view('manageroot/company_setting', $data);
		}
	}

    public function web_setting(){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                'field' => 'web_record_number',
                'label' => '网站备案号',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'webtitle',
                'label' => '网站标题',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'keywords',
                'label' => '关键字',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'consult_url',
                'label' => '咨询地址',
                'rules' => 'trim|prep_url'
            )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $data['web_record_number'] = $this->input->post('web_record_number');
            $data['webtitle'] = $this->input->post('webtitle');
            $data['keywords'] = $this->input->post('keywords');
            $data['webdesc'] = $this->input->post('webdesc');
            $data['consult_url'] = $this->input->post('consult_url');
            $data['online_code'] = $this->input->post('online_code');

            if ($this->db->where(array('company_id' => 1))->update('company_info', $data)) {
                $message_data = array('status' => 200, 'msg' => '站点设置修改成功', 'choice' => array('list' => array('title' => '返回查看站点设置项', 'url' => site_url('manageroot/setting/web_setting'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '站点设置修改成失败', 'choice' => array('list' => array('title' => '返回重新设置', 'url' => site_url('manageroot/setting/web_setting'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $data['company_info'] = $this->db->where(array('company_id' => 1))->get('company_info')->row_array();

            $this->load->view('manageroot/web_setting', $data);
        }
    }
	
}