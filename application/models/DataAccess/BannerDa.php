<?php
class BannerDa extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function getListBanners($pos){
		$this->load->database('default');
		$this->db->select('Id, Link, UrlPath, Title, Code');
		$this->db->where_in('Code', $pos);
		$query = $this->db->get('Banner');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
}