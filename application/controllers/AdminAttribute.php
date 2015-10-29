<?php
require_once 'application/models/Admin/AdminMasterModel.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'application/models/Admin/AdminAttributeModel.php';
require_once 'application/models/Admin/AddingAttributeValueModel.php';
require_once 'application/models/Admin/DeletingAttributeValueModel.php';
require_once 'application/models/Admin/EditingAttributeValueModel.php';
require_once 'application/models/Admin/AddingAttributeModel.php';
require_once 'application/models/Admin/DeletingAttributeModel.php';
require_once 'application/models/Admin/SynchingValueModel.php';
require_once 'application/models/Admin/EditingAttributeModel.php';
require_once 'application/models/Admin/UserLoginModel.php';

//
/**
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminAttribute extends  CI_Controller {
	
	function __construct() {
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
		$temp['title']="Danh sách thuộc tính";
		$temp['content_view']='Admin/AdminAttribute/Index';
		$data = new AdminMasterModel();
		$content = null;
		$data->Init($content, adminParentMenuEnum::Attribute, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp);
	}

	public function GetData(){
		$model = new AdminAttributeModel();
		$model->Init();
		$result = json_encode($model->attributesList);
		echo $result;
	}
	//
	public function AddAttributeValue() {
		$attrId = $this->input->post('attrId', true);
		$attrValue = $this->input->post('attrValue', true);
		$newAttr = new AddingAttributeValueModel();
		$newAttr->Init($attrId, $attrValue);
		$result = $newAttr->Update2Db();
		echo $result;
	}
	//
	public function DeleteAttributeValue() {
		$attrValueId = $this->input->post('attrValueId', true);
		$deletedAttrValue = new DeletingAttributeValueModel();
		$result = $deletedAttrValue->DeleteAttrValue($attrValueId);
		echo $result;
	}
	//
	public function EditAttributeValue() {
		$valId = $this->input->post('attrValId', true);
		$newVal = $this->input->post('attrNewVal', true);
		$editingAttr = new EditingAttributeValueModel();
		$result = $editingAttr->EditValue($valId, $newVal);
		echo $result;
	}
	//
	public function AddAttribute() {
		$attrCode = $this->input->post('newAttrCode', true);
		$attrName = $this->input->post('newAttrName', true);
		$newAttr = new AddingAttributeModel();
		$newAttr->Init($attrCode, $attrName);
		$result = $newAttr->Update2Db();
		echo $result;
	}
	//
	public function DeleteAttribute() {
		$deletedId = $this->input->post('deletedId', true);
		$deletedAttribute = new DeletingAttributeModel();
		$deletedAttribute->Init($deletedId);
		$result = $deletedAttribute->DeleteAttribute();
		echo $result;
	}
	//
	public function SynchValue() {
		$valId = $this->input->post('valId', true);
		$synVal = new SynchingValueModel();
		$result = $synVal->GetData($valId);
		echo $result;
	}
	//
	public function EditAttribute() {
		$attrId = $this->input->post('attrId', true);
		$attrCode = $this->input->post('attrCode');
		$attrName = $this->input->post('attrName');
		$editingAttr = new EditingAttributeModel();
		$editingAttr->Init($attrId);
		$result = $editingAttr->Update2Db($attrCode, $attrName);
		echo $result;
	}
}