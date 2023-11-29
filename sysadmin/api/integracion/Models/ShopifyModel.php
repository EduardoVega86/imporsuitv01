<?php
class ShopifyModel extends Query{
    public function __construct(){
        parent::__construct();
    }

    public function getJson($json){
        $sql = "INSERT INTO shopify (json) VALUES (?)";
        $data = array($json);
        $query = $this->insert($sql, $data);
        return $query;
    }
}