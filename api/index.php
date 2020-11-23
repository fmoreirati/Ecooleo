<?php
include_once "./config.php";
include_once "./api.php";

$method = $_SERVER["REQUEST_METHOD"];

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
            $api->getAcesso();
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

} else {
    http_response_code(404);
    echo json_encode(array("message" => "Item does not exist."));
}
