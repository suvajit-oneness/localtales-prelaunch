@extends('site.app')

@section('title') {{ $pageTitle }} @endsection

@section('content')
<section class="inner_banner articles_inbanner" style="background: url({{asset('site/images/banner')}}-image.jpg) no-repeat center center; background-size:cover;">
	<div class="container position-relative">
		<h1>Collection</h1>
        <div class="page-search-block filterSearchBoxWraper" style="bottom: -83px;">
            <div class="filterSearchBox">
                <form action="" id="checkout-form">
                    <div class="filterSearchBox">
                        <div class="row">
                            <div class="col-5 col-sm-6 col-lg-5">
                                {{-- <input type="" class="form-control" name="pin_code" placeholder="Postcode" value="{{ $request->pin_code ? $request->pin_code : '' }}"  autocomplete="off">
                                <div class="respDrop"></div> --}}
                                <div class="form-floating">
                                    <input id="postcodefloting" type="text" class="form-control pl-3" name="pin_code" placeholder="Postcode/ State" value="{{ request()->input('pin_code') }}" autocomplete="off">
                                    <label for="postcodefloting">Postcode/ State</label>
                                </div>
                                <div class="respDrop"></div>
                            </div>

                            <div class="col-5 col-sm">
                                <div class="form-floating">
                                    <input id="searchbykeyword" type="search" name="title" class="form-control pl-3" placeholder="Search by keyword...">
                                    <label for="searchbykeyword" placeholder="Nom">Search by keyword</label>
                                </div>
                            </div>

                            <div class="col-2 col-sm-auto">
                                <a href="javascript:void(0);" id="btnFilter" class="w-100 btn btn-blue text-center ml-auto"><img src="{{ asset('front/img/search.svg')}}"></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</section>

<section class="pb-5 light-bg more-collection">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center cafe-listing-nav">
            <ul class="d-flex" id="tabs-nav">
               <li class="active">
                    <a href="#all-collections">
                        @if (!empty($request->pin_code) || !empty($request->keyword))
                            @if ($data->count() > 0)
                                Collections with {{ ($request->pin_code) ? 'pincode '.$request->pin_code : '' }} {{ (isset($request->pin_code) && isset($request->keyword)) ? ' & ' : '' }} {{ ($request->keyword) ? 'keyword "'.$request->keyword.'"' : '' }}
                            @else
                                No collections found for {{ ($request->pin_code) ? 'pincode '.$request->pin_code : '' }} {{ (isset($request->pin_code) && isset($request->keyword)) ? ' & ' : '' }} {{ ($request->keyword) ? 'keyword "'.$request->keyword.'"' : '' }}
                            @endif
                        @else
                            All Collections
                        @endif
                    </a>
                </li>
               <li class="">
                    <a href="#saved-collections">
                        Saved collection
                    </a>
                </li>
            </ul>
        </div>

        <div id="tab-contents">
            {{-- all collections --}}
            <div class="tab-content" id="all-collections" style="">
                <div class="row">
                    @foreach($data as $collectionKey => $collectionVal)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="card collectionCard">
                                <a class="cardLink d-block" href="{!! URL::to('collection-page/'.$collectionVal->id) !!}">
                                    <img src="{{URL::to('/').'/Collection/'}}{{$collectionVal->image}}" alt="">
                                    <div class="card-body">
                                        <h4 class="location_btn">{{ $collectionVal->title }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- saved collections --}}
            <div class="tab-content" id="saved-collections" style="">
                <div class="row">
                    @php
                        $ip = $_SERVER['REMOTE_ADDR'];

                        if (auth()->guard('user')->check()) {
                            $savedData = \App\UserCollection::where('user_id', auth()->guard('user')->user()->id)->orWhere('ip', $ip)->get();
                        } else {
                            $savedData = \App\UserCollection::where('ip', $ip)->get();
                        }
                    @endphp

                    @forelse($savedData as $savedCollectionKey => $savedCollectionVal)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="card collectionCard">
                                <a class="cardLink d-block" href="{!! URL::to('collection-page/'.$savedCollectionVal->collection->id) !!}">
                                    <img src="{{URL::to('/').'/Collection/'}}{{$savedCollectionVal->collection->image}}" alt="">
                                    <div class="card-body">
                                        <h4 class="location_btn">{{ $savedCollectionVal->collection->title }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>Nothing here! Go &amp; save some collections to access them quicker</p>
                        </div>
                    @endforelse
                </div>
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

@endsection

@push('scripts')
    <script>
        // state, suburb, postcode data fetch
        $('input[name="pin_code"]').on('keyup', function() {
            var $this = 'input[name="pin_code"]'

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
            $('input[name="pin_code"]').val(code)
        }

        $(document).on("click", "#btnFilter", function() {
            $('#checkout-form').submit();
        });
    </script>
@endpush
