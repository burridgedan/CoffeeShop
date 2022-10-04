<?php
session_start();

if(!array_key_exists('basketItemName', $_SESSION) && empty($_SESSION['basketItemName'])) {
    $_SESSION['basketItemName'] = array();
}

if(!array_key_exists('basketItemQuantity', $_SESSION) && empty($_SESSION['basketItemQuantity'])) {
    $_SESSION['basketItemQuantity'] = array();
}

if(!array_key_exists('isAdminLoggedIn', $_SESSION) && empty($_SESSION['isAdminLoggedIn'])) {
    $_SESSION['isAdminLoggedIn'] = false;
}

$_SESSION["itemsInBasket"] = count($_SESSION['basketItemName']);
?>
<!DOCTYPE html>
<html>
<title>Coffee Shop</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" href="Template/style.css">

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/b828a67e1e.js" crossorigin="anonymous"></script>

<body>
<!-- Top of Page (Title, Home and Basket buttons) -->
<div class="w3-top">
    <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left"><a href="index.php?action=index">
            <i class="fas fa-home"></i></a>
        </div>
        <div class="w3-button w3-right w3-padding-16"><a href="index.php?action=basket">
            <i class="fas fa-shopping-basket" data-count="<?php echo $_SESSION["itemsInBasket"]; ?>"></i></a>
        </div>
        <div class="w3-center w3-padding-16">Coffee Shop</div>
    </div>
</div>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
