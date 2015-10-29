<?php
class BannerItemModel extends CI_Model{
	public $id;
	public $link;
	public $urlPath;
	public $title;
	public function __construct($id, $link, $urlPath, $title){
		parent::__construct();
		$this->id = $id;
		$this->link = $link;
		$this->urlPath = $urlPath;
		$this->title = $title;
	}
}