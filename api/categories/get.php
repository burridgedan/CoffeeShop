<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../Model/Model.php';
$model = new Model(); // connect to the database
$query = $model->showCategories();

// check if more than 0 records found
if(!empty($query))
{
    $categories = array();
    $categories["records"] = array();
    foreach($query as $rows) 
    {
        $category = [
            "CategoryName" => $rows['CategoryName'],
        ];

        array_push($categories["records"], $category);
    }
    http_response_code(200);
    echo json_encode($categories);
}
else 
{
    http_response_code(404);
    echo json_encode(["message" => "No categories found."]);
}
