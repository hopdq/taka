<?php 
require_once 'system/core/Model.php';
class UserLoginModel extends CI_Model{
	private $email;
	private $password;
	public function __construct(){
		$this->load->library('session');
		$this->load->database('default');
	}
	public function init($inEmail, $inPassword){
		$this->email = $inEmail;
		$this->password = $inPassword;
	}
	public function CheckLogin(){
		$sql = "select Id, Name from User where lower(Email) = lower(?) and Password = ?;";
		$query = $this->db->query($sql, array($this->email, md5($this->password)));
		$result = $query->row();
		$this->db->close();
		return $result;
	}
	public function getUserInSession(){
		$result = null;
		if($this->session->has_userdata('adminUserLogin')){
			$result = $this->session->userdata('adminUserLogin');
		}
		return $result;
	}
	public function checkUserIsLogined(){
		return $this->session->has_userdata('adminUserLogin');
	}
	public function setAdminUserLoginSession($user){
		$this->session->set_userdata('adminUserLogin', $user);
	}
	public function clearUserLoginSession(){
		$this->session->unset_userdata('adminUserLogin');
	}
}