# GoodBuy

## An E-Commerce site for clothing, hand-made with PHP Laravel 8

#### The site contains two parts:
* **Client : Login/Signup; Cart; Billing; Enail with Invoice**
* **Admin :  Product CRUD + Categorization; Slider Changer/Updater**

![Goodbuy Home](https://user-images.githubusercontent.com/24864973/210167723-fd744eee-6eb9-407a-8e4d-3a1a1462c75d.png)

### Installation
1. Unzip the downloaded archive
2. Copy and paste **aqm** folder in your htdocs folder
3. In your terminal run `composer install`
4. Update your `.env` configurations accordingly (mainly the database configuration)
5. In your terminal run `php artisan key:generate`
6. Run `php artisan migrate` to create the database tables 
7. Go to mysql and manually import 'stationwises_table_data2' from root folder to populate the the database
8. Test!

### Client :

The client webpages consists of **13 routes** with different functions. The functions are given in the *ClientController*. Of the 13 routes, 6 routes can be viewed and have a blade, dynamic html file which is accessable to all (except the checkout page, which can only be accessed if you are logged in as a user). The five routes can be viewed using url:
* goodbuy.com
* goodbuy/shop

![goodbuy shop](https://user-images.githubusercontent.com/24864973/210167741-911d5ce0-7922-4ec4-af27-49ce3ab11056.png)

* goodbuy/cart

![goodbuy cart](https://user-images.githubusercontent.com/24864973/210167750-eb48a4b0-c211-433d-8174-7adaf6038eeb.png)

* goodbuy/loginv2
* goodbuy/signup


A navbar is present when going through the webpages, which links the other routes. The functions implemented in the *ClientController* all follow standard E-Commerce site conventions like **sorting by category, adding to cart, updating or deleting products in cart, calculating the toal price by using product quantity and price,  showing activated products, form validation, login authrization and signup(with validation for both hashed password and email), routing, client sessions and slider manipulation.**

#### Checkout
For checkout, **stripe API** was implemented. A copy of the invoice will be sent to the client mail via the laravel mailing system when a product is purchased. Another copy, along with the payment ID, will be saved in the *Orders SQL database* and shown in the admins **Orders Data Table**.

### Admin :
![goodbuy admin 1](https://user-images.githubusercontent.com/24864973/210167712-850fbeec-ce78-44e2-a0a7-d40664458cf1.png)

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

![goodbuy admin 2](https://user-images.githubusercontent.com/24864973/210167765-a4bfd97b-36bc-49dd-8019-f1c9e25f9ca7.png)

* Upload new slider image with description, edit or delete existing ones, unactivate or activate sliders in the home page as well.  
* View all orders with their details like client name, address, payment id and cart details in the Orders Data Table. An invoice will also be created as pdf if the  'details' button is clicked. 
* View current products and sliders in the Product Data Table and Sliders Data Table.

![goodbuy admin 3](https://user-images.githubusercontent.com/24864973/210167761-2b3137cd-ba2b-49fb-bc33-77d46eb6eb55.png)


Some validation is present such as the function will not allow you to enter the same category twice. All of changes made in admin dashboard will be effective in the client webpages. 

