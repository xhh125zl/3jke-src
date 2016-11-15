<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends Front_Controller {

    public function catgory()
    {
        //获取三个关键字
        $catgory_id = 6;
        $data['question_catgory'] = $this->db
                                    ->from('study_catgory')
                                    ->where(array('parent_id' => $catgory_id))
                                    ->order_by('catgory_id')
                                    ->get()
                                    ->result_array();
        return $data;
    }

	public function index()
	{
		$data = $this->catgory();
        $act = $this->uri->segment(3);
		$first_value = intval(explode('.', $this->uri->segment(4))[0]);
        if ($act == 'study' && $first_value > 0) {
            $data['question_con'] = $this->db
                                    ->where(array('study_id' => $first_value, 'status' => 1))
                                    ->get('study')
                                    ->row_array();
        } else {
            $catgory_id = 6;
            if ($act == 'cate' && $first_value > 0) {
                $catgory_type = array('study.catgory_id' => $first_value);
            } else {
                $catgory_type = '';
            }

            //解析$p 为分页做准备
            $this->load->library('pagination');
            $config['base_url'] = site_url('help/index/p/');
            $config['total_rows'] = $this->db
                                    ->from('study')
                                    ->join('study_catgory', 'study.catgory_id = study_catgory.catgory_id')
                                    ->where(array('study_catgory.parent_id' => $catgory_id))
                                    ->order_by('study.addtime desc')
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
                                    ->join('study_catgory', 'study.catgory_id = study_catgory.catgory_id')
                                    ->where(array('study_catgory.parent_id' => $catgory_id))
                                    ->order_by('study.addtime desc')
                                    ->limit($config['per_page'], (int)$this->uri->segment(4))
                                    ->get()
                                    ->result_array();

            $data['pages'] = $this->pagination->create_links();
        } 

		$data['webtitle'] = '帮助中心';

		$this->load->view('pc/help', $data);

		/*//判断是否为手机登录
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()) {
			$this->load->view('mobile/distribution', $data);
		} else {
			$this->load->view('pc/distribution', $data);
		}*/
	}

	public function search()
	{
        $data = $this->catgory();

        $catgory_id = 6;

        $keyword = $data['keyword'] = trim($this->input->get('keyword'));
        $like = array('study.title' => $keyword);

		//分页处理
		$this->load->library('pagination');
		
        $config['base_url'] = site_url('help/search/?keyword='.$keyword);
        
        $page = $this->input->get('per_page');

        $config['total_rows'] = $this->db
                                    ->from('study')
                                    ->join('study_catgory', 'study.catgory_id = study_catgory.catgory_id')
                                    ->where(array('study_catgory.parent_id' => $catgory_id))
                                    ->like($like)
                                    ->order_by('study.addtime desc')
                                    ->count_all_results();;
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
                                ->join('study_catgory', 'study.catgory_id = study_catgory.catgory_id')
                                ->where(array('study_catgory.parent_id' => $catgory_id))
				                ->like($like)
					            ->order_by('click desc, addtime desc')
					            ->limit($config['per_page'], $page)
					            ->get()
					            ->result_array();

        $data['webtitle'] = '帮助中心';

		$this->load->view('pc/help', $data);
	}
}
