<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Join extends MY_Controller {

    public function join_list() {
        if($this->session->userdata('role') == 1) {
            $user_id = 0;
        } else {
            $user_id = $this->session->userdata('loginid');
        }
        //$company_info = $this->db->select('company_id')->where(array('user_id' => $user_id))->get('company_info')->row_array();

        $this->load->library('pagination');
        $config['base_url'] = site_url('manageroot/join/join_list?');

        $object = $this->input->get('object');
        $keyword = trim($this->input->get('keyword'));
        $page = $this->input->get('per_page');
        if($object == '' && !empty($keyword)) {
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'keyword='.$keyword;

            $like = array('concat(`join_name` , "#" , `join_phone` , "#" , `join_email` , "#" , `join_qq` , "#" , `join_company` , "#" , `join_address`)' => $keyword);
        } else if($object != '' && !empty($keyword)) {
            $data['object'] = $object;
            $data['keyword'] = $keyword;           
            $config['base_url'] .= 'object='.$object.'&keyword='.$keyword;

            switch($object) {
                case 1: $like = array('join_name' => $keyword); break;
                case 2: $like = array('join_phone' => $keyword); break;
                case 3: $like = array('join_email' => $keyword); break;
                case 4: $like = array('join_qq' => $keyword); break;
                case 5: $like = array('join_company' => $keyword); break;
                case 6: $like = array('join_address' => $keyword); break;
            }
        } else {
            //$config['base_url'] .= 'keyword=';
            $like = array('id' => '');
        }

        $config['total_rows'] = $this->db->select('*')->where(array('user_id' => $user_id))->from('join')->like($like)->count_all_results();

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

        $data['join_list'] = $this->db
                        ->from('join')
                        ->where(array('user_id' => $user_id))
                        ->like($like)
                        ->order_by('addtime desc, id desc')
                        ->limit($config['per_page'], $page)
                        ->get()
                        ->result_array();

        $this->load->view('manageroot/join_list', $data);
    }
    
}