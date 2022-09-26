@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <!-- ========== Inner Banner ========== -->
    @foreach($content as  $key => $blog)
    <section class="inner_banner" style="background-image: url('{{URL::to('/').'/ContactusBanner/'}}{{$blog->banner_image}}');">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-lg-10">
                    <h6>{{$blog->pretty_name}}</h6>
                </div>
            </div>
        </div>
    </section>
  @endforeach
    <!-- ========== Contact ========== -->
    @foreach($content as  $key => $blog)
    <section class="py-4 py-lg-5 contact-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 contact-text">
                    <div class="addresses">
                        <img src="{{ asset('front/img/footer-logo.png')}}" alt="">
                        <ul class="contact-info mt-5">
                            <li>
                                <i class="fa fa-map-marker-alt"></i>
                                <p>
                                    Dummy Location, South lead garb road, 3695AD, Australia
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-phone-alt"></i>
                                <p>
                                    1-25663-59644-569
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-phone-alt"></i>
                                <p>
                                    1-59647-5697-3695
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-paper-plane"></i>
                                <p>
                                    info@localtales.net
                                </p>
                            </li>
                        </ul>
                        <ul class="social-icons d-flex mt-4">
                            <li>
                                <i class="fab fa-facebook-f"></i>
                            </li>
                            <li>
                                <i class="fab fa-twitter"></i>
                            </li>
                            <li>
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-sec border-0 shadow card p-4">
                        <h5>Let's Get In Touch With Us</h5>
                        <form action="#">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name...">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email...">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Phone no...">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" placeholder="What's inyour mind!"></textarea>
                            </div>
                            <button type="submit" class="w-100 btn main-btn">Submit Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
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
