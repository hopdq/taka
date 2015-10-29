<?php
require_once 'application/models/UI/ProductGridModel.php';
class ProviderModel extends CI_Model{
	public $infor;
	public $grid;
	public function __construct(){
		parent::__construct();
	}
	public function init($filter, $sort, $paging){
		$this->grid = new ProductGridModel();
		$this->grid->init($filter, $sort, $paging, 'provider');
	}
}