<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
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

 public function categories()
 {
  $categories = Category::get();

  return view('admin.categories')->with('categories', $categories);

 }

 public function savecategory(Request $request)
 {

  $this->validate($request, ['category_name' => 'required']);

  $checkcat = Category::where('category_name', $request->input('category_name'))->first();

  $category = new Category();

  if (!$checkcat) {

   $category->category_name = $request->input('category_name');
   $category->save();

   return redirect('/addcategory')->with('status', 'The ' . $category->category_name . ' category has been saved successfully');
  } else {

   return redirect('/addcategory')->with('status1', 'The ' . $request->input('category_name') . ' category already exists');
  }
 }

 public function addcategory()
 {
  return view('admin.addcategory');
 }

 public function edit($id)
 {
  $category = Category::find($id);

  return view('admin.editcategory')->with('category', $category);

 }

 public function updatecategory(Request $request)
 {
  // $checkcat = Category::where('category_name', $request->input('category_name'))->first();

  // $category = new Category;

  // if (!$checkcat) {
  //   $category = Category::find($request->input('id'));

  //  $category->category_name = $request->input('category_name');
  // $oldcat = $category->category_name;

  // $data = array();
  // $data['product_category'] = $request->input('category_name');

  //  DB::table('products')->where('product_category', $oldcat)->update($data); //replaces old categiory in database with updated one

  //  $category->update();

  //  return redirect('/categories')->with('status', 'The ' . $category->category_name . ' category has been updated successfully');
  // } else {

  //    return redirect('/categories')->with('status1', 'The ' . $request->input('category_name') . ' category already exists');
  //  }

  $category = Category::find($request->input('id'));

  $category->category_name = $request->input('category_name');
  $oldcat = $category->category_name;

  $data = array();
  $data['product_category'] = $request->input('category_name');

  DB::table('products')->where('product_category', $oldcat)->update($data); //replaces old categiory in database with updated one

  $category->update();

  return redirect('/categories')->with('status', 'The ' . $category->category_name . ' category has been updated successfully');
 }

 public function delete($id)
 {
  $category = Category::find($id);

  $category->delete();

  return redirect('/categories')->with('status', 'The ' . $category->category_name . ' category has been deleted');
 }

}