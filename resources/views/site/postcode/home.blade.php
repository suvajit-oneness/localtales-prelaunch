@extends('site.app')
@section('title')
    {{ $pageTitle }}
@endsection

@section('content')
    <section class="inner_banner articles_inbanner" style="background: url({{ asset('site/images/banner') }}-image.jpg) no-repeat center center; background-size:cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <h1>PostCode</h1>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="page-search-block filterSearchBoxWraper">
                        <div class="filterSearchBox">
                            <form action="" id="checkout-form">
                                <div class="filterSearchBox">
                                    <div class="row">
                                        <div class="col col-sm">
                                            <div class="form-floating">
                                                <input id="postcodefloting" type="text" class="form-control pl-3" name="key_details" placeholder="Postcode/ State" value="{{ request()->input('key_details') }}" autocomplete="off">
                                                <input type="hidden" name="keyword" value="{{ request()->input('keyword') }}">
                                                <label for="postcodefloting">Suburb, Postcode or State</label>
                                            </div>
                                            <div class="respDrop"></div>
                                        </div>
                                        {{-- <input type="hidden" name="state" class="form-control pl-3" value="{{ request()->input('state') }}"> --}}
                                        <div class="col-auto col-sm-auto">
                                            <a href="javascript:void(0);" id="btnFilter" class="w-100 btn btn-blue text-center ml-auto">
                                                <img src="{{ asset('front/img/search.svg') }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="postcode_main pb-5">
        <div class="container">
            <div class="">
                @if (!empty(request()->input('key_details')))
                    @if ($pin->count() > 0)
                        {{-- <h3 class="mb-2 mb-sm-3">Postcode with {{ request()->input('key_details')}}
                            {{ isset($request->state) && isset($request->pin) ? '  ' : '' }}
                        </h3> --}}
                        <h3 class="mb-2 mb-sm-3">Results found for "{{ request()->input('key_details') }}"</h3>
                    @else
                        {{-- <h3 class="mb-2 mb-sm-3">No Postcode found for
                            {{ $request->pin}}
                            {{ isset($request->pin) ? '  ' : '' }}
                        </h3>
                        <p class="mb-2 mb-sm-3 text-muted">Please try again.</p> --}}
                        <h3 class="mb-2 mb-sm-3">No results found for "{{ request()->input('key_details') }}"</h3>
                        <p class="mb-2 mb-sm-3 text-muted">Please try again.</p>
                    @endif
                @else
                    <h3 class="mb-2 mb-sm-3">All Postcodes</h3>
                    <p class="mb-2 mb-sm-3 text-muted">
                        At LocalTales, we want to make it as easy as possible for you to find businesses near you.
                        <br>
                        With our postcode search, just type in your postcode, click search, and you’ll be presented with hundreds of businesses, events, deals, and much more in your area.
                    </p>
                @endif
            </div>
            <div class="row justify-content-center">
                @foreach ($pin as $key => $blog)
                    <div class="col-6 col-md-4 mb-4">
                        <div class="smplace_card text-center">
                            @php
                                // fetch postcode image from suburb of highest population
                                $postcode_img = \App\Models\Suburb::select('image')->where('pin_code', $blog->pin)->orderBy('population', 'desc')->first();

                                $demoImage = DB::table('demo_images')->where('title', '=', 'postcode')->get();
                                $demo = $demoImage[0]->image;
                            @endphp
                                {{-- <img src="{{ asset('/admin/uploads/pincode/images/' . $blog->image) }}" class="card-img-top"> --}}

                                {{-- @if($postcode_img->image != '') --}}
                                @if(!empty($postcode_img->image))
                                    <img src="{{asset('/admin/uploads/suburb/'. $postcode_img->image)}}" class="card-img-top">
                                @else
                                    @if($blog->image!= '')
                                        <img src="{{ asset('/admin/uploads/pincode/images/' . $blog->image) }}" class="card-img-top">
                                    @else
                                        <img src="{{URL::to('/').'/Demo/'}}{{$demo}}" class="card-img-top">
                                   @endif
                                @endif
                            <h4><a href="{!! URL::to('postcode/' . $blog->pin) !!}" class="location_btn">{{ $blog->pin }} </a></h4>
                            <p>{{ $blog->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">{{ $pin->appends($_GET)->links() }}</div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on("click", "#btnFilter", function() {
            $('#checkout-form').submit();
        });
        $('body').on('click', function() {
            //code
            $('.postcode-dropdown').hide();
        });

        // state, suburb, postcode data fetch
        $('input[name="key_details"]').on('keyup', function() {
            var $this = 'input[name="key_details"]'

            if ($($this).val().length > 0) {
                $('input[name="keyword"]').val($($this).val())

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

                               	    // content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode(${value.pin}, '${value.state}', '${value.type}')">${value.suburb}, ${value.short_state} <strong>${value.pin}</strong></a>`;
                               	    //content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode('${value.pin}', '${value.suburb}, ${value.short_state} ${value.pin}', '${value.type}')">${value.suburb}, ${value.short_state} <strong>${value.pin}</strong></a>`;
                            	} else if(value.type == 'suburb') {
                            		content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode('${value.pin}', '${value.suburb}, ${value.short_state} ${value.pin}', '${value.type}')"><strong>${value.suburb}</strong>, ${value.short_state} ${value.pin}</a>`;
                            	} else {
                            		content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode('${value.state}', '${value.state} ${value.pin}', '${value.type}')"><strong>${value.state}</strong> ${value.pin}</a>`;
                            		//content += `<a class="dropdown-item" href="javascript: void(0)" onclick="fetchCode('${value.pin}', '${value.suburb}, ${value.short_state} ', '${value.type}')"> <strong>${value.suburb} ,</strong> ${value.short_state}</strong></a>`;
                            	}
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

        function fetchCode(keyword, details, type) {
            $('.postcode-dropdown').hide()

            // if(type == "pin"){
                $('input[name="keyword"]').val(keyword)
                $('input[name="key_details"]').val(details)
            // }
            //  else if(type == "suburb") {
            //     $('input[name="keyword"]').val(state)
            // } else {
            //     $('input[name="keyword"]').val(state)
            // }
        }

        $(document).on("click", "#btnFilter", function() {
            $('#checkout-form').submit();
        });
    </script>
@endpush
