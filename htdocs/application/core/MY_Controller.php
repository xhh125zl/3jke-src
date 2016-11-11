<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $data['role'] = $this->session->userdata('role');
        $data['user_id'] = $this->session->userdata('loginid');
        if (!$data['user_id'] || ($data['role'] != 0 && $data['role'] != 1)) {
            redirect(site_url('manageroot/login'));
        }

        //判断是否为管理员登录，若用户登录，限制查看的网页
        $user_power = array(
                'user' => array('user_info', 'change_psw', 'check_psw', 'set_url', 'url_edit'),
                'setting' => array('company_setting', 'web_setting', 'qq_add', 'qq_edit', 'qq_del', 'qq_list'),
                'join' => array('join_list')
            );
        if($data['role'] == 0) {
            $class = strtolower($this->uri->segment(2));
            $method = strtolower($this->uri->segment(3));
            foreach($user_power as $k => $v) {
                if($class == $k) {
                    if(!in_array($method, $v)) {
                        redirect(site_url('manageroot/home'));
                    }
                }
            }
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
        $this->load->vars($data);
    }
    
}