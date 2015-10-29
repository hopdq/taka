<?php
class CategoryDa extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function getCategories(){
		$this->load->database('default');
		$this->db->select('Id, Name, ParentId, Order');
		$this->db->order_by('order asc');
		$query = $this->db->get('Category');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function getLv1Categories(){
		$this->load->database('default');
		$this->db->select('Id, Name, Order');
		$this->db->where('ifnull(ParentId, 0) = 0');
		$this->db->order_by('order asc');
		$query = $this->db->get('Category');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function getCategoryLv1Active($categoryId){
		$this->load->database('default');
		$this->db->select('case when ifnull(c2.ParentId, "0") != "0" then c2.ParentId else case when ifnull(c.ParentId, "0") != "0" then c.ParentId else c.Id end end as Id');
		$this->db->where('c.Id', $categoryId);
		$this->db->join('Category c2', 'c.ParentId = c2.Id', 'left');
		$query = $this->db->get('Category c');
		$queryResult = $query->row();
		$this->db->close();
		$result = 0;
		if(isset($queryResult) && isset($queryResult->Id)){
			$result = $queryResult->Id;
		}
		return $result;
	}
	public function getListByParentId($parentId){
		$this->load->database('default');
		$this->db->select('c.Id, c.Name, c.ParentId, c.Order');
		$this->db->join('Category c2', 'c.ParentId = c2.Id', 'left');
		$this->db->where('c.ParentId', $parentId);
		$this->db->or_where('c2.ParentId', $parentId);
		$this->db->order_by('order asc');
		$query = $this->db->get('Category c');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
}