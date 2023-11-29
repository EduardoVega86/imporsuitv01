<?php
class Views
{
    
    public function render($controller, $view, $data = [])
    {
        $controller = get_class($controller);
        if($controller == "Home"){
            $dir = "Views/".$view.".php";
        }else{
            $dir = "Views/".$controller."/".$view.".php";
        }
        require($dir);
    }
}