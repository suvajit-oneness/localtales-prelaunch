@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

<style>
    .pagination {
        float: right;
    }
</style>
@php
$businesses = array();
foreach($businesses_datas as $business){
            $address = $business->address;

            $url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $responseJson = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($responseJson);

            // echo "<pre>";
            // print_r($response);
            // die();

            $latitude = $response->results[0]->geometry->location->lat;
            $longitude = $response->results[0]->geometry->location->lng;

            $business->latitude = $latitude;
            $business->longitude = $longitude;

            array_push($businesses,$business);
        }
@endphp
<section class="inner_banner" style="background: url({{asset('site/images/banner')}}-image.jpg) no-repeat center center; background-size:cover;">
    <div class="container position-relative">
        <h1>Top Directory</h1>
		<div class="page-search-block filterSearchBoxWraper">
            <form action="">
                <div class="filterSearchBox">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="form-floating">
                            <input type="text" id="postcodefloting" class="form-control pl-3" name="address" placeholder="Postcode" value="">
                            <label for="postcodefloting">Postcode</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="form-floating">
                            <input id="establishyearfloting" type="text" class="form-control pl-3" name="establish_year" placeholder="Establish Year" value="">
                            <label for="establishyearfloting">Keyword</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 fcontrol position-relative filter_selectWrap filter_selectWrap2">
                        <img src="{{ asset('front/img/grid.svg')}}">
                        <select class="filter_select form-control" name="category_id">
                            <option value="" hidden selected>Select Category...</option>
                            @foreach ($categories as $index => $item)
                                <option value="{{$item->id}}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="form-floating">
                            <input type="text" id="keywordfloting" class="form-control pl-3" name="keyword" placeholder="Keyword" value="">
                            <label for="keywordfloting">Keyword</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" id="openhourfloting" class="form-control pl-3" name="opening_hour" placeholder="Opening Hour" value="">
                            <label for="openhourfloting">Establish Year</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-blue text-center ml-auto"><img src="{{asset('front/img/search.svg')}}"></button>
                    </div>
                </div>
                {{-- <a href="javascript:void(0);" id="btnFilter" class="btn btn-blue text-center ml-auto">Filter</a> --}}
                </div>
            </form>
        </div>
    </div>
</section>
<!-- directory-->




<section class="pb-4 pb-lg-5 bg-light searchpadding smallGapGrid">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col">
                <div class="best_deal page-title">
        			<h2> @php $category = \App\Models\DirectoryCategory::findOrFail($id); @endphp
                {{$category->title}} directory </h2>
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex cafe-listing-nav">
                    <ul class="d-flex" id="tabs-nav">
                       <li class="">
                            <a href="#grid">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            </a>
                        </li>
                        <li class="">
                            <a href="#list">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                            </a>
                        </li>
                        <li class="">
                            <a href="#map">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div id="tab-contents">
            <div class="tab-content smallGapGrid" id="grid">
                <div class="row Bestdeals">
                    {{-- <div class="swiper-wrapper"> --}}
                        @foreach($businesses as $key => $business)
                    {{-- dd{{ $dir}} --}}
                          <div class="col-md-4 col-lg-3 jQueryEqualHeight">
                <div class="card businessDirectoryCard border-0">
                    <div class="bst_dimg">
                                    @if($business->image)
                                    <img src="{{URL::to('/').'/Directory/'}}{{$business->image}}" class="card-img-top" alt="">
                                    @else
                                    <img src="{{asset('Directory/placeholder-image.png')}}" >
                                    @endif

                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0"><a href="{!! URL::to('directory-details/'.$business->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->name))) !!}" class="location_btn">{{ $business->name }}</a></h5>
                                    <p>{!! $business->address !!}</p>
                                    <input type="hidden" id="googlemapaddress" value="{{ $business->address }}">
                                    {{-- <a href="#">Read More...</a> --}}

                                </div>
                            </div>
                        </div>

                    @endforeach



                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $businesses_datas->links() }}
                </div>
            </div>

            <div class="tab-content smallGapGrid Bestdeals" id="list">
                <div class="row justify-content-center">
                    <div class="col-12 mb-4">

                  <ul class="search_list_items search_list_items-mod">
                      @foreach($businesses as $key => $business)
                      <li>
                          <div class="location_img_wrap">
                              @if($business->image)<img src="{{URL::to('/').'/Directory/'}}{{$business->image}}">
                            @else
                            <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
                              @endif
                          </div>
                          <div class="list_content_wrap">

                                <div class="location_meta">

                                    <figcaption>
                                        <div class="categoryB-list">
                                        @php
                    $cat = substr($business->category_id, 0, -1);
                    $displayCategoryName = '';
                    foreach(explode(',', $cat) as $catKey => $catVal) {
                        $catDetails = \App\Models\DirectoryCategory::findOrFail($catVal);
                        $displayCategoryName .= '<a href="'.route("category.directory", $catDetails->id).'">'.$catDetails->title.'</a>, ';
                    }
                    echo substr($displayCategoryName, 0, -2);
                @endphp
                </div>
                                        <h4 class="place_title bebasnew">{{$business->name}}</h4>

                                    </figcaption>
                                        <p class="history_details">{!!strip_tags(substr($business->description,0,300))!!}</p>
                                        <div class="d-flex location_details">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                            <p class="history_details">{{$business->website}}</p>
                                        </div>
                                        <div class="d-flex location_details">
                                            <span><i class="fas fa-tag"></i></span>
                                            <p class="location">{{$business->category_tree}}</p>
                                        </div>
                                        <div class="location_details">
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                            <p class="location">{{$business->address}}</p>
                                            <input type="hidden" id="googlemapaddress" value="{{ $business->address }}">
                                        </div>
                                        {{-- <p>{{ $business->email }}</p> --}}
                                </div>

                                <div class="location_metaBOttom">
                                    <ul class="bBusinessMailPhone">
                                        <li><a href="#"><i class="fas fa-envelope"></i>{{ $business->email }}</a></li>
                                        <li><a href="#"><i class="fas fa-phone-alt"></i>{{$business->mobile}}</a></li>
                                    </ul>
                                    <a href="{!! URL::to('directory-details/'.$business->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->name))) !!}" class="location_btn">View Details <img src="{{asset('site/images/right-arrow.png')}}"></a>
                                </div>

                          </div>
                      </li>
                      @endforeach

                  </ul>

                    </div>
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-end">
                            {{ $businesses_datas->links() }}
                        </div>
                    </div>
                </div>
            </div>

        <div class="tab-content smallGapGrid Bestdeals" id="map">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="map">
                        <div id="mapShow" style="height: 600px;"></div>

                        <p></p> <span id="latLngShow"></span>
                        <input type="hidden" id="googlemapaddress" value="">
                    </div>
                </div>
            </div>
        </div>
