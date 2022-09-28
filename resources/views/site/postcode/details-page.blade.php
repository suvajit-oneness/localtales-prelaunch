@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

    <!-- ========== Inner Banner ========== -->
    <section class="inner_banner ad-banner">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-lg-8">
                    <small>Published <br>{{ $blog->created_at }}</small>
                    <h6>Top 10 cafes in Eltham</h6>
                    <h5>{{ $blog->category->title }}</h5>
                    <div class="d-flex justify-content-between">
                        <span class="badge">{{$blog->name}}</span>
                        <span class="badge">{{$blog->category_tree}}</span>
                        <span class="badge">{{ $blog->category? $blog->category->title : ''}}</span>
                    </div>
                    <ul class="banner-social">
                        <li>
                            <a href="{{$blog->facebook_link}}">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{$blog->twitter_link}}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{$blog->instagram_link}}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 mt-4">
                    @if($blog->banner_image)
                    <img class="w-100" src="{{URL::to('/').'/Directory/'}}{{$blog->banner_image}}" alt="">
                    @else
                    <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Articles section ========== -->
    <section class="py-4 art-dtls">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                  {!! $blog->content !!}
                  @if($blog->image)
                    <img class="w-100 my-3" src="{{URL::to('/').'/Directory/'}}{{$blog->image}}" alt="">
                    @else
                    <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
                    @endif
                    <p>
                       {!! $blog->description !!}
                    </p>
                    @if($blog->image2)
                    <img class="w-100 my-3" src="{{URL::to('/').'/Directory/'}}{{$blog->image2}}" alt="">
                    @else
                    <img src="{{asset('Directory/placeholder-image.png')}}" class="card-img-top" alt="">
                    @endif
                    <p>
                        {!! $blog->service_description !!}
                    </p>

                    <!-- ========== FAQ ========== -->
                    <div class="faq mt-4">
                        <div class="row mb-4">
                            <div class="col-12 best_deal">
                                <h4>Frequently asked questions</h4>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <ul class="faq-accordion">
                                    <li class="first-set">
                                        <!-- First Layer -->
                                        <div class="toggle">
                                            <h3>Local Deals</h3>
                                            <i class="fas fa-minus plus-sign"></i>
                                        </div>
                                        <div class="inner show container-fluid">

                                            <div class="set">
                                                <h6>Top quality foods</h6>
                                                <ul>
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul> <!-- Second Layer -->
                                            </div>

                                            <div class="set">
                                                <h6>Fruits & vegitables</h6>
                                                <ul>
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                </ul>
                                            </div>

                                            <div class="set">
                                                <h6>Healthy eating</h6>
                                                <ul>
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                </ul>
                                            </div>

                                        </div>
                                    </li> <!-- First Layer -->

                                    <li class="first-set">
                                        <!-- First Layer -->
                                        <div class="toggle">
                                            <h3>Online Deals</h3>
                                            <i class="fas fa-plus plus-sign"></i>
                                        </div>
                                        <div class="inner container-fluid" style="display: none;">

                                            <div class="set">
                                                <h6>Top quality foods</h6>
                                                <ul>
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul> <!-- Second Layer -->
                                            </div>

                                            <div class="set">
                                                <h6>Fruits & vegitables</h6>
                                                <ul>
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                </ul>
                                            </div>

                                            <div class="set">
                                                <h6>Healthy eating</h6>
                                                <ul>
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                    <li class="second-set">
                                                        <!-- Second Layer -->
                                                        <div class="toggle">
                                                            <h5>
                                                                <i class="far fa-check-circle"></i>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                            </h5>
                                                            <i class="fas fa-plus plus-sign-icon plus-sign"></i>
                                                        </div>
                                                        <div class="inner">
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Maecenas tempus
                                                                placerat fringilla. Duis a elit et dolor laoreet
                                                                volutpat. Aliquam
                                                                ultrices
                                                                mauris id mattis imperdiet. Aenean cursus ultrices justo
                                                                et varius.
                                                                Suspendisse aliquam orci id dui dapibus blandit. In hac
                                                                habitasse platea
                                                                dictumst.
                                                                Sed risus velit, pellentesque eu enim ac, ultricies
                                                                pretium felis.
                                                            </p>
                                                        </div>
                                                    </li> <!-- Second Layer -->
                                                </ul>
                                            </div>

                                        </div>
                                    </li> <!-- First Layer -->
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-5 art-aside">
                    <div class="become p-4">
                        <div class="become-text">
                            <h3>
                                Let's
                                <span class="d-block">Become One</span>
                                Of Us
                            </h3>
                            <p>
                                Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed
                                non mauris.
                            </p>
                            <a href="#" class="btn main-btn">Sign up</a>
                        </div>
                    </div>
                    <div class="card alert" role="alert">
                        <div class="card-body p-0">
                            <h3>Get free quote</h3>
                            <p>
                                Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed
                                non .
                            </p>
                            <a href="#" class="btn main-btn">Get it now</a>
                        </div>
                        <button type="button" class="cross-icon close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="card alert" role="alert">
                        <div class="card-body p-0">
                            <h3>How We Work</h3>
                            <p>
                                Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed
                                non .
                            </p>
                            <a href="#" class="btn main-btn">EXPLORE FAQ</a>
                        </div>
                        <button type="button" class="cross-icon close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="card alert" role="alert">
                        <div class="card-body p-0">
                            <h3>Find The Best Deals</h3>
                            <p>
                                Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed
                                non .
                            </p>
                            <a href="#" class="btn main-btn">COMPARE</a>
                        </div>
                        <button type="button" class="cross-icon close" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="card listing-card text-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{ asset('front/img/logo2.png')}}" alt="">
                            </div>
                            <div class="col-sm-6">
                                <h3>The Onigiri</h3>
                                <ul>
                                    <li>Selling point 1</li>
                                    <li>Selling point 2</li>
                                    <li>Selling point 3</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <h3>Key Features</h3>
                        <ul class="feature-list">
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 1
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 2
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 3
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 4
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 5
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 6
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 7
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 8
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 9
                            </li>

                        </ul>
                    </div>
                    <div class="card mt-0 text-center">
                        <div class="card-body p-0">
                            <h4>Find Free Quote For Food & Drinks</h4>
                            <a href="#" class="btn main-btn d-block">free quotes</a>
                        </div>
                    </div>
                    <div class="card listing-card text-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{ asset('front/img/logo2.png')}}" alt="">
                            </div>
                            <div class="col-sm-6">
                                <h3>The Onigiri</h3>
                                <ul>
                                    <li>Selling point 1</li>
                                    <li>Selling point 2</li>
                                    <li>Selling point 3</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <h3>Key Features</h3>
                        <ul class="feature-list">
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 1
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 2
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 3
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 4
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 5
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 6
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 7
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 8
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 9
                            </li>

                        </ul>
                    </div>
                    <div class="card mt-0 text-center">
                        <div class="card-body p-0">
                            <h4>Find Free Quote For Food & Drinks</h4>
                            <a href="#" class="btn main-btn d-block">free quotes</a>
                        </div>
                    </div>
                    <div class="card listing-card text-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="{{ asset('front/img/logo2.png')}}" alt="">
                            </div>
                            <div class="col-sm-6">
                                <h3>The Onigiri</h3>
                                <ul>
                                    <li>Selling point 1</li>
                                    <li>Selling point 2</li>
                                    <li>Selling point 3</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <h3>Key Features</h3>
                        <ul class="feature-list">
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 1
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 2
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 3
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 4
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 5
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 6
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 7
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 8
                            </li>
                            <li>
                                <i class="fa fa-check-circle"></i>
                                Features 9
                            </li>

                        </ul>
                    </div>
                    <div class="card mt-0 text-center">
                        <div class="card-body p-0">
                            <h4>Find Free Quote For Food & Drinks</h4>
                            <a href="#" class="btn main-btn d-block">free quotes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Relevent Articles ========== -->
    <section class="py-4 py-lg-5 bg-light">
        <div class="container">
            <div class="row m-0 mb-4 mb-lg-5 justify-content-between best_deal">
                <h4>Relevent Articles</h4>
                <!-- <a href="">VIEW ALL</a> -->
            </div>
            <div class="row m-0">
                <div class="swiper Bestdeals Bestdeals2">
                    <div class="swiper-wrapper">
                        @foreach($latestBlogs as  $key => $blog)
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <img src="{{URL::to('/').'/Blogs/'}}{{$blog->image}}" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0">{{ $blog->title }}</h5>
                                    <p>
                                        {!! $blog->content !!}
                                    </p>
                                    <span class="tag_text">{{ $blog->tag }}</span>
                                    <a href="{!! URL::to('blog-details/'.$blog->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $blog->title))) !!}" class="location_btn">Read More <img src="{{asset('site/images/right-arrow.png')}}"></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <img src="./img/fd2.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0">Morbiat semper nunc mollis accumsan</h5>
                                    <p>
                                        Morbi consequat semper nunc, mollis cumsa enim molestie tem. velit aliquam.
                                    </p>
                                    <span class="tag_text"># 3095, # Eltham , # Eltham North</span>
                                    <a href="#">Read More...</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0">
                                <div class="bst_dimg">
                                    <img src="./img/fd3.png" class="card-img-top" alt="ltItem">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title m-0">Morbiat semper nunc mollis accumsan</h5>
                                    <p>
                                        Morbi consequat semper nunc, mollis cumsa enim molestie tem. velit aliquam.
                                    </p>
                                    <span class="tag_text"># 3095, # Eltham , # Eltham North</span>
                                    <a href="#">Read More...</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
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
