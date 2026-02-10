@extends('frontend.layout')



@section('fronted_content')
@push('fronted_css')
<style>
    .order{
        color: black ;
        font-size: 19px;
        font-weight: 700;

    }
    .card-header{
        color: black ;
        font-size: 20px;
        font-weight: 900;
    }

</style>
    
@endpush
  <div class="container">
    <div class="card">
         <div class="row  p-5 my-5">
        <div class="card-header">
            <p> Provide your detalis information</p>
        </div>
        <div class="col-4 ">
           
            <form action="{{ route('checkout.order') }}" method="POST" class="mt-4">
    @csrf
    
    <label for="name">Name:</label>
    <input type="text" name="name" placeholder="your name" class="form-control p-3 mb-2" id="name">

    <label for="email">Email:</label>
    <input type="email" name="email" placeholder="your email" class="form-control p-3 mb-2" id="email">

    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" placeholder="your phone number" class="form-control p-3 mb-2" id="phone">
    
    <label for="address">Address:</label>
    <textarea name="address" id="address" class="form-control" placeholder="provide your address"></textarea>

    <div class="mt-2">
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" class="form-control p-3 m-2">
            <option value="cash_on_delivery">Cash on Delivery</option>
            <option value="online_payment">Online Payment</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Confirm. Order</button>
</form>
        </div>
        <div class="col-8 mt-3 im">
            <p class="order"> Order summary</p>

            <table class="table table-bordered">
                <tr>
                   <td>#</td>
                   <td>Product Title</td>
                   <td>Total</td>
                   <td>Action</td>
                    
                </tr>

                @foreach ( session('cart', []) as $key => $cart )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                       <td>{{ $cart['title'] }}</td>
                    <td>{{ $cart['price'] }} * {{ $cart['qty'] }} = {{ $cart['price']  * $cart['qty']}} /-</td>
                    <td><a href="{{ route('delete.cart', $key) }}" class="btn btn-outline-danger btn-sm">Delete</a></td>

                    </tr>
                @endforeach

            </table>
        </div>
    </div>

    </div>
    
  </div>
@endsection

@push('frontend_script')
    <script>
    var obj = {};
    obj.cus_name = $('#name').val();
    obj.cus_phone = $('#phone').val();
    obj.cus_email = $('#email').val();
    obj.cus_addr1 = $('#address').val();
    // obj.amount = $('#amount').val();
    
    $('#sslczPayBtn').prop('postdata', obj);
</script>


<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>


@endpush