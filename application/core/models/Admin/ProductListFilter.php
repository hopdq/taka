<?php
require_once 'application/models/Common/CategoryDropdownModel.php';
require_once 'application/models/Common/StatusDropdownModel.php';
class ProductListFilter extends CI_Model{
	public $keyword;
	public $categoryId;
	public $status;
	public $categoryFilter;
	public $statusFilter;
	public function __construct(){
		$this->keyword = null;
		$this->categoryId = null;
		$this->status = null;
	}
	public function SetFilter($keyword, $categoryId, $status){
		$this->keyword = $keyword;
		$this->categoryId = $categoryId;
		$this->status = $status;
	}
	public function BuildFilterModel(){
		$this->categoryFilter = new CategoryDropdownModel("0");
		$this->statusFilter = new StatusDropdownModel("0");
	}
}