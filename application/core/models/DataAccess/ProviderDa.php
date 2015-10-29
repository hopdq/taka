<?php
require_once 'system/core/Model.php';
class ProviderDa extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function GetListProviderBaseInfo(){
		$this->load->database('default');
		$this->db->select('Id, Name');
		$query = $this->db->get('Provider');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function GetListProviders(){
		$this->load->database('default');
		$this->db->select('Id, Name, LogoUrl');
		$query = $this->db->get('Provider');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
}