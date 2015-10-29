<?php 
require_once 'application/models/UI/HeaderModel.php';
require_once 'application/models/UI/FooterModel.php';
class FrontMasterModel extends CI_Model{
	public $header;
	public $body;
	public $footer;
	public function __construct(){
		parent::__construct();
		$this->header = new HeaderModel();
		$this->footer = new FooterModel();
	}
	public function init($body){
		$this->header->init();
		$this->body = $body;
		$this->footer->init();
	}
	public function setCategoryId($categoryId){
		$this->header->navigator->categoryId = $categoryId;
	}
}