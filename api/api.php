<?php
require_once("./conecta.php");

class ApiCore{

    public $listResults = array();

    public $ipAdress;
    public $quantLitrosColetados;
    public $quantAguaPoluida;
    public $quantSabaoLiquido;
    public $receitaTotal;
    public $gastoTotal;
    public $lucro;
    public $dataConsulta;

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
            //$date = date("Y-m-d", strtotime($this->datanasc));
            //$pass = crypt($this->pws, $this->email);
            //$pass = md5($this->pws, $this->email);
        
            $dao = new DAO;
            $sql = "INSERT INTO dados(id, ipAdress, quantLitrosColetados, quantAguaPoluida, quantSabaoLiquido, receitaTotal, gastoTotal, lucro) VALUES (null, :ipAdress, :quantLitrosColetados, :quantAguaPoluida, :quantSabaoLiquido, :receitaTotal, :gastoTotal, :lucro)";
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":ipAdress", $this->ipAdress);
            $stman->bindParam(":quantLitrosColetados", $this->quantLitrosColetados);
            $stman->bindParam(":quantAguaPoluida", $this->quantAguaPoluida);
            $stman->bindParam(":quantSabaoLiquido", $this->quantSabaoLiquido);
            $stman->bindParam(":receitaTotal", $this->receitaTotal);
            $stman->bindParam(":gastoTotal", $this->gastoTotal);
            $stman->bindParam(":lucro", $this->lucro);
            $stman->execute();

            $sql = "SELECT * FROM dados ORDER by id DESC LIMIT 1";
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
            $result = $stman->fetchAll();
            return $this->listResults = array($result);
        }catch(Exception $e){
            throw new Exception("Erro ao Cadastrar os dados:", $e->getMessage());
        }
    }
    
    public function getAll(){
        try{
            $dao = new DAO;
            $sql = "SELECT * FROM dados";
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
            $result = $stman->fetchAll();
            $this->listResults = $result;
            return $this->listResults = json_encode($result);
        }catch(Exception $e){
            throw new Exception("Erro ao Pegar todos os Dados:", $e->getMessage());
        }
    }
    
    public function getAllTotal(){
        try{
            $dao = new DAO;
            $sql = "SELECT sum(quantLitrosColetados) as totalLitrosColetados, sum(quantAguaPoluida) as totalAguaPoluida, sum(quantSabaoLiquido) as totalSabaoLiquido, sum(receitaTotal) as totalReceita, sum(gastoTotal) as totalGasto, sum(lucro) as totalLucro, DATE_FORMAT(dataConsulta, '%m-%Y') as data from dados GROUP by DATE_FORMAT(dataConsulta, '%m-%Y')";
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
            $result = $stman->fetchAll();
            $this->listResults = $result;
            return $this->listResults = json_encode($result);
        }catch(Exception $e){
            throw new Exception("Erro ao Pegar todos os Dados:", $e->getMessage());
        }
    }

     public function getAcesso(){
        try{
            $dao = new DAO;
            $sql = "Select count(*) as Acessos from acesso";
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
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];

            if(filter_var($client, FILTER_VALIDATE_IP))
            {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP))
            {
                $ip = $forward;
            }
            else
            {
                $ip = $remote;
            }
            $dao = new DAO;
            $sql = "insert into acesso(ipAdress) values (:ip)";
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":ip", $ip);
            $stman->execute();
        }catch(PDOException $e){
            throw new Exception("Erro ao atualizar o acessos:", $e->getMessage());
        }
    }

    public function getIP(){
        try {
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = $_SERVER['REMOTE_ADDR'];

            if(filter_var($client, FILTER_VALIDATE_IP))
            {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP))
            {
                $ip = $forward;
            }
            else
            {
                $ip = $remote;
            }
            return $ip;

        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Erro ao pegar o IP:", $th->getMessage());
        }
        
    }

}