@extends('site.app')
@section('title') {{ $pageTitle }}@endsection

@section('content')
<style>
    .wishlist {
        width: 70px;
    }
</style>

<section class="details_banner">
    <figure>
        @if($business->image)
        <img src="{{ URL::to('/') . '/Directory/' }}{{ $business->image }}">
        @else
        <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
        @endif
    </figure>
    <figcaption>
        <div class="container">
            <div class="details_info py-4 py-lg-5">
            <div class="row justify-content-between">
                <div class="col-lg">
                    <ul class="breadcumb_list mb-4">
                        <li><a href="{!! URL::to('') !!}">Home</a></li>
                        <li>/</li>
                        <li><a href="{!! URL::to('directory-list') !!}"> @php
                                $cat = substr($business->category_id, 0, -1);
                                $displayCategoryName = '';
                                foreach(explode(',', $cat) as $catKey => $catVal) {
                                    $catDetails = \App\Models\DirectoryCategory::findOrFail($catVal);
                                    $displayCategoryName .= '<a href="'.route("category.directory", $catDetails->id).'">'.$catDetails->title.'</a> > ';
                                }
                                echo substr($displayCategoryName, 0, -2);
                            @endphp</a></li>
                        <li>/</li>
                        <li>{{ $business->name }}</li>
                    </ul>
                    <h1 class="details_banner_heading">{{ $business->name }}</h1>
                    <!--<div class="w-100">-->

                    <!--</div>-->
                </div>
                <div class="col-auto align-self-center">
                    {{-- @if ($businessSaved == 1)
                    <a href="{!! URL::to('site-delete-user-directory/'.$business->id) !!}" class="btn btn-blue wishlist text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </a>
                    @else
                    <a href="{!! URL::to('site-save-user-directory/'.$business->id) !!}" class="btn btn-light text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </a>
                    @endif --}}

                    <a href="javascript:void(0)" class="wishlist_button" onclick="directoryBookmark({{$business->id}})">
                        @php
                            $ip = $_SERVER['REMOTE_ADDR'];
                            if(auth()->guard('user')->check()) {
                               $collectionExistsCheck = \App\Models\Userbusiness::where('directory_id', $business->id)->where('ip', $ip)->orWhere('user_id', auth()->guard('user')->user()->id)->first();
                            } else {
                               $collectionExistsCheck = \App\Models\Userbusiness::where('directory_id', $business->id)->where('ip', $ip)->first();
                            }

                            if($collectionExistsCheck != null) {
                                // if found
                                $heartColor = "#ffffff";
                            } else {
                                // if not found
                                $heartColor = "none";
                            }
                        @endphp
                        <svg id="saveBtn" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{$heartColor}}" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </a>
                    
                    <div class="share-btns">
                        <div class="dropdown">
                            <button class="share_button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#898989" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <div class="w-100 pl-2">
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_email"></a>
                                        <a class="a2a_button_whatsapp"></a>
                                        <a class="a2a_button_pinterest"></a>
                                        <a class="a2a_button_linkedin"></a>
                                        <a class="a2a_button_telegram"></a>
                                        <a class="a2a_button_facebook_messenger"></a>
                                        <a class="a2a_button_google_gmail"></a>
                                        <a class="a2a_button_reddit"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="banner_meta_area">
                <div class="banner_meta_item">
                    {{-- <figure>
					<img src="{{URL::to('/').'/categories/'}}{{$business->category->image}}">
				</figure> --}}
                    <figcaption>
                        <h5>Category</h5>
                        {{-- <p>{{ $business->category ? $business->category->title : '' }}</p> --}}

                        @php
                            $cat = substr($business->category_id, 0, -1);
                            $displayCategoryName = '';
                            foreach(explode(',', $cat) as $catKey => $catVal) {
                                $catDetails = \App\Models\DirectoryCategory::findOrFail($catVal);
                                $displayCategoryName .= '<a href="'.route("category.directory", $catDetails->id).'">'.$catDetails->title.'</a>, ';
                            }
                            echo substr($displayCategoryName, 0, -2);
                        @endphp
                    </figcaption>
                </div>
                <div class="banner_meta_item">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-map-pin">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </figure>
                    <figcaption>
                        <h5>Address</h5>
                        <p>{{ $business->address }}</p>
                        <input type="hidden" id="googlemapaddress" value="{{ $business->address }}">
                    </figcaption>
                </div>
                {{-- <div class="banner_meta_item">
                    <figure>
                        <a href="tel: {{ $business->mobile }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </a>
                    </figure>
                    <figcaption>
					<h5>Phone No.</h5>
					<p>{{$business->mobile}}</p>
				</figcaption>
                </div> --}}
                <div class="banner_meta_item">
                    <figure>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    </figure>
                    <figcaption>
                        <h5>Website</h5>
                        <p>{{ $business->website }}</p>
                    </figcaption>
                </div>
            </div>
        </div>
    </figcaption>
