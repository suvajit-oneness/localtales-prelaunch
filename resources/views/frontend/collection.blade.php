@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

    @foreach($dir as  $key => $blog)
    <section class="inner_banner collection_banner" style="background-image: url('{{URL::to('/').'/Collection/'}}{{$blog->image}}');">
        <div class="container position-relative">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-lg-12">
                    <h1>{{ $blog->title }}</h1>
                    {!! $blog->description !!}
                    <span>
                        @php
                        $category =  \App\Models\Collection::findOrFail($id);
                        // dd($data)
                    @endphp
                     <p></p>
                </span>
                </div>
            </div>

            <div class="collection_breadcumb page-search-block">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="details_info mb-0">
                            <ul class="breadcumb_list mb-0">
                                <li><a href="{!! URL::to('') !!}">Home</a></li>
                                <li>/</li>
                                <li class="active"> {{$category->title}} </li>
                            </ul>
                       </div>
                   </div>
                   <div class="col-auto">
                        <a href="javascript:void(0)" class="wishlist_button" onclick="collectionBookmark({{$category->id}})">
                            @php
                                $ip = $_SERVER['REMOTE_ADDR'];
                                if(auth()->guard('user')->check()) {
                                   $collectionExistsCheck = \App\UserCollection::where('collection_id', $category->id)->where('ip', $ip)->orWhere('user_id', auth()->guard('user')->user()->id)->first();
                                } else {
                                   $collectionExistsCheck = \App\UserCollection::where('collection_id', $category->id)->where('ip', $ip)->first();
                                }

                                if($collectionExistsCheck != null) {
                                    // if found
                                    $heartColor = "#fff";
                                } else {
                                    // if not found
                                    $heartColor = "none";
                                }
                            @endphp
                            <svg id="saveBtn" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{$heartColor}}" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </a>

                        {{-- <span class="save collectionSave">
                            @if ($businessSaved == 1)
                            <a href="{!! URL::to('site-delete-user-collection/'.$category->id) !!}" class="btn btn-blue wishlist  text-center"><img src="{{ asset('front/img/bookmark.png')}}" alt=""></a>
                            @else
                            <a href="{!! URL::to('site-save-user-collection/'.$category->id) !!}" class="btn btn-light text-center">
                                <img src="{{ asset('front/img/bookmark.png')}}" alt=""></a>
                            @endif
                        </span> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach<!--end_innerbanner-->

    @foreach($data as  $key => $blog)
    <section class="collectionbreadcumbPadding pb-4 pb-lg-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-lg-9 page-title">

                    <!--{!! $blog->content !!}-->
                </div>
            </div>
            <div class="page-title best_deal">
                        <h2>Directory of this Collection</h2>
                    </div>
            <div class="d-flex justify-content-between align-items-center cafe-listing-nav">
                <ul class="d-flex" id="tabs-nav">
                   <li class="">
                        <a href="#grid">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        </a>
                    </li>
                   <li class="">
                        <a href="#map">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                        </a>
                    </li>

                </ul>
                <span>
                   {{$categories->count()}} Listed
                </span>
            </div>

            <div id="tab-contents">
                <div class="tab-content smallGapGrid Bestdeals" id="grid">
                    <div class="row cafe-card">
                        @foreach($categories as $key => $directory)
                        <div class="col-md-4 col-sm-6 col-lg-3 col-6 jQueryEqualHeight">
                            <div class="card directoryCard collectiondirectoryCard border-0">
                                <img src="{{URL::to('/').'/Directory/'}}{{$directory->directory->image}}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"> <a href="{!! URL::to('directory-details/'.$directory->directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $directory->directory->name))) !!}" class="location_btn">{{ $directory->directory->name }}</a></h5>
                                    <div class="d-flex justify-content-between align-items-center">

                                        <span class="location mb-0">
                                            <i class="fa fa-map-marker-alt"></i>
                                            <p class="mb-0">{!! $directory->directory->address !!}</p>

                                        </span>

                                    </div>
                                </div>

                                <!--<span class="save">-->
                                <!--    <img src="{{ asset('front/img/bookmark.png')}}" alt="">-->
                                <!--</span>-->
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

                <div class="tab-content smallGapGrid" id="map">
                                <div class="row justify-content-center">
                                    <div class="col-12">

                                    </div>
                                    <div class="col-12">
                                        <div class="map">
                                            <div id="mapShow" style="height: 600px;"></div>
                                            <span id="latLngShow"></span>
                                            <input type="hidden" id="googlemapaddress" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                <!--<div class="tab-content" id="list">-->

                <!--    <div class="row cafe-card  justify-content-center">-->
                <!--        @foreach($categories as $key => $directory)-->
                <!--        <div class="col-12 col-lg-6">-->
                <!--            <div class="card collectionListCard border-0">-->
                <!--                <div class="collectionListCardImg">-->
                <!--                    <img src="{{URL::to('/').'/Directory/'}}{{$directory->directory->image}}" class="card-img-top" alt="">-->
                <!--                </div>-->
                <!--                <div class="collectionListCardContent">-->
                <!--                    <strong class="rating ml-4">-->
                <!--                        <span class="badge">4.5</span>-->
                <!--                        Rated-->
                <!--                    </strong>-->
                <!--                    <h4> <a href="{!! URL::to('directory-details/'.$directory->directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $directory->directory->name))) !!}" class="location_btn">{{ $directory->directory->name }}</a></h4>-->
                <!--                    <p>-->
                <!--                        {!! $directory->directory->description !!}-->
                <!--                    </p>-->
                <!--                    <ul>-->
                <!--                        <li>-->
                <!--                            <i class="fas fa-envelope"></i>-->
                <!--                            <a href="matito:test@gmail.com">{{ $directory->email }}</a>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <i class="fas fa-phone-alt"></i>-->
                <!--                            <a href="tel">{{ $directory->mobile }}</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <div class="location pt-3">-->
                <!--                        <i class="fa fa-map-marker-alt"></i>-->
                <!--                        <p>{!! $directory->directory->address !!}</p>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <span class="save">-->
                <!--                    <img src="{{ asset('front/img/bookmark.png')}}" alt="">-->
                <!--                </span>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <span>-->
                    <!-- {{$directory->directory->count()}} Listed -->
                <!--    </span>-->
                <!--        @endforeach-->
                <!--    </div>-->
                <!--</div>-->


            <!--    <div class="tab-content smallGapGrid Bestdeals" id="list">-->
            <!--    <div class="row justify-content-center">-->
            <!--        <div class="col-12 col-lg-10 col-xl-9 mb-4">-->

            <!--      <ul class="search_list_items search_list_items-mod">-->
            <!--          @foreach($categories as $key => $directory)-->
            <!--          <li>-->
            <!--              <div class="location_img_wrap">-->
            <!--                  @if($directory->directory->image)<img src="{{URL::to('/').'/Directory/'}}{{$directory->directory->image}}">-->
            <!--                @else-->
            <!--                <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">-->
            <!--                  @endif-->
            <!--              </div>-->
            <!--              <div class="list_content_wrap row m-0">-->
            <!--                <div class="col-12 p-0">-->

            <!--                    <div class="location_meta">-->

            <!--                        <figcaption>-->
            <!--                            <div class="categoryB-list">-->

            <!--    </div>-->
            <!--                            <h4 class="place_title bebasnew">{{$directory->directory->name}}</h4>-->
            <!--                            <ul class="bBusinessMailPhone">-->
            <!--                                <li><a href="#"><i class="fas fa-envelope"></i>{{ $directory->directory->email }}</a></li>-->
            <!--                                <li><a href="#"><i class="fas fa-phone-alt"></i>{{$directory->directory->mobile}}</a></li>-->
            <!--                            </ul>-->
            <!--                            {{-- <p>{{ $directory->directory->email }}</p> --}}-->
            <!--                        </figcaption>-->
            <!--                    </div>-->
            <!--                    <p class="history_details">{!!strip_tags(substr($directory->directory->description,0,300))!!}</p>-->
            <!--                    <p class="history_details">{{$directory->directory->website}}</p>-->
            <!--                    <div class="location_metaBOttom">-->
            <!--                        <div class="location_details">-->
            <!--                            <span><i class="fas fa-map-marker-alt"></i></span>-->
            <!--                            <p class="location">{{$directory->directory->category_tree}}</p>-->
            <!--                            <p class="location">{!! $directory->directory->address !!}</p>-->
            <!--                            <input type="hidden" id="googlemapaddress" value="{{ $directory->address }}">-->
            <!--                        </div>-->
            <!--                        <a href="{!! URL::to('directory-details/'.$directory->directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $directory->directory->name))) !!}" class="location_btn">View Details <img src="{{asset('site/images/right-arrow.png')}}"></a>-->
            <!--                    </div>-->
            <!--                </div>-->

            <!--              </div>-->
            <!--          </li>-->
            <!--          @endforeach-->

            <!--      </ul>-->

            <!--        </div>-->
            <!--        <div class="col-12 col-lg-10 col-xl-9">-->

            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--</div>-->



        </div>
    </section>
@endforeach

    <section class="py-2 py-sm-4 light-bg more-collection">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center cafe-listing-nav page-title">
                <h3>More Collections</h3>


            </div>
            <div class="row">
                @foreach($leaduser as  $key => $col)

                <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                    <div class="card collectionCard">
                        <a class="cardLink d-block" href="{!! URL::to('collection-page/'.$col->id) !!}">
                            <img src="{{URL::to('/').'/Collection/'}}{{$col->image}}" alt="">
                            <div class="card-body">
                                {{-- <h5><i class="fas fa-map-marker-alt"></i> {{ $col->address }}</h5> --}}
                                <h4 class="location_btn">{{ $col->title }}</h4>
                                {{-- <div class="collectionPlaces">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </div> --}}
                            </div>
                        </a>
                    </div>
                </div>
                <!-- <span>
                        {{$col->count()}} Places
                    </span> -->
                @endforeach
                {{-- <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-2.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-3.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-4.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-5.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-6.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-7.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-8.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-1.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-2.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-3.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="#">
                        <div class="card">
                            <img src="img/collection-4.png" alt="">
                            <div class="card-body">
                                <h5>Melbourne's Best Take..</h5>
                                <a href="#">
                                    20 Places
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
    </section>

    @foreach($data as  $key => $blog)
    <section class="py-2 py-sm-4 py-lg-5">
        <div class="container">
            <div class="row page-title">
                <div class="col-12 mb-4">
                    {!! $blog->content1 !!}
                </div>
                <div class="col-12">
                    <a href="#" class="btn main-btn">
                        let us know your experience
                    </a>
                </div>
            </div>
        </div>
    </section>
  @endforeach
    <section class="py-2 py-sm-4 subscribe">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6>Subscribe For a Newsletter</h6>
                    <p>Want to be notified about new locations? Just sign up.</p>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group position-relative m-0">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button type="submit" class="subscribe-btn">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== Inner Banner ========== -->
@endsection
@push('scripts')

<script src="https://maps.google.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I" type="text/javascript"></script>
<script type="text/javascript">
	@php
	$locations = array();
  foreach($categories as $key => $business){
        $address = $business->directory->address;

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

        $business->directory->latitude = $latitude;
        $business->directory->longitude = $longitude;
	    if($business->directory->image){
	        $img = "https://demo91.co.in/localtales-prelaunch/public/Directory/".$business->directory->image;
	    }else{
	        $img = "https://demo91.co.in/localtales-prelaunch/public/Directory/placeholder-image.png";
	    }

	    $page_link = URL::to('directory-details/'.$business->directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->directory->name)));

		$data = array($business->directory->name,floatval($business->directory->latitude),floatval($business->directory->longitude),$business->directory->address,$img,$page_link);

		array_push($locations,$data);
	}
	@endphp
	var locations = <?php echo json_encode($locations); ?>;
	console.log("businessLocations>>"+JSON.stringify(locations));

    console.log(JSON.stringify(locations));

    var map = new google.maps.Map(document.getElementById('mapShow'), {
      zoom: 7,
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
    var iconBase = 'https://demo91.co.in/localtales-prelaunch/public/site/images/';

    for (i = 0; i < locations.length; i++) {

      const contentString =
    '<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<img src="'+locations[i][4]+'" width="250">' +
    '<div class="mapPopContent"><div id="bodyContent"><a href="'+locations[i][5]+'" target="_blank"><h6 id="firstHeading" class="firstHeading mb-2">'+locations[i][0]+'</h6></a>' +
    '<p>' +locations[i][3]+'</p></div>' +
    '<a href="'+locations[i][5]+'" target="_blank" class="directionBtn"><i class="fas fa-link"></i></a>' +
    '</div></div>';

  const infowindow = new google.maps.InfoWindow({
    content: contentString,
  });

  const marker = new google.maps.Marker({
   position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: iconBase + 'map_icon.png'
  });

  marker.addListener("click", () => {
    infowindow.open({
      anchor: marker,
      map,
      shouldFocus: false,
    });
  });
    }
  </script>

    <script>
        $('input[name="address"]').on('keyup', function() {
            var $this = 'input[name="address"]'

            if ($($this).val().length > 0) {
                $.ajax({
                    url: '{{ route('user.postcode') }}',
                    method: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        code: $($this).val(),
                    },
                    success: function(result) {
                        var content = '';
                        if (result.error === false) {
                            content += `<div class="dropdown-menu show w-100 postcode-dropdown" aria-labelledby="dropdownMenuButton">`;

                            $.each(result.data, (key, value) => {
                                content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode(${value.pin})">${value.state}, ${value.suburb}, ${value.pin}</a>`;
                            })
                            content += `</div>`;
                            // $($this).parent().after(content);
                        } else {
                            content += `<div class="dropdown-menu show w-100 postcode-dropdown" aria-labelledby="dropdownMenuButton"><li class="dropdown-item">${result.message}</li></div>`;
                        }
                        $('.respDrop').html(content);
                    }
                });
            } else {
                $('.respDrop').text('');
            }
        });

        function fetchCode(code) {
            $('.postcode-dropdown').hide()
            $('input[name="address"]').val(code)
        }

        // collection bookmark/ save/ wishlist
        function collectionBookmark(collectionId) {
            $.ajax({
                url: '{{ route('user.collection.save.toggle') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: collectionId,
                },
                success: function(result) {
                    // alert(result);
                    if (result.type == 'add') {
                        toastr.success(result.message);
                        $('#saveBtn').attr('fill', '#fff');
                    } else {
                        toastr.error(result.message);
                        $('#saveBtn').attr('fill', 'none');
                    }
                }
            });
        }
    </script>
@endpush
