@extends('frontlayout.front_design')
@section('content')


<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							@foreach($banners as $key => $banner)
							<li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active" @endif></li>
							@endforeach
						</ol>
						
						<div class="carousel-inner">
							@foreach($banners as $key => $banner)

							<div class="item @if($key==0) active @endif">
								<a href="{{ $banner->link }}" title="Banner 1"><img src="frontend/images/banner/{{ $banner->image}}"></a>
							</div>

							@endforeach
							<div class="item">
								<img src="frontend/images/banner/{{ $banner->image}}">
							</div>
							
							<div class="item">
								<img src="frontend/images/banner/{{ $banner->image}}">
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">

					@include('frontlayout.front_sidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">All Items</h2>

						@foreach($productsAll as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('backend/images/products/small/'.$product->image)}}" alt="" style="width:200px;" />
											<h2>INR {{$product->price}}</h2>
											<p>{{$product->product_name}} </p>
											<a href="{{url('product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<!-- <div class="product-overlay">
											<div class="overlay-content">
												
											  <h2>INR {{$product->price}}</h2>
											  <p>{{$product->product_name}} </p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div> -->
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					
						
					</div><!--features_items-->
					
					
					
						<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php $count=1;?>
								@foreach($productsAll->chunk(3) as $chunk)
								<div <?php if($count==1){?> class="item active" <?php }else{

									?> class="item" <?php } ?>   >
									@foreach($chunk as $item) 

									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width:200px;"  src="{{asset('backend/images/products/small/'.$item->image)}}" alt="" />
													<h2>INR {{$item->price}}</h2>
													<p>{{$item->product_name}}</p>
													<a href="{{ url('product/'.$item->id) }}"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button></a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									
								</div>
								<?php  $count++; ?>
								@endforeach 

								 
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>


@endsection
