<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Route::get('/', function () {
// return view('welcome');
//});

//All Client controller routes
Route::get('/', [ClientController::class, 'home']);

Route::get('/cart', [ClientController::class, 'cart']);

Route::get('/shop', [ClientController::class, 'shop']);

Route::get('/checkout', [ClientController::class, 'checkout']);

Route::get('/loginv2', [ClientController::class, 'loginv2']);

Route::get('/signup', [ClientController::class, 'signup']);

Route::post('/createaccount', [ClientController::class, 'createaccount']);

Route::post('/accessaccount', [ClientController::class, 'accessaccount']);

Route::get('/logout', [ClientController::class, 'logout']);

Route::post('/updateqty', [ClientController::class, 'updateqty']);

Route::post('/postcheckout', [ClientController::class, 'postcheckout']);

Route::get('/addToCart/{id}', [ClientController::class, 'addToCart']);

Route::get('/view_by_cat/{name}', [ClientController::class, 'view_by_cat']);

//All Admin controller routes
Route::get('/admin', [AdminController::class, 'dashboard']);

Route::get('/orders', [AdminController::class, 'orders']);

//Product Controller routes
Route::get('/products', [ProductController::class, 'products']);

Route::get('/addproduct', [ProductController::class, 'addproduct']);

Route::post('/saveproduct', [ProductController::class, 'saveproduct']);

Route::get('/editproduct/{id}', [ProductController::class, 'editproduct']);

Route::post('/updateproduct', [ProductController::class, 'updateproduct']);

Route::get('/deleteproduct/{id}', [ProductController::class, 'deleteproduct']);

Route::get('/unactivateproduct/{id}', [ProductController::class, 'unactivateproduct']);

Route::get('/activateproduct/{id}', [ProductController::class, 'activateproduct']);

Route::get('/addToCart/{id}', [ProductController::class, 'addToCart']);

Route::get('/removeItem/{id}', [ProductController::class, 'removeItem']);

///Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');

//Route::patch('/update-cart', [ProductController::class, 'updateCartItem'])->name('update.cart');

//Route::delete('/remove-from-cart', [ProductController::class, 'removeCartItem'])->name('remove.from.cart');

//Slider Controller routes
Route::get('/sliders', [SliderController::class, 'sliders']);

Route::get('/addslider', [SliderController::class, 'addslider']);

Route::post('/saveslider', [SliderController::class, 'saveslider']);

Route::get('/editslider/{id}', [SliderController::class, 'editslider']);

Route::post('/updateslider', [SliderController::class, 'updateslider']);

Route::get('/deleteslider/{id}', [SliderController::class, 'deleteslider']);

Route::get('/unactivateslider/{id}', [SliderController::class, 'unactivateslider']);

Route::post('/activateslider', [SliderController::class, 'activateslider']);

//Category Controller routes
Route::get('/addcategory', [CategoryController::class, 'addcategory']);

Route::post('/savecategory', [CategoryController::class, 'savecategory']);

Route::get('/categories', [CategoryController::class, 'categories']);

Route::get('/editcategory/{id}', [CategoryController::class, 'edit']);

Route::post('/updatecategory', [CategoryController::class, 'updatecategory']);

Route::get('/delete/{id}', [CategoryController::class, 'delete']);

//PDF Controller routes

Route::get('/view_pdf/{id}', [PdfController::class, 'view_pdf']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);