<?php
class FilterSelectedModel extends CI_Model{
	public $categoryId;
	public $providerId;
	public $price;
	public $attrValues;
	public function __construct(){
		parent::__construct();
	}
}