<?php
require_once("./conecta.php");

class ApiCore{

    public $listResults = array();

    public function login($email, $senha){
        try {
            $pass = md5($senha, $email);
            $dao = new DAO;
            $sql = "SELECT id, nome, email FROM usuario WHERE email = :email AND pws = :senha ";
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":senha", $pass);
            $stman->bindParam(":email", $email);
            $stman->execute();
            $result = $stman->fetchAll();
            return $result;
        }catch(Exception $e){
            throw new Exception("Erro ao Entrar:", $e->getMessage());
        }
    }

    public function add(){
        try{
            $date = date("Y-m-d", strtotime($this->datanasc));
            //$pass = crypt($this->pws, $this->email);
            $pass = md5($this->pws, $this->email);
            $dao = new DAO;
            $sql = "INSERT into usuario(nome, email, tel, ativo, pws, datanasc) VALUES (:nome, :email, :tel, :ativo, :senha, :datanasc)";
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":email", $this->email);
            $stman->bindParam(":tel", $this->tel);
            $stman->bindParam(":ativo", $this->ativo);
            $stman->bindParam(":datanasc",$date);
            $stman->bindParam(":senha",$pass);
            $stman->execute();
        }catch(Exception $e){
            throw new Exception("Erro ao Cadastrar:", $e->getMessage());
        }
    }
    
    public function getAll(){
        try{
            $dao = new DAO;
            $sql = "Select * from usuario";
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
            $result = $stman->fetchAll();
            return $result;
        }catch(Exception $e){
            throw new Exception("Erro ao Cadastrar:", $e->getMessage());
        }
    }

     public function getAcesso(){
        try{
            $dao = new DAO;
            $sql = "Select count(*) as Acessos from dados";
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
            $result = $stman->fetchAll();            
            return $this->listResults = json_encode($result);
        }catch(Exception $e){
            throw new Exception("Erro ao buscar o acessos:", $e->getMessage());
        }
    }

     public function setAcesso(){
        try{
            $dao = new DAO;
            $sql = "insert into dados(macAdress) values ('')";
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
        }catch(Exception $e){
            throw new Exception("Erro ao atualizar o acessos:", $e->getMessage());
        }
    }



}