<?php
class PagingModel extends CI_Model{
	public $page;
	public $startIndex;
	public $itemsGet;
	public $totalItems;
	public $totalPages;
	public function __construct($page, $itemsGet){
		parent::__construct();
		$this->page = $page;
		$this->itemsGet = $itemsGet;
		$this->startIndex = ($this->page - 1) * $itemsGet;
		$this->totalPages = 0;
		$this->totalItems = 0;
	}
	public function calTotalPages($totalItems){
		$this->totalItems = $totalItems;
		$this->totalPages = ceil($this->totalItems / $this->itemsGet);
	}
}