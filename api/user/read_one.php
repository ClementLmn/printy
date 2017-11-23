<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$user = new User($db);
 
// set ID property of product to be edited
$user->mail = isset($_GET['mail']) ? $_GET['mail'] : die();
 
// read the details of product to be edited
$user->readOne();
 
// create array
$user_arr = array(
    "id" =>  $user->id,
    "fname" => $user->fname,
    "lname" => $user->lname,
    "pwd" => $user->pwd,
    "mail" => $user->mail
 
);
 
// make it json format
print_r(json_encode($user_arr));
?>