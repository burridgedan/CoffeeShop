<?php
class Model
{
    private $dbServer = 'localhost';
    private $dbUser = '';
    private $dbPassword = '';
    private $dbDatabase = '';
    private $connectionString;
    private $connection;

    public function __construct(PDO $connection = null)
    {
        $this->connection = $connection;
        try
        {
            if($this->connection === null)
            {
                $this->connectionString = 'mysql:dbname=' . $this->dbDatabase . ';host=' . $this->dbServer;
                $this->connection = new PDO($this->connectionString, $this->dbUser, $this->dbPassword);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        catch(PDOException $error)
        {
            echo 'Connection failed: ', $error->getMessage();
        }
    }

    public function showCategories()
    {
        $sql = 'SELECT * FROM GetCategories';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getProducts()
    {
        $sql = 'SELECT * FROM GetProducts';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getOrders()
    {
        $sql = 'SELECT * FROM GetOrders';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getOrderTable($orderId)
    {
        $sql = "SELECT TableNumber FROM CustomerOrder WHERE OrderId = '$orderId'";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetch(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getOrderDetails($orderId)
    {
        $sql = "SELECT * FROM OrderDetail WHERE OrderId = '$orderId'";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getProductsByCategory($categoryId)
    {
        $sql = 'CALL GetProductsByCategory(' . $categoryId . ')';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getProductDetailsByProductId($productId) 
    {
        $sql = "SELECT * FROM `Product` WHERE `ProductId` = '$productId'";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetch(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getProductPrice($productName) 
    {
        $sql = "SELECT `ProductPrice` FROM `Product` WHERE `ProductName` = '$productName'";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetch(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getProductId($productName) 
    {
        $sql = "SELECT `ProductId` FROM `Product` WHERE `ProductName` = '$productName'";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetch(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function insertData($tableName, $data)
    {
        $sql = "INSERT INTO ";

        switch($tableName)
        {
            case "Product":
                $sql = $sql . " Product (CategoryId, ProductName, ProductDescription, ProductImage, ProductImageText, ProductPrice) 
                                VALUES(:productCategory, :productName, :productDescription, :productImage, :productImageText, :productPrice)";
                break;
            case "Category":
                $sql = $sql . " Category (CategoryName) VALUES(:categoryName)";
                break;
            case "CustomerOrder":
                $sql = $sql . " CustomerOrder (TableNumber) VALUES(:tableNumber)";
                break;
            case "OrderDetail":
                $sql = $sql . " OrderDetail (OrderId, ProductId, Quantity) VALUES(:orderId, :productId, :orderQuantity)";
                break;
            default: // table does not exist or is an invalid table.
                echo '<h1>Error, non table selected.</h1>';
                break;
        }

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);
        $id = $this->connection->lastInsertId();
        return $id;
    }

    public function updateCategoryName($data)
    {
        $sql = "UPDATE Category SET CategoryName = :newCategoryName WHERE CategoryId = :categoryId";

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);
    }

    public function removeCategory($data)
    {
        $sql = "DELETE FROM Category WHERE CategoryId = :categoryId";

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);
    }

    public function updateProduct($data)
    {
        $sql = "UPDATE Product SET 
            CategoryId = :productCategory,
            ProductName = :productName,
            ProductDescription = :productDescription, 
            ProductImage = :productImage, 
            ProductImageText = :productImageText, 
            ProductPrice = :productPrice
            WHERE ProductId = :productId";

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);
    }

    public function removeProduct($data)
    {
        $sql = "DELETE FROM Product WHERE ProductId = :productId";

        $statement = $this->connection->prepare($sql);
        $statement->execute($data);
    }
}
