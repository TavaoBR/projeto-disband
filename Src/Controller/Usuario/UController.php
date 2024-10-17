<?php

namespace Src\Controller\Usuario;
use Config\TemplateConfig;

class UController extends TemplateConfig{

    public function login(){
      session_start();
      include("Web/app/usuario/login.php");   
    }

    public function perfil(){
        
    }


}