<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends Front_Controller {

	public function index()
	{
		$data['webtitle'] = '关于我们';

        $this->load->view('pc/aboutus', $data);
	}

}