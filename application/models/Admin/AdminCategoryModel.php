<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/CategoryBaseInfo.php';
class AdminCategoryModel extends CI_Model {
	public $categoriesList;
	public function __construct() {
		parent::__construct();
		$this->categoriesList = new CategoryBaseInfo();
		$this->categoriesList->Init( "0","Root","0","0");
	}
	//
	public function Init() {
		$this->load->database('default');
		$len = $this->GetMaxId();
		$this->db->select('Id, Name, ParentId, Order');
		$query = $this->db->get('Category');
		$result = $query->result('CategoryBaseInfo');
		$this->db->close();
		$arrayTmp = array(array());
		for ($i = 0; $i <= $len; $i++) {
			$arrayTmp[$i] = null;
		}
		foreach ($result as $category) {
			$i = $category->ParentId;
			$j = $category->Order;
			$arrayTmp[$i][$j] = $category;
		}
		$this->categoriesList->listChilds = $arrayTmp[0];
		foreach ($result as $subCate) {
			$id = intval($subCate->Id);
			if ($id != 0) {
				$subCate->listChilds = $arrayTmp[$id];
			}
		}
	}
	//
	public function GetListChilds($ParentId) {
		$this->load->database('default');
		$len = $this->GetMaxId();
		$this->db->select('Id, Name, ParentId, Order');
		$query = $this->db->get('Category');
		$result = $query->result('CategoryBaseInfo');
		$this->db->close();
		$arrayTmp = array(array());
		for ($i = 0; $i <= $len; $i++) {
			$arrayTmp[$i] = null;
		}
		foreach ($result as $category) {
			$i = $category->ParentId;
			$j = $category->Order;
			$arrayTmp[$i][$j] = $category;
		}
		return $arrayTmp[$ParentId];
	}
	//
	public function GetMaxId() {
		$maxId = 0;
		$this->load->database('default');
		$this->db->select('max(cast(Id as decimal)) as MaxId');
		$query = $this->db->get('Category');
		$row = $query->row();
		if(isset($row))
		{
			$maxId = $row->MaxId + 1;
		}
		else{
			$maxId = 1;
		}
		$this->db->close();
		return $maxId;
	}
}