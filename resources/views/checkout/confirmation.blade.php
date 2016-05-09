@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1>Order confirmation</h1>

            <p>It' a pleasure to confirm you order number #{{$order->id}}.</p>
            
            <a class="btn btn-lg btn-default" href="{{route('products')}}">Continue shopping</a>
        </div>
    </div>
</div>

@endsection