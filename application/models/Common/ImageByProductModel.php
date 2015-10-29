<?php 
require_once 'system/core/Model.php';
require_once 'application/models/DataAccess/ImageDa.php';
class ImageByProductModel extends CI_Model{
	public $listImages;
	public $productId;
	public function __construct($productId){
		$this->productId = $productId;
		if(isset($this->productId) && $this->productId != ''){
			$this->listImages = array();
			$imageDa = new ImageDa();
			$listTmpImages = $imageDa->GetImgListByProduct($this->productId);
			if(isset($listTmpImages) && count($listTmpImages) > 0){
				$this->load->helper('url');
				foreach ($listTmpImages as $img) {
					$img->Path = base_url($img->Path);
					array_push($this->listImages, $img);
				}
			}
		}
	}
}