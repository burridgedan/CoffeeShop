<?php
class Controller
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->showCategories();
    }

    public function basket()
    {
        return 'src/Basket.php';
    }

    public function order()
    {
        return 'src/Order.php';
    }

    public function addtobasket()
    {
        return 'src/AddToBasket.php';
    }

    public function adminLogin()
    {
        return 'src/AdminLogin.php';
    }

    public function adminindex()
    {
        return 'src/AdminIndex.php';
    }

    public function adminCreateCategory() 
    {
        return 'src/AdminAddCategory.php';
    }

    public function adminUpdateCategory() 
    {
        return 'src/AdminUpdateCategory.php';
    }

    public function adminCreateProduct() 
    {
        return 'src/AdminAddProduct.php';
    }

    public function adminUpdateProduct() 
    {
        return 'src/AdminUpdateProduct.php';
    }

    public function adminViewOrder() 
    {
        return 'src/AdminViewOrder.php';
    }
}