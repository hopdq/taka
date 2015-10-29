<?php
require_once 'Object/Admin/BannerBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//

class AdminBannerModel extends CI_Model {
	public $bannersList;
	function __construct() {
		parent::__construct();
		$this->bannersList = array();
	}
	//
	public function Init() {
		$this->load->database('default');
		$this->db->select('Id, UrlPath, Link, Title, Code, CreateDate');
		$this->db->order_by("UPPER(Title)","asc");
		$query = $this->db->get('Banner');
		$result = $query->result('BannerBaseInfo'); 
		$this->db->close();
		$this->bannersList = $result;
		return $result;
	}

}