<?php
require_once 'application/models/DataAccess/CategoryDa.php';
class CategoryListModel extends CI_Model{
	public $categories;
	public function __construct(){
		parent::__construct();
		$this->categories = array();
		$this->load->helper('url');
	}
	public function init($parentId){
		if(isset($parentId))
		{
			$categoryDa = new CategoryDa();
			$categories = $categoryDa->getListByParentId($parentId);
			$children = array();
			if(isset($categories) && count($categories) > 0){
				foreach ($categories as $cate) {
					$cate->Link = base_url('danh-muc/'.$cate->Id);
					$cate->children = array();
					if($cate->ParentId == $parentId){
						array_push($this->categories, $cate);
					}
					else{
						array_push($children, $cate);
					}
				}
				if(count($this->categories) > 0)
				{
					if(count($children) > 0){
						foreach ($this->categories as $parent) {
							foreach ($children as $child) {
								if($child->ParentId == $parent->Id){
									array_push($parent->children, $child);
								}
							}
						}
					}
				}
			}
		}
	}
}