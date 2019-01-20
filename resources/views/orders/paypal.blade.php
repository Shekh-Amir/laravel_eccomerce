@extends('frontlayout.front_design')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{url('/')}}">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>						
		</div>
</section> 

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR  ORDER HAS BEEN PLACED</h3>
				<p>Your order number is {{Session::get('order_id')}} and total payable amount is INR {{Session::get('grand_total')}}</p>
				<p>please make payment by clicking on below paypal button</p>

				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

					  <!-- Saved buttons use the "secure click" command -->
					  <input type="hidden" name="cmd" value="_s-xclick">
					  <input type="hidden" name="buisness" value="amirulapee.ru-facilitator@gmail.com">

					  <!-- Saved buttons are identified by their button IDs -->
					  <input type="hidden" name="item_name" value="{{ Session::get('order_id')}}">
					  <input type="hidden" name="item_number" value="{{ Session::get('order_id')}}">
					  <input type="hidden" name="currency_code" value="INR">
					  <input type="hidden" name="amount" value="{{ Session::get('grand_total')}}">
					  
					

					  <!-- Saved buttons display an appropriate button image. -->
					  <input type="image" 
					    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
					    alt="Pay Now">
					  <img alt="" width="1" height="1"
					    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

				</form>

			</div>
			
		</div>
	</section>


@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');


?>