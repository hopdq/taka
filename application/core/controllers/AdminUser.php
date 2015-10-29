<?php
require_once 'Object/Admin/UserBaseInfo.php';
require_once 'application/models/Admin/EditingUserModel.php';
require_once 'application/models/Admin/AdminMasterModel.php';
require_once 'application/models/Admin/AdminUserModel.php';
require_once 'application/models/Admin/AddingUserModel.php';
require_once 'application/models/Admin/ChangingPasswordUserModel.php';
require_once 'application/models/Admin/UserLoginModel.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminUser extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function Index(){
		//check admin login
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		//end check
		$temp['title']="Danh sách người dùng";
		$temp['content_view']='Admin/AdminUser/Index';
		$data = new AdminMasterModel();
		$content = new AdminUserModel();
		$content->Init();
		$data->Init($content, adminParentMenuEnum::User, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp);
	}
	public function EditUser($id){
		$data = new AdminMasterModel();
		$content = new EditingUserModel();
		$content->Init($id);
		$data->Init($content, adminParentMenuEnum::User, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/AdminUser/EditingUser",$temp);
	}
	
	public function EditProcess(){
		$id = $this->input->post("id", true);
		$newName = $this->input->post("username", true);
		$model = new EditingUserModel();
		$model->SetUserInfo($id, $newName);
		$result = $model->UpdateDb();
		if ($result == 0) {
			echo -1;
		}	else {
			$data = array('Name' => $newName, 'Id' => $id );
			echo json_encode($data);
		}
	}
	//
	public function DeleteUser($id) {
		$this->load->database('default');
		$this->db->select('Id');
		$this->db->where('Id', $id);
		$this->db->delete('User');
		$result = $this->db->affected_rows();
		$this->db->close();
		echo $result; 
	}
	//
	public function ChangePassword($id) {
		$data = new AdminMasterModel();
		$content = new ChangingPasswordUserModel();
		$content->Init($id);
		$data->Init($content, adminParentMenuEnum::User, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/AdminUser/ChangingPasswordUser",$temp);
	}
	//
	public function ChangePasswordProcess() {
		$id = $this->input->post("id", true);
		$password = md5($this->input->post("password", true));
		$confirmPassword = md5($this->input->post("passwordConfirm", true));
		if ($password != $confirmPassword) {
			return null;
		} else {
			$model = new ChangingPasswordUserModel();
			$model->SetUserInfo($id, $password);
			$result = $model->UpdateDb();
			if ($result == 0) {
				echo -1;
			}	else {
				echo 1;
			}
		}
	}
	//
	public function AddUser() {
		$data = new AdminMasterModel();
		$content = new AddingUserModel();
		$content->Init();
		$data->Init($content, adminParentMenuEnum::User, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/AdminUser/AddingUser",$temp);
	}
	//

	public function AddingProcess() {
		//
		$name = $this->input->post("username", true);
		$email = $this->input->post("email", true);
		$password = md5($this->input->post("password", true));
		$confirmPassword = md5($this->input->post("passwordConfirm", true));
		if ($password != $confirmPassword) {
			return null;
		} else {
			$model = new AddingUserModel();
			$model->SetUserInfo($name, $email, $password);
			$id = $model->addingUser->Id;
			$result = $model->Insert2Db();
			if ($result == 0) {
				echo -1;
			} else {
				$data = new AdminMasterModel();
				$content = $model;
				$data->Init($content, adminParentMenuEnum::User, adminChildMenuEnum::ListManagement);
				$temp['data'] = $data;
				$this->load->view("Admin/AdminUser/UpdateUserList", $temp);
			}
		}
	}
}