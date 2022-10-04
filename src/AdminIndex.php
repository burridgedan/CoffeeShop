<?php
if($_SESSION['isAdminLoggedIn'] == false)
{
?>
<form method="POST" action="index.php?action=adminLogin" enctype="multipart/form-data" class="w3-container w3-card-4 w3-light-grey">
    <h2>Enter the Admin Pin to Login</h2>

    <p><label>Admin Pin:</label>
    <input class="w3-input w3-border" name="adminPin" type="password"></p>

    <p><button class="w3-button w3-green" type="submit" name="btnAdminLogin">Login</button></p>
</form>
<?php
}
else if($_SESSION['isAdminLoggedIn'] == true)
{
?>
<form method="POST" action="index.php?action=adminCreateCategory" enctype="multipart/form-data" class="w3-container w3-card-4 w3-light-grey">
    <h2>Create a New Product Category</h2>

    <p><label>Category Name:</label>
    <input class="w3-input w3-border" name="categoryName" type="text"></p>

    <p><button class="w3-button w3-green" type="submit" name="categorySendToDb">Save</button></p>
</form>

<hr />

<form method="POST" action="index.php?action=adminUpdateCategory" enctype="multipart/form-data"  class="w3-container w3-card-4 w3-light-grey">
    <h2>Edit Category</h2>

    <p><label>Select Category:</label>
    <select id="productCategory" class="w3-input w3-border" name="productCategory">
        <?php
            $results = $this->model->showCategories();

            foreach($results as $row)
            {
                echo '<option value="' . $row['CategoryId'] . '">' . $row['CategoryName'] . '</option>';
            }
        ?>
    </select></p>
    <p>New Category Name: <input class="w3-input w3-border" type="text" name="updateCategoryName"></p>
    <p><button class="w3-button w3-green" type="submit" name="btnUpdateCategory">Update Category</button></p>
    <p><button class="w3-button w3-red" type="submit" name="btnRemoveCategory">Remove Category</button></p>
</form>

<hr />

<form method="POST" action="index.php?action=adminCreateProduct" enctype="multipart/form-data"  class="w3-container w3-card-4 w3-light-grey">
    <h2>Create a New Product</h2>

    <p><label>Select Category:</label>
    <select class="w3-input w3-border" name="productCategory">
        <?php
            $results = $this->model->showCategories();

            foreach($results as $row)
            {
                echo '<option value="' . $row['CategoryId'] . '">' . $row['CategoryName'] . '</option>';
            }
        ?>
    </select></p>
    <p>Product Name: <input class="w3-input w3-border" name="productName" type="text"></p>
    <p>Product Description: <textarea class="w3-input w3-border" cols="40" rows="4" name="productDescription"></textarea></p>
    <p>Choose an Image (2MB or less): <input class="w3-input w3-border" type="file" name="productImage"></p>
    <p>Image Text (if image cannot be loaded): <input class="w3-input w3-border" type="text" name="productImageText"></p>
    <p>Product Price: <input class="w3-input w3-border" type="number" step="0.01" name="productPrice"></p>
    <p><button class="w3-button w3-green" type="submit" name="productSendToDb">Save</button></p>
</form>

<hr />

<form method="POST" action="index.php?action=adminUpdateProduct" enctype="multipart/form-data"  class="w3-container w3-card-4 w3-light-grey">
    <h2>Edit Product</h2>

    <p><label>Select Product:</label>
    <select id="productName" class="w3-input w3-border" name="productName">
        <?php
            $results = $this->model->getProducts();

            foreach($results as $row)
            {
                echo '<option value="' . $row['ProductId'] . '">' . $row['ProductName'] . '</option>';
            }
        ?>
    </select></p>
    <p><button class="w3-button w3-green" type="submit" name="btnUpdateProduct">Edit Product</button></p>
    <p><button class="w3-button w3-red" type="submit" name="btnRemoveProduct">Remove Product</button></p>
</form>

<hr />

<form method="POST" action="index.php?action=adminViewOrder" enctype="multipart/form-data"  class="w3-container w3-card-4 w3-light-grey">
    <h2>Orders</h2>

    <p><label>Select Order:</label>
    <select id="orders" class="w3-input w3-border" name="orderList">
        <?php
            $results = $this->model->getOrders();

            foreach($results as $row)
            {
                echo '<option value="' . $row['OrderId'] . '">' . $row['OrderId'] . '</option>';
            }
        ?>
    </select></p>
    <p><button class="w3-button w3-green" type="submit" name="btnGetOrder">Show Order Details</button></p>
</form>

<?php
}
