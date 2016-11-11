<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Study_video extends MY_Controller {

    public function video_list() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/study_video/video_list?');

        $status = $this->input->get('status');
        $catgory_id = $this->input->get('catgory_id');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if($status != '' || !empty($catgory_id) || !empty($keyword)) {
            $data['status'] = $status;
            $data['catgory_id'] = $catgory_id;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'status='.$status.'&catgory_id='.$catgory_id.'&keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('study_video.video_status' => $status, 'study_video.catgory_id' => $catgory_id, 'study_video.video_id' => $keyword);
            } else {
                $like = array('study_video.video_status' => $status, 'study_video.catgory_id' => $catgory_id, 'study_video.video_name' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('study_video.video_id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('study_video')->like($like)->count_all_results();;
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

        $data['video_list'] = $this->db
                                ->from('study_video')
                                ->like($like)
                                ->order_by('study_video.video_status desc, study_video.catgory_id, study_video.addtime desc')
                                ->join('study_catgory', 'study_video.catgory_id = study_catgory.catgory_id')
                                ->limit($config['per_page'], $page)
                                ->get()
                                ->result_array();
        $data['study_catgory'] = $this->db->from('study_video')->group_by('study_video.catgory_id')->join('study_catgory','study_video.catgory_id = study_catgory.catgory_id')->get()->result_array();
        
        $this->load->view('manageroot/study_video_list', $data);
    }

    public function video_add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $cate_rules = array(
            array(
                'field' => 'video_name',
                'label' => '视频名称',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'video_href',
                'label' => '视频链接',
                'rules' => 'trim|required|prep_url'
            )
        );

        $this->form_validation->set_rules($cate_rules);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        $data['catgory_list'] = $this->db->where(array('parent_id' => 2))->order_by('catgory_id')->get('study_catgory')->result_array();

        if ($this->form_validation->run() === TRUE) {
            $newdata['video_name'] = $this->input->post('video_name');
            $newdata['catgory_id'] = $this->input->post('catgory_id');
            /*$newdata['video_keyword'] = $this->input->post('video_keyword');*/
            $newdata['video_href'] = $this->input->post('video_href');
            $newdata['video_status'] = $this->input->post('video_status');
            $newdata['video_order'] = 0;
            $newdata['addtime'] = time();

            if (is_uploaded_file($_FILES['video_cover']['tmp_name'])) {
                $picture_logo = $_FILES['video_cover'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $picture_logo["type"];
                $size = $picture_logo["size"];
                $tmp_name = $picture_logo["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['video_cover'] = $new_name = 'upload/study/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/study_video/video_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_video/video_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if ($this->db->insert('study_video', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '视频添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/study_video/video_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_video/video_list'))));
                $this->load->view('manageroot/message', $message_data);
           
            } else {
                $message_data = array('status' => 0, 'msg' => '视频添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/study_video/video_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_video/video_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/study_video_add',$data);
        }
    }

    public function video_edit($id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $single_info = $data['single_info'] = $this->db->where(array('video_id' => $id))->get('study_video')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的视频资料', 'choice' => array('list' => array('title' => '返回列表重新选择编辑', 'url' => site_url('manageroot/study_video/video_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'video_name',
                    'label' => '视频名称',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'video_href',
                    'label' => '视频链接',
                    'rules' => 'trim|required|prep_url'
                )
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['video_name'] = $this->input->post('video_name');
                $newdata['catgory_id'] = $this->input->post('catgory_id');
                /*$newdata['video_keyword'] = $this->input->post('video_keyword');*/
                $newdata['video_href'] = $this->input->post('video_href');
                $newdata['video_status'] = $this->input->post('video_status');
                $newdata['video_order'] = 0;
                $newdata['addtime'] = time();

                if (is_uploaded_file($_FILES['video_cover']['tmp_name'])) {
                    $picture_logo = $_FILES['video_cover'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $picture_logo["type"];
                    $size = $picture_logo["size"];
                    $tmp_name = $picture_logo["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['video_cover'] = $new_name = 'upload/study/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('list' => array('title' => '返回列表重新操作', 'url' => site_url('manageroot/study_video/video_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if ($this->db->where(array('video_id' => $id))->update('study_video', $newdata)) {
                    if(!empty($newdata['video_cover'])) {
                        if(!empty($single_info['video_cover']) && file_exists($single_info['video_cover'])) {
                            unlink($single_info['video_cover']);
                        }
                    }
                    $message_data = array('status' => 200, 'msg' => '视频修改成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_video/video_list'))));
                    $this->load->view('manageroot/message', $message_data);
               
                } else {
                    if(!empty($newdata['video_cover'])) {
                        unlink($newdata['video_cover']);
                    }
                    $message_data = array('status' => 0, 'msg' => '视频修改失败', 'choice' => array('list' => array('title' => '返回列表重新操作', 'url' => site_url('manageroot/study_video/video_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $data['catgory_list'] = $this->db->where(array('parent_id'=>2))->order_by('catgory_id')->get('study_catgory')->result_array();
                $this->load->view('manageroot/study_video_edit', $data);
            }
        }
    }

    public function video_del($id = 0) {
        $id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('video_id' => $id))->get('study_video')->row_array();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '没有要删除的视频资料', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/study_video/video_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {

                if ($this->db->where(array('video_id' => $id))->delete('study_video')) {
                    if(!empty($single_info['video_cover']) && file_exists($single_info['video_cover'])) {
                        unlink($single_info['video_cover']);
                    }
                    $message_data = array('status' => 200, 'msg' => '视频删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/study_video/video_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '视频删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/study_video/video_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
   
            }
        }
    }



}