<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_talk extends MY_Controller {

    public function talk_list() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/customer_talk/talk_list?');

        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if(!empty($keyword)) {
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('talk_id' => $keyword);
            } else {
                $like = array('concat(`user_name`,"#",`talk_title`)' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('talk_id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('customer_talk')->like($like)->count_all_results();
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

        $data['talk_list'] = $this->db
                            ->from('customer_talk')
                            ->like($like)
                            ->order_by('addtime desc, talk_id desc')
                            ->limit($config['per_page'], $page)
                            ->get()
                            ->result_array();

        $this->load->view('manageroot/talk_list', $data);
    }	

    public function talk_add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                    'field' => 'user_name',
                    'label' => '感言作者',
                    'rules' => 'required'
                ),
            array(
                    'field' => 'talk_title',
                    'label' => '感言标题',
                    'rules' => 'required'
                ),
            array(
                    'field' => 'talk_content',
                    'label' => '感言描述',
                    'rules' => 'required'
                )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['user_id'] = 0;
            $newdata['user_name'] = $this->input->post('user_name');
            $newdata['talk_title'] = $this->input->post('talk_title');
            $newdata['talk_content'] = $this->input->post('talk_content');
            $newdata['addtime'] = time();

            if ($this->db->insert('customer_talk', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '感言发布成功', 'choice' => array('add' => array('title' => '继续写感言', 'url' => site_url('manageroot/customer_talk/talk_add')), 'list' => array('title' => '返回感言列表查看', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '感言发布失败', 'choice' => array('add' => array('title' => '重新写感言', 'url' => site_url('manageroot/customer_talk/talk_add')), 'list' => array('title' => '返回感言列表查看', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/talk_add');
        }
    }

    public function talk_edit($talk_id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['talk_info'] = $this->db->where(array('talk_id' => $talk_id))->get('customer_talk')->row_array();
        if(empty($data['talk_info'])) {
            $message_data = array('status' => 0, 'msg' => '没有要修改的感言', 'choice' => array('list' => array('title' => '返回感言列表重新选择', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                $this->load->view('manageroot/message', $message_data);
        } else {
            $log_rule = array(
                array(
                        'field' => 'user_name',
                        'label' => '感言作者',
                        'rules' => 'required'
                    ),
                array(
                        'field' => 'talk_title',
                        'label' => '感言标题',
                        'rules' => 'required'
                    ),
                array(
                        'field' => 'talk_content',
                        'label' => '感言描述',
                        'rules' => 'required'
                    )
            );
            $this->form_validation->set_rules($log_rule);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() == TRUE) {
                $newdata['user_id'] = 0;
                $newdata['user_name'] = $this->input->post('user_name');
                $newdata['talk_title'] = $this->input->post('talk_title');
                $newdata['talk_content'] = $this->input->post('talk_content');
                $newdata['addtime'] = time();

                if ($this->db->where(array('talk_id' => $talk_id))->update('customer_talk', $newdata)) {
                    $message_data = array('status' => 200, 'msg' => '感言修改成功', 'choice' => array( 'list' => array('title' => '返回感言列表查看', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '感言修改失败', 'choice' => array( 'list' => array('title' => '返回感言列表查看', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            
            } else {
                $this->load->view('manageroot/talk_edit', $data);
            }
        }

    }

    public function talk_del($talk_id = 0) {
        $talk_id = (int)$talk_id;
        if ($talk_id) {
            $talk_info = $this->db->where(array('talk_id' => $talk_id))->get('customer_talk')->row_array();
            if (empty($talk_info)) {
                $message_data = array('status' => 0, 'msg' => '没有要删除的感言', 'choice' => array('list' => array('title' => '返回感言列表重新执行', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if($this->db->where(array('talk_id' => $talk_id))->delete('customer_talk')) {
                    $message_data = array('status' => 200, 'msg' => '感言删除成功', 'choice' => array('list' => array('title' => '返回感言列表', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '感言删除失败', 'choice' => array('list' => array('title' => '返回感言列表', 'url' => site_url('manageroot/customer_talk/talk_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }
    }
	
}