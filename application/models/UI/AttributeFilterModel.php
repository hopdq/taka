<?php
class AttributeFilterModel extends CI_Model{
	public $id;
	public $name;
	public $numbers;
	public function __construct($id, $name){
		parent::__construct();
		$this->id = $id;
		$this->name = $name;
	}
}