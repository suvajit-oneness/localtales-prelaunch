<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
        <a class="navbar-brand" href="#"><img class="w-100" src="{{ asset('front/img/main-logo.png')}}" alt="Local Tales"></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
              <a class="nav-link" href="{!! URL::to('/') !!}">Home</a>
            </li>
            <li class="nav-item {{ request()->is('postcode*') ? 'active' : '' }}">
                <a class="nav-link" href="{!! URL::to('postcode') !!}">Postcode</a>
              </li>
              <li class="nav-item {{ request()->is('directory*') ? 'active' : '' }}">
                <a class="nav-link" href="{!! URL::to('directory-list') !!}">Directory</a>
              </li>
            <li class="nav-item {{ request()->is('collection*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('collection.home') }}">Collection</a>
            </li>
            <li class="nav-item {{ request()->is('category*') ? 'active' : '' }}">
              <a class="nav-link" href="{!! URL::to('category-index') !!}">Category</a>
            </li>
            <li class="nav-item {{ request()->is('article*') ? 'active' : ''  }}">
                <a class="nav-link" href="{!! URL::to('article') !!}">Article</a>
              </li>
          </ul>
          <div class="form-inline my-2 my-lg-0">
              @if(Auth::guard('user')->check())
						<a type="button" class="btn btn-login" href="{!! URL::to('site-edit-profile') !!}">
							<!-- <span><img src="{{ asset('site/images/login-icon.png ')}}"></span> -->

							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
							<span>Hi, {{Auth::guard('user')->user()->name}}</span>
						</a>
						@else
               <a type="button" class="btn btn-login" href="{!! URL::to('login') !!}" ><img src="{{ asset('front/img/login.svg')}}"> Login</a>
               	@endif
            <a type="button" class="btn btn-login btn_buseness" href="{{ route('business.signup')}}"><img src="{{ asset('front/img/briefcase.svg')}}"> Business Signup</a>
          </div>
        </div>
    </nav>
</header>
