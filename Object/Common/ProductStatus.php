<?php
class ProductStatus{
	public $Id;
	public $Name;
	public function __construct($id, $name){
		$this->Id = $id;
		$this->Name = $name;
	}
}