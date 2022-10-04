<?php
if(isset($_POST['btnUpdateCategory']))
{
    $insertData = [
        'categoryId' => $_POST['productCategory'],
        'newCategoryName' => $_POST['updateCategoryName'],
    ];
    $this->model->updateCategoryName($insertData);

    header('Location: index.php?action=adminindex');
}
else if(isset($_POST['btnRemoveCategory']))
{
    $insertData = [
        'categoryId' => $_POST['productCategory'],
    ];
    $this->model->removeCategory($insertData);

    header('Location: index.php?action=adminindex');
}
else
{
    echo 'You cannot access this file directly.';
    header("refresh:1;url=index.php?action=index");
}
