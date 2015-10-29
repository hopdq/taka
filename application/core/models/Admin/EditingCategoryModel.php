<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/CategoryBaseInfo.php';
require_once 'application/models/Admin/AdminCategoryModel.php';
class EditingCategoryModel extends CI_Model{
	public $editingCategory;
	public $data;
	public $categoriesList;
	public $parentOfEditingCategory;
	public $listBrothers;
	public function __construct() {
		parent::__construct();
		$this->addingCategory = new CategoryBaseInfo();
		$this->data = new AdminCategoryModel();
		$this->data->Init();
		$this->categoriesList = $this->data->categoriesList;
	}
	//
	public function Init($id) {
		$this->editingCategory = $this->GetCategory($id);
		$this->parentOfEditingCategory = $this->GetCategory($this->editingCategory->ParentId);
		$this->listBrothers = $this->data->GetListChilds($this->editingCategory->ParentId);
	}
	//
	public function SetNewInfo($newName, $newParentId, $newOrder, $newHintOrder) {
		$id = $this->editingCategory->Id;
		$currentName = $this->editingCategory->Name;
		$currentParentId = $this->editingCategory->ParentId;
		$currentOrder = $this->editingCategory->Order;
		$brothersListLength = count($this->listBrothers);
		$tmpCate = new CategoryBaseInfo();
		$tmpCate->Init($id, $newName, $newParentId, $newOrder);
		if ($newName == $currentName && $newParentId == $currentParentId && $newOrder == $currentOrder) {
			return 1;
		} else if ($newName != $currentName && $newParentId == $currentParentId && $newOrder == $currentOrder) {
				$this->load->database('default');
				$cateModel = array(
			        'Name' => $newName
				);
				$this->db->set($cateModel);
				$this->db->where('Id', $id);
				$this->db->update('Category');
				$result = $this->db->affected_rows();
				$this->db->close();
				return $result;
		} else if ($newParentId == $currentParentId && $newOrder != $currentOrder) {
			if (intval($newOrder) <= 0) {
				$newOrder = "1";
			}
			if (intval($newOrder) > $brothersListLength) {
				$newOrder = strval($brothersListLength);
			}
			$listBrothers = $this->listBrothers;
			if (intval($newOrder) >= intval($currentOrder)) {
				$this->RearrangeBrothersList($currentOrder, $newOrder, $listBrothers);
				$tmpCate->Order = $newOrder;
				$this->UpdateInfoToDatabase($tmpCate);
			} else {
				$tmpCate->Order = $newOrder;
				$this->UpdateInfoToDatabase($tmpCate);
				$this->RearrangeBrothersList($currentOrder, $newOrder, $listBrothers);
			}
			return 1;
		} else if ($newParentId != $currentParentId) {
			$currentListBrothers =  $this->listBrothers;
			$this->RearrangeBrothersList($currentOrder, count($currentListBrothers), $currentListBrothers);
			if (intval($newOrder) <= 0) {
				$newOrder = "1";
			}
			if (intval($newOrder) > intval($newHintOrder)) {
				$newOrder = $newHintOrder;
			}
			if ($newOrder == $newHintOrder) {
				$tmpCate->Order = $newOrder;
				$this->UpdateInfoToDatabase($tmpCate);
				return 1;
			} else {
				$newListBrothers = $this->data->GetListChilds($newParentId);
				$tmpCate->Order = $newOrder;
				$this->UpdateInfoToDatabase($tmpCate);
				for ($i = intval($newHintOrder) - 1; $i >= intval($newOrder); $i--) {
					$newListBrothers[$i]->Order = strval(intval($newListBrothers[$i]->Order) + 1);
					$this->UpdateInfoToDatabase($newListBrothers[$i]);
				}
				return 1;
			}
		}
	}
	//
	public function RearrangeBrothersList($currentOrder, $newOrder, $listBrothers) {
		$currentOrder = intval($currentOrder);
		$newOrder = intval($newOrder);
		$len = count($listBrothers);
		if ($newOrder >= $currentOrder) {
			for ($i = $currentOrder + 1; $i <= $newOrder; $i++) {
				$listBrothers[$i]->Order  = strval(intval($listBrothers[$i]->Order) - 1);
				$this->UpdateInfoToDatabase($listBrothers[$i]);
			}
			return 1;
		} else {
			for ($i = $currentOrder - 1; $i >= $newOrder; $i--) {
				$listBrothers[$i]->Order = strval(intval($listBrothers[$i]->Order) + 1);
				$this->UpdateInfoToDatabase($listBrothers[$i]);
			}
			return 1;
		}
	}
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
	public function UpdateInfoToDatabase($cate) {
		$this->load->database('default');
		$cateModel = array(
	        'Name' => $cate->Name,
	        'ParentId' => $cate->ParentId,
	        'Order' => $cate->Order
		);
		$this->db->set($cateModel);
		$this->db->where('Id', $cate->Id);
		$this->db->update('Category');
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
	
}