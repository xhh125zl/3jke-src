<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

    public function product_list() {
        $data['list'] = $this->db->select('*')->order_by('order, product_id')->get('product')->result_array();
        $this->load->view('manageroot/product_list', $data);
    }

    public function add() {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $log_rule = array(
            array(
                'field' => 'product_name',
                'label' => '产品名称',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'method_name',
                'label' => '调用名称',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'product_desc',
                'label' => '产品描述',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'order',
                'label' => '排序',
                'rules' => 'numeric'
            ),
        );
        $this->form_validation->set_rules($log_rule);
        $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

        if ($this->form_validation->run() == TRUE) {
            $newdata['product_name'] = $this->input->post('product_name');
            $newdata['method_name'] = $this->input->post('method_name');
            $newdata['product_desc'] = $this->input->post('product_desc');
            $newdata['order'] = $this->input->post('order');

            if (is_uploaded_file($_FILES['product_cover']['tmp_name'])) {
                $product_cover = $_FILES['product_cover'];
                $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                $type = $product_cover["type"];
                $size = $product_cover["size"];
                $tmp_name = $product_cover["tmp_name"];
                $type_arr = explode('/', $type);

                $newdata['product_cover'] = $new_name = 'upload/product/' . $name . '.' . $type_arr[count($type_arr) - 1];

                if (!move_uploaded_file($tmp_name, $new_name)) {
                    $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/product/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product/product_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }

            if ($this->db->insert('product', $newdata)) {
                $message_data = array('status' => 200, 'msg' => '产品添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/product/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product/product_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                $message_data = array('status' => 0, 'msg' => '产品添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/product/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product/product_list'))));
                $this->load->view('manageroot/message', $message_data);
            }
        } else {
            $this->load->view('manageroot/product_add');
        }

    }

    /*public function del_product($id = 0) {
        $id = (int)$id;
        if ($id) {
            $single_info = $this->db->where(array('product_id' => $id))->get('product')->row_array();
            if (empty($single_info)) {
                $message_data = array('status' => 0, 'msg' => '产品删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/product/product_list'))));
                $this->load->view('manageroot/message', $message_data);
            } else {
                //删除图片 成功后删除信息
                if (unlink($single_info['product_cover'])) {
                    if ($this->db->where(array('product_id' => $id))->delete('product')) {
                        $message_data = array('status' => 200, 'msg' => '产品删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product/product_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    } else {
                        $message_data = array('status' => 0, 'msg' => '产品删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/product/product_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                } else {
                    $message_data = array('status' => 0, 'msg' => '产品删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/product/product_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            }
        }
    }*/

    public function product_edit($id = 0) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $single_info = $data['single_info'] = $this->db->where(array('product_id' => $id))->get('product')->row_array();
        if (empty($single_info)) {
            $message_data = array('status' => 0, 'msg' => '不存在要编辑的产品', 'choice' => array('list' => array('title' => '返回产品列表重新选择编辑', 'url' => site_url('manageroot/product/product_list'))));
            $this->load->view('manageroot/message', $message_data);
        } else {
            $cate_rules = array(
                array(
                    'field' => 'product_name',
                    'label' => '产品名称',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'product_desc',
                    'label' => '产品描述',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'order',
                    'label' => '排序',
                    'rules' => 'numeric'
                ),
            );

            $this->form_validation->set_rules($cate_rules);
            $this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

            if ($this->form_validation->run() === TRUE) {
                $newdata['product_name'] = $this->input->post('product_name');
                $newdata['product_desc'] = $this->input->post('product_desc');
                $newdata['order'] = $this->input->post('order');

                if (is_uploaded_file($_FILES['product_cover']['tmp_name'])) {
                    $product_cover = $_FILES['product_cover'];
                    $name = date('YmdHis', time()) . '_' . sprintf('%02d', rand(0, 999));
                    $type = $product_cover["type"];
                    $size = $product_cover["size"];
                    $tmp_name = $product_cover["tmp_name"];
                    $type_arr = explode('/', $type);

                    $newdata['product_cover'] = $new_name = 'upload/product/' . $name . '.' . $type_arr[count($type_arr) - 1];

                    if (!move_uploaded_file($tmp_name, $new_name)) {
                        $message_data = array('status' => 0, 'msg' => '图片上传失败', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product/product_list'))));
                        $this->load->view('manageroot/message', $message_data);
                    }
                }

                if ($this->db->where(array('product_id' => $id))->update('product', $newdata)) {
                    //删除旧图片
                    if(!empty($newdata['product_cover'])) {
                        if (!empty($single_info['product_cover']) && file_exists($single_info['product_cover'])) {
                            unlink($single_info['product_cover']);
                        }
                    }

                    $message_data = array('status' => 200, 'msg' => '产品修改成功', 'choice' => array('list' => array('title' => '返回产品列表查看', 'url' => site_url('manageroot/product/product_list'))));
                    $this->load->view('manageroot/message', $message_data);
                } else {
                    $message_data = array('status' => 0, 'msg' => '产品修改失败', 'choice' => array('list' => array('title' => '返回产品列表重新选择编辑', 'url' => site_url('manageroot/product/product_list'))));
                    $this->load->view('manageroot/message', $message_data);
                }
            } else {
                $this->load->view('manageroot/product_edit', $data);
            }
        }


    }
}