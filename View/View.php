<?php
class View
{
    private $model;
    private $controller;

    public function __construct($controller, $model)
    {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output()
    {
        if(isset($_GET['action']) && !empty($_GET['action']))
        {
            switch($_GET['action'])
            {
                case "index":
                    include "src/SiteIndex.php";
                    break;

                case "order":
                    include $this->controller->order();
                    break;

                case "basket":
                    include $this->controller->basket();
                    break;

                case "addtobasket":
                    include $this->controller->addtobasket();
                    break;

                case "adminLogin":
                    include $this->controller->adminLogin();
                    break;

                case "adminindex":
                    include $this->controller->adminindex();
                    break;
 
                case "adminCreateCategory":
                    include $this->controller->adminCreateCategory();
                    break;

                case "adminUpdateCategory":
                    include $this->controller->adminUpdateCategory();
                    break;

                case "adminCreateProduct":
                    include $this->controller->adminCreateProduct();
                    break;

                case "adminUpdateProduct":
                    include $this->controller->adminUpdateProduct();
                    break;

                case "adminViewOrder":
                    include $this->controller->adminViewOrder();
                    break;

                default:
                    echo 'This page does not exist. Redirecting back to the main page...';
                    header("refresh:1; url=index.php?action=index");
                    break;
            }
        }
    }
}