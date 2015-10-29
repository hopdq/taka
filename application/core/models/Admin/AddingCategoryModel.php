<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/CategoryBaseInfo.php';
require_once 'application/models/Admin/AdminCategoryModel.php';
class AddingCategoryModel extends CI_Model{
	public $addingCategory;
	public $data;
	public $categoriesList;
	public $parentOfAddingCategory;
	public $listBrothers;
	public function __construct() {
		parent::__construct();
		$this->addingCategory = new CategoryBaseInfo();
		$this->data = new AdminCategoryModel();
		$this->data->Init();
		$this->categoriesList = $this->data->categoriesList;
	}
	//
	//
	public function GetCategory($id) {
		if ($id == '0') {
			$rootCate = new CategoryBaseInfo();
			$rootCate->Init( "0","Root","0","0");
			return $rootCate;
		} else {
			$this->load->database('default');
			$this->db->select('Id, Name, ParentId, Order');
			$this->db->where('Id', $id);
			$query = $this->db->get('Category');
			$result = $query->result('CategoryBaseInfo');
			$this->db->close();
			if (count($result) == 0) {
				return null;
			} else {
				return $result[0];
			}
		}
	}
	//
	public function SetCategoryInfo($name, $parentId, $order, $hintOrder){
		$this->addingCategory->Name = $name;
		$this->addingCategory->ParentId = $parentId;
		$this->listBrothers = $this->data->GetListChilds($parentId);
		if ($order <= 0 || $order >= $hintOrder) {
			$this->addingCategory->Order = $hintOrder;
		} else {
			$this->addingCategory->Order = $order;
			$tmpList = $this->listBrothers;
			for ($i = $order; $i < $hintOrder; $i++) {
				$tmpList[$i]->Order = intval($tmpList[$i]->Order) + 1;
				$tmpCate = $tmpList[$i];
				$this->UpdateDatabase($tmpCate);
			}
		}
		//
		$this->parentOfAddingCategory = $this->GetCategory($parentId);
	}
	//
	public function UpdateDatabase($cate) {
		$this->load->database('default');
		$cateModel = array(
	        'Order' => $cate->Order
		);
		$this->db->set($cateModel);
		$this->db->where('Id', $cate->Id);
		$this->db->update('Category');
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
	//
	public function Insert2Db(){
		$this->load->database('default');
		$this->db->select('max(cast(Id as decimal)) as MaxId');
		$query = $this->db->get('Category');
		$row = $query->row();
		if(isset($row))
		{
			$this->addingCategory->Id = $row->MaxId + 1;
		}
		else{
			$this->addingCategory->Id = 1;
		}
		$this->db->close();
		
		$this->load->database('default');
		$newCate = array(
				'Id' => $this->addingCategory->Id,
				'Name' => $this->addingCategory->Name,
				'ParentId' => $this->addingCategory->ParentId,
				'Order' => $this->addingCategory->Order
		);
		$this->db->insert('Category', $newCate);
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
	//
	public function Init() {
		$this->load->database('default');
		$this->db->select('Id, Name, ParentId, Order');
		$query = $this->db->get('Category');
		$result = $query->result('CategoryBaseInfo');
		$this->db->close();
	}
	
}