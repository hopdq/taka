<?php
require_once 'application/models/Admin/AdminProductModel.php';
require_once 'application/models/Admin/AdminMasterModel.php';
require_once 'application/models/Admin/AddProductModel.php';
require_once 'application/models/Business/ProductBl.php';
require_once 'application/models/DataAccess/ImageDa.php';
require_once 'application/models/DataAccess/AttributeValueDa.php';
require_once 'application/models/Admin/UserLoginModel.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminProduct extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function Index(){
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		$temp['title']="Danh sách sản phẩm"; 
		$temp['content_view']='Admin/AdminProduct/Index'; 
		$content = new AdminProductModel();
		$content->Init();
		$data = new AdminMasterModel();
		$data->Init($content, adminParentMenuEnum::Product, adminChildMenuEnum::ListManagement);
		$temp['data'] = $data;
		$this->load->view("Admin/Shared/_Layout",$temp); 
	}
	//load data for list product in filter, paging
	public function LoadData(){
		$keyword = $this->input->post('keyword', true);
		$categoryId = $this->input->post('categoryId', true);
		$status = $this->input->post('status', true);
		$page = $this->input->post('page', true);
		$data = new AdminProductModel();
		$data->filter->SetFilter($keyword, $categoryId, $status);
		$data->listData->PageModel->Page = $page;
		$data->listData->PageModel->PageSize = 20;
		$data->Init(false);
		$model['data'] = $data->listData;
		$this->load->view("Admin/AdminProduct/ProductList", $model);
	}
	public function AddProduct(){
		$model["title"] = "Thêm mới sản phẩm";
		$model["content_view"] = "Admin/AdminProduct/ProductDetail";
		$data = new AdminMasterModel();
		$data->Init(null, adminParentMenuEnum::Product, adminChildMenuEnum::Add);
		$model["data"] = $data;
		$this->load->view("Admin/Shared/_Layout", $model);
	}
	public function EditProduct($productId){
		$model["title"] = "Thêm mới sản phẩm";
		$model["content_view"] = "Admin/AdminProduct/ProductDetail";
		$content = null;
		if(isset($productId))
		{
			$content = $productId;
		}
		$data = new AdminMasterModel();
		$data->Init($content, adminParentMenuEnum::Product, adminChildMenuEnum::ListManagement);
		$model["data"] = $data;
		$this->load->view("Admin/Shared/_Layout", $model);
	}
	public function ProductAdminDetailData(){
		$productId = $this->input->get('productId', true);
		$model = new AddProductModel();
		$model->Init("0", "0", "0", $productId);
		echo json_encode($model);
	}
	public function DeleteProduct(){
		$id = $this->input->post('id', true);
		$result = 0;
		if($id != null && $id != ''){
			$productDa = new ProductDa();
			$result = $productDa->delProductByListId($id);
		}
		else{
			$result = 0;
		}
		echo $result;
	}
	public function FileUpload(){
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];
			$targetPath = getcwd() . '/uploads/';
			$targetFile = $targetPath . $fileName ;
			move_uploaded_file($tempFile, $targetFile);
			$path = 'uploads/'.$fileName;
			$imageDa = new ImageDa();
			$imgId = $imageDa->InsertImg($path);
			$this->load->helper('url');
			$fullPath = base_url($path);
			$result = array(
				0 => $imgId,
				1 => $fullPath
			);
			$jsonResult = json_encode($result);
			echo $jsonResult;
		}
	}
	public function createProduct(){
		$data = $this->input->post("product", false);
		try {
			$product = json_decode($data);
			$productBl = new ProductBl();
			$result = $productBl->insertProduct($product);
			$jsonResult = json_encode($result);
			echo $jsonResult;
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	public function updateProduct(){
		$data = $this->input->post("product", false);
		try {
			$product = json_decode($data);
			$productBl = new ProductBl();
			$result = $productBl->updateProduct($product);
			$jsonResult = json_encode($result);
			echo $jsonResult;
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	public function updateAttr(){
		$productId = $this->input->post("productId", true);
		$attrData = $this->input->post("attr", true);
		$imgData = $this->input->post("img", true);
		try {
			$attr = json_decode($attrData);
			$img = json_decode($imgData);
			$attrValueDa = new AttributeValueDa();
			$attrResult = $attrValueDa->updateAttributeValues($productId, $attr);
			$imageDa = new ImageDa();
			$imageResult = $imageDa->updateProductImage($productId, $img);
			$result = $attrResult + $imageResult;
			echo $result;
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	public function updateTest(){
		$data = '{"Id":"5","Code":"MG01","Name":"Máy giặt Sharp","CategoryId":"0","Price":"5000000","Summary":"Máy giặt Sharp","Description":"<p>M&aacute;y giặt Sharp</p>\n","PromotionValue":"14","IsPercentPromotion":"1","PromotionDesc":null,"Status":"CONHANG","ProviderId":"1"}';
		$product = json_decode($data);
		$productBl = new ProductBl();
		$result = $productBl->updateProduct($product);
		$jsonResult = json_encode($result);
		echo $jsonResult;
	}
	public function createTest(){
		$data = '{"CategoryId":"1","Status":"CONHANG","ProviderId":"1","Code":"TV04","Name":"Sản phẩm mới","Price":"100000","PromotionValue":"10","IsPercentPromotion":true,"PromotionDesc":"Sản phẩm mới"}';
		$product = json_decode($data);
		$productBl = new ProductBl();
		$result = $productBl->insertProduct($product);
		var_dump($result);
	}
	public function updateAttributeTest(){
		$productId = '3';
		$attrData = '["1","2","10","11"]';
		$imgData = '{"tempImgIds":[52],"defaultImgId":0}';
		try {
			$attr = json_decode($attrData);
			$img = json_decode($imgData);
			$attrValueDa = new AttributeValueDa();
			$attrResult = $attrValueDa->updateAttributeValues($productId, $attr);
			$imageDa = new ImageDa();
			$imageResult = $imageDa->updateProductImage($productId, $img);
			$result = $attrResult + $imageResult;
			echo $result;
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	public function listImgsGetTest(){
		$productId = '5';
		$data = '["1","3","4"]';
		$attr = json_decode($data);
		$da = new AttributeValueDa();
		$result = $da->updateAttributeValues($productId, $attr);
		echo $result;
	}
	public function uploadTest(){
		$path = 'uploads/test.png';
		$imageDa = new ImageDa();
		$imgId = $imageDa->InsertImg($path);
		$this->load->helper('url');
		$fullPath = base_url($path);
		$result = array(
			0 => $imgId,
			1 => $fullPath
		);
		$jsonResult = json_encode($result);
		echo $jsonResult;
	}
	public function deleteTest(){
		$id = '12,10';
		$result = 0;
		if($id != null && $id != ''){
			$productDa = new ProductDa();
			$result = $productDa->delProductByListId($id);
		}
		else{
			$result = 0;
		}
		echo $result;
	}
}