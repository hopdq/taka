<?php
require_once 'application/models/DataAccess/ProductDa.php';
require_once 'application/models/UI/ProductDetailModel.php';
require_once 'application/models/UI/FrontMasterModel.php';
class ProductDetail extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function Index($productId){
		$productDa = new ProductDa();
		$data = $productDa->getShortInfor($productId);
		$temp['title']= $data->Code.'-'.$data->Name;
		$temp['data'] = $data;
		$temp['loadDataUrl'] = site_url(array('ProductDetail', 'loadData', $productId, $data->CategoryId, $data->ProviderId));
		$temp['loadRelateProducts'] = site_url(array('ProductDetail', 'loadData', $data->CategoryId));
		if(isset($data->ProviderId))
		{
			$temp['loadSameProviderProducts'] = site_url(array('ProductDetail', 'loadData', $data->ProviderId));
		}
		$temp['content_view']='Front/ProductDetail/Index';
		$this->load->view("Front/Shared/_Layout",$temp);
	}
	public function loadData($productId, $categoryId, $providerId){
		$model = new FrontMasterModel();
		$body = new ProductDetailModel($productId, $categoryId, $providerId);
		$body->init();
		$model->init($body);
		$result = json_encode($model);
		echo $result;
	}
	public function loadRelateProducts($categoryId){
		
	}
	public function loadSameProviderProducts($providerId){

	}
}