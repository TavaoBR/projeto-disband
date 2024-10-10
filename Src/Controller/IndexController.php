<?php 

namespace Src\Controller;
use Config\TemplateConfig;

class IndexController extends TemplateConfig{

    public function index(){
        echo "HELLO WORLD";
    }

}