@extends('site.app')
@section('title')
    {{ $pageTitle }}
@endsection

@section('content')
    {{-- BLOG SEARCH --}}
    <section class="inner_banner">
        <div class="container position-relative">
            <h1>Search For Category</h1>
            <div class="page-search-block filterSearchBoxWraper" style="bottom: -83px;">
                <form action="" id="checkout-form">
                    <div class="filterSearchBox">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <input id="searchbykeyword" type="search" name="title" class="form-control pl-3"
                                        placeholder="Search by keyword...">
                                    <label for="searchbykeyword" placeholder="Nom">Search by keyword</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0);" id="btnFilter"
                                    class="w-100 btn btn-blue text-center ml-auto"><img src="{{ asset('front/img/search.svg')}}"></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- BLOG SEARCH RESULT --}}
    <section class="py-2 py-sm-4 py-lg-5">
        <div class="container">
            <h2 class="">Category</h2>
            <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae eaque culpa quos optio qui
                quia ex, blanditiis explicabo quod consequatur rerum assumenda amet sit exercitationem quo esse impedit,
                doloribus at, nobis eos ullam iste? Perspiciatis accusamus voluptatem accusantium distinctio tempore placeat
                odio voluptate delectus mollitia eum quia veniam cum magnam vel quam quibusdam, quis officia quae deleniti
                excepturi unde harum eaque, enim rem. Eveniet itaque dolorum eligendi alias pariatur magnam reprehenderit
                nemo laboriosam odio eaque dolor, aliquid mollitia porro ut tenetur fuga ad impedit incidunt in modi
                sapiente voluptates praesentium. Inventore quam quas eaque dolores officia nulla accusamus tempora
                voluptatibus?</p>
            {{-- <!-- <div class="row m-0 mb-4 justify-content-center">
                <div class="page_title text-center">
                    <h2 class="mb-2">Category</h2>
                    <p></p>
                </div>
            </div> --> --}}
            <div class="row justify-content-center">
                {{-- <div class="swiper-wrapper"> --}}
                @foreach ($cat as $key => $blog)
                    {{-- dd{{ $suburb }} --}}
                    <div class="col-6 col-md-4 mb-4">
                        <div class="smplace_card text-center">
                            <img src="{{ asset('AboutusBanner/about-banner.png') }}">
                            <h4><a href="{!! URL::to('category/' . $blog->id) !!}" class="location_btn">{{ $blog->title }} </a></h4>
                            {{-- <p>{{$blog->description}}</p> --}}
                            @php
                                $array = ['Lorem ipsum dolor sit, amet consectetur adipisicing elit.', 'In bibendum vel mi at feugiat', 'Nulla varius vulputate magna in porta.'];
                            @endphp
                            <p>{{ $array[rand(0, 2)] }}</p>
                        </div>
                    </div>
                @endforeach




                {{-- </div> --}}
                <!--<div class="pagination_swip">
                                                                                                                                                    <div class="swiper-button-next"></div>
                                                                                                                                                    <div class="swiper-button-prev"></div>
                                                                                                                                                    <div class="swiper-pagination"></div>
                                                                                                                                                </div>-->
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $cat->appends($_GET)->links() }}
            </div>
            <p class="small mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae eaque culpa quos optio qui
                quia ex, blanditiis explicabo quod consequatur rerum assumenda amet sit exercitationem quo esse impedit,
                doloribus at, nobis eos ullam iste? Perspiciatis accusamus voluptatem accusantium distinctio tempore placeat
                odio voluptate delectus mollitia eum quia veniam cum magnam vel quam quibusdam, quis officia quae deleniti
                excepturi unde harum eaque, enim rem. Eveniet itaque dolorum eligendi alias pariatur magnam reprehenderit
                nemo laboriosam odio eaque dolor, aliquid mollitia porro ut tenetur fuga ad impedit incidunt in modi
                sapiente voluptates praesentium. Inventore quam quas eaque dolores officia nulla accusamus tempora
                voluptatibus?</p>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        // $(document).ready(function(){
        // 	$('#btnFilter').on("click",function(){
        // 		$('#checskout-form').submit();
        // 	})
        // });

        $(document).on("click", "#btnFilter", function() {
            $('#checkout-form').submit();
        });
    </script>
@endpush
