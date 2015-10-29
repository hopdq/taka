<?php
require_once 'system/core/Model.php';
require_once 'application/models/Admin/Navigator.php';
class AdminMasterModel extends CI_Model{
	public $header;
	public $navigator;
	public $content;
	//
	/*public function Init($content){
		$this->content = $content;
	}*/
	//
	public function Init($content, $parentMenu, $childMenu){
		$this->navigator = new Navigator();
		$this->navigator->init($parentMenu,$childMenu);
		$this->content = $content;
	}
}