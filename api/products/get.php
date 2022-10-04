<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../Model/Model.php';
$model = new Model(); // connect to the database
$query = $model->getProducts();

// check if more than 0 records found
if(!empty($query))
{
    $products = array();
    $products["records"] = array();
    foreach($query as $rows) 
    {
        $product = [
            "ProductName" => $rows['ProductName'],
            "ProductDescription" => $rows['ProductDescription'],
            "ProductPrice" => $rows['ProductPrice'],
        ];

        array_push($products["records"], $product);
    }
    http_response_code(200);
    echo json_encode($products);
}
else 
{
    http_response_code(404);
    echo json_encode(["message" => "No products found."]);
}
