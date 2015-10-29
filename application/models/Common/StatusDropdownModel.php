<?php
require_once 'application/helpers/ProductStatusHelper.php';
require_once 'Object/Common/ProductStatus.php';
class StatusDropdownModel{
	public $listStatuses;
	public $activeId;
	public function __construct($activeId){
		$allStt = new ProductStatus('','-- Tất cả --');
		$this->listStatuses = ProductStatusHelper::GetListStatuses();
		array_unshift($this->listStatuses,$allStt);
		$this->activeId = $activeId;
	}
}