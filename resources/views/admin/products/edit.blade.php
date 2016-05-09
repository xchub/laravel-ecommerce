@extends('layouts.admin')

@section('content')

<div class="container" ng-controller="ProductController" ng-init="loadModel({{$product->id}})">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left"><h3 style="margin: 0px;padding: 0px;">Edit Product</h3></div>
                    <div class="pull-right"><a href="{{route('admin.products.index')}}" class="btn btn-sm btn-default">Back</a></div>
                </div>
            </div>
            
            <hr/>
            
            @include('admin.products.parts.messages')
            
            <form method="put" action="/admin/products/update" name="form" ng-submit="submitUpdate(form)" novalidate>

                @include('admin.products.parts.form')

                <hr/>

                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-lg btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection