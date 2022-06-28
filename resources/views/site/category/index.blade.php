@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

    <!-- ========== Inner Banner ========== -->
    @foreach($event as $key => $blog)
    <section class="inner_banner" style="background-image: url('front/img/category-banner.png');">
        <div class="container position-relative">
            <h1>{{$blog->title}}</h1>
            <!--<div class="page-search-block filterSearchBoxWraper">-->
            <!--    <form action="#">-->
            <!--        <div class="filterSearchBox">-->
            <!--            <div class="row">-->
            <!--                <div class="col">-->
            <!--                    <div class="form-floating">-->
            <!--                        <input type="search" id="searchbykeyword" class="form-control pl-3" placeholder="Search by postcode...">-->
            <!--                        <label for="searchbykeyword" placeholder="Nom">Search by keyword</label>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="col-auto">-->
            <!--                    <button type="submit" class="btn btn-blue text-center ml-auto search-btn">-->
            <!--                        <img src="{{ asset('front/img/search.svg')}}">-->
            <!--                    </button>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </form>-->
            <!--</div>-->
        </div>
    </section>
    @endforeach

    <!-- ========== Description ========== -->
    <section class="map_section pb-4 pb-lg-5">
        <div class="container">
            <div class="row m-0 justify-content-center">
                <div class="col-12">
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Description ========== -->
    <section class="py-4 py-lg-5 top-deals">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 best_deal order-2 order-lg-1">
                    <h4 class="pb-2 pb-sm-4">Top rated deals on foods & drinks in your area</h4>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden.
                    </p>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                    <img class="w-100" src="{{ asset('front/img/top-deals.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Our Process ========== -->
    <section class="py-4 py-lg-5 our-process">
        <div class="container">
            <div class="page-title best_deal">
                <h2>Our Process</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card step shadow">
                        <span class="count">
                            01
                        </span>
                        <h5>
                            Morbi consequat semper mollis accumsan enim.
                        </h5>
                        <p>
                            Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card step shadow">
                        <span class="count">
                            02
                        </span>
                        <h5>
                            Morbi consequat semper mollis accumsan enim.
                        </h5>
                        <p>
                            Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card step shadow">
                        <span class="count">
                            03
                        </span>
                        <h5>
                            Morbi consequat semper mollis accumsan enim.
                        </h5>
                        <p>
                            Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Suburbs ========== -->
    <section class="py-4 py-lg-5 suburbs">
        <div class="container">
            <div class="page-title best_deal">
                <h2>Popular Suburbs</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card">
                        <img src="{{ asset('front/img/brisbane.png')}}" alt="">
                        <h6>Brisbane</h6>
                        <a href="#" class="btn main-btn">
                            Search Now For Brisbane
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card">
                        <img src="{{ asset('front/img/sydney.png')}}" alt="">
                        <h6>Sydney</h6>
                        <a href="#" class="btn main-btn">
                            Search Now For Sydney
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card">
                        <img src="{{ asset('front/img/melbourne.png')}}" alt="">
                        <h6>Melbourne</h6>
                        <a href="#" class="btn main-btn">
                            Search Now For Melbourne
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Category Text ========== -->
    <section class="py-4 py-lg-5 cat cat-alt">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('front/img/cat-1.png')}}" alt="" class="w-100 mb-4 mb-lg-0">
                </div>
                <div class="col-lg-6 best_deal">
                    <h4 class="pb-2 pb-sm-4">Find out best deals in brishbane</h4>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney.
                    </p>
                    <a href="#" class="btn main-btn">Get Free Quote</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Category Text ========== -->
    <section class="py-4 py-lg-5 cat">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 best_deal order-2 order-lg-1">
                    <h4 class="pb-2 pb-sm-4">Proin gravida nibh vel velit auctor aliquet.</h4>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney.
                    </p>
                    <a href="#" class="btn main-btn">Get Free Quote</a>
                </div>
                <div class="col-lg-6  mb-4 mb-lg-0 order-1 order-lg-2">
                    <img src="{{ asset('front/img/cat-2.png')}}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Category Text ========== -->
    <section class="py-4 py-lg-5 cat cat-alt">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('front/img/cat-3.png')}}" alt="" class="w-100 mb-4 mb-lg-0">
                </div>
                <div class="col-lg-6 best_deal">
                    <h4 class="pb-2 pb-sm-4">Lorem Ipsum gravida nibh vel velit auctor aliquet</h4>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney.
                    </p>
                    <a href="#" class="btn main-btn">Get Free Quote</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Category Text ========== -->
    <section class="py-4 py-lg-5 cat">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 best_deal order-2 order-lg-1">
                    <h4 class="pb-2 pb-sm-4">Proin gravida nibh vel velit auctor aliquet.</h4>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney.
                    </p>
                    <a href="#" class="btn main-btn">Get Free Quote</a>
                </div>
                <div class="col-lg-6  mb-4 mb-lg-0 order-1 order-lg-2">
                    <img src="{{ asset('front/img/cat-4.png')}}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Articles ========== -->
    <section class="py-4 py-lg-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="best_deal page-title">
                        <h2>Articles</h2>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="#" class="viewAllBtn">VIEW ALL</a>
                </div>
            </div>
            <div class="row m-0">
                <div class="swiper Bestdeals">
                    <div class="swiper-wrapper">
                    @foreach($latestBlogs as  $key => $content)
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <!--<div class="cmg_div">Coming Soon</div>-->
                                    <img src="{{URL::to('/').'/Blogs/'}}{{$content->image}}" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0">{{$content->title}}</h5>
                                    <p>
                                    {!! $content->description !!}
                                    </p>
                                    <a href="#" class="readmore_btn">Read More...</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="./img/upitm_2.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0">Morbiat semper nunc mollis accumsan</h5>
                                    <p>
                                        Morbi consequat semper nunc, mollis cumsa enim molestie tem. velit aliquam.
                                    </p>
                                    <a href="#">Read More...</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="./img/upitm_3.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0">Morbiat semper nunc mollis accumsan</h5>
                                    <p>
                                        Morbi consequat semper nunc, mollis cumsa enim molestie tem. velit aliquam.
                                    </p>
                                    <a href="#">Read More...</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <div class="cmg_div">Coming Soon</div>
                                    <img src="./img/upitm_1.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0">Morbiat semper nunc mollis accumsan</h5>
                                    <p>
                                        Morbi consequat semper nunc, mollis cumsa enim molestie tem. velit aliquam.
                                    </p>
                                    <a href="#">Read More...</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-4 py-lg-5 ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="best_deal page-title">
                        <h2>Food & drinks FAQs</h2>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="#" class="viewAllBtn">VIEW ALL</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="faq-accordion">
                        <li class="first-set">  <!-- First Layer -->
                            <div class="toggle">
                                <h3>Local Deals</h3>
                                <i class="fas fa-minus plus-sign"></i>
                            </div>
                            <div class="inner show">

                                <div class="set">
                                    <h6>Top quality foods</h6>
                                    <ul>
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>  <!-- Second Layer -->
                                </div>

                                <div class="set">
                                    <h6>Fruits & vegitables</h6>
                                    <ul>
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                    </ul>
                                </div>

                                <div class="set">
                                    <h6>Healthy eating</h6>
                                    <ul>
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                    </ul>
                                </div>

                            </div>
                        </li>  <!-- First Layer -->

                        <li class="first-set">  <!-- First Layer -->
                            <div class="toggle">
                                <h3>Online Deals</h3>
                                <i class="fas fa-plus plus-sign"></i>
                            </div>
                            <div class="inner" style="display: none;">

                                <div class="set">
                                    <h6>Top quality foods</h6>
                                    <ul>
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>  <!-- Second Layer -->
                                </div>

                                <div class="set">
                                    <h6>Fruits & vegitables</h6>
                                    <ul>
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                    </ul>
                                </div>

                                <div class="set">
                                    <h6>Healthy eating</h6>
                                    <ul>
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                        <li class="second-set">   <!-- Second Layer -->
                                            <div class="toggle">
                                                <h5>
                                                    <i class="far fa-check-circle"></i>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                </h5>
                                                <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                            </div>
                                            <div class="inner">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempus
                                                    placerat fringilla. Duis a elit et dolor laoreet volutpat. Aliquam ultrices
                                                    mauris id mattis imperdiet. Aenean cursus ultrices justo et varius.
                                                    Suspendisse aliquam orci id dui dapibus blandit. In hac habitasse platea dictumst.
                                                    Sed risus velit, pellentesque eu enim ac, ultricies pretium felis.
                                                </p>
                                            </div>
                                        </li>   <!-- Second Layer -->
                                    </ul>
                                </div>

                            </div>
                        </li>  <!-- First Layer -->
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== Category ========== -->
    <section class="py-4 py-lg-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title best_deal">
                        <h2>Related Categories</h2>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="#" class="viewAllBtn">VIEW ALL</a>
                </div>
            </div>
            <div class="row m-0 rel-cat">
                <div class="swiper Bestdeals cafe-card">
                    <div class="swiper-wrapper">
                    @foreach($cat as  $key => $content)
                        <div class="swiper-slide">
                            <div class="card relatedCard border-0">
                                <!--<img src="{{URL::to('/').'/Category/'}}{{$content->image}}" alt="">-->
                                <div class="relatedCardBody px-0">
                                    <h4>{{$content->title}}</h4>
                                    <div class="justify-content-between align-items-center">
                                        <div class="rating">
                                            <span class="badge">4.5</span>
                                            Rated
                                        </div>
                                        <div class="location">
                                            <i class="fa fa-map-marker-alt"></i>
                                            South Melbourne, Melbourne
                                        </div>
                                    </div>
                                </div>
                                <!--<span class="save">-->
                                <!--    <img src="img/bookmark.png" alt="">-->
                                <!--</span>-->
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="swiper-slide">
                            <div class="card border-0">
                                <img src="img/cafe-1.png" alt="">
                                <div class="card-body px-0">
                                    <h4>Aenean sollicitudin, lorem quis bibendum</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="location">
                                            <i class="fa fa-map-marker-alt"></i>
                                            South Melbourne, Melbourne
                                        </span>
                                        <strong class="rating">
                                            <span class="badge">4.5</span>
                                            Rated
                                        </strong>
                                    </div>
                                </div>
                                <span class="save">
                                    <img src="img/bookmark.png" alt="">
                                </span>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <img src="img/cafe-1.png" alt="">
                                <div class="card-body px-0">
                                    <h4>Aenean sollicitudin, lorem quis bibendum</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="location">
                                            <i class="fa fa-map-marker-alt"></i>
                                            South Melbourne, Melbourne
                                        </span>
                                        <strong class="rating">
                                            <span class="badge">4.5</span>
                                            Rated
                                        </strong>
                                    </div>
                                </div>
                                <span class="save">
                                    <img src="img/bookmark.png" alt="">
                                </span>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <img src="img/cafe-1.png" alt="">
                                <div class="card-body px-0">
                                    <h4>Aenean sollicitudin, lorem quis bibendum</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="location">
                                            <i class="fa fa-map-marker-alt"></i>
                                            South Melbourne, Melbourne
                                        </span>
                                        <strong class="rating">
                                            <span class="badge">4.5</span>
                                            Rated
                                        </strong>
                                    </div>
                                </div>
                                <span class="save">
                                    <img src="img/bookmark.png" alt="">
                                </span>
                            </div>
                        </div> -->
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Subscribe ========== -->
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
