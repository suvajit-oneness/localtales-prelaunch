<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Tales</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css')}}">
    <link rel="stylesheet"
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?ver=5.9.3' />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/responsive.css')}}">
</head>

<body>


    <!-- ========== Header ========== -->
    {{-- <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#"><img class="w-100" src="{{ asset('front/img/main-logo.png')}}" alt="Local Tales"></a> --}}
            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button> --}}

            {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Local Directory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Local Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Local Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Local Loop</a>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                <button type="button" class="btn btn-login"><img src="{{ asset('front/img/login.svg')}}"> Login</button>
                <button type="button" class="btn btn-login btn_buseness"><img src="{{ asset('front/img/briefcase.svg')}}"> Business Login</button>
                </div>
            </div> --}}
        {{-- </nav>
    </header> --}}

    <!-- ========== Sign up form ========== -->
    <section class="signup-form">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-xl-5">
                    <div class="signup-text">
                        <h2>
                            Sign Up To Become
                            <span>Our Member</span>
                        </h2>
                        <h5>We're currently in alpha launch</h5>
                        <p>
                            To become one of the first companies to access the site, please sign-up below
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 position-relative">
                <form action="{{ route('business.signuppage.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                        <div class="card">
                            <div class="card-body pt-0">
                                <h3>Please fill the slots below <span class="form-step">02</span></h3>
                                <div class="form-field mt-4">
                                    <div class="form-icon">
                                        <img src="{{ asset('front/img/category.png')}}" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>CATEGORY</label>
                                        <select class="form-control" name="category_id">
                                <option hidden selected>Select Category...</option>
                                @foreach ($dircategory as $index => $item)
                                    <option value="{{$item->id}}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="form-field mt-4">
                                    <div class="form-icon">
                                        <img src="{{ asset('front/img/desc.png')}}" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>DESCRIPTION</label>
                                        <textarea class="form-control" rows="4" name="description" id="description" value="{{ old('description') }}"/>
                            @error('description') {{ $message ?? '' }} @enderror</textarea>
                                    </div>
                                </div>
                                <div class="form-field mt-4">
                                    <div class="form-icon">
                                        <img src="{{ asset('front/img/ser-desc.png')}}" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>SERVICE DESCRIPTION</label>
                                        <textarea class="form-control" rows="4" name="service_description" id="service_description" value="{{ old('service_description') }}"/>
                            @error('service_description') {{ $message ?? '' }} @enderror</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top">
                                <h5>OPENING HOURS</h5>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-5 col-lg-6 col-xl-5">
                                        <div class="form-field mt-4 align-items-center">
                                            <div class="form-icon">
                                                <img src="{{ asset('front/img/ser-desc.png')}}" alt="">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" >
                                                    <option value="" selected>MON - WED</option>
                                                    <option value="">MON - FRI</option>
                                                    <option value="">MON - SAT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-5 col-lg-6 col-xl-5">
                                        <div class="form-field mt-4 align-items-center">
                                            <div class="form-icon">
                                                <img src="{{ asset('front/img/time.png')}}" alt="">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" >
                                                    <option value="" selected>9 am - 6 pm</option>
                                                    <option value="">9 am - 6 pm</option>
                                                    <option value="">9 am - 6 pm</option>
                                                </select>
                                                @error('opening_hour') {{ $message ?? '' }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-5 col-lg-6 col-xl-5">
                                        <div class="form-field mt-4 align-items-center">
                                            <div class="form-icon">
                                                <img src="{{ asset('front/img/ser-desc.png')}}" alt="">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option value="" selected>THU - SUN</option>
                                                    <option value="">MON - FRI</option>
                                                    <option value="">MON - SAT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-5 col-lg-6 col-xl-5">
                                        <div class="form-field mt-4 align-items-center">
                                            <div class="form-icon">
                                                <img src="{{ asset('front/img/ser-desc.png')}}" alt="">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option value="" selected>11 am - 8 pm</option>
                                                    <option value="">9 am - 6 pm</option>
                                                    <option value="">9 am - 6 pm</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top pb-0 add-social">
                                <h5>Social Media</h5>
                                <div class="form-field">
                                    <div class="form-icon">
                                        <img src="{{ asset('front/img/tick.png')}}" alt="">
                                    </div>
                                     <div class="form-group">
                                        <label>
                                            <i class="fab fa-facebook-f"></i>
                                           <input type="text" name="facebook_link">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <div class="form-icon">
                                        <img src="{{ asset('front/img/tick.png')}}" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <i class="fab fa-twitter"></i>
                                            <input type="text" name="twitter_link">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <div class="form-icon">
                                        <img src="{{ asset('front/img/tick.png')}}" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <i class="fab fa-instagram"></i>
                                            <input type="text" name="instagram_link">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <div class="form-group">
                                        <a href="#">
                                            <label>
                                                Add More
                                                <i class="fa fa-plus ml-2"></i>
                                            </label>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-0">
                                <button type="submit" class="btn main-btn btn-block mt-4">
                                    SUBMIT
                                </button>
                            </div>
                            <span class="rect-img">
                                <img src="{{ asset('front/img/rect.png')}}" alt="">
                            </span>
                        </div>
                    </form>
                    <span class="card-line"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== Subscribe Section ========== -->
    <!-- <section class="py-4 subscribe">
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
    </section> -->

    <!-- ========== Inner Banner ========== -->
    <!-- <footer class="footerinner">
        <div class="container">
            <div class="row m-0 justify-content-between">
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="f-menu">
                        <img src="img/footer-logo.png" alt="Local Tales" width="180px" class="mb-3">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam nobis id voluptatem
                            reprehenderit, minima sit, nulla maxime a fuga, ut perferendis et.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="f-menu">
                        <h6>Products</h6>
                        <ul class="f-menu p-0">
                            <li><a href="">Home</a></li>
                            <li><a href="">About</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Shop</a></li>
                            <li><a href="">Contacts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="f-menu">
                        <h6>Other</h6>
                        <ul class="f-menu p-0">
                            <li><a href="">Home</a></li>
                            <li><a href="">About</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Shop</a></li>
                            <li><a href="">Contacts</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center copy_sec">
            <p class="mt-2"><small>Copyrights © 2021 All Rights Reserved by XYZ</small></p>
        </div>
    </footer> -->

    <script type="text/javascript" src="{{ asset('front/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/swiper-bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('front/js/custom.js')}}"></script>

</body>

</html>
