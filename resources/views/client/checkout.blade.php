@extends('layouts.app1')

@section('title')
Checkout
@endsection

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('frontend/images/art1.jpeg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
				<h1 class="mb-0 bread">Checkout</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-7 ftco-animate">


				{!!Form::open(['action'=> 'App\Http\Controllers\ClientController@postcheckout',

				'method'=>'POST', 'class' =>'billing- form', 'id' =>'checkout-form'])!!}
				{{csrf_field()}}
				<h3 class="mb-4 billing-heading">Billing Details</h3>

				@if (Session::has('error'))
				<div class="alert alert-danger">
					{{Session::get('error')}}
					{{Session::put('error', null)}}
				</div>
				@endif
				<div class="row align-items-end">
					<div class="col-md-12">
						<div class="form-group">
							<label for="firstname"> Full Name</label>
							<input type="text" class="form-control" name="name">
						</div>
					</div>


					<div class="w-100"></div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="lastname">Full Address</label>
							<input type="text" class="form-control" name="address">
						</div>
					</div>


					<div class="w-100"></div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="lastname">Phone</label>
							<input type="text" class="form-control" name="phone-number">
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="lastname">Name on Card </label>
							<input type="text" id="card-name" class="form-control" name="card_name">
						</div>
					</div>


					<div class="col-md-12">
						<div class="form-group">
							<label for="lastname">Card Number </label>
							<input type="text" id="card-number" class="form-control">
						</div>
					</div>



					<div class="col-md-6">
						<div class="form-group">
							<label for="lastname">Expiration Month </label>
							<input type="text" id="card-expiry-month" class="form-control">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="lastname">Expiration Year</label>
							<input type="text" id="card-expiry-year" class="form-control">
						</div>
					</div>


					<div class="col-md-6">
						<div class="form-group">
							<label for="lastname">CVC</label>
							<input type="text" id="card-cvc" class="form-control">
						</div>
					</div>



					<div class=" col-md-6">
						<div class="form-group">
							<label for="emailaddress">Email Address</label>
							<input type="text" class="form-control" placeholder="">
						</div>
					</div>

				</div>
				<div class="col-md-12">
					<div class="form-group">
						<input value="Buy Now" type="submit" class="btn btn-primary py-3 px-4">
					</div>
				</div>
				{!!Form::close()!!}
				<!-- END -->
			</div>
			<div class="col-xl-5">
				<div class="row mt-5 pt-3">
					<div class="col-md-12 d-flex mb-5">
						<div class="cart-detail cart-total p-3 p-md-4">
							<h3 class="billing-heading mb-4">Cart Total</h3>
							<p class="d-flex">
								<span>Subtotal</span>
								<span>${{Session::get('cart')->totalPrice}}</span>
							</p>
							<p class="d-flex">
								<span>Delivery</span>
								<span>$0.00</span>
							</p>
							<p class="d-flex">
								<span>Discount</span>
								<span>$0.00</span>
							</p>
							<hr>
							<p class="d-flex total-price">
								<span>Total</span>
								<span>${{Session::get('cart')->totalPrice}}</span>
							</p>
						</div>
					</div>

				</div> <!-- .col-md-8 -->


			</div>

</section> <!-- .section -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="src/js/checkout.js"></script>


<script>
	$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });
             
			 
		
		    
			
			
			 $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
</script>

@endsection