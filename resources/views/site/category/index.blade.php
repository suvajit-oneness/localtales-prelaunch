@extends('site.app')
@section('title') {{ $pageTitle }} @endsection

@if($type != "primary")
@php
    $directories = array();
    foreach ($data as $subcategory)
    // $directoryList = \App\Models\Directory::where('category_id', 'like', $subcategory->id.',%')->paginate(3)->appends(request()->query());
    foreach($directoryList as $business){
        $directoryLattitude = $business->lat;
        $directoryLongitude = $business->lon;
        $address = $business->address;

        if ($directoryLattitude == null || $directoryLongitude == null ) {
            $url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&key=AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $responseJson = curl_exec($ch);
            curl_close($ch);

            $response = json_decode($responseJson);

            if (count($response->results)>0) {
                $latitude = $response->results[0]->geometry->location->lat;
                $longitude = $response->results[0]->geometry->location->lng;

                $business->latitude = $latitude;
                $business->longitude = $longitude;

                // insert lat & lon into directories
                \DB::table('directories')->where('id', $business->id)->update([
                    'lat' => $latitude,
                    'lon' => $longitude
                ]);
            }
        } else {
            $business->latitude = $directoryLattitude;
            $business->longitude = $directoryLongitude;
        }

        array_push($directories, $business);
    }
@endphp
@endif

@section('content')
<section class="inner_banner"

    @if($type == "primary")
        @if($data[0]->parent_category_image)
            style="background: url({{URL::to('/').'/categories/'}}{{$data[0]->parent_category_image}})"height: 350px;object-fit: cover
        @else
            @php
                $demoImage = DB::table('demo_images')->where('title', '=', 'category')->get();
                $demo = $demoImage[0]->image;
            @endphp
            style="background: url({{URL::to('/').'/Demo/' .$demo}})"height: 350px;object-fit: cover
        @endif >
    @else
        @if($data[0]->child_category_image)
            style="background: url({{URL::to('/').'/admin/uploads/directorysubcategory/images/'}}{{$data[0]->child_category_image}})"height: 350px;object-fit: cover
        @else
            @php
                $demoImage = DB::table('demo_images')->where('title', '=', 'category')->get();
                $demo = $demoImage[0]->image;
            @endphp
            style="background: url({{URL::to('/').'/Demo/' .$demo}})"height: 350px;object-fit: cover
        @endif >
    @endif

    <div class="container position-relative">
        @if($type == "primary")
            <h1>{{$data[0]->parent_category}}</h1>
        @else
            <h1>{{$data[0]->child_category}}</h1>
        @endif
    </div>
</section>
<section class="pb-4 pb-lg-5 our-process pt-3">
    <div class="container">
    <ul class="breadcumb_list mb-4 border-bottom pb-2">
        <li><a href="{!! URL::to('/') !!}">Home</a></li>
        <li>/</li>
        <li><a href="{{ route('category-home') }}">Category</a></li>
        <li>/</li>
        @if($type == "secondary")
        <li><a href="{!! URL::to('category/' . $data[0]->parent_category_slug) !!}">{{$data[0]->parent_category}}</a></li>
        <li>/</li>
        @endif
        @if($type == "primary")
        <li class="active">{{$data[0]->parent_category}}</li>
        @else
        <li class="active">{{$data[0]->child_category}}</li>
        @endif
    </ul>
   </div>
</section>
@if(!empty($data[0]->description))
    <section class="map_section pb-4 pb-lg-5 pt-1">
        <div class="container">
            <div class="row m-0 justify-content-center">
                <div class="col-12">
                <p>{!! $data[0]->description ?? '' !!}</p>
                </div>
            </div>
        </div>
    </section>
@endif

