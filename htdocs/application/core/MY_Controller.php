<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $data['user_id'] = $this->session->userdata('loginid');
        if (!$data['user_id']) {
            redirect(site_url('manageroot/login'));
        }

        $this->load->vars($data);
    }

}

class Front_Controller extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
        
        $data['action'] = $this->uri->segment(1);
        $data['method'] = $this->uri->segment(2);
   
        //获取公司信息
        $data['company_info'] = $this->db->where(array('company_id' => 1))->get('company_info')->row_array();

        $this->load->vars($data);
    }
    
}