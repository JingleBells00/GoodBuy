@extends('layouts.appadmin')
@section('title')
Add Slider
@endsection
@section('content')
<div class="row grid-margin">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Slider</h4>
        @if(Session::has('status'))
        <div class="alert alert-success">
          {{Session::get('status')}}
        </div>
        @endif

       {{-- {!!Form::open(['action'=> 'App\Http\Controllers\SliderController@saveslider',
        'class'=>'cmxform','method'=>'POST','id'=>'commentForm', 'enctype' => 'multipart/form-data'])!!}
        {{csrf_field()}} --}} 
        {{--<div class="form-group">--}}
         
          {{--{!!Form::label('', 'Description one', ['for'=>'cname'])!!}
          {!!Form::text('description_one', '', ['class'=>'form-control', 'minlength'=>'2'])!!}--}}
          <form action="{{ route('saveslider') }}" method="POST" enctype="multipart/form-data">
            @csrf 
        <div class="form-group">
         
          {!!Form::label('', 'Description one', ['for'=>'cname'])!!}
          {!!Form::text('description_one', '', ['class'=>'form-control', 'minlength'=>'2'])!!}
        <div>
             
          <div class="form-group">
          {!!Form::label('', 'Description two', ['for'=>'cname'])!!}
          {!!Form::text('description_two', '', ['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
          {!!Form::file('slider_image', ['class'=>'form-control', 'type'=>'file', 'name'=>'slider_image', 'id'=>'inputImage'])!!}
        </div>

        {!!Form::submit('Save', ['class'=>'btn btn-primary'])!!}
        {!!Form::close()!!}
      </form>
      </div>
    </div>
  </div>
</div>

@endsection