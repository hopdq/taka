<?php
class PriceFilterModel extends CI_Model{
	public $from;
	public $to;
	public function __construct($from, $to){
		parent::__construct();
		$this->from = isset($from) ? $from : 0;
		$this->to = isset($to) ? $to : 0;
	}
}