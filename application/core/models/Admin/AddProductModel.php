<?php
require_once 'application/models/Common/CategoryDropdownModel.php';
require_once 'application/models/Common/StatusDropdownModel.php';
require_once 'application/models/Common/ProviderDropdownModel.php';
require_once 'application/models/Common/AttributeForProductModel.php';
require_once 'application/models/Common/ImageByProductModel.php';
require_once 'application/models/DataAccess/ProductDa.php';
class AddProductModel extends CI_Model{
	public $listCategoriesModel;
	public $listStatusesModel;
	public $listProvidersModel;
	public $product;
	public $listAttrValues;
	public $listImgs;
	public function __construct(){
		parent::__construct();
	}
	public function Init($cateId, $sttId, $providerId, $productId){
		$this->listCategoriesModel = new CategoryDropdownModel($cateId);
		$this->listStatusesModel = new StatusDropdownModel($sttId);
		$this->listProvidersModel = new ProviderDropdownModel($providerId);
		$this->listAttrValues = new AttributeForProductModel($productId);
		$this->listImgs = new ImageByProductModel($productId);
		if($productId != null && $productId != "" && $productId != "0"){
			$productDa = new ProductDa();
			$this->product = $productDa->GetSingleItem($productId);
		}
	}
	public function SaveProduct(){
		if($this->product->Id == null || $this->product->Id <= 0){
			$this->InsertProduct();
		}
		else{
			$this->UpdateProduct();
		}
	}
	public function InsertProduct(){
		$da = new ProductDa();
		$result = $da->InsertProduct($this->product);
		return result;
	}
	public function UpdateProduct(){
		$da = new ProductDa();
		$result = $da->UpdateProduct($this->product);
		return result;
	}
}