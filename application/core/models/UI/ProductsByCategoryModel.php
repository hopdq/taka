<?php 
require_once 'application/models/DataAccess/ProductDa.php';
require_once 'application/models/UI/ProductItemModel.php';
class ProductsByCategoryModel{
	public $categoryId;
	public $limit;
	public $sort;
	public $products;
	public function __construct(){

	}
	public function init($categoryId, $limit, $sort){
		$this->categoryId = $categoryId;
		$this->limit = $limit;
		$this->sort = $sort;
		$this->products = array();
		$productDa = new ProductDa();
		$productsGet = $productDa->getProductByCategorySort($this->categoryId, $sort, $limit);
		if(isset($productsGet) && count($productsGet) >= 3){
			foreach ($productsGet as $product) {
				$productStd = new ProductItemModel();
				$productStd->init($product);
				array_push($this->products, $productStd);
			}
			return true;
		}
		return false;
	}
}