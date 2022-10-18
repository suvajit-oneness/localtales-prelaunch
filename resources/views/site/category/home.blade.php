@extends('site.app')
@section('title')
    {{ $pageTitle }}
@endsection

@section('content')
    <section class="inner_banner articles_inbanner" style="background: url({{ asset('site/images/banner') }}-image.jpg) no-repeat center center; background-size:cover;">
        <div class="container position-relative">
            @if (!empty(request()->input('title')))
                @if ($data->count() > 0)
                    <h1> {{ (request()->input('title')) ? request()->input('title') : '' }} </h1><br>
                @endif
            @else
                <h1>Category</h1><br>
            @endif
            <div class="page-search-block filterSearchBoxWraper" style="bottom: -83px;">
                <form action="" id="checkout-form">
                    <div class="filterSearchBox">
                        <div class="row">
                            <div class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                <div class="select-floating">
                                    <img src="{{ asset('front/img/grid.svg')}}">
                                    <label>Category</label>
                                    <select class="filter_select form-control" name="title">
                                        <option value="" hidden selected>Select Category...</option>
                                        @foreach ($allCategories as $index => $item)
                                            <option value="{{$item->parent_category}}" {{ (request()->input('parent_category') == $item->parent_category) ? 'selected' : '' }}>{{ $item->parent_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" id="btnFilter" class="w-100 btn btn-blue text-center ml-auto"><img src="{{ asset('front/img/search.svg')}}"></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="py-2 py-sm-4 py-lg-5">
        <div class="container pt-4">
            <div class="d-flex justify-content-between align-items-center cafe-listing-nav pb-0">
                <ul class="d-flex" id="tabs-nav">
                    <li class="active">
                        @if (!empty(request()->input('title')))
                            @if ($data->count() > 0)
                                <h3 class="mb-2 mb-sm-3">Results found for "{{ (request()->input('title')) ? request()->input('title') : '' }}"</h3>
                            @else
                                <h3 class="mb-2 mb-sm-3">No results found for {{ (request()->input('title')) ? request()->input('title') : '' }} </h3>
                            @endif
                        @else
                            <h3 class="mb-2 mb-sm-3">All Category</h3>
                        @endif

                        <p class="mb-2 mb-sm-3 text-muted">
                            Welcome to our Category section. Here you can search for businesses near you by category.
                        </p>
                    </li>
                </ul>
            </div>

            <div class="row justify-content-center">
                @foreach ($data as $key => $category)
                    <div class="col-6 col-md-4 mb-4">
                        <div class="smplace_card text-center">
                            @if (!empty($category->parent_category_image))
                                <img  src="{{URL::to('/').'/categories/'}}{{$category->parent_category_image}}">
                            @else
                                @php
                                    $demoImage = DB::table('demo_images')->where('title', '=', 'category')->get();
                                    $demo = $demoImage[0]->image;
                                @endphp

                                <img src="{{URL::to('/').'/Demo/'}}{{$demo}}" class="card-img-top">
                            @endif
                            <h4><a href="{!! URL::to('category/' . $category->parent_category_slug) !!}" class="location_btn">{{ $category->parent_category }} </a></h4>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $data->appends($_GET)->links() }}
            </div>
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
