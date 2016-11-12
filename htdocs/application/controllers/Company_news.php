<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_news extends Front_Controller {

	public function index()
	{
		$data = $this->keywords();
		$first_value = intval(explode('.', $this->uri->segment(3))[0]);
        if ($first_value > 0) {
            $data['study_content'] = $this->db
                                    ->where(array('study_id' => $first_value, 'status' => 1))
                                    ->get('study')
                                    ->row_array();
        } else {
            $catgory_id = 3;

            //解析$p 为分页做准备
            $this->load->library('pagination');
            $config['base_url'] = site_url('company_news/index/p/');
            $config['total_rows'] = $this->db
                                    ->from('study')
                                    ->where(array('catgory_id' => $catgory_id, 'status' => 1))
                                    ->order_by('addtime desc')
                                    ->count_all_results();
            $config['per_page'] = 10;
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

            $data['company_news'] = $this->db
                                    ->from('study')
                                    ->where(array('catgory_id' => $catgory_id, 'status' => 1))
                                    ->order_by('addtime desc')
                                    ->limit($config['per_page'], (int)$this->uri->segment(4))
                                    ->get()
                                    ->result_array();

            $data['pages'] = $this->pagination->create_links();
        } 

		$data['webTitle'] = '公司动态';

		$this->load->view('pc/company_news', $data);

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
        $data['search_keywords'] = $this->db
                                    ->from('study')
                                    ->where(array('study.status' => 1))
                                    ->join('study_catgory', 'study.catgory_id = study_catgory.catgory_id')
                                    ->like('study_catgory.catgory_path', '0-1-', 'after')
                                    ->order_by('study.click desc, study.addtime desc')
                                    ->limit(3)
                                    ->get()
                                    ->result_array();
        return $data;
	}

	public function search()
	{
        $keyword = $data['keyword'] = trim($this->input->get('keyword'));

        if(!empty($keyword)) {
            //收集搜索关键字
            $res = $this->db->where(array('search_word' => $keyword))->get('search_keyword')->row_array();
            if(!empty($res)) {
                $this->db->where(array('keyword_id' => $res['keyword_id']))->update('search_keyword', array('search_num' => $res['search_num']+1));
            } else {
                $this->db->insert('search_keyword', array('search_word' => $keyword));
            }
        }

		$data = $this->keywords();
        $like = array('study.title' => $keyword);
		//分页处理
		$this->load->library('pagination');
		
        $config['base_url'] = site_url('company_news/search/?keyword='.$keyword);
        
        $page = $this->input->get('per_page');

        $config['total_rows'] = $this->db->select('*')->from('study')->where(array('status' => 1))->like($like)->count_all_results();;
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
        
        $data['study_list'] = $this->db
					            ->from('study')
					            ->where(array('study.status' => 1))
					            ->like($like)
					            ->join('study_catgory', 'study.catgory_id = study_catgory.catgory_id')
					            ->order_by('study.click desc, study.addtime desc')
					            ->limit($config['per_page'], $page)
					            ->get()
					            ->result_array();
		$this->load->view('pc/company_news', $data);
	}
}
