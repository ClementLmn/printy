<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
include_once '../objects/product.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
// initialize object
$category = new Category($db);
$product = new Product($db);

 
// query categorys
$stmt = $category->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // categorys array
    $categorys_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only

        // La on chope les products dans cette category
        $stmt2 = $product->getCat($row['id']);
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

        $category_item=array(
            "id" => $row['id'],
            "name" => $row['name'],
            "description" => html_entity_decode($row['description']),
            "products" => $products_arr
        );

        array_push($categorys_arr, $category_item);
    }
 
    echo json_encode($categorys_arr);
}
 
else{
    echo json_encode(
        array("message" => "No categorys found.")
    );
}
?>