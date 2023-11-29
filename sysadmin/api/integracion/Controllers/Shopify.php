<?php

class Shopify extends Controller {
    
    public function index(){
        $json = file_get_contents('php://input');
        $this->model->getJson($json);
    }
    public function shopify(){
        $this->views->render($this, "shopify");
    }
}