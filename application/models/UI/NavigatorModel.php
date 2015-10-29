<?php
require_once 'application/models/DataAccess/CategoryDa.php';
class NavigatorModel extends CI_Model{
	public $listCategories;
	public $categoryId;
	public function __construct(){
		parent::__construct();
		$this->listCategories = array();
		$this->load->helper('url');
	}
	public function init(){
		$categoryDa = new CategoryDa();
		$categories = $categoryDa->getCategories();
		if(isset($this->categoryId))
		{
			$cateActiveId = $categoryDa->getCategoryLv1Active($this->categoryId);
		}
		$childs = array();
		if(isset($categories) && count($categories) > 0){
			foreach ($categories as $cate) {
				$cate->CategoryUrl = base_url('/danh-muc/'.$cate->Id);
				if(!isset($cate->ParentId) || $cate->ParentId == "0"){
					if(isset($cateActiveId) && $cate->Id == $cateActiveId){
						$cate->active = true;
					}
					else{
						$cate->active = false;
					}
					array_push($this->listCategories, $cate);
				}
				else{
					array_push($childs, $cate);
				}
			}
			if(isset($this->listCategories) && count($this->listCategories) > 0){
				foreach ($this->listCategories as $parent) {
					$parent->listChilds = array();
					foreach ($childs as $child) {
						if($child->ParentId == $parent->Id){
							$child->listChilds = array();
							foreach ($childs as $gchild) {
								if($gchild->ParentId == $child->Id){
									array_push($child->listChilds, $gchild);
								}
							}
							array_push($parent->listChilds, $child);
						}
					}
				}
			}
		}
	}
}