@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<!-- <style type="text/css">
#mapShow
{
    filter: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="g"><feColorMatrix type="matrix" values="0.3 0.3 0.3 0 0 0.3 0.3 0.3 0 0 0.3 0.3 0.3 0 0 0 0 0 1 0"/></filter></svg>#g');
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);    
    filter: progid:DXImageTransform.Microsoft.BasicImage(grayScale=1);
}
</style> -->
<!-- <section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{!! URL::to('') !!}">Home</a></li>
					<li><img src="{{asset('site/images/down-arrow.png')}}"></li>
					<li><a href="{!! URL::to('deal-list') !!}">Deals</a></li>
					<li><img src="{{asset('site/images/down-arrow.png')}}"></li>
					<li>Deal Details</li>
				</ul>
			</div>
		</div>
	</div>
</section> --><!--Breadcumb-->


<section class="details_banner">
	<figure>
		<img src="{{URL::to('/').'/deals/'}}{{$deal->image}}">
	</figure>
	<figcaption>
		<div class="container">
			<div class="details_info">
				<ul class="breadcumb_list">
					<li><a href="{!! URL::to('') !!}">Home</a></li>
					<li>/</li>
					<li><a href="{!! URL::to('deal-list') !!}">Deals</a></li>
					<li>/</li>
					<li>Deal Details</li>
				</ul>
				<h1 class="details_banner_heading">{{$deal->title}}</h1>
				@if($dealSaved==1)
				<a href="{!! URL::to('site-delete-user-deal/'.$deal->id) !!}" class="btn btn-blue text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Remove</a>
				@else
				<a href="{!! URL::to('site-save-user-deal/'.$deal->id) !!}" class="btn btn-blue text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> Save Deal</a>
				@endif
			</div>
			<div class="banner_meta_area">
				<div class="banner_meta_item">
					<figure>
						<img src="{{URL::to('/').'/categories/'}}{{$deal->category->image}}">
					</figure>
					<figcaption>
						<h5>Category</h5>
						<p>{{$deal->category->title}}</p>
					</figcaption>
				</div>
				<div class="banner_meta_item">
					<figure>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
					</figure>
					<figcaption>
						<h5>Address</h5>
						<p>{{$deal->address}}</p>
					</figcaption>
				</div>
				<div class="banner_meta_item">
					<figure>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
					</figure>
					<figcaption>
						<h5>Price</h5>
						<p>$ {{$deal->price}}</p>
					</figcaption>
				</div>
				<div class="banner_meta_item">
					<figure>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
					</figure>
					<figcaption>
						<h5>Promo Code</h5>
						<p>{{$deal->promo_code}}</p>
					</figcaption>
				</div>
				<div class="banner_meta_item">
					<figure>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
					</figure>
					<figcaption>
						<h5>Expired</h5>
						<p>{{date("d-M-Y",strtotime($deal->expiry_date))}}</p>
					</figcaption>
				</div>
			</div>
		</div>
	</figcaption>
</section>

