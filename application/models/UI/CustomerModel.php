<?php
class CustomerModel extends CI_Model{
	public $id;
	public $name;
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	public function init(){
		$result = null;
		if($this->session->has_userdata('customer')){
			$result = $this->session->userdata('customer');
		}
		if(isset($result))
		{
			$id = $result->id;
			$name = $result->name;
		}
	}
}