{{-- <section class="newsletter-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6 mb-3 mb-sm-0">
				<h2 class="main-heading">Subscribe For a Newsletter</h2>
				<p>Whant to be notified about new locations ? Just sign up.</p>
			</div>
			<div class="col-sm-6">
				<form id="" action="" class="news">
					<input type="text" id="usr" placeholder="Enter your email">
					<!-- <input type="submit" id="43t" value="Send"> -->
					<button type="submit" id="43t">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
					</button>
				</form>
			</div>
		</div>
	</div>
</section>
<footer>
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-sm-4 col-md-4 mb-4 mb-sm-0">
				<a href="#" class="footer-logo">
					<img src="{{ asset('site/images/footer-logo.png')}}">
				</a>
				<p>
					Award-winning, in-store coffee roastery, coffee bean boutique and sydney cbd cafe. VELLA NERO is a one stop shop for all thing coffee.
				</p>
			</div>
			<!-- <div class="col-md-2">
				<h3 class="footer-heading">State</h3>
				<ul class="footer-list">
					<li><a href="#">Australian Capital Territory</a></li>
					<li><a href="#">New South Wales</a></li>
					<li><a href="#">Northern Territory</a></li>
					<li><a href="#">Queensland</a></li>
					<li><a href="#">South Australia</a></li>
					<li><a href="#">Tasmania</a></li>
					<li><a href="#">Victoria</a></li>
					<li><a href="#">Western Australia</a></li>
				</ul>
			</div> -->
			<div class="col-6 col-sm-4 col-md-2">
				<h3 class="footer-heading">Products</h3>
				<ul class="footer-list">
					<li><a href="{!! URL::to('directory-list') !!}">Local Directory</a></li>
					<li><a href="{!! URL::to('event-list') !!}">Local Events </a></li>
					<li><a href="{!! URL::to('deal-list') !!}">Local Deals </a></li>
					<li><a href="{!! URL::to('local-loops') !!}">Local Loop</a></li>
					<li><a href="{!! URL::to('business/login') !!}">Business Login</a></li>
				</ul>
			</div>
			<div class="col-6 col-sm-4 col-md-2">
				<h3 class="footer-heading">Other</h3>
				<ul class="footer-list">
					<li><a href="{!! URL::to('blog-list') !!}">Blogs</a></li>
					<li><a href="{!! URL::to('about-us') !!}">About Us</a></li>
					<!-- <li><a href="#">Contact Us</a></li> -->
					<li><a href="#">FAQs</a></li>
					<li><a href="{!! URL::to('terms-of-use') !!}">Terms Of Use</a></li>
					<li><a href="{!! URL::to('privacy-policy') !!}">Privacy Policy</a></li>
				</ul>
			</div>
			<div class="col-md-2">
			</div>
		</div>
	</div>
	<div class="copyright">© 2021 {{ config('app.name') }}. All Rights Reserved.</div>
</footer> --}}




<footer class="footerinner">
    <div class="container">
        <div class="row m-0 justify-content-between">
            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="f-menu">
                    <img src="{{ asset('front/img/footer-logo.png')}}" alt="Local Tales" width="180px" class="mb-3">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam nobis id voluptatem reprehenderit, minima sit, nulla maxime a fuga, ut perferendis et.
                    </p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="f-menu">
                    <h6>Products</h6>
                    <ul class="f-menu p-0">
                        <li><a href="{!! URL::to('index') !!}">Home</a></li>
                        <li><a href="{!! URL::to('about-us') !!}">About</a></li>
                        <li><a href="{!! URL::to('article') !!}">Blog</a></li>
                        <li><a href="{!! URL::to('collection') !!}">Collection</a></li>
                        <li><a href="{!! URL::to('contact-us') !!}">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="f-menu">
                    <h6>Other</h6>
                    <ul class="f-menu p-0">
                        <li><a href="{!! URL::to('index') !!}">Home</a></li>
                        <li><a href="{!! URL::to('about-us') !!}">About</a></li>
                        <li><a href="{!! URL::to('article') !!}">Blog</a></li>
                        <li><a href="{!! URL::to('collection') !!}">Collection</a></li>
                        <li><a href="{!! URL::to('contact-us') !!}">Contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center copy_sec">
        <p class="mt-2"><small>Copyrights © 2021 All Rights Reserved by XYZ</small></p>
    </div>
</footer>
