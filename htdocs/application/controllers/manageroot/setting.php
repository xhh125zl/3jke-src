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

			if ($this->db->where($where)->update('company_info', $data)) {
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

            if ($this->db->where($where)->update('company_info', $data)) {
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

	//公司历史操作
	public function company_history_list() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

		$data['company_history'] = $this->db->where(array('company_id' => $company_info['company_id']))->order_by('history_time desc')->get('company_history')->result_array();
		$this->load->view('manageroot/company_history_list',$data);
	}

	public function company_history_add() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

		$this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                    'field' => 'history_time',
                    'label' => '时间',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'history_desc',
                    'label' => '简要描述',
                    'rules' => 'required'
                )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['company_id'] = $company_info['company_id'];
            $newdata['history_time'] = $this->input->post('history_time');
            $newdata['history_desc'] = $this->input->post('history_desc');

            if ($this->db->insert('company_history', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '公司历史添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/setting/company_history_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_history_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '公司历史添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_history_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_history_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/company_history_add');
        }

	}

	public function company_history_edit($id = 0) {
		$this->load->helper('form');
        $this->load->library('form_validation');

        $single_info = $data['single_info'] = $this->db->where(array('history_id' => $id))->get('company_history')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的公司历史日志', 'choice' => array('list' => array('title' => '返回公司历史列表重新选择编辑', 'url' => site_url('manageroot/setting/company_history_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'history_time',
                    'label' => '时间',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'history_desc',
                    'label' => '简要描述',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['history_time'] = $this->input->post('history_time');
                $newdata['history_desc'] = $this->input->post('history_desc');

                if ($this->db->where(array('history_id' => $id))->update('company_history', $newdata)) {
                    $message_data = array('status' => 200, 'msg' => '公司历史修改成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/setting/company_history_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_history_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '公司历史修改失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_history_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_history_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/company_history_edit', $data);
            }
        }

	}

	public function company_history_del($id = 0) {
		$id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('history_id' => $id))->get('company_history')->row_array();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '公司历史删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/company_history_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if ($this->db->where(array('history_id' => $id))->delete('company_history')) {
                    $message_data = array('status' => 200, 'msg' => '公司历史删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_history_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '公司历史删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/company_history_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }
	}

    //公司面貌
    public function company_face_list() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

        $data['company_face'] = $this->db->where(array('company_id' => $company_info['company_id']))->order_by('face_status desc, face_id')->get('company_face')->result_array();
        $this->load->view('manageroot/company_face_list',$data);
    }

    public function company_face_add() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                    'field' => 'face_title',
                    'label' => '图片标题',
                    'rules' => 'trim|required'
                )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['company_id'] = $company_info['company_id'];
            $newdata['face_title'] = $this->input->post('face_title');
            $newdata['face_status'] = $this->input->post('face_status');
            $newdata['order'] = $this->input->post('order');

            if (is_uploaded_file($_FILES['face_pic']['tmp_name'])) {
                $picture_logo = $_FILES['face_pic'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $picture_logo["type"];
                $size = $picture_logo["size"];
                $tmp_name = $picture_logo["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['face_pic'] = $new_name = 'upload/company/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_face_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_face_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if ($this->db->insert('company_face', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '公司面貌添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/setting/company_face_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_face_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                //信息写入失败，删除图片
                if(!empty($newdata['face_pic'])) {
                    unlink($newdata['face_pic']);
                }
                $message_data = array('status' => 0, 'msg' => '公司面貌添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_face_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_face_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/company_face_add');
        }

    }

    public function company_face_edit($id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $single_info = $data['single_info'] = $this->db->where(array('face_id' => $id))->get('company_face')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的公司面貌', 'choice' => array('list' => array('title' => '返回公司面貌列表重新选择编辑', 'url' => site_url('manageroot/setting/company_face_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'face_title',
                    'label' => '图片标题',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['face_title'] = $this->input->post('face_title');
                $newdata['face_status'] = $this->input->post('face_status');
                $newdata['order'] = $this->input->post('order');

                if (is_uploaded_file($_FILES['face_pic']['tmp_name'])) {
                    $picture_logo = $_FILES['face_pic'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $picture_logo["type"];
                    $size = $picture_logo["size"];
                    $tmp_name = $picture_logo["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['face_pic'] = $new_name = 'upload/company/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_face_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_face_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if ($this->db->where(array('face_id' => $id))->update('company_face', $newdata)) {
                    $message_data = array('status' => 200, 'msg' => '公司面貌修改成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/setting/company_face_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_face_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '公司面貌修改失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_face_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_face_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/company_face_edit', $data);
            }
        }

    }

    public function company_face_del($id = 0) {
        $id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('face_id' => $id))->get('company_face')->row_array();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '公司面貌删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/company_face_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if ($this->db->where(array('face_id' => $id))->delete('company_face')) {
                    $message_data = array('status' => 200, 'msg' => '公司面貌删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_face_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '公司面貌删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/company_face_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }
    }

	//公司招聘
	public function company_recruit_list() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

		$data['company_recruit'] = $this->db->order_by('order desc, recruit_id')->get('company_recruit')->result_array();
		$this->load->view('manageroot/company_recruit_list',$data);
	}

	public function company_recruit_add() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

		$this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                    'field' => 'recruit_post',
                    'label' => '招聘职位',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'post_desc',
                    'label' => '简要描述',
                    'rules' => 'required'
                )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['company_id'] = $company_info['company_id'];
            $newdata['recruit_post'] = $this->input->post('recruit_post');
            $newdata['post_desc'] = $this->input->post('post_desc');
            $newdata['order'] = $this->input->post('order');

            if ($this->db->insert('company_recruit', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '公司招聘添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/setting/company_recruit_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_recruit_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '公司招聘添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_recruit_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_recruit_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/company_recruit_add');
        }

	}

	public function company_recruit_edit($id = 0) {
		$this->load->helper('form');
        $this->load->library('form_validation');

        $single_info = $data['single_info'] = $this->db->where(array('recruit_id' => $id))->get('company_recruit')->row_array();

        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的公司招聘信息', 'choice' => array('list' => array('title' => '返回公司招聘信息列表重新选择编辑', 'url' => site_url('manageroot/setting/company_recruit_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'recruit_post',
                    'label' => '招聘职位',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'post_desc',
                    'label' => '简要描述',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['company_id'] = $single_info['company_id'];
                $newdata['recruit_post'] = $this->input->post('recruit_post');
	            $newdata['post_desc'] = $this->input->post('post_desc');
	            $newdata['order'] = $this->input->post('order');

                if ($this->db->where(array('recruit_id' => $id))->update('company_recruit', $newdata)) {
                    $message_data = array('status' => 200, 'msg' => '公司招聘信息修改成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/setting/company_recruit_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_recruit_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '公司招聘信息修改失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/company_recruit_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_recruit_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/company_recruit_edit', $data);
            }
        }

	}

	public function company_recruit_del($id = 0) {
		$id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('recruit_id' => $id))->get('company_recruit')->num_rows();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '公司招聘信息删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/company_recruit_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if ($this->db->where(array('recruit_id' => $id))->delete('company_recruit')) {
                    $message_data = array('status' => 200, 'msg' => '公司招聘信息删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/company_recruit_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '公司招聘信息删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/company_recruit_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }
	}

	public function qq_list() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/setting/qq_list?');

        $status = $this->input->get('status');
        $qq_class = $this->input->get('qq_class');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if($status != '' || $qq_class != '' || !empty($keyword)) {
            $data['status'] = $status;
            $data['qq_class'] = $qq_class;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'status='.$status.'&qq_class='.$qq_class.'&keyword='.$keyword;

            $like = array('serve_status' => $status, 'qq_class' => $qq_class, 'concat(`qq_name`, "#", `qq_code`)' => $keyword);

        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('serve_id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('serve_qq')->where(array('company_id' => $company_info['company_id']))->like($like)->count_all_results();;
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

        $data['qq_list'] = $this->db
                            ->from('serve_qq')
                            ->where(array('company_id' => $company_info['company_id']))
                            ->like($like)
                            ->order_by('qq_class, serve_status desc, savetime desc')
                            ->limit($config['per_page'], $page)
                            ->get()
                            ->result_array();

        $this->load->view('manageroot/qq_list', $data);
    }

    public function qq_add() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        $company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                    'field' => 'qq_name',
                    'label' => '客服名称',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'qq_code',
                    'label' => 'qq号码',
                    'rules' => 'trim|required|numeric'
                )
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['company_id'] = $company_info['company_id'];
            $newdata['qq_class'] = $this->input->post('qq_class');
            $newdata['qq_name'] = $this->input->post('qq_name');
            $newdata['qq_code'] = $this->input->post('qq_code');
            $newdata['serve_status'] = $this->input->post('serve_status');
            $newdata['addtime'] = time();
            $newdata['savetime'] = time();

            if ($this->db->insert('serve_qq', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/setting/qq_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/qq_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/setting/qq_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/qq_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/qq_add');
        }
    }

    public function qq_edit($id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $single_info = $data['single_info'] = $this->db->where(array('serve_id' => $id))->get('serve_qq')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑客服信息', 'choice' => array('list' => array('title' => '返回列表重新选择编辑', 'url' => site_url('manageroot/setting/qq_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'qq_name',
                    'label' => '客服名称',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'qq_code',
                    'label' => 'qq号码',
                    'rules' => 'trim|required|numeric'
                )
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['qq_class'] = $this->input->post('qq_class');
                $newdata['qq_name'] = $this->input->post('qq_name');
                $newdata['qq_code'] = $this->input->post('qq_code');
                $newdata['serve_status'] = $this->input->post('serve_status');
                $newdata['savetime'] = time();

                if ($this->db->where(array('serve_id' => $id))->update('serve_qq', $newdata)) {
                    $message_data = array('status' => 200, 'msg' => '客服信息修改成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/qq_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '客服信息修改失败', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/qq_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/qq_edit', $data);
            }
        }

    }

    public function qq_del($id = 0) {
        $id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('serve_id' => $id))->get('serve_qq')->row_array();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '客服信息删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/qq_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                if ($this->db->where(array('serve_id' => $id))->delete('serve_qq')) {
                    $message_data = array('status' => 200, 'msg' => '客服信息删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/setting/qq_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '客服信息删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/setting/qq_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }
    }

    
	
}