<?php
if(isset($_POST['btnOrder'])) 
{
    $insertOrder = [
        'tableNumber' => $_POST['tableNumber'],
    ];
    $orderId = $this->model->insertData("CustomerOrder", $insertOrder);

    for($i = 0; $i < count($_SESSION['basketItemName']); $i++)
    {
        $itemId = $this->model->getProductId($_SESSION['basketItemName'][$i]);
        $insertOrderDetail = [
            'orderId' => $orderId,
            'productId' => $itemId['ProductId'],
            'orderQuantity' => $_SESSION['basketItemQuantity'][$i],
        ];
        $this->model->insertData("OrderDetail", $insertOrderDetail);
    }
    

    // reset the basket arrays once ordered
    $_SESSION['basketItemName'] = array();
    $_SESSION['basketItemQuantity'] = array();

    echo 'Your order has been accepted.';
    //header("refresh:1;url=index.php?action=index");
}
else
{
    echo 'You cannot access this file directly.';
    header("refresh:1;url=index.php?action=index");
}
