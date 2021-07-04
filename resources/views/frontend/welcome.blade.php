
	@extends('frontend.layouts.master')
@section('title')
<title>{{__('messages.dashboard_text')}}</title>
@endsection

@section('content')
    <div id="slider">
		<ul>
			<li style="background-image: url(images/0.jpg)">
				<h3>Make your life better</h3>
				<h2>Genuine diamonds</h2>
				<a href="#" class="btn-more">Read more</a>
			</li>
			<li class="purple" style="background-image: url(images/01.jpg)">
				<h3>She will say “yes”</h3>
				<h2>engagement ring</h2>
				<a href="#" class="btn-more">Read more</a>
			</li>
			<li class="yellow" style="background-image: url(images/02.jpg)">
				<h3>You deserve to be beauty</h3>
				<h2>golden bracelets</h2>
				<a href="#" class="btn-more">Read more</a>
			</li>
		</ul>
	</div>
	<!-- / body -->
	<?php
	// echo '<pre>';
	// print_r($cat_list);
	// exit;
	?>
	<div id="body">
		<div class="container">
			<div class="row">
				<div class="col-3">
				<ul class="">
						@foreach($cat_list as $key=>$cat)
							<li>{{$key}}
							
								<ul class="">
									@foreach($cat->original['product_sub_categories'] as $val)
										<li>{{$val->product_sub_cat_name}}</li>
									@endforeach
								</ul>
								</li>
						@endforeach
					</ul>
					
				</div>
				<div class="col-9">
			<div class="last-products">
				<h2>Last products</h2>
				<section class="products">
                    @if(!empty($product_list->original['product_lists']))
                        @foreach($product_list->original['product_lists'] as $product)
                        
                        <article>
						<img class=" product_img" src="{{URL::to('/')}}/public/images/{{$product->product_image}}" alt="">
						<h3>{{$product->product_name}}</h3>
						<h4>৳{{$product->product_carat_type}}</h4>
						<h4>{{$product->weight}}</h4>
						<a href="cart.html" class="btn-add">Add to cart</a>
					</article>
                        @endforeach
                    @endif
					
					
				</section>
			</div>
			</div>
			</div>
		</div>
		<!-- / container -->
	</div>
	<!-- / body -->
    @endsection