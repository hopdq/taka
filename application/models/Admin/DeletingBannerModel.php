<?php
require_once 'Object/Admin/BannerBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//

class DeletingBannerModel extends CI_Model {
	public $deletedBanner;
	function __construct() {
		parent::__construct();
	}
	//
	public function Init($id) {
		$this->deletedBanner = new BannerBaseInfo();
		$this->deletedBanner->Id = $id;
	}
	//
	public function Update2Db() {
		$id = $this->deletedBanner->Id;
		$this->load->database('default');
		$this->db->where('Id', $id);
		$result = $this->db->delete('Banner');
		if ($result == 1) {
			return 1;
		}
		else {
			return -1;
		}
	}
	//
}