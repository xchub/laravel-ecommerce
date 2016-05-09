@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">
                    <p>Welcome to E-commerce Admin</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Manager</div>
                <div class="list-group">
                    <a href="{{route('admin.products.index')}}" class="list-group-item">
                         Products
                        <span class="glyphicon glyphicon-th-list pull-right"></span>
                    </a>
                    <a href="{{route('admin.products.create')}}" class="list-group-item">
                        Add a new product
                        <span class="glyphicon glyphicon-plus pull-right"></span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
