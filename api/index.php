<?php
include_once "./config.php";
include_once "./api.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "POST") {
    // POST
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    $myDatas = json_decode($_POST['myData']);

    //var_dump($myDatas);

    try {
        $api = new ApiCore();
        $api->ipAdress = $api->getIP();
        $api->quantLitrosColetados = $myDatas->quantLitrosColetados;
        $api->quantAguaPoluida = $myDatas->quantAguaPoluida;
        $api->quantSabaoLiquido = $myDatas->quantSabaoLiquido;
        $api->receitaTotal = $myDatas->receitaTotal;
        $api->gastoTotal = $myDatas->gastoTotal;
        $api->lucro = $myDatas->lucro;
        var_dump($api);       
        $api->add();
        http_response_code(200);
        
        echo json_encode($api->listResults);

    } catch (Exception $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    
}


if ($method === "GET") {
    // GET
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    $url = explode("/", $_GET['quest']);
    $quest = htmlspecialchars(str_replace(" ", "+", trim($url[0])));
    $num = (isset($url[1]) && is_numeric($url[1])) ? trim($url[1]) : null;

    //var_dump($quest);

    if ($quest == "cont"){
        try {
            $api = new ApiCore();
            $api->setAcesso();
            http_response_code(200);
            echo $api->listResults;
        } catch (Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }  
    
    if ($quest == "acessos"){
        try {
            $api = new ApiCore();
            $api->getAcesso();
            http_response_code(200);
            echo $api->listResults;
        } catch (Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    if ($quest == "all"){
        try {
            $api = new ApiCore();
            $api->getAll();
            http_response_code(200);
            echo $api->listResults;
        } catch (Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }


  if ($quest == "totais"){
        try {
            $api = new ApiCore();
            $api->getAllTotal();
            http_response_code(200);
            echo $api->listResults;
        } catch (Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

} else {
    http_response_code(404);
    echo json_encode(array("message" => "Item does not exist."));
}
