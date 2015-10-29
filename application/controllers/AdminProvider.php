<?php
//
require_once 'Object/Admin/ProviderBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
require_once 'application/models/Admin/AdminProviderModel.php';
require_once 'application/models/Admin/AddingProviderModel.php';
require_once 'application/models/Admin/EditingProviderModel.php';
require_once 'application/models/Admin/DeletingProviderModel.php';
require_once 'application/models/Admin/UserLoginModel.php';
require_once 'application/models/DataAccess/ImageDa.php';


//
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminProvider extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	//
	public function Index() {
		//check admin login
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		//end check
		$temp['title']="Danh sách nhà cung cấp";
		$temp['content_view']='Admin/AdminProvider/index';
		$data = new AdminMasterModel();
		$content = null;
		$data->Init($content, adminParentMenuEnum::Provider, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp);
	}
	//
	public function GetData() {
		$adminProvider = new AdminProviderModel();
		$adminProvider->Init();
		$providersList = $adminProvider->providersList;
		$data = json_encode($providersList);
		echo $data;
	}
	//
	public function AddProvider() {
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		$temp['title']="Thêm mới nhà cung cấp sản phẩm"; 
		$temp['content_view']='Admin/AdminProvider/AddProvider'; 
		$content = null;
		$data = new AdminMasterModel();
		$data->Init($content, adminParentMenuEnum::Provider, adminChildMenuEnum::Add);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp); 
	}
	//
	public function FileUpload(){
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];
			$targetPath = getcwd() . '/uploads/';
			$targetFile = $targetPath . $fileName ;
			move_uploaded_file($tempFile, $targetFile);
			$path = 'uploads/'.$fileName;
			$this->load->helper('url');
			$fullPath = base_url($path);
			$result = array(
				0 => $path,
				1 => $fullPath
			);
			$jsonResult = json_encode($result);
			echo $jsonResult;
		}
		//
	}
	//
	public function AddingProviderProcess() {
		$newProviderData = $this->input->post('proData', true);
		$newPro = json_decode($newProviderData);
		$addingPro = new AddingProviderModel();
		$addingPro->Init($newPro);
		$result = $addingPro->Update2Db();
		echo $result;
	}
	//
	public function EditProvider($proId) {
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		$temp['title']="Sửa thông tin nhà cung cấp sản phẩm"; 
		$temp['content_view']='Admin/AdminProvider/EditProvider'; 
		$data = new AdminMasterModel();
		$content = $proId;
		$data->Init($content, null, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp);
	}
	public function EditingProviderProcess() {
		$newProviderData = $this->input->post('newProJsonData', true);
		$newData = json_decode($newProviderData);
		$id = $newData->Id;
		$code = $newData->Code;
		$name = $newData->Name;
		$logoUrl = $newData->LogoUrl;
		$descript = $newData->Description;
		$editingProvider = new EditingProviderModel();
		$result = $editingProvider->Update2Db($id, $code, $name, $logoUrl, $descript);
		echo $result;
	}
	//
	public function GetProviderData($id) {
		$model = new EditingProviderModel();
		$model->Init($id);
		$curProData = json_encode($model->curPro);
		echo $curProData;
	}
	//
	public function DeleteProvider() {
		$proId = $this->input->post('proId', true);
		$deletingProvider = new DeletingProviderModel();
		$result = $deletingProvider->Update2Db($proId);
		echo $result;
	}
}