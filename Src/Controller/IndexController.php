<?php 

namespace Src\Controller;
use Config\TemplateConfig;
use Config\TokenUser;
use Src\Models\Usuario\Usuario;

class IndexController extends TemplateConfig{

    public function index(){
        echo "HELLO WORLD";
    }

    public function teste(){
        
        $usuario = new Usuario;

        $senha = "Batman1";
        $usuario->usuario = "wolverine";
        $usuario->senha =  hash("sha256", $senha);
        $usuario->viewSenha = $senha;
        $usuario->tentativas = 1;
        $usuario->avatar = "07d1420abe8cb2fc4422970bdc8f5392.jpg";
        $create = $usuario->resgitro();
        if($create[0] > 0){
            $id = $create[1];
            $usuario->id = $id;
            $token = new TokenUser($id);
            $token->token();
            $select = $usuario->ById();
            $usuario->token = $select[1]->token; 
            echo "Deu certo <br>";
            echo "Ultimo Id inserido: $id <br>";
            echo "Seu token de acesso: {$usuario->token}";
        }else{
            echo "Deu ruim";
        }
    }

}