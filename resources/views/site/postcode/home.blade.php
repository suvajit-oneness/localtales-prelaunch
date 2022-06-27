@extends('site.app')
@section('title')
    {{ $pageTitle }}
@endsection

@section('content')
    {{-- BLOG SEARCH --}}
    <section class="inner_banner articles_inbanner"
        style="background: url({{ asset('site/images/banner') }}-image.jpg) no-repeat center center; background-size:cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1>PostCode</h1>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="page-search-block filterSearchBoxWraper">
                        <div class="filterSearchBox">
                            <form action="" id="checkout-form">
                                <div class="filterSearchBox">
                                    <div class="row">
                                        {{-- <div class="col-12 col-lg-6 plr-6 pl-lg-0 fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                            <select class="filter_select form-control" name="state_id">
                                                <option value="" hidden selected>Select State...</option>
                                                @foreach ($state as $index => $item)
                                                    <option value="{{$item->id}}" {{ ($item->id == request()->input('state_id')) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="respDrop"></div>
                                        </div> --}}
                                        <div class="col-5 col-lg-6 fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                            <div class="select-floating">
                                                <img src="{{ asset('front/img/grid.svg') }}">
                                                <label for="blogcategory">State</label>
                                                <select class="filter_select blogcategory floating-select form-control"
                                                    name="state_id">
                                                    <option value="" hidden selected>Select state</option>
                                                    @foreach ($state as $index => $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == request()->input('state_id') ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5 col-sm">
                                            <div class="form-floating">
                                                <input id="searchbykeyword" type="search" name="pin"
                                                    value="{{ request()->input('pin') }}" class="form-control"
                                                    placeholder="Search by keyword...">
                                                <label for="searchbykeyword" placeholder="Nom">Search by keyword</label>
                                            </div>
                                        </div>
                                        <div class="col-2 col-sm-auto">
                                            <a href="javascript:void(0);" id="btnFilter"
                                                class="w-100 btn btn-blue text-center ml-auto"><img
                                                    src="{{ asset('front/img/search.svg') }}"></a>
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

    {{-- BLOG SEARCH RESULT --}}
    <section class="postcode_main pb-5">
        <div class="container">
            <div class="">
                @if (!empty($request->state_id) || !empty($request->pin))
                    @if ($pin->count() > 0)
                        <h3 class="mb-2 mb-sm-3">Postcode with {{ $request->state_id ? 'state ' . $request->state_id : '' }}
                            {{ isset($request->state_id) && isset($request->pin) ? ' & ' : '' }}
                            {{ $request->pin ? 'keyword "' . $request->pin . '"' : '' }}</h3>
                    @else
                        <h3 class="mb-2 mb-sm-3">No Postcode found for
                            {{ $request->state_id ? 'state ' . $request->state_id : '' }}
                            {{ isset($request->state_id) && isset($request->pin) ? ' & ' : '' }}
                            {{ $request->pin ? 'keyword "' . $request->pin . '"' : '' }}</h3>

                        <p class="mb-2 mb-sm-3 text-muted">Please try again with different State or keyword</p>
                    @endif
                @else
                    <h3 class="mb-2 mb-sm-3">All Postcodes</h3>
                    <p class="mb-2 mb-sm-3 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat
                        pariatur illo, optio corrupti saepe ipsum asperiores illum fugit! Dignissimos debitis nulla laborum
                        illum iure dolores deleniti aspernatur, sit iste quas?</p>
                @endif
            </div>
            <div class="row justify-content-center">
                @foreach ($pin as $key => $blog)
                    <div class="col-6 col-md-4 mb-4">
                        <div class="smplace_card text-center">
                            <img src="{{ asset('/Directory/placeholder-image.png') }}">
                            <h4><a href="{!! URL::to('postcode/' . $blog->pin) !!}" class="location_btn">{{ $blog->pin }} </a></h4>
                            <p>{{ $blog->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">{{ $pin->links() }}</div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on("click", "#btnFilter", function() {
            $('#checkout-form').submit();
        });
    </script>
@endpush
