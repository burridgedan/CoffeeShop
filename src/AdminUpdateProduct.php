<?php
if(isset($_POST['btnUpdateProduct']))
{
$product = $this->model->getProductDetailsByProductId($_POST['productName']);

// set some session variables to store the product data for when the updated data is sent
$_SESSION['productId'] = $product['ProductId'];
$_SESSION['productCategory'] = $product['CategoryId'];
$_SESSION['productName'] = $product['ProductName'];
$_SESSION['productDescription'] = $product['ProductDescription'];
$_SESSION['productImage'] = $product['ProductImage'];
$_SESSION['productImageText'] = $product['ProductImageText'];
$_SESSION['productPrice'] = $product['ProductPrice'];
?>
<div class="w3-container w3-card-4 w3-light-grey">
    <h2>Product Name: <?php echo $product['ProductName']; ?></h2>
    <h2>Product Description: <?php echo $product['ProductDescription']; ?></h2>
    <h2>Product Image: </h2>
    <img src="<?php echo $product['ProductImage']; ?>" alt="<?php echo $product['ProductImageText']; ?>" style="width:40%">
    <h2>Product Image Text: <?php echo $product['ProductImageText']; ?></h2>
    <h2>Product Price: £ <?php echo $product['ProductPrice']; ?></h2>
</div>

<hr />

<form method="POST" action="index.php?action=adminUpdateProduct" enctype="multipart/form-data"  class="w3-container w3-card-4 w3-light-grey">
    <h2>Edit Product</h2>
    <h4>*Leave fields you don't wish to change blank*</h4>

    <p><label>Select Category:</label>
    <select class="w3-input w3-border" name="productCategory">
        <?php
            $results = $this->model->showCategories();

            foreach($results as $row)
            {
                if($product['CategoryId'] == $row['CategoryId'])
                {
                    echo '<option value="' . $row['CategoryId'] . '" selected>' . $row['CategoryName'] . '</option>';
                }
                else 
                {
                    echo '<option value="' . $row['CategoryId'] . '">' . $row['CategoryName'] . '</option>';
                }
            }
        ?>
    </select></p>
    <p>Product Name: <input class="w3-input w3-border" name="productName" type="text"></p>
    <p>Product Description: <textarea class="w3-input w3-border" cols="40" rows="4" name="productDescription"></textarea></p>
    <p>Choose an Image (2MB or less): <input class="w3-input w3-border" type="file" name="productImage"></p>
    <p>Image Text (if image cannot be loaded): <input class="w3-input w3-border" type="text" name="productImageText"></p>
    <p>Product Price: <input class="w3-input w3-border" type="number" step="0.01" name="productPrice"></p>
    <p><button class="w3-button w3-green" type="submit" name="btnProductUpdate">Save Changes</button></p>
</form>
<?php
}
else if(isset($_POST['btnRemoveProduct']))
{
    $insertData = [
        'productId' => $_POST['productName'],
    ];
    $this->model->removeProduct($insertData);

    echo 'You removed the product from sale.';
    header("refresh:1;url=index.php?action=adminindex");
}
else if(isset($_POST['btnProductUpdate']))
{
    if($_SESSION['productCategory'] == $_POST['productCategory'])
    {
        $categoryId = $_SESSION['productCategory'];
    }
    else 
    {
        $categoryId = $_POST['productCategory'];
    }
    
    if(empty($_POST['productName']))
    {
        $productName = $_SESSION['productName'];
    }
    else 
    {
        $productName = $_POST['productName'];
    }

    if(empty($_POST['productDescription']))
    {
        $productDescription = $_SESSION['productDescription'];
    }
    else 
    {
        $productDescription = $_POST['productDescription'];
    }

    if(empty($_POST['productImage']))
    {
        $image = $_FILES['productImage']['name'];
        $productImage = "Template/img/" . basename($image);
    }
    else 
    {
        $productImage = $_POST['productImage'];
    }

    if(empty($_POST['productImageText']))
    {
        $productImageText = $_SESSION['productImageText'];
    }
    else 
    {
        $productImageText = $_POST['productImageText'];
    }

    if(empty($_POST['productPrice']))
    {
        $productPrice = $_SESSION['productPrice'];
    }
    else 
    {
        $productPrice = $_POST['productPrice'];
    }

    $productId = $_SESSION['productId'];

    $insertData = [
        'productCategory' => $categoryId,
        'productName' => $productName,
        'productDescription' => $productDescription,
        'productImage' => $productImage,
        'productImageText' => $productImageText,
        'productPrice' => $productPrice,
        'productId' => $productId,
    ];
    $this->model->updateProduct($insertData);

    echo 'You updated the product.';
    header("refresh:1;url=index.php?action=adminindex");
}
else
{
    echo 'You cannot access this file directly.';
    header("refresh:1;url=index.php?action=index");
}
