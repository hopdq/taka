<?php
require_once 'application/models/DataAccess/CategoryDa.php';
class HomeModel extends CI_Model{
	public $listCategories;
	public function __construct(){
		parent::__construct();
		$this->listCategories = array();
	}
	public function init(){
		$categoryDa = new CategoryDa();
		$categories = $categoryDa->getLv1Categories();
		if(isset($categories) && count($categories) > 0){
			foreach ($categories as $cate) {
				$cate->listProducts =  new ProductsByCategoryModel();
				$check = $cate->listProducts->init($cate->Id, 4, 'NEW_OLD');
				if($check){
					array_push($this->listCategories, $cate);
				}
			}
		}
	}
}