<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_case extends MY_Controller {

    public function case_list() {
        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/customer_case/case_list?');

        $product_id = $this->input->get('product_id');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if(!empty($keyword) || !empty($product_id)) {
            $data['product_id'] = $product_id;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'product_id='.$product_id.'&keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('customer_case.product_id' => $product_id, 'customer_case.id' => $keyword);
            } else {
                $like = array('customer_case.product_id' => $product_id, 'customer_case.case_name' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('customer_case.id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('customer_case')->like($like)->count_all_results();;
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

        $data['list'] = $this->db
            ->from('customer_case')
            ->like($like)
            ->order_by('customer_case.product_id')
            ->join('product', 'product.product_id=customer_case.product_id')
            ->limit($config['per_page'], $page)
            ->get()
            ->result_array();
        $data['product_catgory'] = $this->db->from('customer_case')->group_by('customer_case.product_id')->join('product','product.product_id = customer_case.product_id')->get()->result_array();

        $this->load->view('manageroot/case_list', $data);
    }

    public function case_add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $study_rules = array(
            array(
                'field' => 'case_name',
                'label' => '案例名称',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($study_rules);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        $data['product_arr'] = $this->db->select('product_id,product_name')->get('product')->result_array();

        if ($this->form_validation->run() === TRUE) {
            $newdata['product_id'] = $this->input->post('product_id');
            $newdata['case_name'] = $this->input->post('case_name');
            $newdata['order'] = 0;

            if (is_uploaded_file($_FILES['case_pic']['tmp_name'])) {
                $product_cover = $_FILES['case_pic'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $product_cover["type"];
                $size = $product_cover["size"];
                $tmp_name = $product_cover["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['case_pic'] = $new_name = 'upload/case/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/customer_case/case_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/customer_case/category'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if (is_uploaded_file($_FILES['customer_QRcode']['tmp_name'])) {
                $product_cover = $_FILES['customer_QRcode'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $product_cover["type"];
                $size = $product_cover["size"];
                $tmp_name = $product_cover["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['customer_QRcode'] = $new_name = 'upload/case/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/customer_case/case_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/customer_case/case_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if (is_uploaded_file($_FILES['customer_logo']['tmp_name'])) {
                $product_cover = $_FILES['customer_logo'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $product_cover["type"];
                $size = $product_cover["size"];
                $tmp_name = $product_cover["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['customer_logo'] = $new_name = 'upload/case/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/customer_case/case_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/customer_case/case_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if ($this->db->insert('customer_case', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/customer_case/case_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/customer_case/case_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/case_add', $data);
        }

    }

    public function case_delete($id = "") {
        $id = (int)$id;
        if (empty($id) || !is_numeric($id)) {
            $message_data = array('status' => 0, 'msg' => '删除失败', 'choice' => array('list' => array('title' => '返回列表重新操作', 'url' => site_url('manageroot/customer_case/case_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            if ($this->db->delete('customer_case', array('id' => $id))) {
                $message_data = array('status' => 200, 'msg' => '删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/customer_case/case_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '删除失败', 'choice' => array('list' => array('title' => '返回列表重新操作', 'url' => site_url('manageroot/customer_case/case_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        }
    }

    public function case_edit($id = "") {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['single_info'] = $single_info = $this->db->where(array('id' => $id))->get('customer_case')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的案例', 'choice' => array('list' => array('title' => '返回列表重新选择编辑', 'url' => site_url('manageroot/customer_case/case_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $data['product_arr'] = $this->db->select('product_id,product_name')->get('product')->result_array();
            $study_rules = array(
                array(
                    'field' => 'case_name',
                    'label' => '案例名称',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($study_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['product_id'] = $this->input->post('product_id');
                $newdata['case_name'] = $this->input->post('case_name');
                $newdata['order'] = 0;

                if (is_uploaded_file($_FILES['case_pic']['tmp_name'])) {
                    $product_cover = $_FILES['case_pic'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $product_cover["type"];
                    $size = $product_cover["size"];
                    $tmp_name = $product_cover["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['case_pic'] = $new_name = 'upload/case/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('list' => array('title' => '返回列表重新操作', 'url' => site_url('manageroot/customer_case/category'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if (is_uploaded_file($_FILES['customer_QRcode']['tmp_name'])) {
                    $product_cover = $_FILES['customer_QRcode'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $product_cover["type"];
                    $size = $product_cover["size"];
                    $tmp_name = $product_cover["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['customer_QRcode'] = $new_name = 'upload/case/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('list' => array('title' => '返回列表重新操作', 'url' => site_url('manageroot/customer_case/case_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if (is_uploaded_file($_FILES['customer_logo']['tmp_name'])) {
                    $product_cover = $_FILES['customer_logo'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $product_cover["type"];
                    $size = $product_cover["size"];
                    $tmp_name = $product_cover["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['customer_logo'] = $new_name = 'upload/case/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('list' => array('title' => '返回列表重新操作', 'url' => site_url('manageroot/customer_case/case_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if ($this->db->where(array('id' => $id))->update('customer_case', $newdata)) {
                    $message_data = array('status' => 200, 'msg' => '修改成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/customer_case/case_add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/customer_case/case_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/case_edit', $data);
            }

        }


    }


}