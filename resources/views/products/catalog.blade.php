@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @foreach($products->chunk(4) as $items)
            <div class="row">
                @foreach($items as $product)
                <div class="col-sm-3">
                    <div class="product-item">
                        @if(count($product['images']))
                            @foreach($product['images'] as $image)
                            <img src="{{$image['image']}}" class="img-responsive"/>
                            @endforeach
                        @else
                            <img src="/images/noimage.jpg" class="img-responsive"/>
                        @endif
                        <h4>{{$product['title']}}</h4>
                        <a name="catalog" href="{{route('product.detail', ['slug' => $product['slug']])}}" class="btn btn-md btn-default">Show details</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        {!! $products->links() !!}
    </div>
</div>

@endsection