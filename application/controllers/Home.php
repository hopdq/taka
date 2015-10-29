<?php
require_once 'application/models/UI/ProductsByCategoryModel.php';
require_once 'application/models/UI/FrontMasterModel.php';
require_once 'application/models/UI/HomeModel.php';
require_once 'application/models/UI/HomeBannerModel.php';
class Home extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	//index action
	public function Index(){
		$temp['title']="Trang chủ";
		$temp['content_view']='Front/Home/Index';
		$temp['data'] = null;
		$temp['cateBoxSortingUrl'] = site_url(array('Home', 'getProductsByCategorySort'));
		$temp['loadDataUrl'] = site_url(array('Home', 'loadData'));
		$temp['loadBannerUrl'] = site_url(array('Home', 'getBanner'));
		$this->load->view("Front/Shared/_Layout",$temp);
	}
	//load initial data for home page
	public function loadData(){
		$model = new FrontMasterModel();
		$body = new HomeModel();
		$body->init();
		$model->init($body);
		$result = json_encode($model);
		echo $result;
	}
	//load products data for category box has sort
	public function getProductsByCategorySort(){
		$categoryId = $this->input->get('categoryId', true);
		$limit = 4;
		$sort = $this->input->get('sort', true);
		$listProducts = new ProductsByCategoryModel();
		$listProducts->init($categoryId, $limit, $sort);
		$result = json_encode($listProducts);
		echo $result;
	}
	//load banner
	public function getBanner(){
		$homeBanner = new HomeBannerModel();
		$homeBanner->init();
		$result = json_encode($homeBanner);
		echo $result;
	}
	//load products data for category box has sort
	public function getProductsByCategorySortTest(){
		$categoryId = '1';
		$limit = 5;
		$sort = null;
		$listProducts =  new ProductsByCategoryModel();
		$listProducts->init($categoryId, $limit, $sort);
		$result = json_encode($listProducts);
		echo $result;
	}
}