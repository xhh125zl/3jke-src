<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Study_catgory extends MY_Controller {

    public function catgory_list() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/study_catgory/catgory_list?');

        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if(!empty($keyword)) {
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('catgory_id' => $keyword);
            } else {
                $like = array('catgory_name' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('catgory_id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('study_catgory')->like($like)->count_all_results();
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

        $data['catgory_list'] = $this->db
                            ->from('study_catgory')
                            ->like($like)
                            ->order_by('catgory_path')
                            ->limit($config['per_page'], $page)
                            ->get()
                            ->result_array();

        $this->load->view('manageroot/catgory_list', $data);
    }

    public function catgory_add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $cate_rules = array(
            array(
                'field' => 'catgory_name',
                'label' => '栏目名称',
                'rules' => 'trim|required'
            )
        );

        $this->form_validation->set_rules($cate_rules);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() === TRUE) {
            $newdata['catgory_name'] = $this->input->post('catgory_name');
            $newdata['parent_id'] = $this->input->post('parent_id');
            $newdata['addtime'] = time();

            if ($this->db->insert('study_catgory', $newdata)) {
                //获取新增加的数据的主键
                $new_catgory_id = $this->db->insert_id();
                
                if($newdata['parent_id'] == 0) {
                    $otherdata['catgory_path'] = '0-'.$new_catgory_id;
                    $otherdata['catgory_grade'] = 0;
                } else {
                    $parent_info = $this->db->select('catgory_path, catgory_grade')->where(array('catgory_id'=>$newdata['parent_id']))->get('study_catgory')->row_array();
                    $otherdata['catgory_path'] = $parent_info['catgory_path'].'-'.$new_catgory_id;
                    $otherdata['catgory_grade'] = $parent_info['catgory_grade'] + 1;
                }
                //更新数据
                if($this->db->where(array('catgory_id' => $new_catgory_id))->update('study_catgory', $otherdata)) {
                    $message_data = array('status' => 200, 'msg' => '分类添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/study_catgory/catgory_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    //不成功则删除不完整的数据
                    $this->db->where(array('catgory_id' => $new_catgory_id))->delete('study_catgory');
                    $message_data = array('status' => 0, 'msg' => '分类添加失败', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/study_catgory/catgory_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $message_data = array('status' => 0, 'msg' => '分类添加失败', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/study_catgory/catgory_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/catgory_add');
        }
    }

    public function catgory_edit($id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $single_info = $data['single_info'] = $this->db->where(array('catgory_id' => $id))->get('study_catgory')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的栏目', 'choice' => array('list' => array('title' => '返回列表重新选择编辑', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'catgory_name',
                    'label' => '分类名称',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['catgory_name'] = $this->input->post('catgory_name');

                if ($this->db->where(array('catgory_id' => $id))->update('study_catgory', $newdata)) {
                    $message_data = array('status' => 200, 'msg' => '栏目修改成功', 'choice' => array('add' => array('title' => '添加栏目', 'url' => site_url('manageroot/study_catgory/catgory_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/catgory_edit', $data);
            }
        }
    }

    public function catgory_del($id = 0) {
        $id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('catgory_id' => $id))->get('study_catgory')->num_rows();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '栏目删除失败', 'choice' => array('list' => array('title' => '返回分类列表重新执行', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $catgory_info = $this->db->where(array('parent_id'=>$id))->get('study_catgory')->num_rows();
                $study_info = $this->db->where(array('catgory_id'=>$id))->get('study')->num_rows();
                if(empty($study_info) && empty($catgory_info)) {
                    if ($this->db->where(array('catgory_id' => $id))->delete('study_catgory')) {
                        $message_data = array('status' => 200, 'msg' => '栏目删除成功', 'choice' => array('list' => array('title' => '返回分类列表查看', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    } else {
                        $message_data = array('status' => 0, 'msg' => '栏目删除失败', 'choice' => array('list' => array('title' => '返回分类列表重新执行', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                } else {
                    $message_data = array('status' => 0, 'msg' => '此分类下有文章，请清空后再删除此分类', 'choice' => array('add' => array('title' => '文档列表', 'url' => site_url('manageroot/study/study_list')),'list' => array('title' => '返回分类列表重新执行', 'url' => site_url('manageroot/study_catgory/catgory_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }    
            }
        }
    }

}