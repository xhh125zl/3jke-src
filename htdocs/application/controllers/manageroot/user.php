<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

    public function user_list() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/user/user_list?');

        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if(!empty($keyword)) {
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('user.user_id' => $keyword);
            } else {
                $like = array('user.user_name' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('user.user_id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('user')->like($like)->count_all_results();
        $config['per_page'] = 15;
        $config['num_links'] = 4;
        //$config['uri_segment'] = 7;
        $config['use_page_numbers'] = false;    //必须false
        $config['page_query_string'] = true;    //必须为true

        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['cur_tag_open'] = '<li class="disabled"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = '下一页';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '上一页';

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $data['user_list'] = $this->db
                            ->from('user')
                            ->like($like)
                            ->join('company_info','user.user_id = company_info.user_id')
                            ->order_by('user.user_status desc, user.addtime desc')
                            ->limit($config['per_page'], $page)
                            ->get()
                            ->result_array();

        $this->load->view('manageroot/user_list', $data);
    }

    public function user_add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                    'field' => 'user_name',
                    'label' => '用户名',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'user_psw',
                    'label' => '密码',
                    'rules' => 'trim|required'
                )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $data['user_name'] = $this->input->post('user_name');
            $data['user_psw'] = md5($this->input->post('user_psw'));
            $data['addtime'] = time();

            $res = $this->db->where(array('user_name' => $data['user_name']))->get('user')->num_rows();
            $res1 = $this->db->where(array('user_name' => $data['user_name']))->get('admin')->num_rows();
            if($res || $res1) {
                $message_data = array('status' => 0, 'msg' => '该用户已被注册，请重新填写', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/user/user_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/user/user_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if($this->db->insert('user', $data)) {
                    $user_id = $this->db->insert_id();

                    //注册后生成用户关联的公司信息id
                    $wzw_info = $this->db->where(array('user_id' => 0))->get('company_info')->row_array();
                    $company_data = array(
                            'user_id' => $user_id,
                            'consult_url' => $wzw_info['consult_url'],
                            'web_record_number' => $wzw_info['web_record_number'],
                            'webtitle' => $wzw_info['webtitle'],
                            'keywords' => $wzw_info['keywords'],
                            'webdesc' => $wzw_info['webdesc'],
                            'online_code' => $wzw_info['online_code'],
                            'company_name' => $wzw_info['company_name'],
                            'company_logo' => $wzw_info['company_logo'],
                            'company_slogan' => $wzw_info['company_slogan'],
                            'company_QRcode1' => $wzw_info['company_QRcode1'],
                            'company_QRcode2' => $wzw_info['company_QRcode2'],
                            'company_desc' => $wzw_info['company_desc'],
                            'company_address' => $wzw_info['company_address'],
                            'address_img' => $wzw_info['address_img'],
                            'company_email' => $wzw_info['company_email'],
                            'aboutus_banner' => $wzw_info['aboutus_banner'],
                            'company_contactNum' => $wzw_info['company_contactNum'],
                            'company_saleNum' => $wzw_info['company_saleNum'],
                            'company_afterSaleNum' => $wzw_info['company_afterSaleNum'],
                        );
                    if($this->db->insert('company_info',$company_data)) {
                        $message_data = array('status' => 200, 'msg' => '添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/user/user_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/user/user_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    } else {
                        $message_data = array('status' => 0, 'msg' => '添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/user/user_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/user/user_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }   
                } else {
                    $message_data = array('status' => 0, 'msg' => '添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/user/user_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/user/user_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        } else {
            $this->load->view('manageroot/user_add');
        }
    }

    public function user_edit($user_id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $user_info = $data['user_info'] = $this->db->where(array('user_id' => $user_id))->get('user')->row_array();
        if (empty($user_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的用户', 'choice' => array('list' => array('title' => '返回用户列表重新选择编辑', 'url' => site_url('manageroot/user/user_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'user_psw',
                    'label' => '重置密码',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['user_psw'] = md5($this->input->post('user_psw'));

                if ($this->db->where(array('user_id' => $user_id))->update('user', $newdata)) {
                    
                    $message_data = array('status' => 200, 'msg' => '用户密码修改成功', 'choice' => array('list' => array('title' => '返回用户列表查看', 'url' => site_url('manageroot/user/user_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '用户密码修改失败', 'choice' => array('list' => array('title' => '返回用户列表重新选择编辑', 'url' => site_url('manageroot/user/user_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/user_edit', $data);
            }
        }
    }

    public function user_del($user_id = 0) {
        $user_id = (int)$user_id;
        if ($user_id) {
            $user_info = $this->db->where(array('user_id' => $user_id))->get('user')->num_rows();
            if (empty($user_info)) {
                $message_data = array('status' => 0, 'msg' => '没有要删除的用户', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/user/user_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if($this->db->where(array('user_id' => $user_id))->delete('user')) {
                    //删除用户后，同时删除连带信息--公司信息--qq信息
                    $company_info = $this->db->where(array('user_id' => $user_id))->get('company_info')->row_array();
                    //删除图片
                    //判断图片是否被用
                    $logo = $this->db->where(array('company_logo' => $company_info['company_logo']))->get('company_info')->num_rows();
                    if(!empty($company_info['company_logo']) && file_exists($company_info['company_logo']) && empty($logo) ) {
                        unlink($company_info['company_logo']);
                    }
                    $QRcode1 = $this->db->where(array('company_QRcode1' => $company_info['company_QRcode1']))->get('company_info')->num_rows();
                    if(!empty($company_info['company_QRcode1']) && file_exists($company_info['company_QRcode1']) && empty($QRcode1) ) {
                        unlink($company_info['company_QRcode1']);
                    }
                    $QRcode2 = $this->db->where(array('company_QRcode2' => $company_info['company_QRcode2']))->get('company_info')->num_rows();
                    if(!empty($company_info['company_QRcode2']) && file_exists($company_info['company_QRcode2']) && empty($QRcode2) ) {
                        unlink($company_info['company_QRcode2']);
                    }
                    $address = $this->db->where(array('address_img' => $company_info['address_img']))->get('company_info')->num_rows();
                    if(!empty($company_info['address_img']) && file_exists($company_info['address_img']) && empty($address) ) {
                        unlink($company_info['address_img']);
                    }
                    $banner = $this->db->where(array('aboutus_banner' => $company_info['aboutus_banner']))->get('company_info')->num_rows();
                    if(!empty($company_info['aboutus_banner']) && file_exists($company_info['aboutus_banner']) && empty($banner) ) {
                        unlink($company_info['aboutus_banner']);
                    }
                    $this->db->where(array('user_id' => $user_id))->delete('company_info');

                    $this->db->where(array('company_id' => $company_info['company_id']))->delete('serve_qq');

                    $message_data = array('status' => 200, 'msg' => '删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/user/user_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '删除失败', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/user/user_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }
    }

    //个人信息
    public function user_info(){
        if($this->session->userdata('role') == 0) {
            $user_id = $this->session->userdata('loginid');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['user_info'] = $this->db->where(array('user_id' => $user_id))->get('user')->row_array();

        $this->load->view('manageroot/user_info', $data);
    }

    //修改用户名密码
    public function change_psw() {
        //获取登录id
        $login_id = (int)$this->session->userdata('loginid');
        $role = $this->session->userdata('role');
        //判断是谁登陆
        if($role == 1) {
            //管理员登陆
            $data['user_info'] = $this->db->where(array('id' => $login_id))->get('admin')->row_array();
        } elseif($role == 0) {
            //用户登录
            $data['user_info'] = $this->db->where(array('user_id' => $login_id))->get('user')->row_array();
        } else {
            redirect(site_url('manageroot/login'));
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                    'field' => 'user_name',
                    'label' => '用户名',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'user_opsw',
                    'label' => '原密码',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'user_npsw',
                    'label' => '新密码',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'user_spsw',
                    'label' => '确认密码',
                    'rules' => 'trim|required'
                )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $user_name = $this->input->post('user_name');       //用户名
            $opsw = md5($this->input->post('user_opsw'));       //原密码
            $npsw = md5($this->input->post('user_npsw'));       //新密码
            $spsw = md5($this->input->post('user_spsw'));       //确认密码
            //判断用户名是否重复
            $res = $this->db->where(array('id !=' => $login_id, 'user_name' => $user_name))->get('admin')->num_rows();
            $res1 = $this->db->where(array('user_id !=' => $login_id, 'user_name' => $user_name))->get('user')->num_rows();
            if(!$res && !$res1) {
                if($opsw == $data['user_info']['user_psw']) {
                    if($npsw == $spsw) {
                        $newdata['user_name'] = $user_name;
                        $newdata['user_psw'] = $npsw;
                        if($role == 1) {
                            $update_res = $this->db->where(array('id' => $login_id))->update('admin', $newdata);
                        } elseif($role == 0) {
                            $update_res = $this->db->where(array('user_id' => $login_id))->update('user', $newdata);
                        }
                        if ($update_res) {
                            //修改成功，重新登录
                            $this->session->unset_userdata('loginname');
                            $this->session->unset_userdata('loginid');
                            $this->session->unset_userdata('role');
                            echo '<script>parent.location.reload();</script>';
                        } else {
                            $message_data = array('status' => 0, 'msg' => '修改失败', 'choice' => array('list' => array('title' => '返回重新修改', 'url' => site_url('manageroot/user/change_psw'))));
                            $this->load->view('manageroot/message', $message_data);
                        }
                    } else {
                        $message_data = array('status' => 0, 'msg' => '两次密码不一致', 'choice' => array('list' => array('title' => '返回重新修改', 'url' => site_url('manageroot/user/change_psw'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                        
                } else {
                    $message_data = array('status' => 0, 'msg' => '密码不正确', 'choice' => array('list' => array('title' => '返回重新修改', 'url' => site_url('manageroot/user/change_psw'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $message_data = array('status' => 0, 'msg' => '用户名已被占用', 'choice' => array('list' => array('title' => '返回重新修改', 'url' => site_url('manageroot/user/change_psw'))));
                $this->load->view('manageroot/message', $message_data);
            }

            
                
        } else {
            $this->load->view('manageroot/change_psw', $data);
        }
    }

    public function check_psw() {
        $user_id = $this->input->post('user_id');
        $user_psw = md5($this->input->post('user_psw'));

        $user_info = $this->db->where(array('user_id' => $user_id))->get('user')->row_array();
        if(!empty($user_info)) {
            if($user_psw == $user_info['user_psw']) {
                echo json_encode(array('status' => 1, 'content' => '密码验证成功'));die;
            } else {
                echo json_encode(array('status' => 0, 'content' => '密码错误，请重试！'));die;
            }
        } else {
            echo json_encode(array('status' => 0, 'content' => '查询错误'));die;
        }
    }

    public function set_url() {
        $user_id = $this->input->post('user_id');
        $user_url = trim($this->input->post('user_url'));

        if($this->db->where(array('user_id' => $user_id))->update('user', array('user_url' => $user_url))) {
            echo json_encode(array('status' => 1, 'content' => '绑定成功'));die;
        } else {
            echo json_encode(array('status' => 0, 'content' => '绑定失败，请重试！'));die;
        }
    }

    public function url_edit() {
        $user_id = $this->input->post('user_id');
        $user_url = trim($this->input->post('user_url'));

        if($this->db->where(array('user_id' => $user_id))->update('user', array('user_url' => $user_url))) {
            echo json_encode(array('status' => 1, 'content' => '修改成功'));die;
        } else {
            echo json_encode(array('status' => 0, 'content' => '修改失败，请重试！'));die;
        }
    }

	 
	
}