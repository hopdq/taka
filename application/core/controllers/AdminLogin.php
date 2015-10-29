<?php
require_once 'application/models/Admin/UserLoginModel.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminLogin extends CI_Controller{
	/*
	 * login page for module admin
	 * */
	public function Index(){
		$this->load->view('Admin/AdminLogin/Index');
	}
	
	public function Login(){
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$user = new UserLoginModel();
		$user->init($email, $password);
		$result = $user->CheckLogin();
		$check = isset($result);
		if($check){
			$user->setAdminUserLoginSession($result);
		}
    	echo json_encode( $check );
	}
	public function Logout(){
		$user = new UserLoginModel();
		$user->clearUserLoginSession();
	}
	public function testLogin(){
		$email = 'hopdq1102@gmail.com';
		$password = '123456';
		$user = new UserLoginModel($email, $password);
		$user->init($email, $password);
		$result = $user->CheckLogin();
		$check = isset($result);
		if($check){
			$user->setAdminUserLoginSession($result);
		}
    	echo json_encode( $check );
	}
}