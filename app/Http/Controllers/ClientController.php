<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;use App\Models\Cart;use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ClientController extends Controller
{
 //
 public function home()
 {
  $products = Product::where('status', 1)->get(); //if product is activated
  $sliders = Slider::where('status', 1)->get();
  return view('client.home')->with('sliders', $sliders)->with('products', $products);

 }

 public function cart()
 {
  if (!Session::has('cart')) {return view('client.cart');} else {

   $oldCart = Session::has('cart') ? Session::get('cart') : null;

   $cart = new Cart($oldCart);

   //dd(Session::get('cart'));
   return view('client.cart', ['products' => $cart->items]);}
 }

 public function addToCart($id)
 {
  $product = Product::find($id);
  $oldCart = Session::has('cart') ? Session::get('cart') : null;
  $cart = new Cart($oldCart);
  $cart->add($product, $id);
  Session::put('cart', $cart);

  //dd(Session::get('cart'));
  return redirect('/shop');
 }

 public function updateqty(Request $request)
 {
//print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
  $oldCart = Session::has('cart') ? Session::get('cart') : null;
  $cart = new Cart($oldCart);
  $cart->updateQty($request->id, $request->quantity);
  Session::put('cart', $cart);

//dd(Session::get('cart'));
  return redirect('/cart');
 }

 public function shop()
 {
  $categories = Category::get();
  $products = Product::where('status', 1)->get(); //when product is activated get em
  return view('client.shop')->with('products', $products)->with('categories', $categories);

 }

 public function checkout()
 {if (!Session::has('client')) {
  return redirect('/loginv2');
 }
  if (!Session::has('cart')) {return view('client.cart');}
  return view('client.checkout');

 }

 public function __construct()
 {
//disables the requirement for certification. can be used for local environment
  $this->stripeService = new \Stripe\Stripe();
  $this->stripeService->setVerifySslCerts(false);

 }

 public function postcheckout(Request $request)
 {
  //disables the use of http2 and runs 1 instead., some machines dont do well while sending out api key for http2. unfortunately mine was one of them ;-;
  $curl = new \Stripe\HttpClient\CurlClient([CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1]);
  $curl->setEnableHttp2(false);
  \Stripe\ApiRequestor::setHttpClient($curl);

  if (!Session::has('cart')) {
   return view('client.cart');
   // , ['Products' => null]
  }

  $oldCart = Session::get('cart');
  $cart = new Cart($oldCart);

  Stripe::setApiKey('sk_test_51JIKEjErJvOw5CLU2FLdStLDTnHkjtVQNeciXqVbpuvLcCxMD8Se7OesZLVTi8XdUo7INCd2Xr8tgmjEUvYIgGEj00G5OhBks4
        ');
  Stripe::setApiVersion('2020-08-27 ');

  try {
   $charge = Charge::create(array( //create bill
    "amount" => $cart->totalPrice * 100,
    "currency" => "usd",
    "source" => $request->input('stripeToken'), // obtainded with Stripe.js
    "description" => "Test Charge"
   ));

   $order = new Order();
   $order->name = $request->input('name');
   $order->address = $request->input('address');
   $order->cart = serialize($cart);
   $order->payment_id = $charge->id;
   $order->save();

// for mailing system
   $orders = Order::where('payment_id', $charge->id)->get();
   $orders->transform(function ($order, $key) {
    $order->cart = unserialize($order->cart);
    return $order;
    //$ php artisan make:mail SendMail
   });

   $email = Session::get('client')->email;
   Mail::to($email)->send(new SendMail($orders));

  } catch (\Exception$e) { //display error

   Session::put('error', $e->getMessage());
   return redirect('/checkout');
  }

  Session::forget('cart');
  Session::put('success', 'Purchase accomplished successfully !');
  return redirect('/');

 }

 public function loginv2()
 {

  return view('client.login');

 }

 public function signup()
 {

  return view('client.signup');

 }

 public function createaccount(Request $request)
 {$this->validate($request, ['email' => 'email | required | unique:clients', //name of the table  with unique for duplicate entry
  'password' => 'required | min:4']);

  $client = new Client();
  $client->email = $request->input('email');
  $client->password = bcrypt($request->input('password'));
  $client->save();

  return back()->with('status', 'Your account has been created successfully'); //returns back to same page with message
 }

 public function accessaccount(Request $request)
 {$this->validate($request, ['email' => 'email | required', //name of the table  with unique for duplicate entry
  'password' => 'required ']);

  $client = Client::where('email', $request->input('email'))->first();
  if ($client) {

   if (Hash::check($request->input('password'), $client->password)) { //checks if password matches with the one in database without decrypting it

    Session::put('client', $client);
    return redirect('/');
    // return back()->with('status', 'Your email is ' . Session::get('client')->email);

   } else {
    return back()->with('error', 'Wrong password ');
   }

  } else {
   return back()->with('error', 'Wrong email');
  }

 }

 public function logout()
 {
  Session::forget('client');
  return back();
 }

 public function view_by_cat($name)
 {
  $categories = Category::get();
  $products = Product::where('product_category', $name)->get();
  //view product where product category = name

  return view('client.shop')->with('products', $products)->with('categories', $categories);
 }
}