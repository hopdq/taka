<?php
class CategoryBaseInfo{
	public $Id;
	public $Name;
	public $ParentId;
	public $Order;
	public $listChilds;
	public function __construct(){
		$this->listChilds = array();
	}
	//
	public function Init($id, $name, $parentId, $order) {
		$this->Id = $id;
		$this->Name = $name;
		$this->ParentId  = $parentId;
		$this->Order = $order;
		$this->listChilds = array();
	}
}