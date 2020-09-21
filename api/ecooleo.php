<?php
class Ecooleo
{
    public $id;
    public $Data;
    public $quantOleo;
    public $quantAgua;
    public $quantOleoConsumo;
    public $valorMedioSabao;
    public $valorTotal;
    public $valorGasto;
    public $valorLucro;


    public function __construct()
    {

    }

    public function add()
    {
        try {
            require_once("dao.php");
            $sql = "insert into ecooleo(quantOleo, quantAgua, quantOleoConsumo, valorMedioSabao, valorTotal, valorGasto, valorLucro)
            value (:quantOleo, :quantAgua, :quantOleoConsumo, :valorMedioSabao, :valorTotal, :valorGasto, :valorLucro )";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":quantOleo", $this->$quantOleo);
            $stman->bindParam(":quantAgua", $this->$quantAgua);
            $stman->bindParam(":quantOleoConsumo", $this->$quantOleoConsumo);
            $stman->bindParam(":valorMediaSabao", $this->$valorMediaSabao);
            $stman->bindParam(":valorTotal", $this->$valorTotal);
            $stman->bindParam(":valorGasto", $this->$valorGasto);
            $stman->bindParam(":valorLucro", $this->$valorLucro);         
            $stman->execute();
            aviso("Cadastrado!");
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
    }

    public function listAll()
    {
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from ecooleo";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            //$stman->bindParam(":nome", $this->nome);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("erro " .  $e->getMessage());
        }
        return $result;
    }

    public function get($id)
    {
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from ecooleo where id = :id";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->execute();
            $result = $stman->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
        return $result;
    }

