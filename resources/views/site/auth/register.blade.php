<!DOCTYPE html>
<html lang="en">
<head>
  <title>Local Tales</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ asset('b2b/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('b2b/css/slick.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('b2b/css/slick-theme.css') }}"/>
  <link rel="stylesheet" href="{{ asset('b2b/css/style.css') }}">

</head>
<body ><!-- class="login-body" -->

<!-- Navbar-->
<section class="login_block" style="background: url({{asset('site/images/banner')}}-image.jpg) no-repeat center center; background-size:cover;">
    <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-sm-auto">
                    <img src="{{asset('site/images/login')}}-logo.png" class="login_logo">
                    <h1><span>Advertise</span><br/>Your Business</h1>
                </div>
                <div class="col">
                    <div class="form_holder">
                        <h3>Register Now</h3>
                      <form action="{{ route('site.register.post') }}" method="POST" role="form">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @csrf
                        <div class="row px-3">
                            <label class="mb-1">Name</label>
                            <input class="mb-3" type="text" name="name" placeholder="Enter a valid name" required="required">
                        </div>
                        <!--<div class="row px-3">-->
                        <!--    <label class="mb-1">User Type</label>-->
                        <!--    <select id="user_type" name="user_type" class="form-control">-->
                               

                        <!--            <option value="1">User</option>-->
                        <!--            <option value="2">Advocate</option>-->


                        <!--    </select>-->
                        <!--    @error('user_type') <p class="small text-danger">{{ $message }}</p> @enderror-->
                        <!--</div>-->
                        <div class="row px-3">
                            <label class="mb-1">Email Address</label>
                            <input class="mb-3" type="text" name="email" placeholder="Enter a valid email address" required="required">
                        </div>
                        <div class="row px-3">
                            <label class="mb-1">Mobile No</label>
                            <input class="mb-3" type="text" name="mobile" placeholder="Enter a valid mobile no" required="required">
                        </div>
                        <div class="row px-3">
                            <label class="mb-1">Password</label>
                            <input class="mb-4" type="password" name="password" placeholder="Enter password" required="required">
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-6">
                                <div class="grid">
                                    <button type="submit" class="btn btn-orange m-0">Register</button>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <!-- <a href="#" class="">Forgot Password?</a> -->
                            </div>
                        </div>
                        <div class="w-100">Already have an account? <a class="text-orange " href="{{ route('site.login') }}">Login</a></div>
                        <!-- <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Register</button> </div>
                        <div class="row mb-4 px-3"> <small class="font-weight-bold text-muted">Already have an account? <a class="text-orange " href="{{ route('site.login') }}">Login</a></small> </div> -->
                      </form>
                    </div>
                </div>
            </div>
      </div>


</section>
<!--Script-->

<script src="{{ asset('b2b/js/jquery.min.js') }}"></script>
<script src="{{ asset('b2b/js/popper.min.js') }}"></script>
<script src="{{ asset('b2b/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('b2b/js/slick.min.js') }}"></script>
<script src="{{ asset('b2b/js/custom.js') }}"></script>




</body>
</html>
