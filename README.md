# GoodBuy

## An E-Commerce site for clothing, hand-made with PHP Laravel
Live View: https://goodbuy-ecommerce.herokuapp.com/

#### The site contains two parts:
* **Client : Login/Signup; Cart; Billing; Enail with Invoice**
* **Admin :  Product CRUD + Categorization; Slider Changer/Updater**


### Client :

The client webpages consists of **13 routes** with different functions. The functions are given in the *ClientController*. Of the 13 routes, 6 routes can be viewed and have a blade, dynamic html file which is accessable to all (except the checkout page, which can only be accessed if you are logged in as a user). The five routes can be viewed using url:
* goodbuy.com
* goodbuy/shop
* goodbuy/cart
* goodbuy/loginv2
* goodbuy/signup

A navbar is present when going through the webpages, which links the other routes. The functions implemented in the *ClientController* all follow standard E-Commerce site conventions like **sorting by category, adding to cart, updating or deleting products in cart, calculating the toal price by using product quantity and price,  showing activated products, form validation, login authrization and signup(with validation for both hashed password and email), routing, client sessions and slider manipulation.**

#### Checkout
For checkout, **stripe API** was implemented. A copy of the invoice will be sent to the client mail via the laravel mailing system when a product is purchased. Another copy, along with the payment ID, will be saved in the *Orders SQL database* and shown in the admins **Orders Data Table**.

### Admin :

Access: goodbuy/admin

The admin webpages consists of **27 routes** with different functions. The functions are given in the follwowing controllers:
* AdminController
* CategoryController
* ProductController
* SliderController
* PdfController

Of the 27 routes, 11 routes can be viewed and have a blade, dynamic html file which is accessable to all admins.
To be allowed to enter the backend admin you have to first go through the **laravel authentication system**, which will require you to signup first. An option is available which will send a email token for **resetting your password** if you forgot it. To signup use the url:
*goodbuy/signin*

In the admin dashboard you can:
* Create new categories. You can later edit or delete categories.
* Create new products (with other details such as images and price). Categories must be selected from the existing ones. You can edit or delete product details and  unactivate or activate products in the Products Data Table.
* Upload new slider image with description, edit or delete existing ones, unactivate or activate sliders in the home page as well.  
* View all orders with their details like client name, address, payment id and cart details in the Orders Data Table. An invoice will also be created as pdf if the  'details' button is clicked. 
* View current products and sliders in the Product Data Table and Sliders Data Table.

Some validation is present such as the function will not allow you to enter the same category twice. All of changes made in admin dashboard will be effective in the client webpages. 





    



