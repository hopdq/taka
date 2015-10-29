<?php
require_once 'system/core/Model.php';
require_once 'application/models/Admin/TempListModel.php';
require_once 'application/models/Admin/ProductListFilter.php';
require_once 'Object/Admin/ProductBaseInfo.php';
require_once 'application/models/DataAccess/ProductDa.php';
class AdminProductModel extends CI_Model{
	public $listData;
	public $filter;
	public function __construct(){
		$this->listData = new TempListModel();
		$this->filter = new ProductListFilter();
	}
	public function Init($init = true){
		if($init)
		{
			$this->filter->BuildFilterModel();
		}
		$productDa = new ProductDa();
		$this->listData->PageModel->PageSize = 20;
		$productDa->GetProductList_Paging($this->listData,$this->filter);
	}
}