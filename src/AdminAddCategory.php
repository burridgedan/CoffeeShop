<?php
if(isset($_POST['categorySendToDb']))
{
    $insertData = [
        'categoryName' => $_POST['categoryName'],
    ];

    $this->model->insertData("Category", $insertData);
    header('Location: index.php?action=adminindex');
}
else
{
    echo 'You cannot access this file directly.';
    header("refresh:1;url=index.php?action=index");
}
