<?php 
require_once 'system/core/Model.php';
class ImageDa extends CI_Model{
	public function GetImgListByProduct($productId){
		$this->load->database('default');
		$this->db->select('g.Id, g.Path, p.IsDefault');
		$this->db->join('ProductImage p', 'g.Id = p.ImageId');
		$this->db->where('p.ProductId', $productId);
		$this->db->order_by('p.IsDefault DESC');
		$query = $this->db->get('Gallery g');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function InsertImg($path){
		$this->load->database('default');
		$data = array(
	        'Path' => $path,
	        'CreateDate' => 'now()'
		);

		$this->db->insert('Gallery', $data);
		$result = $this->db->insert_id();
		$this->db->close();
		return $result;
	}
	// public function updateProductImage($productId, $imgData){
	// 	if(isset($imgData) && isset($imgData->tempImgIds) && count($imgData->tempImgIds) > 0){
	// 		if(isset($imgData->defaultImgId) && $imgData->defaultImgId <= 0){
	// 			$imgData->defaultImgId = $imgData->tempImgIds[0];
	// 		}
	// 		$lstStr = StringHelper::concatArray2Str($imgData->tempImgIds, ',');
	// 		$this->load->database('default');
	// 		$sql = "call productImage_InsertUpdate (?, ?, ?);";
	//         $query = $this->db->query($sql, array($productId, $lstStr, $imgData->defaultImgId));
	// 		$this->db->close();
	// 		return 1;
	// 	}
	// 	return 0;
	// }
	public function updateProductImage($productId, $imgData){
		if(isset($imgData) && isset($imgData->tempImgIds) && count($imgData->tempImgIds) > 0){
			if(isset($imgData->defaultImgId) && $imgData->defaultImgId <= 0){
				$imgData->defaultImgId = $imgData->tempImgIds[0];
			}
			$this->load->database('default');
			$this->db->where('ProductId', $productId);
			$this->db->delete('ProductImage');
			foreach ($imgData->tempImgIds as $imgId) {
				$data = array(
						'ProductId' => $productId,
						'ImageId' => $imgId,
						'IsDefault' => $imgId == $imgData->defaultImgId
					);
				$this->db->insert('ProductImage', $data);
			}
			$this->db->close();
			return 1;
		}
		return 0;
	}
}