<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends MY_Controller {

    public function friend_list() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/friend/friend_list?');

        $status = $this->input->get('status');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if(!empty($keyword) || $status != '') {
            $data['status'] = $status;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'status='.$status.'&keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('friend_status' => $status, 'id' => $keyword);
            } else {
                $like = array('friend_status' => $status, 'friend_name' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('friend')->where(array('type' => 1))->like($like)->count_all_results();
        $config['per_page'] = 10;
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

        $data['list'] = $this->db
                        ->from('friend')
                        ->where(array('type' => 1))
                        ->like($like)
                        ->order_by('friend_status desc, id desc')
                        ->limit($config['per_page'], $page)
                        ->get()
                        ->result_array();
        
        $this->load->view('manageroot/friend_list', $data);
    }

    public function add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                'field' => 'friend_name',
                'label' => '名称',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'friend_href',
                'label' => '链接地址',
                'rules' => 'trim|required|prep_url'
            )
        );

        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['type'] = $this->input->post('type');
            $newdata['friend_name'] = $this->input->post('friend_name');
            $newdata['friend_href'] = $this->input->post('friend_href');
            $newdata['friend_status'] = $this->input->post('friend_status');
            $newdata['order'] = 0;

            if (is_uploaded_file($_FILES['friend_logo']['tmp_name'])) {
                $friend_logo = $_FILES['friend_logo'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $friend_logo["type"];
                $size = $friend_logo["size"];
                $tmp_name = $friend_logo["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['friend_logo'] = $new_name = 'upload/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/friend/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/friend/friend_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if ($this->db->insert('friend', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '合作伙伴添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/friend/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/friend/friend_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '合作伙伴添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/friend/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/friend/friend_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $ssdata['type'] = $type = (int)$this->uri->segment(5);
            if (!in_array($type, array('0', '1'))) {
                $message_data = array('status' => 0, 'msg' => '非法操作', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/friend/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/friend/friend_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $this->load->view('manageroot/friend_add', $ssdata);
            }

        }
    }

    public function friend_delete($id = 0) {
        $id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('id' => $id))->get('friend')->row_array();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '合作伙伴删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/friend/friend_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if ($this->db->where(array('id' => $id))->delete('friend')) {
                    //删除图片
                    if(!empty($single_info['friend_logo']) && file_exists($single_info['friend_logo'])) {
                        unlink($single_info['friend_logo']);
                    }
                    $message_data = array('status' => 200, 'msg' => '合作伙伴删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/friend/friend_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '合作伙伴删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/friend/friend_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }

    }

    public function friend_edit($id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['single_info'] = $single_info = $this->db->where(array('id' => $id))->select('*')->get('friend')->row_array();

        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的合作伙伴', 'choice' => array('list' => array('title' => '返回合作伙伴列表重新选择编辑', 'url' => site_url('manageroot/friend/friend_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $study_rules = array(
                array(
                    'field' => 'friend_name',
                    'label' => '名称',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'friend_href',
                    'label' => '链接地址',
                    'rules' => 'trim|required|prep_url'
                )
            );

            $this->form_validation->set_rules($study_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['type'] = $this->input->post('type');
                $newdata['friend_name'] = $this->input->post('friend_name');
                $newdata['friend_href'] = $this->input->post('friend_href');
                $newdata['friend_status'] = $this->input->post('friend_status');
                $newdata['order'] = 0;

                if (is_uploaded_file($_FILES['friend_logo']['tmp_name'])) {
                    $friend_logo = $_FILES['friend_logo'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $friend_logo["type"];
                    $size = $friend_logo["size"];
                    $tmp_name = $friend_logo["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['friend_logo'] = $new_name = 'upload/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/friend/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/friend/friend_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if ($this->db->where(array('id' => $id))->update('friend', $newdata)) {
                    //有新上传图片时，删除旧图片
                    if(!empty($newdata['friend_logo'])) {
                        if(!empty($single_info['friend_logo']) && file_exists($single_info['friend_logo'])) {
                            unlink($single_info['friend_logo']);
                        }
                    }

                    $message_data = array('status' => 200, 'msg' => '合作伙伴修改成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/friend/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/friend/friend_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/friend_edit', $data);
            }

        }
    }

}