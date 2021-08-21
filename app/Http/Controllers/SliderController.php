<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;use Illuminate\Support\Facades\Storage;use Illuminate\Support\Facades\View;

class SliderController extends Controller
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

 public function saveslider(Request $request)
 {

  $this->validate($request, ['description_one' => 'required', 'description_two' => 'required', 'slider_image' => 'image|nullable|max:5000']);

  if ($request->hasfile('slider_image')) {

   $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();

   // $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

   // $extention = $request->file('slider_image')->getClientOriginalName();

   // $fileNameToStore = $fileName . '_' . time() . '.' . $extention;

   $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameWithExt);

  } else {
   $fileNameWithExt = 'noimage.jpg';

  }

  $slider = new Slider();

  $slider->description1 = $request->input('description_one'); //input(name)  whatever is in the form text while variable object to be stored in the database column

  $slider->description2 = $request->input('description_two');

  $slider->slider_image = $fileNameWithExt;

  $slider->status = 1;

  $slider->save();

  return redirect('/addslider')->with('status', 'The slider has been saved successfully');

 }

 public function sliders()
 {
  $sliders = Slider::get();
  return view('admin.sliders')->with('sliders', $sliders);

 }

 public function addslider()
 {

  return view('admin.addslider');

 }

 public function editslider($id)
 {

  $slider = Slider::find($id);

  $description1 = Slider::find($id);

  $description2 = Slider::find($id);

  return view('admin.editslider')->with('slider', $slider);

 }

 public function updateslider(Request $request)
 {
  $this->validate($request, ['description_one' => 'required', 'description_two' => 'required', 'slider_image' => 'image|nullable|max:5000']);

  $slider = Slider::find($request->input('id'));

  $slider->description1 = $request->input('description_one'); //input(name)  whatever is in the form text while variable object to be stored in the database column

  $slider->description2 = $request->input('description_two');

  if ($request->hasfile('slider_image')) {

   $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();

   $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameWithExt);

   $old_image = Slider::find($request->input('id'));

   if ($old_image != 'noimage.jpg') {
    Storage::delete('public/slider_images/' . $old_image->slider_image);
   }
   $slider->slider_image = $fileNameWithExt;

  }
  $slider->update();
  return redirect('/sliders')->with('status', 'The slider has been updated successfully');
 }

 public function activateslider($id)
 {
  $slider = Slider::find($id);

  $slider->status = 1;

  $slider->update();

  return redirect('/sliders')->with('status', 'The slider has been activated');
 }

 public function unactivateslider($id)
 {
  $slider = Slider::find($id);

  $slider->status = 0;

  $slider->update();

  return redirect('/sliders')->with('status', 'The slider has been unactivated');
 }

 public function deleteslider($id)
 {
  $slider = Slider::find($id);

  if ($slider->slider_image != 'noimage.jpg') {
   Storage::delete('public/slider_images/' . $slider->slider_image);
  }
  $slider->delete();

  return redirect('/sliders')->with('status', 'The slider has been deleted');
 }
}