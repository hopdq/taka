<?php
require_once 'Object/Admin/BannerBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//

class AddingBannerModel extends CI_Model {
	public $newBanners;
	function __construct() {
		parent::__construct();
		$this->newBanners = array();
	}
	//
	public function Init($newBannersList) {
		$this->newBanners = $newBannersList;
	}
	//
	public function Update2Db() {
		//
		$newBanners = $this->newBanners;
		$len = count($newBanners);
		$result = 0;
		for ($i = 0; $i < $len; $i ++) {
			$result += $this->UpdateImageToDb($newBanners[$i]);
		}
		if ($result == $len) {
			return 1;
		}
		else {
			return -1;
		}
	}
	//
	public function UpdateImageToDb($img) {
		$this->load->database('default');
		$this->db->select('max(cast(Id as decimal)) as MaxId');
		$query = $this->db->get('Banner');
		$row = $query->row();
		if(isset($row))
		{
			$img->Id = $row->MaxId + 1;
		}
		else{
			$img->Id = 1;
		}
		$this->db->close();
		$this->load->database('default');
		$newImg = array(
				'Id' => $img->Id,
				'UrlPath' => $img->UrlPath,
				'Link' => $img->Link,
				'Title' => $img->Title,
				'Code' => $img->Code
		);
		$this->db->insert('Banner', $newImg);
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
}