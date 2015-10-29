<?php
require_once 'application/models/DataAccess/ProductDa.php';
require_once 'application/models/DataAccess/CategoryDa.php';
require_once 'application/models/UI/FilterSelectedModel.php';
require_once 'application/models/UI/PagingModel.php';
require_once 'application/models/UI/PriceFilterModel.php';
require_once 'application/models/UI/CategoryModel.php';
require_once 'application/models/UI/FrontMasterModel.php';
class Category extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function Index($categoryId){
		$temp['title']="Danh mục sản phẩm";
		$temp['content_view']='Front/Category/Index';
		$temp['data'] = $categoryId;
		$temp['loadDataUrl'] = site_url(array('Category', 'loadData', $categoryId));
		$temp['loadGridData'] = site_url(array('Category', 'loadGridData'));
		$this->load->view("Front/Shared/_Layout",$temp);
	}
	//load initial data for home page
	public function loadData($categoryId){
		$model = new FrontMasterModel();
		$body = new CategoryModel();
		$filter = new FilterSelectedModel();
		$filter->categoryId = $categoryId;
		$sort = 'OLD_NEW';
		$paging = new PagingModel(1, 12);
		$body->init($filter, $sort, $paging);
		$model->setCategoryId($categoryId);
		$model->init($body);
		$result = json_encode($model);
		echo $result;
	}

	//load initial data for home page
	public function loadGridData(){
		$input = $this->input->get('input', true);
		$data = json_decode($input);
		$paging = new PagingModel($data->paging->page, $data->paging->itemsGet);
		$grid = new ProductGridModel();
		$grid->init($data->filter, $data->sorter, $paging, 'category');
		$jsonResult = json_encode($grid);
		echo $jsonResult;
	}
	public function testGridGetDa(){
		$input = '{"paging":{"page":1,"startIndex":0,"itemsGet":5,"totalItems":"3","totalPages":1},"filter":{"categoryId":"1","providerId":null,"price":{"from":"3000000","to":"4300000"},"attrValues":[{"attrId":"3","value":"10"}]},"sorter":"OLD_NEW"}';
		$data = json_decode($input);
		$paging = new PagingModel($data->paging->page, $data->paging->itemsGet);
		$grid = new ProductGridModel();
		$grid->init($data->filter, $data->sorter, $paging);
		$jsonResult = json_encode($grid);
		echo $jsonResult;
	}

	public function testFilters(){
		$productDa = new ProductDa();
		$filter = new FilterSelectedModel();
		$filter->categoryId = '1';
		$attrValue = null;
		$attrValue->attrId = '1';
		$attrValue->value = '1';
		$attrValue2 = null;
		$attrValue2->attrId = '3';
		$attrValue2->value = '10';
		$filter->attrValues = array(1 => $attrValue,2 => $attrValue2);
		$sort = 'OLD_NEW';
		$result = $productDa->getFilters($filter);
		var_dump($result);
	}
}