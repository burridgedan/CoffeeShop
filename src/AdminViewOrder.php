<?php
if(isset($_POST['btnGetOrder']))
{
$tableNumber = $this->model->getOrderTable($_POST['orderList']);
?>
<div class="w3-container w3-card-4 w3-light-grey">
    <h2>Order ID: <?php echo $_POST['orderList']; ?></h2>
    <h2>Tablenumber: <?php echo $tableNumber['TableNumber']; ?></h2>
    <h2>Products Ordered: </h2>
    <table id="orderBasket" class="w3-table w3-striped w3-border">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>
        <?php 
        $orderProducts = $this->model->getOrderDetails($_POST['orderList']);
        foreach($orderProducts as $product)
        {
            $productName = $this->model->getProductDetailsByProductId($product['ProductId']);
            echo '<tr>';
                echo '<th>';
                    echo $productName['ProductName'];
                echo '</th>';

                echo '<th>';
                    echo $product['Quantity'];
                echo '</th>';
            echo '</tr>';
        }
    ?>
    </table>
    <br />
</div>
<?php
}
else
{
    echo 'You cannot access this file directly.';
    header("refresh:1;url=index.php?action=index");
}
