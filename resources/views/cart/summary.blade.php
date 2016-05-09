@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h3 >Cart Summary</h3>
            
            <hr/>

            @include('common.cart.message')

            @if($cart->getNumberOfItems())

            <form method="post" action="{{route('cart.update')}}" name="cartForm">
                {!! csrf_field() !!}
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="width: 100px">Options</th>
                                <th style="width:100px">Quantity</th>
                                <th style="width:150px">Price</th>
                                <th style="width: 100px">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->getItems() as $item)
                            <tr>
                                <td>
                                    <a href="{{route('product.detail', $item->sku->product->slug)}}"><strong>{{$item->sku->product->title}}</strong></a>
                                    <p class="text-muted small">{{$item->sku->id}}</p>
                                </td>
                                <td>
                                    <a name="btnDeleteProduct" href="{{route('cart.delete', $item->sku->id)}}">Delete <span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                                <td>
                                    {!! Form::hidden('skus['.$item->sku->id.'][id]', $item->sku->id) !!}
                                    {!! Form::select('skus['.$item->sku->id.'][qty]', [1=>1,2=>2,3=>3,4=>4,5=>5], $item->qty, ['class' => 'form-control input-sm', 'style' => 'width:80px;', 'onchange' => 'this.form.submit()', 'id' => 'btnUpdateQty']) !!}
                                </td>
                                <td>
                                    {{$item->sku->price}}
                                </td>
                                <td>
                                    {{number_format($item->getSubtotal(),2)}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12 text-right">
                    <p><span class="h4">Total {{number_format($cart->getSubtotal(), 2)}}</span></p>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <a class="btn btn-lg btn-default" href="{{route('products')}}">Continue shopping</a>
                </div>
                <div class="col-sm-6 col-xs-12 text-left-xs text-right-not-xs">
                    <a name="btnCheckout" class="btn btn-lg btn-success" href="{{route('checkout')}}">Proceed to checkout</a>
                </div>
            </div>

            @else
            <div class="alert alert-info" role="alert"> Your cart is current empty.</div>
            <a class="btn btn-lg btn-default" href="{{route('products')}}">Continue shopping</a>
            @endif
        </div>
    </div>
</div>

@endsection