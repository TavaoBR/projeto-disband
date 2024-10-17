<?php 

namespace Src\Models\Usuario;

use Src\Database\Model\Model;

class Usuario extends Model{

    protected string $table = "usuario";
    public int $id;
    public string $usuario;
    public string $senha;
    public string $viewSenha;
    public int $tentativas;
    public string $avatar;
    public string $token;

    public function __construct(){
    }

    public function resgitro(): array {
        $create = $this->create([
           "usuario" => $this->usuario,
            "senha" => $this->senha,
            "viewSenha" => $this->viewSenha,
            "tentativas" => $this->tentativas,
            "avatar" => $this->avatar
        ]);

        return $create;
    }

    public function login(){
        
    }

    public function updateTentativas($tentativas): void{
        $this->update("id", $this->id, ["tentativas" => $tentativas]);
    }

    public function resetarTentativas(): void{
        $this->update("id", $this->id, ["tentativas" => "1"]);
    } 

    public function criarToken(){
        $this->update("id", $this->id, ["token" => $this->token]);
    }

    public function ById(): array{
        return $this->findBy("id", $this->id);
    }

    public function ByToken(): array{
        return $this->findBy("token", $this->token);
    }

    public function ByName(): array{
        return $this->findBy("usuario", $this->usuario);
    }

    public function All(): array{
        return $this->fetchAll();
    }
}