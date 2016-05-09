@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left"><h3 style="margin: 0px;padding: 0px;">Products</h3></div>
                    <div class="pull-right"><a href="{{route('admin.products.create')}}" class="btn btn-sm btn-info">New product</a></div>
                </div>
            </div>
            
            <hr/>
            
            <div class="panel panel-default">
                <div class="panel-heading">Products admin</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:50px;">#</th>
                                <th>Product</th>
                                <th style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td style="width:50px;">#</td>
                                <td>{{$product->title}}</td>
                                <td>
                                    <form method="post" action="{{route('admin.products.destroy', $product->id)}}" style="margin:0px !important;padding:0px;">
                                        {!! csrf_field() !!}
                                        {!! Form::hidden('_method', 'delete') !!}
                                        <a href="{{route('admin.products.images', $product->id)}}" class="btn btn-xs btn-default">Images</a>
                                        <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-xs btn-default">Edit</a>
                                        <button type="submit" href="{{route('admin.products.destroy', $product->id)}}" class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {!! $products->links() !!}
        </div>
    </div>
</div>
@endsection
