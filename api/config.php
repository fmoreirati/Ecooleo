<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//Configuração do DAO para acesso ao Bando de dados
//linux - Professor
define("DRIVE","mysql");
define("HOST","172.17.0.2");
define("PORT","3306");
define("USER","root");
define("PASS","mypass");
define("DB","ecooleo");

//Windows - Xampp
// define("DRIVE","mysql");
// define("HOST","localhost");
// define("PORT","3306");
// define("USER","root");
// define("PASS","");
// define("DB","phpschool");