<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<table width='700px;'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('frontend/images/home/logo.png')}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Hello {{$name}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you for shopping with  us.Your order detail as below:--</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Order no:- {{$order_id}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		
		<tr><td>
		<table width="95%" cellpadding="5" cellspacing="5" bgcolor="#ccc000">
				<tr bgcolor="#fda">
				<td>Product Name</td>
				<td>Product Code</td>
				<td> Size</td>
				<td> Color</td>
				<td>Quantity </td>
				<td>Unit Price </td>
				</tr>
				@foreach($productDetails['orders'] as $product)
				<tr>
					<td>{{ $product['product_name'] }}</td>
					<td>{{ $product['product_code'] }}</td>
					<td>{{ $product['product_size'] }}</td>
					<td>{{ $product['product_color'] }}</td>
					<td>{{ $product['product_qty'] }}</td>
					
					<td>{{ $product['product_price'] }}</td>
				</tr>

				@endforeach
				<tr>
					<td colspan="5" align="right">shipping charges</td><td> TK{{ $productDetails['shipping_changes'] }}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Coupon Discount </td><td> TK{{ $productDetails['coupon_amount'] }}</td>
				</tr>
				<tr>
					<td colspan="5" align="right"> Grand Total</td><td>   TK{{ $productDetails['grand_total'] }}</td>
				</tr>
		</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<table width="100%" bgcolor="#fdaaaa">
			<tr>
				<table width="50%" align="left">
					<tr><td><strong>Bill To..</strong></td></tr>
					<tr>
						<td><strong>{{ $userDetails['name'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['address'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['city'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['state'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['country'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['pincode'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['mobile'] }}</strong></td>
					</tr>
				
				</table>
					<table width="50%" align="right">
					<tr><td><strong>Shipp To..</strong></td></tr>
					<tr>
						<td><strong>{{ $userDetails['name'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['address'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['city'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['state'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['country'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['pincode'] }}</strong></td>
					</tr>
					<tr>
						<td><strong>{{ $userDetails['mobile'] }}</strong></td>
					</tr>
				
				</table>
			</tr>		
		</table>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
					For any enquiries, you can contact us as<a href="mailto:info@gmail.com">info@gmail.com</a> 
				</td>
			</tr>
		<tr><td>Regards,<br>Team E-com</td></tr>
		<tr><td>&nbsp;</td></tr>



	  </table>

</body>
</html>