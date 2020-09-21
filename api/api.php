<?php
require_once("dao.php");
require_once("ecooleo.php");
require_once("mesagem.php");

$method = $_SERVER["REQUEST_METHOD"];


if ($method === "POST"){
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$eco = new Ecooleo;
$eco->quantOleo = htmlspecialchars($_POST['quantOleo']);
$eco->quantAgua = htmlspecialchars($_POST['quantAgua']);
$eco->quantOleoConsumo = htmlspecialchars($_POST['quantOleoConsumo']);
$eco->valorMedioSabao = htmlspecialchars($_POST['quantMediaSabao']);
$eco->valorTotal = htmlspecialchars($_POST['quantTotal']);
$eco->valorGasto = htmlspecialchars($_POST['quantGasto']);
$eco->valorLucro = htmlspecialchars($_POST['quantLucro']);
// create the product
$result = $eco->add();
if($result){

return $this->listResults = json_encode(array_values($result));

// set response code - 201 created
http_response_code(201);

// tell the user
echo json_encode(array("message" => "Product was created."));
}

// if unable to create the product, tell the user
else{

// set response code - 503 service unavailable
http_response_code(503);

// tell the user
echo json_encode(array("message" => "Unable to create product."));
}
}

// tell the user data is incomplete
else{

// set response code - 400 bad request
http_response_code(400);

// tell the user
echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}

}

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
// header("Access-Control-Allow-Methods: GET");
// header("Access-Control-Allow-Credentials: true");
// header('Content-Type: application/json');

// // required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// // get database connection
// include_once '../config/database.php';

// // instantiate product object
// include_once '../objects/product.php';

// $database = new Database();
// $db = $database->getConnection();

// $product = new Product($db);

// // get posted data
// $data = json_decode(file_get_contents("php://input"));

// // make sure data is not empty
// if(
// !empty($data->name) &&
// !empty($data->price) &&
// !empty($data->description) &&
// !empty($data->category_id)
// ){

// // set product property values
// $product->name = $data->name;
// $product->price = $data->price;
// $product->description = $data->description;
// $product->category_id = $data->category_id;
// $product->created = date('Y-m-d H:i:s');