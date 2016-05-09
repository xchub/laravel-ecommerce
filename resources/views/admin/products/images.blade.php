@extends('layouts.admin')

@section('content')

<div class="container" ng-controller="ProductController">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left">
                        <h3 style="margin: 0px;padding: 0px;">Product images</h3>
                    </div>
                    <div class="pull-right"><a href="{{route('admin.products.index')}}" class="btn btn-sm btn-default">Back</a></div>
                </div>
            </div>

            <hr/>
            
            @include('common.errors')
            
            @if (session('image_sucess'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ session('image_sucess') }}
            </div>
            @endif
            
            <h4>{{$product->title}}</h4>

            {!! Form::open(array('route' => array('admin.products.images.save', $product->id), 'method'=>'POST', 'files' => true)) !!}
            <div class="panel panel-default">
                <div class="panel-heading">Image upload</div>
                <div class="panel-body">
                    {!! Form::file('image[]',  ['multiple' => true]) !!}
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-md btn-success">Upload</button>
                </div>
            </div>

            {!! Form::close() !!}

            <hr/>
            
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Image</th>
                                <th class="text-right">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->images as $image)
                            <tr>
                                <td><img class="img-responsive" src="{{$image->image}}"/></td>
                                <td class="text-right">
                                    <a href="{{route('admin.products.images.delete', [$product->id, $image->id])}}" class="btn btn-md btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection