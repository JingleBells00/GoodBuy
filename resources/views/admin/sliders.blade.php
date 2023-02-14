@extends('layouts.appadmin')

@section('title')
All sliders
@endsection


@section('content')
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

{{Form::hidden('', $increment=1)}}

<div class="card">
    <div class="card-body">
        <h4 class="card-title">sliders</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Image</th>
                                <th>Description 1</th>
                                <th>Description 2</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td>{{$increment}}</td>
                                <td><img src={{ asset('slider_images/'.$slider->slider_image) }} alt=''></td>
                                <td>{{$slider->description1}}</td>
                                <td>{{$slider->description2}}</td>
                                <td>{{$slider->description1}}</td>
                                @if($slider->status ==1)

                                <td>
                                    <label class="badge badge-success">Activated</label>
                                </td>
                                @else
                                <td>
                                    <label class="badge badge-danger">Unactivated</label>
                                </td>
                                @endif

                                <td>
                                    <button class="btn btn-outline-primary"
                                        onclick="window.location='{{url('editslider/'.$slider->id)}}'">Edit</button>

                                    <a href="/deleteslider/{{$slider->id}}" class="btn btn-outline-danger"
                                        id='delete'>Delete</a>

                                    @if($slider->status ==1)

                                    <button class="btn btn-outline-warning"
                                        onclick="window.location='{{url('unactivateslider/'.$slider->id)}}'">Unactivate</button>

                                    @else
                                    <button class="btn btn-outline-success"
                                        onclick="window.location='{{url('activateslider/'.$slider->id)}}'">Activate</button>
                                    @endif
                                </td>
                            </tr>
                            {{Form::hidden('', $increment=$increment+1)}}
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection