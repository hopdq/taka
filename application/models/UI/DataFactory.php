<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/10/2015
 * Time: 22:41
 */
require_once 'application/models/DataAccess/ProductDa.php';
class DataFactory{
    public static function getFilters($type, $filter){
        $result = null;
        $productDa = new ProductDa();
        switch($type){
            case 'category': $result = $productDa->getFilters($filter); break;
            case 'provider': $result = $productDa->getFilterByProvider($filter); break;
        }
        return $result;
    }
}