@extends('site.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <!-- ========== Inner Banner ========== -->
    @foreach($about as  $key => $blog)
    <section class="inner_banner" style="background-image: url('{{URL::to('/').'/AboutusBanner/'}}{{$blog->banner_image}}');">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-lg-10">
                    <h6>{{$blog->pretty_name}}</h6>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <!-- ========== About ========== -->
    @foreach($about as  $key => $blog)
    <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row mb-4 mb-lg-5">
                <div class="col-12 best_deal">

                   {!! $blog->content !!}
                </div>
            </div>
            <div class="row mb-4 mb-lg-5 justify-content-between">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img class="w-100" src="{{URL::to('/').'/Aboutus/'}}{{$blog->image}}" alt="">
                </div>
                <div class="col-lg-7 best_deal">
                {!! $blog->content1 !!}
                </div>
            </div>
            <div class="row">
                <div class="col-12 best_deal">
                {!! $blog->content2 !!}
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
