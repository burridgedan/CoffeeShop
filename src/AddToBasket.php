<?php 
if(isset($_POST['btnSubmitToBasket']))
{
    if(in_array($_POST['product_name'], $_SESSION['basketItemName'])) 
    {
        $index = array_search($_POST['product_name'], $_SESSION['basketItemName']);
        $_SESSION['basketItemQuantity'][$index] += 1;
    }
    else 
    {
        array_push($_SESSION['basketItemName'], $_POST['product_name']);
        array_push($_SESSION['basketItemQuantity'], $_POST['product_quantity']);
    }
    
    header("Location: index.php?action=basket");
}
else
{
    echo 'You cannot access this file directly.';
    header("refresh:1;url=index.php?action=index");
}
