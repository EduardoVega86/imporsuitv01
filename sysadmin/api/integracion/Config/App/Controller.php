<?php
class Controller{

    public function __construct(){
        $this->views = new Views();
        $this->loadModel();
    }
    public function loadModel(){
        $model = get_class($this)."Model";
        $routClass = "Models/".$model.".php";
        if(file_exists($routClass)){
            require_once($routClass);
            $this->model = new $model();
        }
    }
    public function view($view, $data = []){
        require_once '../api/Views/'.$view.'.php';
    }
}