<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/UserBaseInfo.php';
class EditingUserModel extends CI_Model{
	public $editingUser;
	public $id;
	public function __construct() {
		$this->editingUser = new UserBaseInfo();
	}
	//
	public function Init($id) {
		$this->id = $id;
		$this->load->database('default');
		$this->db->select('Id, Name, Email');
		$this->db->where('Id', $id);
		$query = $this->db->get('User');
		$result = $query->result('UserBaseInfo');
		$user = $result[0];
		$this->editingUser = $user;
		$this->db->close();
	}
	//
	public function SetUserInfo($id, $userName) {
		$this->editingUser->Id = $id;
		$this->editingUser->Name = $userName;
	}
	//
	public function UpdateDb() {
		$this->load->database('default');
		$data = array(
	        'Name' => $this->editingUser->Name
		);
		$this->db->set($data);
		$this->db->where('Id', $this->editingUser->Id);
		$this->db->update('User');
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
}