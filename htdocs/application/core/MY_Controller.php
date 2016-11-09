<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *自定义全局类
 */
class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$data['action'] = $this->uri->segment(1);
		$data['method'] = $this->uri->segment(2);
		$this->load->vars($data);
	}

}
