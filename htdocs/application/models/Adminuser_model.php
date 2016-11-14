<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminuser_model extends CI_Model{
	function __construct(){
  		parent::__construct();
	}

	/**
	 * 根据传递参数获取不同的信息
	 *
	 * $table 要查询的数据表 $field 要查询该表的字段（默认全部查询） $where 查询条件
	 * return 该数据集的数组表达方式
	 */
	function get_field_values($table, $field = '*', $where = '')
	{
		if(empty($table)) return FALSE;

		$q = $this->db->select($field)->where($where)->get($table, 1);

		return $q->row_array();
	}
}


/* End of file adminuser_model.php */
/* Location: ./application/controllers/adminuser_model.php */