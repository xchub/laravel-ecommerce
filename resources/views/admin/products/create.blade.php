@extends('layouts.admin')

@section('content')

<div class="container" ng-controller="ProductController">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left"><h3 style="margin: 0px;padding: 0px;">New Product</h3></div>
                    <div class="pull-right"><a href="{{route('admin.products.index')}}" class="btn btn-sm btn-default">Back</a></div>
                </div>
            </div>
            
            <hr/>
            
            @include('admin.products.parts.messages')
            
            <form method="put" action="/admin/products/update" ng-submit="submitCreate(form)" name="form" novalidate>
                @include('admin.products.parts.form')
                <hr/>

                <div class="row">
                    <div class="col-sm-12">
                        <button name="btnCreate" type="submit" class="btn btn-lg btn-success">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection