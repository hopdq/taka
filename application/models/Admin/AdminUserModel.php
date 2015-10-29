<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/UserBaseInfo.php';
class AdminUserModel extends CI_Model{
	public $listUsers;
	public function __construct() {
		$listUsers = array();
	}
	//
	public function Init() {
		$this->load->database('default');
		$this->db->select('Id, Name, Email, CreateDate');
		$query = $this->db->get('User');
		$result = $query->result('UserBaseInfo');
		$this->db->close();
		$this->listUsers = $result;
	}
}