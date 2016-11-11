<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_log extends MY_Controller {

	public function log_list() {
		$this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/product_log/log_list?');

        $product_id = $this->input->get('product_id');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');

        if(!empty($keyword) || !empty($product_id)) {
            $data['product_id'] = $product_id;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'product_id='.$product_id.'&keyword='.$keyword;
            //判断是否为整数，是整数则为搜索的id
            if(is_numeric($keyword) && strpos($keyword,'.') == false) {
                $like = array('update_log.product_id' => $product_id, 'update_log.update_log_id' => $keyword);
            } else {
                $like = array('update_log.product_id' => $product_id, 'update_log.title' => $keyword);
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('update_log.update_log_id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->from('update_log')->like($like)->count_all_results();;
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
            ->from('update_log')
            ->like($like)
            ->order_by('update_log.product_id, update_log.log_time desc')
            ->join('product', 'product.product_id = update_log.product_id')
            ->limit($config['per_page'], $page)
            ->get()
            ->result_array();
        $data['product_catgory'] = $this->db->from('update_log')->group_by('update_log.product_id')->join('product','product.product_id = update_log.product_id')->get()->result_array();

		$this->load->view('manageroot/product_log_list', $data);
	}

	public function add() {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$log_rule = array(
			array(
	            'field'   => 'product_id', 
	            'label'   => '选择产品', 
	            'rules'   => 'required'
            ),
			array(
	            'field'   => 'log_time', 
	            'label'   => '填写日期', 
	            'rules'   => 'trim|required'
            ),
            array(
	            'field'   => 'title', 
	            'label'   => '日志标题', 
	            'rules'   => 'trim|required'
            ),
             array(
	            'field'   => 'desc', 
	            'label'   => '日志描述', 
	            'rules'   => 'trim|required'
            )
		);
		$this->form_validation->set_rules($log_rule);
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

		if ($this->form_validation->run() == TRUE) {
			$newdata['product_id'] = $this->input->post('product_id');
			$newdata['log_time'] = strtotime($this->input->post('log_time'));
			$newdata['year'] = date('Y',strtotime($this->input->post('log_time')));
			$newdata['title'] = $this->input->post('title');
			$newdata['desc'] = $this->input->post('desc');

			if ($this->db->insert('update_log', $newdata)) {
				$message_data = array('status' => 200, 'msg' => '日志添加成功', 'choice' => array('add' => array('title' => '继续添加', 'url' => site_url('manageroot/product_log/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product_log/log_list'))));
				$this->load->view('manageroot/message', $message_data);
			} else {
				$message_data = array('status' => 0, 'msg' => '日志添加失败', 'choice' => array('add' => array('title' => '重新添加', 'url' => site_url('manageroot/product_log/add')), 'list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product_log/log_list'))));
				$this->load->view('manageroot/message', $message_data);
			}
		} else {
			$data['product_list'] = $this->db->select('product_id, product_name')->order_by('product_id')->get('product')->result_array();
			$this->load->view('manageroot/product_log_add', $data);
		}

	}

	public function del_log($id = '') {
		$id = (int)$id;
		if ($id) {
			$single_info = $this->db->where(array('update_log_id' => $id))->get('update_log')->num_rows();
			if (empty($single_info)) {
				$message_data = array('status' => 0, 'msg' => '日志删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/product_log/log_list'))));
				$this->load->view('manageroot/message', $message_data);
			} else {
				if ($this->db->where(array('update_log_id' => $id))->delete('update_log')) {
					$message_data = array('status' => 200, 'msg' => '日志删除成功', 'choice' => array('list' => array('title' => '返回列表查看', 'url' => site_url('manageroot/product_log/log_list'))));
					$this->load->view('manageroot/message', $message_data);
				} else {
					$message_data = array('status' => 0, 'msg' => '日志删除失败', 'choice' => array('list' => array('title' => '返回列表重新执行', 'url' => site_url('manageroot/product_log/log_list'))));
					$this->load->view('manageroot/message', $message_data);
				}
			}
		}
	}

	public function edit_log($id = 0) {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$single_info = $data['single_info'] = $this->db->where(array('update_log_id' => $id))->get('update_log')->row_array();
		if (empty($single_info)) {
			$message_data = array('status' => 0, 'msg' => '不存在要编辑的日志', 'choice' => array('list' => array('title' => '返回日志列表重新选择编辑', 'url' => site_url('manageroot/product_log/log_list'))));
			$this->load->view('manageroot/message', $message_data);
		} else {
			$cate_rules = array(
				array(
		            'field'   => 'product_id', 
		            'label'   => '选择产品', 
		            'rules'   => 'required'
	            ),
				array(
		            'field'   => 'log_time', 
		            'label'   => '填写日期', 
		            'rules'   => 'trim|required'
	            ),
	            array(
		            'field'   => 'title', 
		            'label'   => '日志标题', 
		            'rules'   => 'trim|required'
	            ),
	            array(
		            'field'   => 'desc', 
		            'label'   => '日志描述', 
		            'rules'   => 'trim|required'
	            )
			);

			$this->form_validation->set_rules($cate_rules);
			$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');

			if ($this->form_validation->run() === TRUE) {
				$newdata['product_id'] = $this->input->post('product_id');
				$newdata['log_time'] = strtotime($this->input->post('log_time'));
				$newdata['year'] = date('Y',strtotime($this->input->post('log_time')));
				$newdata['title'] = $this->input->post('title');
				$newdata['desc'] = $this->input->post('desc');

				if ($this->db->where(array('update_log_id' => $id))->update('update_log', $newdata)) {
					$message_data = array('status' => 200, 'msg' => '日志修改成功', 'choice' => array('add' => array('title' => '添加日志', 'url' => site_url('manageroot/product_log/add')), 'list' => array('title' => '返回日志列表查看', 'url' => site_url('manageroot/product_log/log_list'))));
					$this->load->view('manageroot/message', $message_data);
				}
			}else{
				$data['product_list'] = $this->db->select('product_id, product_name')->order_by('product_id')->get('product')->result_array();
				$this->load->view('manageroot/product_log_edit', $data);
			}
		}
	}

}