<?php
require_once 'application/models/DataAccess/BannerDa.php';
require_once 'application/models/UI/BannerItemModel.php';
class HomeBannerModel extends CI_Model{
	public $topHeader;
	public $slider;
	public function __construct(){
		parent::__construct();
		$this->slider = array();
	}
	public function init(){
		$bannerDa = new BannerDa();
		$banners = $bannerDa->getListBanners(array(0 => bannerPosition::HomeSlider, 1 => bannerPosition::HomeHeader));
		if(isset($banners) && count($banners) > 0){
			foreach ($banners as $banner) {
				$bannerItem = new BannerItemModel($banner->Id, $banner->Link, $banner->UrlPath, $banner->Title);
				if($banner->Code == bannerPosition::HomeSlider){
					array_push($this->slider, $bannerItem);
				}
				else if($banner->Code == bannerPosition::HomeHeader){
					$this->topHeader = $bannerItem;
				}
			}
		}
	}
}