<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/CategoryBaseInfo.php';
class CategoryDropdownModel extends CI_Model{
	public $listCategories;
	public $activeId;
	public function __construct($activeId){
		parent::__construct();
		$this->load->database('default');
		$this->db->select('Id, Name, ParentId');
		$query = $this->db->get('Category');
		$this->db->close();
		$all = new CategoryBaseInfo();
		$all->Id = '';
		$all->textName = '-- Tất cả --';
		$all->ParentId = '0';
		$listCates = array();
		$listResult = array(1 => $all);
		$listChilds = array(); 
		foreach($query->result('CategoryBaseInfo') as $category){
			if($category->ParentId > 0){
				array_push($listChilds, $category);
			}
			else{
				$category->textName = $category->Name;
				array_push($listCates, $category);
			}
		};
		if(count($listCates) > 0 && count($listChilds) > 0){
			foreach($listCates as $cate){
				array_push($listResult, $cate);
				foreach($listChilds as $child){
					if($child->ParentId == $cate->Id){
						$child->textName = $this->createLvSpace(1).$child->Name;
						array_push($listResult, $child);
						foreach($listChilds as $gchild){
							if($gchild->ParentId == $child->Id){
								$gchild->textName = $this->createLvSpace(2).$gchild->Name;
								array_push($listResult, $gchild);
							}
						}
					}
				}
			}
		}
		$this->listCategories = array_values($listResult);
		$this->activeId = $activeId;
	}
	private function createLvSpace($cnt){
		$result = '';
		for($i = 0; $i < $cnt; $i++){
			$result = $result.'--';
		}
		return $result;
	}
}