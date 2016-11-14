<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Study extends MY_Controller {

     public function study_list() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/study/study_list?');

        $status = $this->input->get('status');
        $catgory_id = $this->input->get('catgory_id');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if($status != '' || !empty($keyword) || !empty($catgory_id)) {
            $data['status'] = $status;
            $data['catgory_id'] = $catgory_id;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'status='.$status.'&catgory_id='.$catgory_id.'&keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('status' => $status, 'study.catgory_id' => $catgory_id, 'study.study_id' => $keyword);
            } else {
                $like = array('status' => $status, 'study.catgory_id' => $catgory_id, 'study.title' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('study.study_id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('study')->like($like)->count_all_results();;
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
        
        $data['study_list'] = $this->db
            ->from('study')
            ->like($like)
            ->order_by('study.order desc, study.study_id desc, study.updatetime desc')
            ->join('study_catgory', 'study.catgory_id = study_catgory.catgory_id')
            ->limit($config['per_page'], $page)
            ->get()
            ->result_array();
        $data['study_catgory'] = $this->db->from('study')->group_by('study.catgory_id')->join('study_catgory','study.catgory_id = study_catgory.catgory_id')->get()->result_array();
        
        $this->load->view('manageroot/study_list', $data);
    }

    public function study_add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['cat_arr'] = $this->db->order_by('catgory_path')->get('study_catgory')->result_array();
        $study_rules = array(
            array(
                'field' => 'title',
                'label' => '标题',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'description',
                'label' => '描述',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'content',
                'label' => '内容',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($study_rules);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() === TRUE) {
            $sdata['catgory_id'] = $this->input->post('catgory_id');
            $sdata['title'] = $this->input->post('title');
            /*$sdata['keywords'] = $this->input->post('keywords');*/
            $sdata['description'] = $this->input->post('description');
            $sdata['content'] = $this->input->post('content');
            $sdata['click'] = 0;
            $sdata['order'] = 0;
            $sdata['addtime'] = time();
            $sdata['updatetime'] = time();

            if (is_uploaded_file($_FILES['cover_img']['tmp_name'])) {
                $picture_logo = $_FILES['cover_img'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $picture_logo["type"];
                $size = $picture_logo["size"];
                $tmp_name = $picture_logo["tmp_name"];
                $type_arr = explode('/', $type);

                $sdata['cover_img'] = $new_name = 'upload/study/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/study/study_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study/study_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if ($this->db->insert('study', $sdata)) {
                $message_data = array('status' => 200, 'msg' => '栏目添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/study/study_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study/study_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/study_add', $data);
        }

    }

    public function study_delete($id = "") {
        $id = (int)$id;
        if (empty($id) || !is_numeric($id)) {
            $message_data = array('status' => 0, 'msg' => '文档删除失败', 'choice' => array('add' => array('title' => '添加文档', 'url' => site_url('manageroot/study/study_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study/study_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            if ($this->db->delete('study', array('study_id' => $id))) {
                $message_data = array('status' => 200, 'msg' => '文档删除成功', 'choice' => array('add' => array('title' => '添加文档', 'url' => site_url('manageroot/study/study_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study/study_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '文档删除失败', 'choice' => array('add' => array('title' => '添加文档', 'url' => site_url('manageroot/study/study_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study/study_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        }
    }

    public function study_edit($id = "") {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['cat_arr'] = $this->db->order_by('catgory_path')->get('study_catgory')->result_array();

        $single_info = $data['single_info'] = $this->db->where(array('study_id' => $id))->get('study')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的文档', 'choice' => array('list' => array('title' => '返回列表重新选择编辑', 'url' => site_url('manageroot/study/study_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $study_rules = array(
                array(
                    'field' => 'title',
                    'label' => '标题',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'description',
                    'label' => '描述',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'content',
                    'label' => '内容',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($study_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $sdata['catgory_id'] = $this->input->post('catgory_id');
                $sdata['title'] = $this->input->post('title');
                /*$sdata['keywords'] = $this->input->post('keywords');*/
                $sdata['description'] = $this->input->post('description');
                $sdata['content'] = $this->input->post('content');
                /*$sdata['click'] = $this->input->post('click');
                $sdata['order'] = $this->input->post('order');*/
                $sdata['status'] = $this->input->post('status');
                $sdata['updatetime'] = time();

                if (is_uploaded_file($_FILES['cover_img']['tmp_name'])) {
                    $picture_logo = $_FILES['cover_img'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $picture_logo["type"];
                    $size = $picture_logo["size"];
                    $tmp_name = $picture_logo["tmp_name"];
                    $type_arr = explode('/', $type);

                    $sdata['cover_img'] = $new_name = 'upload/study/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/study/study_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study/study_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    } else {
                        if(!empty($single_info['cover_img'])) {
                            unlink($single_info['cover_img']);
                        }
                    }
                }

                if ($this->db->where(array('study_id' => $id))->update('study', $sdata)) {
                    if(!empty($sdata['cover_img'])) {
                        if(!empty($single_info['cover_img']) && file_exists($single_info['cover_img'])) {
                            unlink($single_info['cover_img']);
                        }
                    }
                    $message_data = array('status' => 200, 'msg' => '文档修改成功', 'choice' => array('add' => array('title' => '添加文档', 'url' => site_url('manageroot/study/study_add')), 'list' => array('title' => '返回文档列表查看', 'url' => site_url('manageroot/study/study_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/study_edit', $data);
            }
        }

    }


}