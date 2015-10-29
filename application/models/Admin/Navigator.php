<?php 
class Navigator {
	public $parentMenu;
	public $childMenu;
	public function init($parentMenu, $childMenu){
		$this->parentMenu = $parentMenu;
		$this->childMenu = $childMenu;
	}
	public function setParentMenu($parentMenu){
		$this->parentMenu = $parentMenu;
	}
}