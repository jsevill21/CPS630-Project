Main Page
---------
The online service platform (OSP) lets customers order items and have these items delivered to them. The main page is where they can see the items.
Customers can place orders using the following steps:
  1. Customer adds items from the shop into the shopping cart using the drag and drop method
  2. Customer selects a branch for delivery and enters their login credentials
  3. When customer presses submit, they will be directed to a new page that shows the invoice summary and the delivery route on a map
  4. Customer accepts the invoice and submits
  5. A truck is assigned to the customer's order and a message is displayed to confirm the order

About Us
--------
This page shows email info of each team member. The link to it is found in the main page.

Services
--------
Summarizes what services are provided by the OSP. The link to it is found in the main page.

DB Maintain, SQL Forms, Admin
-----------------------------------
This option found in the main page allows a database admin to do SQL actions. When they select an action (insert, delete, update, select) they are directed to SQL Forms.php that shows different forms based on the selected action. When the appropiate form is completed, the admin is directed to Admin.php that shows or confirms the results.

Search
------
When clicked, this option found in the main page makes a dialogue box appear. A user can enter an order ID in the dialogue box to search for their order. They will be directed to a new page (Search.php) that uses SQL queries to show the results. 

PHP Class
---------
A PHP file that connects to the database abd has a class that other files can use so that they can do SQL queries in the database.

Invoice
-------------
Validates login info and shows items in the shopping cart after a user submits their order.

Database
--------
The name of the database is osp.
