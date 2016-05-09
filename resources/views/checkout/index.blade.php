@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Checkout</h3>
            <hr/>
            
            @include('common.errors')
            
            <form method="post" action="{{route('checkout.complete')}}">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-sm-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">Order summary</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
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
                                                <td>{{$item->qty}}</td>
                                                <td>{{$item->sku->price}}</td>
                                                <td>{{number_format($item->getSubtotal(),2)}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-right">
                                                    <p><span class="h4">Total {{number_format($cart->getSubtotal(), 2)}}</span></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">Payment details</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12"><img src="/images/accepted_cc.png"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Name on Card</label>
                                        {!! Form::text('card_name', null, array('class' => 'form-control', 'autocomplete' => 'off')) !!}
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Card number</label>
                                        {!! Form::text('card_number', null, array('class' => 'form-control', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Expiration date</label>
                                        {!! Form::text('card_expiration_date', null, array('class' => 'form-control', 'autocomplete' => 'off')) !!}
                                    </div>
                                    <div class="col-sm-6">
                                        <label>CV Code</label>
                                        {!! Form::text('card_cv_code', null, array('class' => 'form-control', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button name="btnCompleteOrder" type="submit" class="btn btn-lg btn-danger">Complete order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection