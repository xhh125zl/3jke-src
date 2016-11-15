<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends Front_Controller {

	public function index()
	{
		$data = $this->keywords();
		$first_value = intval(explode('.', $this->uri->segment(3))[0]);
        if ($first_value > 0) {
            $data['question_con'] = $this->db
                                    ->where(array('study_id' => $first_value, 'status' => 1))
                                    ->get('study')
                                    ->row_array();
        } else {
            $catgory_id = 6;

            //解析$p 为分页做准备
            $this->load->library('pagination');
            $config['base_url'] = site_url('help/index/p/');
            $config['total_rows'] = $this->db
                                    ->from('study')
                                    ->where(array('catgory_id' => $catgory_id, 'status' => 1))
                                    ->order_by('addtime desc')
                                    ->count_all_results();
            $config['per_page'] = 15;
            $config['num_links'] = 4;
            $config['uri_segment'] = 4;

            $config['first_link'] = '';
            $config['last_link'] = '';

            $config['full_tag_open'] = '<div class="seepage"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['prev_link'] = '<<';
            $config['prev_tag_open'] = '<div class="pageup">';
            $config['prev_tag_close'] = '</div>';

            $config['next_link'] = '>>';
            $config['next_tag_open'] = '<div class="pagedown">';
            $config['next_tag_close'] = '</div>';

            $config['cur_tag_open'] = '<li class="nowpage">';
            $config['cur_tag_close'] = '</li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $config['use_page_numbers'] = FALSE;
            
            $this->pagination->initialize($config);

            $data['question_list'] = $this->db
                                    ->from('study')
                                    ->where(array('catgory_id' => $catgory_id, 'status' => 1))
                                    ->order_by('addtime desc')
                                    ->limit($config['per_page'], (int)$this->uri->segment(4))
                                    ->get()
                                    ->result_array();

            $data['pages'] = $this->pagination->create_links();
        } 

		$data['webtitle'] = '常见问题';

		$this->load->view('pc/help', $data);

		/*//判断是否为手机登录
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()) {
			$this->load->view('mobile/distribution', $data);
		} else {
			$this->load->view('pc/distribution', $data);
		}*/
	}

	public function keywords()
	{
		//获取三个关键字
        $catgory_id = 6;
        $data['search_keywords'] = $this->db
                                    ->from('study')
                                    ->where(array('catgory_id' => $catgory_id, 'status' => 1))
                                    ->order_by('click desc, addtime desc')
                                    ->limit(3)
                                    ->get()
                                    ->result_array();
        return $data;
	}

	public function search()
	{
        $data = $this->keywords();

        $catgory_id = 6;

        $keyword = $data['keyword'] = trim($this->input->get('keyword'));
        $like = array('title' => $keyword);

		//分页处理
		$this->load->library('pagination');
		
        $config['base_url'] = site_url('help/search/?keyword='.$keyword);
        
        $page = $this->input->get('per_page');

        $config['total_rows'] = $this->db->select('*')->from('study')->where(array('catgory_id' => $catgory_id, 'status' => 1))->like($like)->count_all_results();;
        $config['per_page'] = 15;
        $config['num_links'] = 4;
        //$config['uri_segment'] = 7;
        $config['use_page_numbers'] = false;    //必须false
        $config['page_query_string'] = true;    //必须为true

        $config['first_link'] = '';
        $config['last_link'] = '';

        $config['full_tag_open'] = '<div class="seepage"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['prev_link'] = '<<';
        $config['prev_tag_open'] = '<div class="pageup">';
        $config['prev_tag_close'] = '</div>';

        $config['next_link'] = '>>';
        $config['next_tag_open'] = '<div class="pagedown">';
        $config['next_tag_close'] = '</div>';

        $config['cur_tag_open'] = '<li class="nowpage">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        
        $data['question_list'] = $this->db
					            ->from('study')
					            ->where(array('catgory_id' => $catgory_id, 'status' => 1))
					            ->like($like)
					            ->order_by('click desc, addtime desc')
					            ->limit($config['per_page'], $page)
					            ->get()
					            ->result_array();

        $data['webtitle'] = '常见问题';

		$this->load->view('pc/help', $data);
	}
}
