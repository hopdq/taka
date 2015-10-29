<?php
require_once 'application/models/Admin/AdminMasterModel.php';
require_once 'application/models/Admin/UserLoginModel.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminHome extends CI_Controller{
	/*
	 * login page for module admin
	 * */
	public function Index(){
		$checkLogin = new UserLoginModel();
		if(!$checkLogin->checkUserIsLogined()){
			$this->load->helper('url');
			redirect(site_url(array('AdminLogin')));
		}
		$temp['title']="Trang chủ quản trị"; 
        $temp['content_view']='Admin/AdminHome/Index'; 
        $data = new AdminMasterModel();
        $data->Init(null, adminParentMenuEnum::Home, null);
        $temp['data'] = $data;
        $this->load->view("Admin/Shared/_Layout",$temp); 
	}
}