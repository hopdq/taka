<?php
class PageModel{
	public $Page;
	public $PageSize;
	public $TotalItems;
	public $TotalPages;
	public function __construct(){
		$this->Page = 1;
		$this->PageSize = 10;
		$this->TotalPages = 0;
		$this->TotalItems = 0;
	}
}