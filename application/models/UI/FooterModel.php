<?php
require_once 'application/models/DataAccess/ProviderDa.php';
class FooterModel extends CI_Model{
	public $providers;
	public $infor;
	public function __construct(){
		parent::__construct();
		$this->providers = array();
		$this->load->database('default');
	}
	public function init(){
		$providerDa = new ProviderDa();
		$lstProviders = $providerDa->GetListProviders();
		if(isset($lstProviders) && count($lstProviders) > 0){
			foreach ($lstProviders as $provider) {
				$provider->Link = base_url('thuong-hieu/'.$provider->Id);
				$provider->LogoUrl = base_url($provider->LogoUrl);
				array_push($this->providers, $provider);
			}
		}
		$this->infor = array(
				'logo' => array(
						'logoLink' => base_url('/'),
						'logoPath' => base_url('application/Content/Front/images/home/logo.png')
					),
				'company' => array(
						'name' => 'CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ XUẤT NHẬP KHẨU TAKA VIỆT NAM',
						'address' => '229/61 Tây Thạnh, Phường Tây Thạnh, Quận Tân Phú, Thành phố Hồ Chí Minh',
						'mst' => '0313436891'
					)
			);
	}
}