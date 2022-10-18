@extends('site.app')
@section('title') 'Splash page' @endsection

@section('content')
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-8">
                @foreach($data as  $key => $blog)
                <h4>Welcome here!</h4>
                {!! $blog->content !!}

                <div class="banner_counter">
                    <div class="banner_counter_item">
                        <h3>{{ number_format($postcode)}}</h3>
                        <h5>Postcode</h5>
                    </div>
                    <div class="banner_counter_item">
                        <h3>{{number_format($directory)}}</h3>
                        <h5>Directory</h5>
                    </div>
                    <div class="banner_counter_item">
                        <h3>{{number_format($collection)}}</h3>
                        <h5>Collections</h5>
                    </div>
                </div>
                <form action="" method="get" class="banner_form">
                    @csrf
                    <div class="row">
                        <div class="col-5 col-sm-4 pr-sm-0">
                            <div class="banner-form-group">
                                <input type="text" name="name" id="inputSearchTextFilter" class="form-control" placeholder="Your Business Name">
                                <label>Your Business Name</label>
                            </div>
                        </div>
                        <div class="col-5 col-sm-4 pr-sm-0">
                            <div class="banner-form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="col-2 col-sm-4">
                            <input type="hidden" name="website" value="">
                            <input type="hidden" name="email" value="">
                            <input type="hidden" name="address" value="">
                            <input type="hidden" name="mobile" value="">
                            <button type="submit" class="btn main-btn"><span>Join Us</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>

<section class="play-section">
    <div class="container">
        <div class="row align-items-center">
            @foreach($data as $key => $blog)
            <div class="col-lg-6 mb-4">
                <figure>
                    @if($blog->image!='')
                        <video width="100%" height="100%" autoplay muted>
                        <source src="{{URL::to('/').'/Extra/'}}{{$blog->image}}" type="video/mp4"></video>
                    @endif

                    <div class="browse_box">
                        <span class="browse_icon">
                            <img src="{{ asset('front/img/localtale_icon.png') }}">
                        </span>
                        <h3>Find the best collections</h3>
                        <h4>Browse thousands of collections</h4>
                    </div>
                </figure>
            </div>
            <div class="col-lg-5 offset-lg-1 page-title">
                {!! $blog->content1 !!}
                <!--<h2>Proin gravida vel <span class="text-main">velit Aenean</span> sollicitudin</h2>-->
                <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam nobis id voluptatem reprehenderit, minima sit, nulla maxime a fuga, ut perferendis et..</p>-->

                {{-- <a href="{{url('/')}}/business-signup" class="btn main-btn">Sign up</a> --}}
                <a href="{{url('/')}}/postcode" class="btn main-btn">Postcode</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="available-section">
        <div class="container">
            <div class="row align-items-center">
                @foreach($data as  $key => $blog)
                <div class="col-7 col-lg-5 page-title order-2 order-lg-1">
                    <span class="app-tag">Available for all platforms.</span>

                    {!! $blog->content2 !!}

                    <a href="javascript:void(0)" class="mt-3" style="font-size:30px;color:#ff6355;">
                        <span>Coming Soon</span>
                        {{-- <img src="{{  asset('front/img/play_store.png') }}" alt=""> --}}
                    </a>
                </div>
                <div class="col-5 p-0 col-lg-7 mb-0 mb-sm-4 mb-lg-0 order-1 order-lg-2">
                    @if($blog->image2!='')
                    <img class="w-100"  src="{{URL::to('/').'/Splash/'}}{{$blog->image2}}">
                @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4&libraries=places"></script>

    <script>
        google.maps.event.addDomListener(window,'load',initialize);
        function initialize(){
            var autocomplete= new google.maps.places.Autocomplete(document.getElementById('inputSearchTextFilter'));
            autocomplete.setComponentRestrictions({'country': ['au']});
            google.maps.event.addListener(autocomplete, 'place_changed', function(){
                var places = autocomplete.getPlace();
                console.log(places);
                addressObj = places.address_components;
                addressObjLength = places.address_components.length;
                for (let index = 0; index < addressObjLength; index++) {
                    if(index = addressObjLength-1) {
                        var pinCode = addressObj[index].long_name;
                        console.log(pinCode);
                        $("#pin").val(pinCode)
                    }
                }
                $('#inputSearchTextFilter').val(places.name);
                $('#website').val(places.website);
                $('#email').val(places.email);
                $('#address').val(places.formatted_address);

                if(places.formatted_phone_number){
                    function phpneNumberFormatted(phNum){
                        var i,newValue='';
                        for(i = 0; i < phNum.length; i++){
                            if($.isNumeric(phNum[i])){
                                newValue+=phNum[i];
                            }
                        }
                        return newValue;
                    }
                    var phNum = phpneNumberFormatted(places.formatted_phone_number);

                    $('#mobile').val(phNum);
                } else {
                    $('#mobile').val('');
                }

                $('#selectedLongitude').val(places.geometry.location.lng());
                $('#selectedLatitude').val(places.geometry.location.lat());

                window.location = "{{URL::to('/')}}/business-signup?name="+places.name+"&website="+places.website+"&email="+places.email+"&address="+places.formatted_address+"&mobile="+phNum+"&pin="+pinCode;
            });
        }
    </script>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                const geolocation = navigator.geolocation.getCurrentPosition(showLOcation);
            } else {
                console.log("failed");
            }
        }
        getLocation()
        function showLOcation(position) {
            console.log("position", position);
            if (position.coords?.latitude && position.coords?.longitude) {
                $.ajax({
                   url: `https://maps.googleapis.com/maps/api/geocode/json?latlng=${position.coords?.latitude},${position.coords?.longitude}&key=AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4`,
                   //  url: `https://maps.googleapis.com/maps/api/geocode/json?latlng=-33.878844,151.210072&key=AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4`,
                    method: 'get',
                    data: {},
                    success: function(result) {
                        console.log("location", result);
                        let address = result?.results[0]?.address_components;
                        console.log("address", address);
                        const postcode = address.filter(e => e.types.includes("postal_code"))
                        console.log("postcode", postcode);
                        localStorage.setItem("postcode", postcode[0].long_name)
                        document.cookie = 'postcode=' + postcode[0].long_name;
                        console.log(localStorage.getItem("postcode")+"here");


                    }
                })
            }
        }
        // function getCookie(postcode)
        </script>
@endpush
