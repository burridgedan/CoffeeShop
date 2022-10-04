<script src="src/js/refreshBasket.js"></script>

<table id="basket" class="w3-table w3-striped w3-border">
    <tr>
        <th>Product</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Add/Remove</th>
    </tr>
    <?php 
        $totalCost = 0;

        for($i = 0; $i < count($_SESSION['basketItemName']); $i++)
        {
            $itemPrice = $this->model->getProductPrice($_SESSION['basketItemName'][$i]);
            echo '<tr>';
                echo '<th>';
                    echo $_SESSION['basketItemName'][$i];
                echo '</th>';

                echo '<th>';
                    echo $_SESSION['basketItemQuantity'][$i];
                echo '</th>';

                echo '<th>';
                    echo '£' . floatval($itemPrice['ProductPrice']) * floatval($_SESSION['basketItemQuantity'][$i]);
                    $totalCost = $totalCost + floatval($itemPrice['ProductPrice']) * floatval($_SESSION['basketItemQuantity'][$i]);
                echo '</th>';

                echo '<th>';
                    echo '<form action="" method="POST">
                            <input type="hidden" name="productIndex" value="' . $i . '" /> 
                            <button id="addQuantity" name="btnAddQuantity" class="w3-button w3-green"><i class="fas fa-plus"></i></button>
                        </form>';
                    echo '<form action="" method="POST">
                            <input type="hidden" name="productIndex" value="' . $i . '" /> 
                            <button id="minusQuantity" name="btnMinusQuantity" class="w3-button w3-red"><i class="fas fa-minus"></i></button>
                        </form>';
                echo '</th>';
            echo '</tr>';
        }
    ?>
</table>

<?php
if($_SESSION["itemsInBasket"] >= 1)
{
    echo '<h1>Total: £' . $totalCost . '</h1>';
    echo '<form method="POST" action="index.php?action=order" enctype="multipart/form-data">
            <select name="tableNumber">
                <option value="1">Table 1</option>
                <option value="2">Table 2</option>
                <option value="3">Table 3</option>
                <option value="4">Table 4</option>
                <option value="5">Table 5</option>
                <option value="6">Table 6</option>
                <option value="7">Table 7</option>
                <option value="8">Table 8</option>
                <option value="9">Table 9</option>
                <option value="10">Table 10</option>
            </select>
            <button name="btnOrder" class="w3-button w3-green">Order</button>
        </form>';

    echo '<form method="POST" action="index.php?action=basket" enctype="multipart/form-data">';
        echo '<button name="btnClearBasket" class="w3-button w3-red">Empty Basket</button>';
    echo '</form>';
}

if(isset($_POST['btnClearBasket']))
{
    $_SESSION['basketItemName'] = array();
    $_SESSION['basketItemQuantity'] = array();

    refreshBasket();
}

if(isset($_POST['btnAddQuantity'])) 
{
    $productIndex = $_POST['productIndex'];
    $_SESSION['basketItemQuantity'][$productIndex] += 1;

    refreshBasket();
}

if(isset($_POST['btnMinusQuantity'])) 
{
    $productIndex = $_POST['productIndex'];
    
    if($_SESSION['basketItemQuantity'][$productIndex] == 1)
    {
        $_SESSION['basketItemQuantity'][$productIndex] -= 1;
        array_splice($_SESSION['basketItemName'], $productIndex, 1);
        array_splice($_SESSION['basketItemQuantity'], $productIndex, 1);
    }
    else if($_SESSION['basketItemQuantity'][$productIndex] > 1)
    {
        $_SESSION['basketItemQuantity'][$productIndex] -= 1;
    }

    refreshBasket();
}

/*
* Refreshes basket page while checking whether headers have been sent or not.
* If headers have already been sent then it will use Javascript to refresh the window and give the user the latest data.
* Credit: https://www.php.net/manual/en/function.headers-sent.php#60450
*/
function refreshBasket()
{
    if(!headers_sent())
    {
        header("refresh:0.5;url=index.php?action=basket");
    }
    else 
    {
        echo '<script type="text/javascript">';
        echo 'window.location.href = index.php?action=basket;';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=index.php?action=basket" />';
        echo '</noscript>';
    }
}