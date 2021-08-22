# GoodBuy

### An E-Commerce site for clothing, hand-made made with PHP Laravel

#### The site contains two parts:
* **Client**
* **Admin**

#### Client :

The client webpages consists of **13 routes** with different functions. The functions are given in the *ClientController*. Of the 13 routes, 6 routes can be viewed and have a blade, dynamic html file which is accessable to all (except the checkout page, which can only be accessed if you are logged in as a user). The five routes can be viewed using url:
* goodbuy.com
* goodbuy/shop
* goodbuy/cart
* goodbuy/loginv2
* goodbuy/signup

A navbar is present when going through the webpages, which links the other routes. The functions implemented in the *ClientController* all follow standard E-Commerce site conventions like **sorting by category, adding to cart, showing activated products, form validation, login authrization and signup(with validation for both hashed password and email), routing, and slider manipulation.**

#### Checkout
For checkout, **stripe API** was implemented. A copy of the invoice will be sent to the client mail via the laravel mailing system when a product is purchased. Another copy, along with the payment ID, will be saved in the *Orders SQL database* and shown in the admins **Orders Data Table**.


    



