<?php 

namespace Src\Request\Usuario; 

use Src\Models\Usuario\Usuario;
use Src\Request\Validate;

class Login {

    private Usuario $user;
    private Validate $validate;

    public function __construct(){
        $this->user = new Usuario;
        $this->validate = new Validate;
        $this->user->usuario = $_POST['usuario'];
        $this->user->senha = $_POST['senha'];
    }

    public function Request(){
        session_start();
       if(!$this->validate()){
          $this->logar();
       }
    }

    private function validate(){
       $data = [
        "Nome de usuario" => $this->user->usuario,
        "Senha" => $this->user->senha
       ];

       if($this->validate->validate($data)){
        setSessions(["MensagemLogin" => messageWarning($this->validate->validate($data)), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
        redirectBack();
        return true;
       }

       return false;
    }

    private function logar(){
        $select = $this->user->ByName();
        if($select[0] == 0){
            setSessions(["MensagemLogin" => sweetAlertError("Dados invalidos"), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
            redirectBack();
        }

        $dados = $select[1];
        $this->user->id = $dados->id;
        $this->user->tentativas = $dados->tentativas;
        $this->user->token = $dados->token;

        switch(true){
           case $this->user->tentativas == 5:
            setSessions(["MensagemLogin" => sweetAlertError("Login Bloqueado"), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
            redirectBack();
           break; 

           case password_verify($dados->senha, hash("sha256",$this->user->senha)):
             $soma = $this->user->tentativas + 1;
             $this->user->updateTentativas($soma);
             $tentativas = 5;
             $tentativasRestantes = $tentativas - $dados->tentativas;
             setSessions(["MensagemLogin" => sweetAlertError("Login Inválido. Restão apenas $tentativasRestantes"), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
             redirectBack();
           break; 

           default:
             $this->user->resetarTentativas();
             $this->criarSessao($this->user->id, $this->user->token);
             viewSession("id");
             echo "<br>";
             viewSession("token");
           break;
        }
    }

    private function criarSessao(string $id, string $token){
       return setSessions(["id" => $id, "token" => $token]);
    }

}