<?php
$results = $this->controller->index();

foreach($results as $row)
{
    echo '<h1>' . $row['CategoryName'] . '</h1><hr />';
    $result = $this->model->getProductsByCategory($row['CategoryId']);

    echo '<div class="flex-container">';
    foreach($result as $rows) 
    {
    ?>
        <section>
            <img class="w3-hover-opacity" src="<?php echo $rows['ProductImage']; ?>" 
            onclick="document.getElementById('<?php echo $rows['ProductName']; ?>').style.display='block'" alt=" 
            <?php echo $rows['ProductImageText']; ?>" style="width:60%">
            <p><?php echo $rows['ProductName']; ?></p>
            <p><?php echo $rows['ProductDescription']; ?><br />£ <?php echo $rows['ProductPrice']; ?></p>
        </section>

        <div id="<?php echo $rows['ProductName']; ?>" name="<?php echo $rows['ProductName']; ?>" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('<?php echo $rows['ProductName']; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <br />
                    <img src="<?php echo $rows['ProductImage']; ?>" alt="<?php echo $rows['ProductImageText']; ?>" style="width:40%">
                    <p><?php echo $rows['ProductDescription']; ?></p>
                    
                    <form id="btnAddItem" method="POST" action="index.php?action=addtobasket" enctype="multipart/form-data">
                        <input type="hidden" name="product_name" value="<?php echo $rows['ProductName']; ?>" /> 
                        <input type="hidden" name="product_quantity" value="1" />     
                        <input id="btnSubmitToBasket" type="submit" value="Add to Basket" name="btnSubmitToBasket" class="w3-button w3-green">
                    </form>
                    <br /><br />
                </div>
            </div>
        </div>
    <?php
    }
    echo '</div>';
}
