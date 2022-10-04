-- create tables
CREATE TABLE IF NOT EXISTS `Category` (
    `CategoryId` INT NOT NULL AUTO_INCREMENT,
    `CategoryName` VARCHAR(255) NOT NULL,

    CONSTRAINT catname_unique UNIQUE (`CategoryName`),
    CONSTRAINT pk_categories PRIMARY KEY (`CategoryId`)
);

CREATE TABLE IF NOT EXISTS `Product` (
    `ProductId` INT NOT NULL AUTO_INCREMENT,
    `CategoryId` INT NOT NULL,
    `ProductName` VARCHAR(255) NOT NULL,
    `ProductDescription` VARCHAR(255) NOT NULL,
    `ProductImage` VARCHAR(255) NOT NULL,
    `ProductImageText` VARCHAR(255) NOT NULL,
    `ProductPrice` NUMERIC(10,2) NOT NULL,

    CONSTRAINT productname_unique UNIQUE (`ProductName`),
    CONSTRAINT fk_categories FOREIGN KEY (`CategoryId`) REFERENCES `Category` (`CategoryId`),
    CONSTRAINT pk_products PRIMARY KEY (`ProductId`)
);

CREATE TABLE IF NOT EXISTS `CustomerOrder` (
    `OrderId` INT NOT NULL AUTO_INCREMENT,
    `TableNumber` INT NOT NULL,

    CONSTRAINT pk_orders PRIMARY KEY (`OrderId`)
);

CREATE TABLE IF NOT EXISTS `OrderDetail` (
    `OrderId` INT NOT NULL,
    `ProductId` INT NOT NULL,
    `Quantity` INT NOT NULL,

    CONSTRAINT fk_orders FOREIGN KEY (`OrderId`) REFERENCES `CustomerOrder` (`OrderId`),
    CONSTRAINT fk_products FOREIGN KEY (`ProductId`) REFERENCES `Product` (`ProductId`),
    CONSTRAINT pk_orderdetail PRIMARY KEY (`OrderId`, `ProductId`)
);

-- create the views
CREATE VIEW GetCategories
AS 
    SELECT *
    FROM `Category` 
    ORDER BY `CategoryId` ASC;

CREATE VIEW GetProducts
AS 
    SELECT *
    FROM `Product` 
    ORDER BY `ProductId` ASC;

CREATE VIEW GetOrders
AS 
    SELECT *
    FROM `CustomerOrder` 
    ORDER BY `OrderId` ASC;

-- create the procedures 
-- syntax is CALL ProcedureName(parameters (if any))
CREATE PROCEDURE GetProductsByCategory(IN category INT)
    SELECT * FROM Product WHERE CategoryId = category;

CREATE PROCEDURE GetProductDetailsByProductId(IN productid INT)
    SELECT * FROM Product WHERE ProductId = productid;

CREATE PROCEDURE GetOrderDetails(IN ordernum INT)
    SELECT * FROM OrderDetail WHERE OrderId = ordernum;
