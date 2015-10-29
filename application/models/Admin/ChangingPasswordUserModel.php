<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/UserBaseInfo.php';
class ChangingPasswordUserModel extends CI_Model{
	public $changingPasswordUser;
	public $id;
	public function __construct() {
		$this->changingPasswordUser = new UserBaseInfo();
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
		$this->changingPasswordUser = $user;
		$this->db->close();
	}
	//
	public function SetUserInfo($id, $passWord) {
		$this->changingPasswordUser->Id = $id;
		$this->changingPasswordUser->Password = $passWord;
	}
	//
	public function UpdateDb() {
		$this->load->database('default');
		$data = array(
	        'Password' => $this->changingPasswordUser->Password
		);
		$this->db->set($data);
		$this->db->where('Id', $this->changingPasswordUser->Id);
		$this->db->update('User');
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
}