</section>

    <section class="letest-offer">
        @php  @endphp
        <div class="container">
            <div class="row">
                <div class="col-md-6 details_left">
                    <!-- <div class="card position-relative"> -->
                    <!-- <div class="price-deat">
                    <h1>$ 200<span>Inc. of all taxes<span></h1></div> -->

                    {{-- <ul class="nav nav-tabs details_tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#service" role="tab" aria-controls="service"
                                aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-settings">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path
                                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                    </path>
                                </svg> <span>Service Description</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#description" role="tab"
                                aria-controls="description" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg> Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" id="hours-tab" href="#hours" role="tab"
                                aria-controls="hours" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>

                                <span>Opening Hours</span></a>
                        </li>
                    </ul><!-- Tab panes --> --}}
                    <div class="tab-content descriptionContent">
                        <div class="descriptonBox" id="service">
                            <h4>Service Description</h4>
                            {!! $business->service_description !!}
                        </div>
                        <div class="descriptonBox" id="description">
                            <h4>Description</h4>
                            {!! $business->description !!}
                        </div>
                        <div class="descriptonBox" id="hours" aria-labelledby="hours-tab">
                            <h4>Opening Hours</h4>
                            <table class="table table-sm table-hover">
                                <tr>
                                    <td>Monday</td>
                                    <td>{{ $business->monday }}</td>
                                </tr>
                                <tr>
                                    <td>Tuesday</td>
                                    <td>{{ $business->tuesday }}</td>
                                </tr>
                                <tr>
                                    <td>Wednesday</td>
                                    <td>{{ $business->wednesday }}</td>
                                </tr>
                                <tr>
                                    <td>Thursday</td>
                                    <td>{{ $business->thursday }}</td>
                                </tr>
                                <tr>
                                    <td>Friday</td>
                                    <td>{{ $business->friday }}</td>
                                </tr>
                                <tr>
                                    <td>Saturday</td>
                                    <td>{{ $business->saturday }}</td>
                                </tr>
                                <tr>
                                    <td>Sunday</td>
                                    <td>{{ $business->sunday }}</td>
                                </tr>
                                <tr>
                                    <td>Public Holiday</td>
                                    <td>{{ $business->public_holiday }}</td>
                                </tr>
                            </table>
                            {{-- <ul class="deals-contant">
                                <li>Address : {{ $business->address }}</li><br>
                                <li>Website : {{ $business->website }}</li><br>
                                <li>Email Id : {{ $business->email }}</li><br>
                                <li>Phone No : {{ $business->mobile }}</li>
                            </ul> --}}
                        </div>
                    </div>
                    <!-- <div class="mt-4 text-right">
                        <a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">DETAILS</a>
                        <a href="javascript:void(0);" class="blue-btn load_btn" id="load-more2">+ Add</a>
                        </div> -->
                    <!-- </div> -->
                </div>
                <div class="col-md-6 details_left">
                    <div class="directory-map">
                        <div id="mapShow" style="height: 400px;"></div>
                    </div>
                </div>

            </div>


            {{-- CTA --}}
            {{-- <section class="py-4 py-lg-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Contact us</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="">
                            <div class="banner_meta_item">
                                <figure>
                                    <a href="tel: {{ $business->mobile }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-phone">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                            </path>
                                        </svg>
                                    </a>
                                </figure>
                            </div>
                        </div>

                        <div class="">
                            <div class="banner_meta_item">
                                <figure>
                                    <a href=" {{ $business->website }}">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}



            <!-- Related B -->
            <section class="py-4 py-lg-5">
                <div class="container">
                    <div class="row">
                        <div class="reviewListWrap col">
                            @foreach ( $review as $cat)
                                {{-- <h3>{{ $cat->name }}</h3>
                                {{ $cat->created_at }}
                                {{ $cat->rating }}
                                {{ $cat->comment }} --}}
                                <div class="reviewList">
                                    <div class="reviewListImg">
                                        <img src="{{asset('Directory/userDefualt.png')}}" alt="">
                                    </div>
                                    <div class="reviewListText">
                                        <div class="reviewListTextTop">
                                            <h3>{{ $cat->name }}</h3>
                                            <div class="date">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                {{ $cat->created_at }}
                                            </div>
                                        </div>
                                        <div class="reviewListTextRating">
                                            @php
                                                $rating = number_format($cat->rating,1);
                                                for ($i = 1; $i < 6; $i++) {
                                                    if ($rating >= $i) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    } elseif (($rating < $i) && ($rating > $i-1)) {
                                                        echo '<i class="fas fa-star-half-alt"></i>';
                                                    } else {
                                                        echo '<i class="far fa-star"></i>';
                                                    }
                                                }
                                            @endphp
                                        </div>
                                        <p>{{ $cat->comment }}</p>
                                    </div>
                                </div>
                                @endforeach
                            {{-- <div class="reviewList">
                                <div class="reviewListImg">
                                    <img src="{{asset('Directory/userDefualt.png')}}" alt="">
                                </div>
                                <div class="reviewListText">
                                    <div class="reviewListTextTop">
                                        <h3>Jhon Deo</h3>
                                        <div class="date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            24 May, 2020
                                        </div>
                                    </div>
                                    <div class="reviewListTextRating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.

                                </div>
                            </div>
                            <div class="reviewList">
                                <div class="reviewListImg">
                                    <img src="{{asset('Directory/userDefualt.png')}}" alt="">
                                </div>
                                <div class="reviewListText">
                                    <div class="reviewListTextTop">
                                        <h3>Jhon Deo</h3>
                                        <div class="date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            24 May, 2020
                                        </div>
                                    </div>
                                    <div class="reviewListTextRating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.

                                </div>
                            </div> --}}

                        </div>
                        {{-- <div class="col-auto align-self-start">
                            <a type="button" id="openreviewBbox" class="reviewbtn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></a>
                        </div> --}}
                    </div>
                    <form method="post" action="{{route('review')}}" id="form">
        @csrf
          <input type="hidden" name="directory_id" id="selectedLongitude" value="{{$business->id  }}">
                    <div class="reviwbox mt-4">
                        <div class="row">
                            <h2 class="col-12 mb-3">Review</h2>
                            <div class="form-group col-md-6">
                                <label for="Name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="comment">Comment:</label>
                                <textarea type="text" class="form-control" name="comment" id="comment"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="rating">Rating:</label>

                                <div class="star-rating">
                                    <input id="star-5" type="radio" name="rating" value="5" />
                                    <label for="star-5" title="5 stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-4" type="radio" name="rating" value="4" />
                                    <label for="star-4" title="4 stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-3" type="radio" name="rating" value="3" />
                                    <label for="star-3" title="3 stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-2" type="radio" name="rating" value="2" />
                                    <label for="star-2" title="2 stars">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                    <input id="star-1" type="radio" name="rating" value="1" />
                                    <label for="star-1" title="1 star">
                                        <i class="active fa fa-star" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary reviewBtn">Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </section>
            <!-- Related B -->

         <section class="py-4 py-lg-5 smallGapGrid">
                <div class="container">
                    <div class="page-title best_deal">
                        <h2>Related directory</h2>
                    </div>

                    @php
                        /*$cat = substr($business->category_id, 0, -1);
                        $displayCategoryName = '';
                        $cat = explode(',', $cat);

                        $pincode = Str::substr($business->address, -4, 4);

                        $relatedProducts = \App\Models\Directory::where('address', 'LIKE', '%'.substr($business->address, -6).'%')->where('id', '!=', $business->id)->limit(4)->get();
                        $test = '';
                        $newPInArr = [];
                        for($i = 1; $i < 7; $i++) {
                            $newPincode = $pincode - $i;
                            array_push($newPInArr, $newPincode);
                        }
                        

                        dd($newPInArr);

                        $displayRelated = [];
                        foreach($newPInArr as $pinKey => $pinVal) {
                            $relatedProducts = \App\Models\Directory::where('address', 'LIKE', '%'.$pinVal.'%')->first()->toArray();

                            // if ($pinKey == 6) dd(count($relatedProducts));

                            array_push($displayRelated, $relatedProducts);
                            // if ( count($relatedProducts) > 0 ) array_push($displayRelated, $relatedProducts);
                        }

                         //dd($displayRelated);*/
                         
                        $displayRelated = array();
                         
                        $cat = explode(',', $cat);

                        $pincode = Str::substr($business->address, -4, 4);
                         
                        $pin1 = $pincode + 1;
                        $pin2 = $pincode - 1;
                        $pin3 = $pincode + 2;
                        $pin4 = $pincode - 2;
                        $pin5 = $pincode + 3;
                        $pin6 = $pincode - 3;
                        $pin7 = $pincode + 4;
                        $pin8 = $pincode - 4;
                        $pin9 = $pincode + 5;
                        $pin10 = $pincode - 5;
                        
                        $cat1 = $cat[0];
                         
                        $data1 = DB::select("select * from directories where address like '%, ".$pin1."' and category_id like '$cat1,%'");
                        $data2 = DB::select("select * from directories where address like '%, ".$pin2."' and category_id like '$cat1,%'");
                        
                        foreach($data1 as $d){
                            array_push($displayRelated,$d);
                        }
                        
                        foreach($data2 as $d){
                            array_push($displayRelated,$d);
                        }
                        
                        if(count($displayRelated)<8){
                            $data3 = DB::select("select * from directories where address like '%, ".$pin3."' and category_id like '$cat1,%'");
                            $data4 = DB::select("select * from directories where address like '%, ".$pin4."' and category_id like '$cat1,%'");
                            
                            foreach($data3 as $d){
                                array_push($displayRelated,$d);
                            }
                            
                            foreach($data4 as $d){
                                array_push($displayRelated,$d);
                            }
                        }
                        
                        if(count($displayRelated)<8){
                            $data5 = DB::select("select * from directories where address like '%, ".$pin5."' and category_id like '$cat1,%'");
                            $data6 = DB::select("select * from directories where address like '%, ".$pin6."' and category_id like '$cat1,%'");
                            
                            foreach($data5 as $d){
                                array_push($displayRelated,$d);
                            }
                            
                            foreach($data6 as $d){
                                array_push($displayRelated,$d);
                            }
                        }
                        
                        if(count($displayRelated)<8){
                            $data7 = DB::select("select * from directories where address like '%, ".$pin7."' and category_id like '$cat1,%'");
                            $data8 = DB::select("select * from directories where address like '%, ".$pin8."' and category_id like '$cat1,%'");
                            
                            foreach($data7 as $d){
                                array_push($displayRelated,$d);
                            }
                            
                            foreach($data8 as $d){
                                array_push($displayRelated,$d);
                            }
                        }
                        
                    @endphp

                <div class="row">
                   <div class="col-md-12">
                       <div class="row Bestdeals">
                         @foreach($displayRelated as $key => $blog)
                        <div class="col-md-4 col-lg-3 jQueryEqualHeight">
                            <div class="card directoryCard border-0">
                                <div class="bst_dimg">
                                    @if($blog->image)
                                    <img src="{{URL::to('/').'/Directory/'}}{{$blog->image}}" class="card-img-top" alt="">
                                    @else
                                    <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{!! URL::to('directory-details/'.$blog->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $blog->name))) !!}" class="location_btn">{{ $blog->name }}</a></h5>
                                    <p class="mb-0">{!! $blog->address !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        {{-- <div class="col-12 text-right mt-4">
                            {{ $data->links() }}
                        </div> --}}
                    </div>
                </div>
            </section>

            <section class="py-4 py-lg-5 smallGapGrid">
                <div class="container">
                    <div class="page-title best_deal">
                        <h2>Nearby directory</h2>
                    </div>

                    @php
                        // $cat = substr($business->category_id, 0, -1);
                        // $displayCategoryName = '';
                        // $cat = explode(',', $cat);
                        $nearbyProducts = \App\Models\Directory::where('address', 'LIKE', '%'.substr($business->address, -4).'%')->where('id', '!=', $business->id)->limit(4)->get();
                    @endphp

                <div class="row m-0">
                          <div class="col-md-12">
                           <div class="row Bestdeals">
                        @foreach($nearbyProducts as $key => $blog)
                        <div class="col-md-4 col-lg-3 jQueryEqualHeight">
                            <div class="card directoryCard border-0">
                                <div class="bst_dimg">
                                    @if($blog->image)
                                    <img src="{{URL::to('/').'/Directory/'}}{{$blog->image}}" class="card-img-top" alt="">
                                    @else
                                    <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{!! URL::to('directory-details/'.$blog->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $blog->name))) !!}" class="location_btn">{{ $blog->name }}</a></h5>
                                    <p class="mb-0">{!! $blog->address !!}</p>

                                    {{-- <a href="#">Read More...</a> --}}

                                </div>
                            </div>
                        </div>
                    @endforeach

                        {{-- <div class="col-12 text-right mt-4">
                            {{ $data->links() }}
                        </div> --}}
                    </div>
                </div>
            </section>


        </div>
    </section>

    <form method="post" action="{{route('review')}}" id="form">
        @csrf
    <!-- Modal -->
    <input type="hidden" name="directory_id" id="selectedLongitude" value="{{$business->id  }}">

    <!--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="comment">Comment:</label>
                            <textarea type="text" class="form-control" name="comment" id="comment"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="rating">Rating:</label>

                            <div class="star-rating">
                                <input id="star-5" type="radio" name="rating" value="1" />
                                <label for="star-5" title="5 stars">
                                  <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-4" type="radio" name="rating" value="2" />
                                <label for="star-4" title="4 stars">
                                  <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-3" type="radio" name="rating" value="3" />
                                <label for="star-3" title="3 stars">
                                  <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-2" type="radio" name="rating" value="4" />
                                <label for="star-2" title="2 stars">
                                  <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-1" type="radio" name="rating" value="5" />
                                <label for="star-1" title="1 star">
                                  <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                            </div>
                            {{-- <input type="text" class="form-control" name="rating" id="rating"> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary ">Save changes</button>
                </div>
            </div>
        </div>
    </div>-->

  </form>
@endsection
@push('scripts')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I" type="text/javascript"></script>
    <script async src="https://static.addtoany.com/menu/page.js"></script>

    <script>
        // AutoComplete Start

        var geocoder = new google.maps.Geocoder();
        var address = $("#googlemapaddress").val();

        geocoder.geocode( { 'address': address}, function(results, status) {
            // console.log(results);
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                console.log(latitude, longitude);
                $("#latLngShow").html('lat: ' + latitude + '<br>lng: ' + longitude)
                var map = new google.maps.Map(document.getElementById('mapShow'), {
                    zoom: 16,
                    center: new google.maps.LatLng(latitude, longitude),
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

                //map marker show
                var infowindow = new google.maps.InfoWindow();

                var marker, i;
                // var iconBase = 'http://cp-33.hostgator.tempwebhost.net/~a1627unp/dev/localtales_v2/public/site/images/';
                var iconBase = 'https://demo91.co.in/localtales-prelaunch/public/site/images/map_icon.png';

                for (i = 0; i < locations.length; i++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude, longitude),
                        map: map,
                        icon: iconBase
                        // icon: iconBase + 'map_icon.png'
                    });

                    google.maps.deal.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(latitude, longitude);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }
        });

        @php
            $locations = [];
            $data = [$business->title, floatval($business->lat), floatval($business->lon)];
            array_push($locations, $data);
        @endphp
        var locations = <?php echo json_encode($locations); ?>;
        console.log("dealLocations>>" + JSON.stringify(locations));

        console.log(JSON.stringify(locations));
    </script>

    <script>
        // directory bookmark/ save/ wishlist
        function directoryBookmark(collectionId) {
            $.ajax({
                url: '{{ route('user.directory.save.toggle') }}',
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