@if(!empty($data[0]->short_content))
<section class="pb-4 pb-lg-5 our-process">
    <div class="container">
        {{-- <div class="page-title best_deal"></div> --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <h4>
                    {!! $data[0]->short_content ?? '' !!}
                </h4>
            </div>
        </div>
    </div>
</section>
@endif

@if(!empty($data[0]->medium_content))
<section class="pb-4 pb-lg-5 top-deals">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 best_deal order-2 order-lg-1">
                <p>{!! $data[0]->medium_content ?? '' !!}</p>
            </div>
            @if($blog->medium_content_image)
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                <img class="w-100" src="{{URL::to('/').'/categories/'}}{{$blog->medium_content_image}}" alt="">
            </div>
            @endif
        </div>
    </div>
</section>
@endif

@if(!empty($data[0]->long_content))
<section class="pb-4 pb-lg-5 our-process">
    <div class="container">
        {{-- <div class="page-title best_deal"></div> --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <h4>{!! $data[0]->long_content ?? '' !!}</h4>
                <div class="col-lg-6 order-1">
                    <img class="w-100" src="{{ URL::to('/').'/categories/'}}{{$data[0]->long_content_image}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
@endif


{{-- showing sub-categories --}}
@if($type == "primary")
    @if(count($childCategories) > 0)
    <section class="pt-4 pb-4 pb-lg-5 our-process">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-3">Categories under {{$data[0]->parent_category}}</h5>
                </div>
                @foreach ($childCategoriesGrouped as $childCategory)
                    @if($childCategory->child_category_slug == null) @continue @endif
                    <div class="col-6 col-md-3 mb-2">
                        <a href="{{ route('category', $childCategory->child_category_slug) }}" class="d-block">
                            <div class="card card-body">
                                <!--<img src="https://demo91.co.in/localtales-prelaunch/public/Demo/1662111055.placeholder-image.png" alt="" height="130px" style="object-fit: cover;">-->
                                <img src="@if($childCategory->child_category_image) {{URL::to('/').'/admin/uploads/directorysubcategory/images/'.$childCategory->child_category_image}}
                                @else
                                    @php
                                        $demoImage = DB::table('demo_images')->where('title', '=', 'category')->get();
                                        $demo = $demoImage[0]->image;
                                    @endphp
                                    {{URL::to('/').'/Demo/' .$demo}}
                                @endif
                                " alt="" height="130px" style="object-fit: cover;">
                                <p class="mt-2 mb-0">{{ $childCategory->child_category }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endif


{{-- showing directories --}}
@if($type == "secondary")
    @if(count($data) > 0)
    @if(!empty($data[0]->child_description))
  <section class="pb-4 pb-lg-2 our-process pt-lg-5">
    <div class="container">
        {{-- <div class="page-title best_deal"></div> --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <h4>
                    {!! $data[0]->child_description ?? '' !!}
                </h4>
            </div>
        </div>
    </div>
  </section>
@endif

    @if(!empty($data[0]->child_short_content))
  <section class="pb-4 pb-lg-2 our-process pt-lg-5">
    <div class="container">
        {{-- <div class="page-title best_deal"></div> --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <h4>
                    {!! $data[0]->child_short_content ?? '' !!}
                </h4>
            </div>
        </div>
    </div>
  </section>
@endif

@if(!empty($data[0]->child_medium_content))
<section class="pb-4 pb-lg-2 top-deals pt-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 best_deal order-2 order-lg-1">
                <p>{!! $data[0]->child_medium_content ?? '' !!}</p>
            </div>
        </div>
    </div>
</section>
@endif

@if(!empty($data[0]->child_long_content))
<section class="pb-4 pb-lg-2 our-process pt-lg-5">
    <div class="container">
        {{-- <div class="page-title best_deal"></div> --}}
        <div class="row justify-content-center">
            <div class="col-12">
                <h4>{!! $data[0]->child_long_content ?? '' !!}</h4>
            </div>
        </div>
    </div>
</section>
@endif

    <section class="pt-4 pb-4 pb-lg-5 searchpadding bg-light smallGapGrid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <div class="best_deal page-title">
                        <h2> Directory </h2>
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
                {{-- grid view --}}
                <div class="tab-content smallGapGrid" id="grid">
                    <div class="row Bestdeals">
                        {{-- @foreach ($data as $subcategory)
                            @php
                                $directoryList = \App\Models\Directory::where('category_id', 'like', $subcategory->id.',%')->paginate(3)->appends(request()->query());
                            @endphp --}}
                            @foreach($directoryList as $key => $business)
                                <div class="col-6 col-md-4 col-lg-4 jQueryEqualHeight">
                                    <div class="card directoryCard border-0 v3card">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{ URL::to('directory/'.$business->slug) }}" class="location_btn">{{ $business->name }}</a></h5>

                                            {!! directoryRatingHtml($business->rating) !!}

                                            <p><i class="fas fa-map-marker-alt"></i> {!! $business->address !!}</p>

                                            <div>
                                                <div>
                                                    @php
                                                        $only_numbers = (int)filter_var($business->mobile, FILTER_SANITIZE_NUMBER_INT);
                                                        if(strlen((string)$only_numbers) == 9) {
                                                            $only_number_to_array = str_split((string)$only_numbers);
                                                            $mobile_number = '(0'.$only_number_to_array[0].') '.$only_number_to_array[1].$only_number_to_array[2].$only_number_to_array[3].$only_number_to_array[4].$only_number_to_array[5].$only_number_to_array[6].$only_number_to_array[7].$only_number_to_array[8];
                                                        } elseif(strlen((string)$only_numbers) == 10) {
                                                            $only_number_to_array = str_split((string)$only_numbers);
                                                            $mobile_number = '('.$only_number_to_array[0].$only_number_to_array[1].$only_number_to_array[2].$only_number_to_array[3].') '.$only_number_to_array[4].$only_number_to_array[5].$only_number_to_array[6].$only_number_to_array[7].$only_number_to_array[8].$only_number_to_array[9];
                                                        } else {
                                                            $mobile_number = $business->mobile;
                                                        }
                                                    @endphp
                                                    <a href="tel:{{$mobile_number}}" class="g_l_icon"><i class="fas fa-phone-alt"></i>{{$mobile_number}}</a>
                                                </div>
                                                <div class="categoryB-list v3_flag">
                                                    {!! directoryCategory($business->category_id) !!}
                                                {{-- @php
                                                    if (!empty($business->category_id)) {
                                                        $cat = substr($business->category_id, 0, -1);
                                                        $catArr = explode(',', $cat);

                                                        $displayCategoryName = '';
                                                        foreach($catArr as $catKey => $catVal) {
                                                            $catDetails = \App\Models\DirectoryCategory::select('id', 'title')->where('id', $catVal)->first();

                                                            if ($catDetails) {
                                                                $displayCategoryName .= '<a class="mb-2" href="'.route("category.directory", $catDetails->id).'">'.$catDetails->title.'</a>, ';
                                                            }
                                                        }
                                                        echo substr($displayCategoryName, 0, -2);
                                                    }
                                                @endphp --}}
                                                </div>
                                            </div>
                                            <div class="v3readmore">
                                                <a href="{{ URL::to('directory/'.$business->slug) }}" class="location_btn"><i class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        {{-- @endforeach --}}
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{-- {{ $directoryList->appends($_GET)->links() }} --}}
                    </div>
                </div>

                {{-- list view --}}
                <div class="tab-content smallGapGrid Bestdeals" id="list">
                    <div class="row">
                    <ul class="search_list_items search_list_items-mod v3_list_view">
                        @foreach($directoryList as $key => $business)
                        <li>
                            <div class="list_content_wrap">
                                <div class="location_meta">
                                    <figcaption>
                                        <h4 class="place_title bebasnew">{{$business->name}}</h4>

                                        {!! directoryRatingHtml($business->rating) !!}

                                        {{-- @php
                                            if ($business->rating == "0" || $business->rating == "" || $business->rating == null) {
                                                echo '';
                                            } else {
                                                echo $business->rating.' <span class="fa fa-star checked" style="color: #FFA701;"></span>';
                                            }
                                        @endphp --}}

                                        <div class="v3_Listd mb-2">
                                            <div><p class="v3_call mt-0"><i class="fas fa-phone-alt"></i>{{$business->mobile}}</a></p></div>
                                            <div class="d-flex location_details">
                                                @php
                                                    // var_dump($business->website);
                                                    if (($business->website == "NA" || $business->website == "")) {
                                                        echo '';
                                                    } else {
                                                        echo '
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                                        <a href="'.$business->website.'" target="_blank" class="history_details">'.$business->website.'</a>';
                                                    }
                                                @endphp
                                            </div>
                                        </div>
                                    </figcaption>
                                    {{-- <p class="history_details">{!!strip_tags(substr($business->description,0,300))!!}</p> --}}
                                    <div class="d-flex location_details">
                                        <span><i class="fas fa-tag"></i></span>
                                        <p class="location mb-0">{{$business->category_tree}}</p>
                                    </div>
                                    <div class="d-flex location_details">
                                        <span><i class="fas fa-map-marker-alt"></i></span>
                                        <p class="location mb-0">{{$business->address}}</p>
                                    </div>
                                    {{-- <input type="hidden" id="googlemapaddress" value="{{ $business->address }}"> --}}
                                    <div class="categoryB-list">
                                        {!! directoryCategory($business->category_id) !!}
                                        {{-- @php
                                            if (!empty($business->category_id)) {
                                                $cat = substr($business->category_id, 0, -1);
                                                $catArr = explode(',', $cat);

                                                $displayCategoryName = '';
                                                foreach($catArr as $catKey => $catVal) {
                                                    $catDetails = \App\Models\DirectoryCategory::select('id', 'title')->where('id', $catVal)->first();

                                                    if ($catDetails) {
                                                        $displayCategoryName .= '<a class="mb-2" href="'.route("category.directory", $catDetails->id).'">'.$catDetails->title.'</a>, ';
                                                    }
                                                }
                                                echo substr($displayCategoryName, 0, -2);
                                            }
                                            /* if(!empty($business->category_id)) {
                                                $cat = substr($business->category_id, 0, -1);
                                                $displayCategoryName = '';
                                                foreach(explode(',', $cat) as $catKey => $catVal) {
                                                    $catDetails = \App\Models\DirectoryCategory::findOrFail($catVal);
                                                    $displayCategoryName .= '<a href="'.route("category.directory", $catDetails->id).'">'.$catDetails->title.'</a>, ';
                                                }
                                                echo substr($displayCategoryName, 0, -2);
                                            } */
                                        @endphp --}}
                                    </div>
                                    <div class="v3readmore">
                                        {{-- <a href="{!! URL::to('directory/'.$business->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->name))) !!}">View Details<i class="fa fa-arrow-right"></i></a> --}}

                                        <a href="{{ URL::to('directory/'.$business->slug) }}">View Details <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                        <div class="col-12">
                            <div class="d-flex justify-content-center mt-4">
                                {{-- {{ $directoryList->appends($_GET)->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- map view --}}
                <div class="tab-content smallGapGrid Bestdeals" id="map">
                    <div class="row justify-content-center">
                        <div class="col-12"></div>
                        <div class="col-12">
                            <div class="map">
                                <div id="mapShow" style="height: 600px;"></div>
                                <span id="latLngShow"></span>
                                {{-- <input type="hidden" id="googlemapaddress" value=""> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endif

{{-- <section class="pb-4 pb-lg-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title best_deal">
                    <h2>Related Categories</h2>
                </div>
            </div>
            <div class="col-auto">
                <a href="{!! URL::to('category') !!}" class="viewAllBtn">VIEW ALL</a>
            </div>
        </div>
        <div class="row m-0 rel-cat">
            <div class="swiper Bestdeals cafe-card">
                <div class="swiper-wrapper">
                @foreach($relatedCategories as $key => $content)
                    <div class="swiper-slide">
                        <div class="card relatedCard border-0">
                            @if ($content->parent_category_image)
                                <img  src="{{URL::to('/').'/categories/'}}{{$content->parent_category_image}}" style="height: 350px;object-fit: cover;">
                            @else
                                @php
                                    $demoImage=DB::table('demo_images')->where('title', '=', 'category')->get();
                                    $demo=$demoImage[0]->image;
                                    //dd($demoImage);
                                @endphp
                                <img src="{{URL::to('/').'/Demo/'}}{{$demo}}"  style="height: 350px;object-fit: cover;">
                            @endif
                            <div class="relatedCardBody px-0">
                                <h4><a href="{!! URL::to('category/' . $content->parent_category_slug) !!}" class="location_btn">{{$content->parent_category}}</a></h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section> --}}
@endsection

@push('scripts')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4" type="text/javascript"></script>

    <script>
        @if($type != "primary")
        @php
        $locations = array();
        foreach($directories as $business) {
            $img = "https://maps.googleapis.com/maps/api/streetview?size=640x640&location=".$business->latitude.",".$business->longitude."&fov=120&heading=0&key=AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4";

            // $page_link = URL::to('directory/'.$business->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $business->name)));
            $page_link = URL::to('directory/'.$business->slug);

           // $data = array($business->name,floatval($business->latitude),floatval($business->longitude),$business->address,$img,$page_link);
           $data = array($business->name,floatval($business->latitude),floatval($business->longitude),$business->address,$page_link);
            array_push($locations,$data);
        }
        @endphp


        var locations = <?php echo json_encode($locations); ?>;
        // console.log("businessLocations>>"+JSON.stringify(locations));
        // console.log(JSON.stringify(locations));

        var map = new google.maps.Map(document.getElementById('mapShow'), {
            zoom: 15,
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
            //'<img src="'+locations[i][4]+'" width="">' +
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
        @endif
    </script>

    <script>
        // state, suburb, postcode data fetch
        $('input[name="key_details"]').on('keyup', function() {
            var $this = 'input[name="key_details"]'

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
                            	if(value.type == 'pin') {
                                    content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode(${value.pin}, '${value.pin}', '${value.type}')"><strong>${value.pin}</strong></a>`;
                            	} else if(value.type == 'suburb') {
                            		content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode('${value.suburb}', '${value.suburb}, ${value.short_state} ${value.pin}', '${value.type}')"><strong>${value.suburb}</strong>, ${value.pin}, ${value.short_state} </a>`;
                                } else {
                                    content += ``;
                                }
                            })

                            if(result.data.length == 1) {
                                content = '';
                            }

                            content += `</div>`;
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

        function fetchCode(keyword, details, type) {
            $('.postcode-dropdown').hide()
            $('input[name="keyword"]').val(keyword)
            $('input[name="key_details"]').val(details)
        }
    </script>
@endpush

