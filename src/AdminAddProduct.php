<?php
if(isset($_POST['productSendToDb']))
{
    $image = $_FILES['productImage']['name'];
    $target = "Template/img/" . basename($image);

    if(move_uploaded_file($_FILES['productImage']['tmp_name'], $target))
    {
        $insertData = [
            'productCategory' => $_POST['productCategory'],
            'productName' => $_POST['productName'],
            'productDescription' => $_POST['productDescription'],
            'productImage' => $target,
            'productImageText' => $_POST['productImageText'],
            'productPrice' => $_POST['productPrice'],
        ];

        $this->model->insertData("Product", $insertData);
        header('Location: index.php?action=adminindex');
    }
    else
    {
        echo 'Failed to upload image to the website, please try again.';
        header("refresh:0.5;url=index.php?action=adminindex");
    }
}
else
{
    echo 'You cannot access this file directly.';
    header("refresh:0.5;url=index.php?action=index");
}
