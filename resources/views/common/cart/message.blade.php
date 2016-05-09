@if (session('cart_success'))
<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    {{ session('cart_success') }} <a name="btnGoCheckout" href="{{route('checkout')}}">Click here to checkout! <span class="glyphicon glyphicon-shopping-cart"></span></a>
</div>
@endif

