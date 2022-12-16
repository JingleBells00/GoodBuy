<?php
namespace App\Http\Controllers;

use App\Http\Controllers\redirect;use App\Models\Cart;use App\Models\Category;
use App\Models\Product;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{

 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct()
 {
  $this->middleware('auth');
 }

 public function addproduct()
 {
  $categories = Category::All()->pluck('category_name', 'category_name');
  return view('admin.addproduct')->with('categories', $categories);

 }

 public function products()
 {
  $products = Product::get(); //if product is activated
  return view('admin.products')->with('products', $products);

 }

 public function saveproduct(Request $request)
 {

  $this->validate($request, ['product_name' => 'required', 'product_price' => 'required', 'product_image' => 'image|nullable|max:5000']);

  if ($request->input('product_category')) {

   if ($request->hasfile('product_image')) {

    $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
    $fileNameWithExt = str_replace(' ', '', $fileNameWithExt); //remove spaces
 

    // $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
 
    // $extention = $request->file('slider_image')->getClientOriginalName();
 
    // $fileNameToStore = $fileName . '_' . time() . '.' . $extention;
 
    $path = $request->product_image->move(public_path('product_images'), $fileNameWithExt);
   } else {
    $fileNameWithExt = 'noimage.jpg';

   }

   $product = new Product();

   $product->product_name = $request->input('product_name');

   $product->product_price = $request->input('product_price');

   $product->product_category = $request->input('product_category');

   $product->product_image = $fileNameWithExt;

   $product->status = 1;

   $product->save();

   return redirect('/addproduct')->with('status', 'The ' . $product->product_name . ' product has been saved successfully');
  } else {
   return redirect('/addproduct')->with('status1', 'Select your category');
  }

 }

 public function editproduct($id)
 {
  $categories = Category::All()->pluck('category_name', 'category_name');

  $product = Product::find($id);

  $product_category = Product::find($id);

  return view('admin.editproduct')->with('product', $product)->with('categories', $categories);

 }

 public function updateproduct(Request $request)
 {$this->validate($request, ['product_name' => 'required', 'product_price' => 'required', 'product_image' => 'image|nullable|max:5000']);

  $product = Product::find($request->input('id'));

  $product->product_name = $request->input('product_name');

  $product->product_price = $request->input('product_price');

  $product->product_category = $request->input('product_category');

  if ($request->hasfile('product_image')) {

   $fileNameWithExt = $request->file('product_image')->getClientOriginalName();

   $path = $request->file('product_image')->storeAs('public/product_images', $fileNameWithExt);

   $old_image = Product::find($request->input('id'));

   if ($old_image != 'noimage.jpg') {
    Storage::delete('public/product_images/' . $old_image->product_image);
   }
   $product->product_image = $fileNameWithExt;

  }
  $product->update();
  return redirect('/products')->with('status', 'The ' . $product->product_name . ' product has been updated successfully');
 }

 public function deleteproduct($id)
 {
  $product = Product::find($id);

  if ($product->product_image != 'noimage.jpg') {
   Storage::delete('public/product_images/' . $product->product_image);
  }
  $product->delete();

  return redirect('/products')->with('status', 'The ' . $product->product_name . ' product has been deleted');
 }

 public function activateproduct($id)
 {
  $product = Product::find($id);

  $product->status = 1;

  $product->update();

  return redirect('/products')->with('status', 'The ' . $product->product_name . ' product has been activated');
 }

 public function unactivateproduct($id)
 {
  $product = Product::find($id);

  $product->status = 0;

  $product->update();

  return redirect('/products')->with('status', 'The ' . $product->product_name . ' product has been unactivated');
 }

 public function removeItem($product_id)
 {
  $oldCart = Session::has('cart') ? Session::get('cart') : null; //if session is active then get session. If new session is created then start with null

  $cart = new Cart($oldCart); //create new cart

  $cart->removeItem($product_id);

  if (count($cart->items) > 0) {
   Session::put('cart', $cart);
  } else {
   Session::forget('cart');
  }

//dd(Session::get('cart'));
  return redirect('/cart');
 }
}