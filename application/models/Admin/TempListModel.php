<?php
require_once 'application/models/Admin/PageModel.php';
class TempListModel{
	public $PageModel;
	public $ListItem;
	public function __construct(){
		$this->PageModel = new PageModel();
		$this->ListItem = array();
	}
}