<?php
//
/**
* 
*/
class BannerBaseInfo
{
	public $Id;
	public $UrlPath;
	public $Link;
	public $Title;
	public $Code;
	public $CreateDate;
	public function __construct() {
		# code...
	}
	//
	public function Init($id, $urlPath, $link, $title, $code, $createDate) {
		$this->Id = $id;
		$this->UrlPath = $urlPath;
		$this->Link = $link;
		$this->Title = $title;
		$this->Code = $code;
		$this->CreateDate = $createDate;
	}
}