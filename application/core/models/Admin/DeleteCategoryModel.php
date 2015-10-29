<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/CategoryBaseInfo.php';
class DeleteCategoryModel extends CI_Model{
	public $deletingCategory;
	public function __construct() {
		parent::__construct();
		$this->deletingCategory = new CategoryBaseInfo();
	}
	//
	public function Init($id) {
			$this->load->database('default');
			$this->db->select('Id, Name, ParentId, Order');
			$this->db->where('Id', $id);
			$query = $this->db->get('Category');
			$result = $query->result('CategoryBaseInfo');
			$this->db->close();
			$this->deletingCategory = $result[0];
	}
	//
	public function DeleteCategory($id) {
		$cate = $this->GetCategory($id);
		if ($cate == null) {
			return 1;
		}
		$listChilds = $this->GetListChilds($id, $id);
		$counter = $this->DeleteDataCategory($id);
		if ($counter != 1) {
			return -1;
		} else {
			$cateOrder = $cate->Order;
			
			if ($listChilds != null) {
				$lenChilds = count($listChilds);
				foreach ($listChilds as $childCate) {
					$this->DeleteCategory($childCate->Id);
				}

			}
			
		}
		return 1;
	}
	//
	public function GetCategory($id) {
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
	//
	public function ChangeOrderBrothersList($cate) {
		if ($cate == null) {
			return 1;
		}
		$listBrothers = $this->GetListChilds($cate->ParentId, $cate->Id);
		if (count($listBrothers) == 0 || (intval($cate->Order) == count($listBrothers) + 1)) {
			return 1;
		} else {
			for($i = intval($cate->Order) + 1; $i <= count($listBrothers)+1; $i++) {
				$listBrothers[$i]->Order = strval(intval($listBrothers[$i]->Order)-1);
				$this->load->database('default');
				$data = array(
			        'Order' => $listBrothers[$i]->Order
				);
				$this->db->set($data);
				$this->db->where('Id', $listBrothers[$i]->Id);
				$this->db->update('Category');
				$result = $this->db->affected_rows();
				$this->db->close();
			}
			return 1;
		}
	}
	//
	public function DeleteDataCategory($id) {
		$this->load->database('default');
		$this->db->select('Id, Name, ParentId, Order');
		$this->db->where('Id', $id);
		$this->db->delete('Category');
		$counter = $this->db->affected_rows();
		$this->db->close();
		return $counter;
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
	//
	public function GetListChilds($ParentId, $id) {
		$this->load->database('default');
		$len = $this->GetMaxId();
		$this->db->select('Id, Name, ParentId, Order');
		$query = $this->db->get('Category');
		$result = $query->result('CategoryBaseInfo');
		$this->db->close();
		if (count($result) == 0) {
			return null;
		}
		$arrayTmp = array(array());
		for ($i = 0; $i <= $len; $i++) {
			$arrayTmp[$i] = null;
		}
		foreach ($result as $category) {
			if ($category->Id != $id) {
				$i = $category->ParentId;
				$j = $category->Order;
				$arrayTmp[$i][$j] = $category;
			}
		}
		return $arrayTmp[$ParentId];
	}
}