<!--Search-list-->





</section>
<section class="py-4 py-lg-5 bg-light smallGapGrid">
    <div class="container">
        <div class="page-title best_deal">
            <h2>
                <!--@php $category = \App\Models\DirectoryCategory::findOrFail($id); @endphp-->
                <!--{{$category->title}} directory-->
            </h2>
        </div>

        <!--<div class="row">-->
        <!--    <div class="col-md-12">-->
        <!--        <div class="row Bestdeals businessDirectory">-->
        <!--    @foreach($data as $key => $blog)-->
        <!--    <div class="col-md-4 col-lg-3 jQueryEqualHeight">-->
        <!--        <div class="card businessDirectoryCard border-0">-->
        <!--            <div class="bst_dimg">-->
        <!--                @if($blog->image)-->
        <!--                <img src="{{URL::to('/').'/Directory/'}}{{$blog->image}}" class="card-img-top" alt="">-->
        <!--                @else-->
        <!--                            <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">-->
        <!--                            @endif-->
        <!--            </div>-->
        <!--            <div class="card-body">-->
        <!--                <h5 class="card-title"><a href="{!! URL::to('directory-details/'.$blog->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $blog->name))) !!}" class="location_btn">{{ $blog->name }}</a></h5>-->
        <!--                <p class="mb-0">{!! $blog->address !!}</p>-->

        <!--                {{-- <a href="#">Read More...</a> --}}-->

        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--@endforeach-->
        {{-- </div> --}}
        {{-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> --}}

            <!--<div class="d-flex col-12 justify-content-center mt-4">-->
            <!--    {{ $data->links() }}-->
            <!--</div>-->
        </div>
    </div>
</div>

    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
	// @php
	// $locations = array();
	// foreach($dir as $deal){
	// 	$data = array($deal->title,floatval($deal->lat),floatval($deal->lon));
	// 	array_push($locations,$data);
	// }
	// @endphp

    // $(document).ready(function(){
    // 	$('#btnFilter').on("click",function(){
    // 		$('#checskout-form').submit();
    // 	})
    // });

    $(document).on("click", "#btnFilter", function() {
        $('#checkout-form').submit();
    });
</script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I" type="text/javascript"></script>
<script type="text/javascript">
	@php
	$locations = array();
	foreach($businesses as $business){
		$data = array($business->name,floatval($business->latitude),floatval($business->longitude));
		array_push($locations,$data);
	}
	@endphp
	var locations = <?php echo json_encode($locations); ?>;
	console.log("businessLocations>>"+JSON.stringify(locations));

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

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
@endpush
