<?php
require_once 'Object/Admin/BannerBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
require_once 'application/models/DataAccess/ImageDa.php';
require_once 'application/models/Admin/UserLoginModel.php';
require_once 'application/models/Admin/AdminBannerModel.php';
require_once 'application/models/Admin/AddingBannerModel.php';
require_once 'application/models/Admin/DeletingBannerModel.php';

//
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminBanner extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	//
	public function Index() {
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		$temp['title']="Quản lí banner"; 
		$temp['content_view']='Admin/AdminBanner/Index'; 
		$content = null;
		$data = new AdminMasterModel();
		$data->Init($content, adminParentMenuEnum::Banner, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp); 
	}
	//
	public function GetBannersList() {
		$adminBanner = new AdminBannerModel();
		$adminBanner->Init();
		$bannersList = $adminBanner->bannersList;
		$bannersListString = json_encode($bannersList);
		echo $bannersListString;
	}
	//
	public function AddBanner() {
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		$temp['title']="Thêm mới banner"; 
		$temp['content_view']='Admin/AdminBanner/AddBanner'; 
		$content = null;
		$data = new AdminMasterModel();
		$data->Init($content, adminParentMenuEnum::Banner, adminChildMenuEnum::Add);
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
	public function AddingBannerProcess() {
		$imgsJsonData = $this->input->post('imgsData', true);
		$imgs = json_decode($imgsJsonData);
		$newBanners = array();
		$lenImgs = count($imgs);
		for ($i = 0; $i < $lenImgs; $i ++) {
			$newBanners[$i] = new BannerBaseInfo();
			$newBanners[$i]->UrlPath = $imgs[$i]->UrlPath;
			$newBanners[$i]->Link = $imgs[$i]->Link;
			$newBanners[$i]->Title = $imgs[$i]->Title;
			$newBanners[$i]->Code = $imgs[$i]->Code;
		}
		$addingBanners = new AddingBannerModel();
		$addingBanners->Init($newBanners);
		$result = $addingBanners->Update2Db();
		echo $result;
	}
	//
	public function DeleteBanner() {
		$id = $this->input->post('deletedId', true);
		$banner = new DeletingBannerModel();
		$banner->Init($id);
		$result = $banner->Update2Db();
		echo $result;
	}
}