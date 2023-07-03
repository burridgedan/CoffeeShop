# Coffee Shop Site
This repository is for the code I created in 2019 - 2020 for a second-year university module.

* The only changes to the code since the assignment was handed in are making it compatible with PHP 8.1 (the demo site runs on PHP 8.1.11 currently) and updating font awesome.
* The admin panel is not usable on the demo to stop abuse. If you wish to test the admin panel, please download the code from this repo and run it on your own local environment.
* You will need to generate your own kit link for font awesome. You can find the relevant line in Template/header.php.
* The database structure can be found within SQL/database.sql.
* Database connection settings can be set under Model/Model.php.

You can find the live site at: https://demo.dburridge.com/restaurant/

I am happy to support people who wish to use this code for education. I also accept feedback on improving the code and improving myself. Please note that apart from
the small changes to make the code work with PHP 8.1. I have not looked at this code since 2020.

I achieved 71.25% (a first) for this piece of work and 74.25% for the overall module.

## Application Description
This application allows a customer to order from a menu which is stored in a MySQL database. The basket icon on the top right of the application shows how many products are within the customer’s basket. When a customer clicks on the image of a product, it opens a popup window showing the product details and allowing them to add the product to their basket.

On the basket, the customer can add or remove from the quantity of the product, and it lists all products, the quantity they wish to order, and the price. At the bottom of the basket page the customer has the option of emptying their entire basket or selecting a table number and ordering their basket. Their order is then sent to the database.

In summary, the customer can do the following actions:
- View products for sale
- Add a product to their basket
- View their basket
- Edit the number of products in their basket
- Remove items from their basket
- Empty their basket
- Order the items within their basket

The admin user controls the content of the site. They can add categories and products to those categories, which show up on the main page for customers to purchase. They can also edit or remove those categories/products. The changes to categories or products show instantly on the main page when refreshed because the application always pulls its latest data from the database.

Alongside the above, the admin user can also view successful orders stored within the database.

In summary, the admin user has access to the following features:
- The ability to create a product category
- The ability to create a product and add it to a category
- The ability to edit/remove a category
- The ability to edit/remove a product
- The ability to view orders that are in the database.

## Credits
- W3.CSS v4: https://www.w3schools.com/w3css
- Font Awesome Version 6: https://fontawesome.com/
- "data-count" CSS code provided from https://stackoverflow.com/a/51160175
