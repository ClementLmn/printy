<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
include_once '../objects/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare category object
$category = new Category($db);
$product = new Product($db);
 
// set ID property of category to be edited
$category->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of category to be edited
$category->readOne();

 // La on chope les products dans cette category
 $stmt2 = $product->getCat($_GET['id']);
 $num2 = $stmt2->rowCount();
 $products_arr=array();
 if($num2>0){

     while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
         // extract row
         // this will make $row['name'] to
         // just $name only
  
         $product_item=array(
             "id" => $row2['id'],
             "image_path" => $row2['image_path'],
             "name" => $row2['name'],
             "description" => html_entity_decode($row2['description']),
             "price" => $row2['price']
         );
  
         array_push($products_arr, $product_item);
     }

 }
 
// create array
$category_arr = array(
    "id" =>  $category->id,
    "name" => $category->name,
    "description" => $category->description,
    "products" => $products_arr
);
 
// make it json format
print_r(json_encode($category_arr));
?>