<section class="letest-offer">
	<div class="container">
		<?php /* ?>
		<div class="row m-0 mt-5 mb-5">
			<div class="col-12 col-md-6 bg-bipblue p-4">
				<ul class="detail-evtext">
					<li>
						<p class="w-100 catagoris_ev">
							<span><img src="{{URL::to('/').'/categories/'}}{{$deal->category->image}}" class="mr-2"> {{$deal->category->title}}</span>
							<span class="float-right w-142">
								<small class="d-block">Expires : {{date("d-M-Y",strtotime($deal->expiry_date))}} </small>
								
							</span>
						</p>
						<a href="#"><h1>{{$deal->title}}</h1></a>
						<h6>Address</h6>
						<p class="text-white">
							Address : {{$deal->address}}<br>
							Price : $ {{$deal->price}} <br>
							Promo Code : {{$deal->promo_code}}
						</p>
					<li>
				</ul>
			</div>
			<div class="col-12 col-md-6 p-0 image-part" style="background:url({{URL::to('/').'/deals/'}}{{$deal->image}});">
				<!-- <a href="javascript:void(0);" class="all_pic shadow-lg">View All 3 Images</a> -->
			</div>
		</div>
		<?php */ ?>
		
		<div class="row mt-4 mb-5">
			<div class="col-md-6 details_left">
				
					<!-- <div class="price-deat">
						<h1>$ 200<span>Inc. of all taxes<span></h1>
					</div> -->
					<!-- @if($dealSaved==1)
					<a href="{!! URL::to('site-delete-user-deal/'.$deal->id) !!}" class="btn btn-blue text-center">Remove</a>
					@else
					<a href="{!! URL::to('site-save-user-deal/'.$deal->id) !!}" class="btn btn-blue text-center">Save Deal</a>
					@endif -->
					<ul class="nav nav-tabs details_tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#deals" role="tab"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> <span>Highlight</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#about" role="tab"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> <span>Description</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#photos" role="tab"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg> <span>How To Redeem</span></a>
						</li>
					</ul><!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="deals" role="tabpanel">
							{!!$deal->short_description!!}
							
						</div>
						<div class="tab-pane" id="about" role="tabpanel">
							{!!$deal->description!!}
						</div>
						<div class="tab-pane" id="photos" role="tabpanel">
							{!!$deal->how_to_redeem!!}
						</div>
					</div>
					<!-- <div class="mt-4 text-right">
						<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">DETAILS</a>
						<a href="javascript:void(0);" class="blue-btn load_btn" id="load-more2">+ Add</a>
					</div> -->
				
			</div>
			<div class="col-md-6 details_left">
				<div class="directory-map">
					<div id="mapShow" style="width: 100%; height: 400px;"></div>
				</div>
			</div>
			<!-- <div class="col-md-4 p-0 details_right">
				<div class="card position-relative">
					<div class="card-header text-center border-0 bg-bipblue text-white">
						<h4>Your Bookings</h4>
					</div>
					<div class="card-body p-0">
						<div class="bg-light p-3 text-center">
							<h5>Please add an option <span class="d-block">Your order is empty</span></h5>
						</div>
						<div class="p-3">
							<h4><span>Total</span> : $0</h4>
						</div>
					</div>
					<div class="card-footer border-0 p-0">
						<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">BOOK NOW</a>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</section>
@endsection
@push('scripts')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I" type="text/javascript"></script>
<script type="text/javascript">
	@php
	$locations = array();
	$data = array($deal->title,floatval($deal->lat),floatval($deal->lon));
	array_push($locations,$data);
	@endphp
	var locations = <?php echo json_encode($locations); ?>;
	console.log("dealLocations>>"+JSON.stringify(locations));

    console.log(JSON.stringify(locations));
    
    var map = new google.maps.Map(document.getElementById('mapShow'), {
      zoom: 16,
      center: new google.maps.LatLng(locations[0][1], locations[0][2]),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      "styles": [{
				"featureType": "administrative",
				"elementType": "labels.text.fill",
				"stylers": [{
					"color": "#444444"
				}]
			}, {
				"featureType": "landscape",
				"elementType": "all",
				"stylers": [{
					"color": "#f2f2f2"
				}]
			}, {
				"featureType": "poi",
				"elementType": "all",
				"stylers": [{
					"visibility": "off"
				}]
			}, {
				"featureType": "road",
				"elementType": "all",
				"stylers": [{
					"saturation": -100
				}, {
					"lightness": 45
				}]
			}, {
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [{
					"visibility": "simplified"
				}]
			}, {
				"featureType": "road.arterial",
				"elementType": "labels.icon",
				"stylers": [{
					"visibility": "off"
				}]
			}, {
				"featureType": "transit",
				"elementType": "all",
				"stylers": [{
					"visibility": "off"
				}]
			}, {
				"featureType": "water",
				"elementType": "all",
				"stylers": [{
					"color": "#4f595d"
				}, {
					"visibility": "on"
				}]
			}],
    });
    
    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    var iconBase = 'http://cp-33.hostgator.tempwebhost.net/~a1627unp/dev/localtales_v2/public/site/images/';
    
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: iconBase + 'map_icon.png'
      });
      
      google.maps.deal.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
@endpush