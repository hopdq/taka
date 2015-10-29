<?php
require_once 'Object/Admin/CategoryBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
require_once 'application/models/Admin/AdminCategoryModel.php';
require_once 'application/models/Admin/AddingCategoryModel.php';
require_once 'application/models/Admin/HintOrderModel.php';
require_once 'application/models/Admin/DeleteCategoryModel.php';
require_once 'application/models/Admin/EditingCategoryModel.php';
require_once 'application/models/Admin/UserLoginModel.php';
//
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminCategory extends CI_Controller{
	public function __construct() {
		parent::__construct();
	}
	//
	public function Index(){
		//check admin login
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		//end check
		$temp['title']="Danh sách phân loại sản phẩm";
		$temp['content_view']='Admin/AdminCategory/Index';
		$data = new AdminMasterModel();
		$content = new AdminCategoryModel();
		$content->Init();
		$data->Init($content, adminParentMenuEnum::Category, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp);
	}
	//
	public function AddCategory() {
		$data = new AdminMasterModel();
		$content = new AddingCategoryModel();
		$content->Init();
		$data->Init($content, adminParentMenuEnum::Category, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/AdminCategory/AddingCategory",$temp);
	}
	//
	public function HintOrder($parentId) {
		$model = new HintOrderModel();
		$hintOrder = $model->GetHintOrder($parentId);
		return $hintOrder;
		//
	}
	//
	public function GetHintOrder($parentId) {
		echo $this->HintOrder($parentId);
	}
	//
	public function AddingCategoryProcess() {
		//
		$categoryname = $this->input->post("categoryname", true);
		$parentId = $this->input->post("parentId", true);
		$order = $this->input->post("categoryOrder", true);
		$hintOrder = $this->HintOrder($parentId);
		$model = new AddingCategoryModel();
		$model->SetCategoryInfo($categoryname, $parentId, $order, $hintOrder);
		$id = $model->addingCategory->Id;
		$result = $model->Insert2Db();
		if ($result == 0) {
			echo -1;
		} else {
			$data = new AdminMasterModel();
			$content = new AdminCategoryModel();
			$content->Init();
			$temp['data'] = $content;
			$this->load->view("Admin/AdminCategory/NewCategoryList", $temp);
		}
	}
	//
	public function DeleteCategory($id) {
		$model = new DeleteCategoryModel();
		$model->Init($id);
		$tmpCate = $model->deletingCategory;
		$result1 = $model->DeleteCategory($id);
		$result2 = $model->ChangeOrderBrothersList($tmpCate);
		$data = new AdminMasterModel();
		$content = new AdminCategoryModel();
		$content->Init();
		$temp['data'] = $content;
		$this->load->view("Admin/AdminCategory/NewCategoryList",$temp);
	}
	//
	public function EditCategory( $id ) {
		$data = new AdminMasterModel();
		$content = new EditingCategoryModel();
		$content->Init($id);
		$data->Init($content, adminParentMenuEnum::User, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/AdminCategory/EditingCategory",$temp);
	}
	//
	public function EditingCategoryProcess() {
		//
		$categoryId = $this->input->post("categoryId", true);
		$categoryName = $this->input->post("categoryname", true);
		$parentId = $this->input->post("parentId", true);
		$order = $this->input->post("categoryOrder", true);
		$hintOrder = $this->HintOrder($parentId);
		$editingCategoryModel = new EditingCategoryModel();
		$editingCategoryModel->Init($categoryId);
		$result = $editingCategoryModel->SetNewInfo($categoryName, $parentId, $order, $hintOrder);
		if ($result == 0) {
			echo -1;
		} else {
			$data = new AdminMasterModel();
			$content = new AdminCategoryModel();
			$content->Init();
			$temp['data'] = $content;
			$this->load->view("Admin/AdminCategory/NewCategoryList", $temp);
		}
	}
}