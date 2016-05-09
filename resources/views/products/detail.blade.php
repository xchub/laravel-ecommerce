@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            @if(count($product->images))
                @foreach($product->images as $image)
                <img src="{{$image->image}}" class="img-responsive"/>
                @endforeach
            @else
                <img src="/images/noimage.jpg" class="img-responsive"/>
            @endif
        </div>
        <div class="col-md-8">
            
            <h1>{{$product->title}}</h1>
            
            <p class="text-muted">{{$product->sku->id}}</p>
            <p>{{$product->description}}</p>

            @include('common.cart.message')

            <p style="text-decoration: line-through">Before: {{number_format($product->sku->before_price, 2, '.', ',')}}</p>
            <p>Now: {{number_format($product->sku->price, 2, '.', ',')}}</p>

            {!! Form::open(array('route' => 'cart.add', 'method' => 'post')) !!}

            {!! Form::label('qty', 'Quantity') !!}
            {!! Form::select('qty', [1=>1,2=>2,3=>3,4=>4,5=>5], 0, ['class' => 'form-control']) !!}
            
            @if($product->variants)
            {!! Form::label('sku', 'Options') !!}
            {!! Form::select('sku', $product->variants, $product->sku->id, ['class' => 'form-control']) !!}
            @else
            {!! Form::hidden('sku', $product->sku->id)!!}
            @endif

            {!! Form::hidden('product_id', $product->id)!!}

            {!! Form::submit('Add to cart', ['name' => 'btnAddCart','class' => 'btn btn-success btn-lg', 'style' => 'margin-top:20px;']); !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection