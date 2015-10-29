<?php
require_once 'application/models/UI/CustomerModel.php';
require_once 'application/models/UI/ShoppingCartModel.php';
require_once 'application/models/UI/NavigatorModel.php';
class HeaderModel extends CI_Model{
	public $logo;
	public $customer;
	public $shoppingCart;
	public $navigator;
	public function __construct(){
		$this->customer = new CustomerModel();
		$this->shoppingCart = new ShoppingCartModel();
		$this->navigator = new NavigatorModel();
	}
	public function init(){
		//init for logo
		$this->load->helper('url');
		$this->logo = array('logoLink' => base_url('/'), 'logoPath' => base_url('application/Content/Front/images/home/logo.png'));
		//end logo
		//init for customer information
		$this->customer->init();
		//end customer
		//init for shopping cart infomation
		$this->shoppingCart->init();
		//end shopping cart
		//init navigator model
		$this->navigator->init();
		//end navigator
	}
}