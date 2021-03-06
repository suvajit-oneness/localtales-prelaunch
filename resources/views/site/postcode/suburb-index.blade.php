
@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

  @php
    $businesses = [];
    foreach ($dir as $business) {
        $address = $business->address;

        $url = 'https://maps.google.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I';

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

        array_push($businesses, $business);
    }
    @endphp
<style>
    .pagination {
        float: right;
    }
</style>

{{-- dd{{ $suburb }} --}}
    <section class="inner_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @php
                    $data = \App\Models\Suburb::where('pin_code', $pincode)->first();
                    // dd($data)
                @endphp
                    <h1>{{ $data->name }} </h1>
                    <h1>{{ $data->state }} {{ $data->pin_code }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!--end_innerbanner-->

    <section class="map_section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <p>
                        {{ ($data) ? $data->description : '' }}.
                    </p>
                </div>
                <div class="col-12">
                    <div class="map">
                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2270.7669782997973!2d-1.9121755843464756!3d55.30969183354697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487dfb2f69ab851d%3A0x736c21f03db666c1!2sUnited%20Kingdom%20TaeKwon-Do%20Centres!5e0!3m2!1sen!2sin!4v1650272988401!5m2!1sen!2sin" width="100%" height="330" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                        <div id="mapShow" style="height: 400px;"></div>
                        <input type="hidden" id="googlemapaddress" value="{{ ($data) ? $data->pin_code : '' }}">
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="page-search-block post_directory_search">
                    <form action="{{ route('directory.search') }}" id="checkout-form" class="filterSearchBox">
                        <div class="row align-items-center">
                            <div class="col-10 col-lg-11">
                                <div class="row">
                                    <div class="col-6 col-lg-6 plr-3 pl-lg-0 fcontrol position-relative filter_selectWrap">
                                        {{-- <input list="category_id" name="category_id" id="category_id">
                                        <datalist id="category_id" > --}}

                                        <select class="filter_select form-control" name="category_id">
                                            <option value="" hidden selected>Select Category...</option>
                                            @foreach ($cat as $index => $item)
                                                <option value="{{$item->id}}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-6 col-lg-6 plr-3 pl-lg-0 fcontrol position-relative">
                                        <input type="search" name="title" class="form-control pl-3 m-0" placeholder="Search by keyword...">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-9 col-lg-2 plr-3">
                                <input type="search" name="title" class="form-control pl-3" placeholder="Search by Pincode...">
                            </div> --}}
                            <div class="col-2 col-lg-1 plr-3 pr-lg-0">
                                <a href="javascript:void(0);" id="btnFilter" class="w-100 btn btn-blue filterBtnOrange text-center ml-auto"><img src="{{ asset('front/img/search.svg')}}"></a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--end_map-->
    <section class="py-4 py-lg-5 bg-light">
        <div class="container">
            <div class="row mb-4 mb-lg-5 justify-content-between best_deal">
                <div class="col-md-12">
                    <h4>Directory </h4>
                </div>

            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0">
                    <div class="row Bestdeals">
                        {{-- <div class="swiper-wrapper"> --}}
                        @foreach($dir as $key => $directory)
                        {{-- dd{{ $dir}} --}}
                        <div class="col-6 col-md-4 mb-4 mb-lg-0">
                                <div class="card border-0">
                                    <div class="bst_dimg">
                                        @if($directory->image)
                                        <img src="{{URL::to('/').'/Directory/'}}{{$directory->image}}" class="card-img-top" alt="">
                                        @else
                                        <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title m-0"><a href="{!! URL::to('directory-details/'.$directory->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $directory->name))) !!}" class="location_btn">{{ $directory->name }}</a></h5>
                                        <p>{!! $directory->address !!}</p>

                                        {{-- <a href="#">Read More...</a> --}}

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- </div> --}}

                    </div>
                </div>
            </div><br>
            {{ $dir->links() }}
        </div>
    </section>


    {{-- <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row m-0 justify-content-center">
                <div class="page_title text-center">
                    <h4>Similar places in Eltham</h4>
                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when.</p>
                </div>
            </div>
            <div class="row m-0 mt-4 mt-lg-5 justify-content-center">
                <div class="swiper smplace col-12 col-lg-10">
                    <div class="swiper-wrapper">
                        @foreach($suburb as  $key => $blog)
                        {{-- dd{{ $suburb }} --}}
                          {{-- <div class="swiper-slide">
                            <div class="smplace_card text-center">
                              <h4><a href="{!! URL::to('suburb-details/'.$blog->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $blog->name))) !!}" class="location_btn">{{$blog->name}} </a> <span>Directory Listed</span></h4>
                              <h5>{{  $blog->pincodeDetails ? $blog->pincodeDetails->pin :''}}</h5>
                            </div>
                          </div>
                          @endforeach




                    </div>
                    <div class="pagination_swip">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section class="border-top py-4 py-lg-5">
        <div class="container">
            <div class="row m-0 mb-4 mb-lg-5 justify-content-between best_deal">
                <h4>Best deals</h4>
                <a href="">VIEW ALL</a>
            </div>
            <div class="row m-0">
                <div class="swiper Bestdeals post_code">
                    <div class="swiper-wrapper">
                    @foreach($content as  $key => $blog)
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="{{URL::to('/').'/deals/'}}{{$blog->image}}" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                <h5 class="card-title m-0">{{$blog->title}}</h5>
                                <ul class="fd_item">
                                    <li><small>4.5</small>4 Rating</li>
                                    <li>|</li>
                                    <li>From <span>${{$blog->price}}</span></li>
                                    <li>|</li>
                                    <li>Food</li>
                                </ul>
                                <div class="avatar">
                                    <img src="{{asset('front/img/avtar.png')}}">
                                      {!! $blog->description !!}
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="./img/itm_2.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                <h5 class="card-title m-0">Lorem Food Plaza</h5>
                                <ul class="fd_item">
                                    <li><small>4.5</small>4 Rating</li>
                                    <li>|</li>
                                    <li>From <span>$10.00</span></li>
                                    <li>|</li>
                                    <li>Food</li>
                                </ul>
                                <div class="avatar">
                                    <img src="./img/avtar.png">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and  industry.
                                    </p>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section> --}}


    {{-- <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row m-0 mb-4 mb-lg-5 justify-content-between best_deal">
                <h4>Top events</h4>

            </div>
            <div class="row m-0">
                <div class="swiper Bestdeals post_code">
                    <div class="swiper-wrapper">
                    @foreach($event as  $key => $blog)
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="{{URL::to('/').'/events/'}}{{$blog->image}}" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                <h5 class="card-title m-0">{{$blog->title}}</h5>
                                <ul class="fd_item">
                                    <li><small>4.5</small>4 Rating</li>
                                    <li>|</li>
                                    <li>From <span>${{$blog->price}}</span></li>
                                    <li>|</li>
                                    <li>{{$blog->category->title}}</li>
                                </ul>
                                <div class="avatar">
                                    <img src="{{asset('front/img/avtar.png')}}">
                                    <p>
                                       {!! $blog->description !!}
                                    </p>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="./img/eitm_2.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                <h5 class="card-title m-0">Lorem Food Plaza</h5>
                                <ul class="fd_item">
                                    <li><small>4.5</small>4 Rating</li>
                                    <li>|</li>
                                    <li>From <span>$10.00</span></li>
                                    <li>|</li>
                                    <li>Food</li>
                                </ul>
                                <div class="avatar">
                                    <img src="./img/avtar.png">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and  industry.
                                    </p>
                                </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="./img/eitm_3.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                <h5 class="card-title m-0">Lorem Food Plaza</h5>
                                <ul class="fd_item">
                                    <li><small>4.5</small>4 Rating</li>
                                    <li>|</li>
                                    <li>From <span>$10.00</span></li>
                                    <li>|</li>
                                    <li>Food</li>
                                </ul>
                                <div class="avatar">
                                    <img src="./img/avtar.png">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and  industry.
                                    </p>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="./img/eitm_1.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                <h5 class="card-title m-0">Lorem Food Plaza</h5>
                                <ul class="fd_item">
                                    <li><small>4.5</small>4 Rating</li>
                                    <li>|</li>
                                    <li>From <span>$10.00</span></li>
                                    <li>|</li>
                                    <li>Food</li>
                                </ul>
                                <div class="avatar">
                                    <img src="./img/avtar.png">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and  industry.
                                    </p>
                                </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="py-4 py-lg-5 bg-light">
        <div class="container">
            <div class="row m-0 mb-4 mb-lg-5 justify-content-between best_deal">
                <h4>Articles</h4>

            </div>
            <div class="row m-0">
                <div class="swiper Bestdeals">
                    <div class="swiper-wrapper">
                    @foreach($article as  $key => $blog)
                           {{-- {{ dd($article) }} --}}
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div"></div>
                                    <img src="{{URL::to('/').'/Blogs/'}}{{$blog->image}}" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0"><a href="{!! URL::to('blog-details/'.$blog->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $blog->title))) !!}" class="location_btn">{{$blog->title}}</a></h5>
                                   {!! $blog->description !!}

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
    </section>

    <section class="py-4 subscribe">
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
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I" type="text/javascript">
    </script>

    <script>
        @php
            $locations = [];
            foreach ($businesses as $business) {
                if ($business->image) {
                    $img = 'https://demo91.co.in/localtales-prelaunch/public/Directory/' . $business->image;
                } else {
                    $img = 'https://demo91.co.in/localtales-prelaunch/public/Directory/placeholder-image.png';
                }

                $page_link = URL::to('directory-details/' . $business->id . '/' . strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $business->name)));

                $data = [$business->name, floatval($business->latitude), floatval($business->longitude), $business->address, $img, $page_link];
                array_push($locations, $data);
            }
        @endphp
        var locations = <?php echo json_encode($locations); ?>;
        console.log("businessLocations>>" + JSON.stringify(locations));

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
        var iconBase = 'https://demo91.co.in/localtales-prelaunch/public/site/images/';

        for (i = 0; i < locations.length; i++) {

            const contentString =
                // '<div id="content">' +
                // '<div id="siteNotice">' +
                // "</div>" +
                // '<img src="'+locations[i][4]+'" width="">' +

                // '<div class="mapPopContent"><div id="bodyContent"><a href="'+locations[i][5]+'" target="_blank"><h6 id="firstHeading" class="firstHeading">'+locations[i][0]+'</h6></a>' +
                // '<p>' +locations[i][3]+'</p></div>' +

                //  '<a href="'+locations[i][5]+'" target="_blank" class="directionBtn"><i class="fas fa-directions"></i></a>' +
                // '</div></div>';
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<img src="' + locations[i][4] + '" width="">' +

                '<div class="mapPopContent"><div id="bodyContent"><a href="' + locations[i][5] +
                '" target="_blank"><h6 id="firstHeading" class="firstHeading mb-2">' + locations[i][0] + '</h6></a>' +
                '<p>' + locations[i][3] + '</p></div>' +

                '<a href="' + locations[i][5] + '" target="_blank" class="directionBtn"><i class="fas fa-link"></i></a>' +
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
                            content +=
                                `<div class="dropdown-menu show w-100 postcode-dropdown" aria-labelledby="dropdownMenuButton">`;

                            $.each(result.data, (key, value) => {
                                content +=
                                    `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode(${value.pin})">${value.state}, ${value.pin}</a>`;
                            })
                            content += `</div>`;
                            // $($this).parent().after(content);
                        } else {
                            content +=
                                `<div class="dropdown-menu show w-100 postcode-dropdown" aria-labelledby="dropdownMenuButton"><li class="dropdown-item">${result.message}</li></div>`;
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
    </script>
@endpush
