<?php
require_once 'application/models/UI/ProductGridModel.php';
require_once 'application/models/UI/CategoryListModel.php';
class CategoryModel extends CI_Model{
	public $infor;
	public $grid;
	public $childCategories;
	public function __construct(){
		parent::__construct();
	}
	public function init($filter, $sort, $paging){
		$this->grid = new ProductGridModel();
		$this->grid->init($filter, $sort, $paging, 'category');
		$this->childCategories = new CategoryListModel();
		$this->childCategories->init($filter->categoryId);
	}
}