@extends('layouts.appadmin')

@section('title')
Edit Slider
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

                @if(Session::has('status1'))
                <div class="alert alert-danger">
                    {{Session::get('status1')}}
                </div>
                @endif



                {!!Form::open(['action'=> 'App\Http\Controllers\SliderController@updateslider', 'class'=>'cmxform',
                'method'=>'POST', 'id'=>'commentForm', 'enctype' => 'multipart/form-data'])!!}
                {{csrf_field()}}
                <div class="form-group">

                    {{Form::hidden('id', $slider->id)}}
                    {!!Form::label('', 'Description one', ['for'=>'cname'])!!}
                    {!!Form::text('description_one', $slider->description1, ['class'=>'form-control',
                    'minlength'=>'2'])!!}

                </div>

                <div class="form-group">

                    {{Form::hidden('id', $slider->id)}}
                    {!!Form::label('', 'Description two', ['for'=>'cname'])!!}
                    {!!Form::text('description_two', $slider->description2, ['class'=>'form-control',
                    'minlength'=>'2'])!!}

                </div>

                <div class="form-group">
                    {!!Form::file('slider_image', ['class'=>'form-control'])!!}
                </div>

                {!!Form::submit('Update', ['class'=>'btn btn-primary'])!!}
                {!!Form::close()!!}

            </div>
        </div>
    </div>
</div>

@endsection