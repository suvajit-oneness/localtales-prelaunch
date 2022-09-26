<footer class="footerinner">
    <div class="container">
        <div class="row m-0 justify-content-between">
            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="f-menu">
                    <img src="{{ asset('front/img/footer-logo.png')}}" alt="Local Tales" width="180px" class="mb-3">
                    <p>At LocalTales, we’re on a mission to empower community members. 
                    We want locals to be better-informed about their neighbourhood.
                    We want to create a one-stop shop for locals to go and find everything they need to know about their local area. </p>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-lg-3">
                <div class="f-menu">
                    <h6>Menu</h6>
                    <ul class="f-menu p-0">
                        <li><a href="{!! URL::to('/') !!}">Home</a></li>
                        <li><a href="{!! URL::to('directory') !!}">Directory</a></li>
                        <li><a href="{!! URL::to('article') !!}">Blog</a></li>
                        <li><a href="{!! URL::to('collection') !!}">Collection</a></li>
                        <li><a href="{!! URL::to('contact-us') !!}">Contact us</a></li>
                        <li><a href="{!! URL::to('help') !!}">Help</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-lg-3">
                <div class="f-menu">
                    <h6>Other</h6>
                    <ul class="f-menu p-0">
                        <li><a href="{!! URL::to('terms') !!}">Terms</a></li>
                        <li><a href="{!! URL::to('privacy') !!}">Privacy</a></li>
                        <li><a href="{!! URL::to('about-us') !!}">About</a></li>
                        <li><a href="{!! URL::to('faq') !!}">Faq</a></li>
                        <li><a href="{!! URL::to('contact-us') !!}">Contact us</a></li>
                          <li><a href="{{ route('user.raise.query') }}">Submit a query!</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center copy_sec">
        <p class="mt-2"><small>Copyrights © 2022 All Rights Reserved by LocalTales</small></p>
    </div>
</footer>
