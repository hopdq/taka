<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/UserBaseInfo.php';
class AddingUserModel extends CI_Model{
	public $addingUser;
	public function __construct() {
		parent::__construct();
		$this->addingUser = new UserBaseInfo();
	}
	public function SetUserInfo($userName, $email, $password){
		$this->addingUser->Name = $userName;
		$this->addingUser->Email = $email;
		$this->addingUser->Password = $password;
	}
	//
	public function Insert2Db(){
		$this->load->database('default');
		$this->db->select('max(cast(Id as decimal)) as MaxId');
		$query = $this->db->get('User');
		$row = $query->row();
		if(isset($row))
		{
			$this->addingUser->Id = $row->MaxId + 1;
		}
		else{
			$this->addingUser->Id = 1;
		}
		$this->db->close();
		
		$this->load->database('default');
		$newUser = array(
				'Id' => $this->addingUser->Id,
				'Name' => $this->addingUser->Name,
				'Email' => $this->addingUser->Email,
				'Password' => $this->addingUser->Password
		);
		$this->db->set('CreateDate', 'NOW()', FALSE);
		$this->db->insert('User', $newUser);
		$this->load->helper('date');
		$timeFomat = "%Y/%m/%d";
		$time = time();
		$date = mdate($timeFomat, $time);
		$this->addingUser->CreateDate = $date;
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
	//
	public function Init() {
		$this->load->database('default');
		$this->db->select('Id, Name, Email, CreateDate');
		$query = $this->db->get('User');
		$result = $query->result('UserBaseInfo');
		$this->db->close();
	}
	
}