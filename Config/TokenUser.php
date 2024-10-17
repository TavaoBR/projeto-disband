<?php 

namespace Config;
use Src\Models\Usuario\Usuario; 

class TokenUser {

    private Usuario $user;

    public function __construct(int $id){
        $this->user = new Usuario;
        $this->user->id = $id; 
    }

    private function verificarTokenExiste(){
         $this->user->token = $this->gerarToken();
         return $this->user->Bytoken();
    }
    
    private function gerarToken(): string{
        $uuid = bin2hex(random_bytes(16));
        $token = sprintf("%s-%s-%s-%s-%s", 
        substr($uuid, 0, 8),
        substr($uuid, 8, 4),
        substr($uuid, 12, 4),
        substr($uuid, 16, 4),
        substr($uuid, 20)  
        );

        return $token;
    }

    private function atualizarToken(){
        $this->user->token = $this->gerarToken();
        $this->user->criarToken();
    }

    public function token(): void{
      if($this->verificarTokenExiste()[0] == 0){
        $this->atualizarToken();
      }
    }


}