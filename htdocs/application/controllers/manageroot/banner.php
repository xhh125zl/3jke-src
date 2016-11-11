<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MY_Controller {

    public function banner_list() {

        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/banner/banner_list?');

        $status = $this->input->get('status');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if(!empty($keyword) || $status != '') {
            $data['status'] = $status;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'status='.$status.'&keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('banner_status' => $status, 'id' => $keyword);
            } else {
                $like = array('banner_status' => $status, 'banner_name' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('banner')->like($like)->count_all_results();
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
                        ->from('banner')
                        ->like($like)
                        ->order_by('banner_status desc, id desc, order desc')
                        ->limit($config['per_page'], $page)
                        ->get()
                        ->result_array();

        $this->load->view('manageroot/banner_list', $data);
    }

    public function add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                'field' => 'banner_href',
                'label' => '链接地址',
                'rules' => 'prep_url'
            ),
            array(
                'field' => 'order',
                'label' => '排序',
                'rules' => 'numeric'
            )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['banner_name'] = $this->input->post('banner_name');
            $newdata['banner_href'] = $this->input->post('banner_href');
            $newdata['banner_status'] = $this->input->post('banner_status');
            $newdata['order'] = $this->input->post('order');

            //PC端banner图片上传
            if (is_uploaded_file($_FILES['banner_img']['tmp_name'])) {
                $picture_logo = $_FILES['banner_img'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $picture_logo["type"];
                $size = $picture_logo["size"];
                $tmp_name = $picture_logo["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['banner_img'] = $new_name = 'upload/banner/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/banner/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
            //手机端banner图片上传
            if (is_uploaded_file($_FILES['banner_phone_img']['tmp_name'])) {
                $picture_logo = $_FILES['banner_phone_img'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $picture_logo["type"];
                $size = $picture_logo["size"];
                $tmp_name = $picture_logo["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['banner_phone_img'] = $new_name = 'upload/banner/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/banner/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if ($this->db->insert('banner', $newdata)) {
                $message_data = array('status' => 200, 'msg' => 'banner信息添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/banner/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => 'banner信息添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/banner/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/banner_add');
        }
    }

    public function banner_delete($id = 0) {
        $id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('id' => $id))->get('banner')->row_array();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => 'banner信息删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/banner/banner_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if ($this->db->where(array('id' => $id))->delete('banner')) {
                    //删除PC端banner图片
                    if(!empty($single_info['banner_img']) && file_exists($single_info['banner_img'])) {
                        unlink($single_info['banner_img']);
                    }
                    //删除手机端banner图片
                    if(!empty($single_info['banner_phone_img']) && file_exists($single_info['banner_phone_img'])) {
                        unlink($single_info['banner_phone_img']);
                    }
                    $message_data = array('status' => 200, 'msg' => 'banner信息删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => 'banner信息删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/banner/banner_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }

    }

    public function banner_edit($id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['single_info'] = $single_info = $this->db->where(array('id' => $id))->select('*')->get('banner')->row_array();

        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的banner', 'choice' => array('list' => array('title' => '返回banner列表重新选择编辑', 'url' => site_url('manageroot/banner/banner_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $study_rules = array(
                array(
                    'field' => 'banner_href',
                    'label' => '链接地址',
                    'rules' => 'prep_url'
                ),
                array(
                    'field' => 'order',
                    'label' => '排序',
                    'rules' => 'numeric'
                ),
            );

            $this->form_validation->set_rules($study_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['banner_name'] = $this->input->post('banner_name');
                $newdata['banner_href'] = $this->input->post('banner_href');
                $newdata['banner_status'] = $this->input->post('banner_status');
                $newdata['order'] = $this->input->post('order');
                //PC端banner图片上传
                if (is_uploaded_file($_FILES['banner_img']['tmp_name'])) {
                    $picture_logo = $_FILES['banner_img'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $picture_logo["type"];
                    $size = $picture_logo["size"];
                    $tmp_name = $picture_logo["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['banner_img'] = $new_name = 'upload/banner/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/banner/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }
                //手机端banner图片上传
                if (is_uploaded_file($_FILES['banner_phone_img']['tmp_name'])) {
                    $picture_logo = $_FILES['banner_phone_img'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $picture_logo["type"];
                    $size = $picture_logo["size"];
                    $tmp_name = $picture_logo["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['banner_phone_img'] = $new_name = 'upload/banner/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/banner/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if ($this->db->where(array('id' => $id))->update('banner', $newdata)) {
                    //PC端banner有新上传图片时，删除旧图片
                    if(!empty($newdata['banner_img'])) {
                        if(!empty($single_info['banner_img']) && file_exists($single_info['banner_img'])) {
                            unlink($single_info['banner_img']);
                        }
                    }
                    //手机端banner有新上传图片时，删除旧图片
                    if(!empty($newdata['banner_phone_img'])) {
                        if(!empty($single_info['banner_phone_img']) && file_exists($single_info['banner_phone_img'])) {
                            unlink($single_info['banner_phone_img']);
                        }
                    }
                    $message_data = array('status' => 200, 'msg' => 'banner信息修改成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/banner/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/banner/banner_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/banner_edit', $data);
            }

        }
    }

}