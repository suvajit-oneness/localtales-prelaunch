<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Tales</title>

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?ver=5.9.3' />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('front/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('front/css/select2.min.css') }}"> -->
    {{-- Remove style.css for splash page only --}}
    {{-- @if(\Request::route()->getName() != "index")--}}
    <link rel="stylesheet" href="{{ asset('site/css/style.css ') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    {{-- @endif--}}

    <style type="text/css">
        .map-top {
            margin-top: 50px;
        }
    </style>

    @yield('styles')

    @stack('styles')
</head>

<body>
    @include('site.partials.header')

    @yield('content')

    @include('site.partials.footer')

    <script src="{{ asset('front/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-equal-height.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('front/js/select2.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('site/js/slick.min.js') }}"></script>


    <script type="text/javascript">
        // $('.home-directory--slider').on('afterChange', function(event, slick, currentSlide) {
        //   if (slick.$slides.length+1 == currentSlide) {
        //     alert();
        //   }
        // });
        $('.home-directory--slider').on('beforeChange', function(event, slick, currentSlide) {
            console.log('test1' + currentSlide);
            if (currentSlide == 0) {
                $('.directory-bar').addClass('active');
            }
        });

        $('.home-directory--slider').on('afterChange', function(event, slick, currentSlide) {
            console.log('test2' + currentSlide);
            if (currentSlide == 0) {
                $('.directory-bar').removeClass('active');
            }
        });

        // var slideIndex = 1;
        // var translateX = -177.264;
        // var translateY = 0;
        // var translateZ = -511.273;
        // var rotate = -100.003;

        // $(document).on('click', '.slick-arrow.right-arrow', function(){
        //   slideIndex--;
        //   translateX--;
        //   translateY--;
        //   translateZ--;
        //   rotate--;
        //   $('.directory-bar').css("transform","translate3d("+ translateX +"px, 0px, "+ translateZ +"px) rotateY("+ rotate +"deg)");
        //   //$('.directory-bar').css({'transform':'translate3d(-50px, 0px, -511.273px) rotateY(-100.003deg)'});
        // });

        // $(document).on('click', '.slick-arrow.left-arrow', function(){
        //   slideIndex++;
        //   $('.directory-bar').css({'opacity':slideIndex});
        //   //$('.directory-bar').css({'transform':'translate3d(-177.264px, 0px, -511.273px) rotateY(-100.003deg)'});
        // });

        // $(document).on('click', '.slick-arrow.left-arrow.slick-disabled', function(){
        //   return false;
        //   //$('.directory-bar').css({'transform':'translate3d(-177.264px, 0px, -511.273px) rotateY(-100.003deg)'});
        // });


        // $('.home-directory--slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
        //   $(".slick-slide").removeClass('works');
        //   $('.slick-current').addClass('works');
        // });

        //community slider
        $('.community-list').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

        //business slider
        $('.business-list').slick({
            dots: true,
            //infinite: false,
            speed: 300,
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });


        $('.home-banner--slider').slick({
            dots: false,
            arrows: false,
            infinite: false,
            speed: 600,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            cssEase: 'linear',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

        $('.home-about--slider').slick({
            dots: false,
            arrows: false,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

        $('.home-directory--slider').slick({
            dots: false,
            arrows: true,
            infinite: false,
            speed: 600,
            variableWidth: true,
            slidesToScroll: 1,
            cssEase: 'linear',
            prevArrow: $('.left-arrow'),
            nextArrow: $('.right-arrow'),
        });

        $('.event-block:first').addClass('active');
        $('.event-block').hover(function() {
            if ($(this).hasClass('active')) {
                //$(this).removeClass('active');
            } else {
                $('.event-block.active').removeClass('active');
                $(this).addClass('active');
            }
            //$(this).next().slideToggle();
            //$('.site_accordian_details').not($(this).next()).slideUp();
        });

        // counter
        var a = 0;
        $(window).scroll(function() {
            const servicecounter = document.querySelector(".counter-list");
            if (!document.body.contains(servicecounter)) return;
            var oTop = $('.counter-list').offset().top - window.innerHeight;
            if (a == 0 && $(window).scrollTop() > oTop) {
                $('.counter-list li figure').each(function() {
                    var $this = $(this),
                        countTo = $this.attr('data-count');
                    $({
                        countNum: $this.text()
                    }).animate({
                            countNum: countTo
                        },

                        {

                            duration: 1000,
                            easing: 'swing',
                            step: function() {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function() {
                                $this.text(this.countNum);
                                //alert('finished');
                            }

                        });
                });
                a = 1;
            }

        });



        $(document).ready(function() {
            $('.ham').click(function(e) {
                e.stopPropagation();
                $('.navigation').toggleClass('slide');
            });

            $(document).click(function() {
                $('.navigation').removeClass('slide');
            });

            $('.navigation').click(function(e) {
                e.stopPropagation();
            });
            $('.filter_btn').click(function(e) {
                e.stopPropagation();
                $('.filter_wrap').slideToggle();
                $('.page-search-block').toggleClass('filter-open');
            });
            $('.filter_wrap').click(function(e) {
                e.stopPropagation();
            });

            $(document).click(function() {
                $('.filter_wrap').slideUp();
                $('.page-search-block').removeClass('filter-open');
            });

        });

        $('.filter_select').select2({
          width:"100%",
        });


        $('.filter_select').select2().on('select2:select', function (e) {
          var data = e.params.data;
         
      });


        $('.filter_select').select2().on('select2:open', (elm) => {
    const targetLabel = $(elm.target).prev('label');
    targetLabel.addClass('filled active');
}).on('select2:close', (elm) => {
    const target = $(elm.target);
    const targetLabel = target.prev('label');
    const targetOptions = $(elm.target.selectedOptions);
    if (targetOptions.length === 0) {
        targetLabel.removeClass('filled active');
    }
});


        $(document).on('.filter_selectWrap select2:open', () => {
          document.querySelector('.select2-search__field').focus();
        });


        $(".questionSetItemButton").click(function(){
          $(this).parents(".questionSetItem").hide();
          $(this).parents(".questionSetItem").next().show();
        });
        $(".questionSetItemButtonPrev").click(function(){
          $(this).parents(".questionSetItem").hide();
          $(this).parents(".questionSetItem").prev().show();
        });
        $("#questionModal").modal({
        show:false,
        backdrop:'static'
        });

        $(".openAlertModal").click(function(){
          $("#questionModal").addClass("questionModalHide");
        })
        $(".closeAlertThis, .leaveBtn, .stayBtn").click(function(){
          $("#questionModal").removeClass("questionModalHide");
        })
        $(".openreviewBbox").click(function(){

        })
        
        $('.jQueryEqualHeight').jQueryEqualHeight('.businessDirectoryCard h5');
        $('.jQueryEqualHeight').jQueryEqualHeight('.businessDirectoryCard .card-body');
        $('.jQueryEqualHeight').jQueryEqualHeight('.directoryCard h5');
        $('.jQueryEqualHeight').jQueryEqualHeight('.directoryCard .card-body');
        
        $('.jQueryEqualHeight').jQueryEqualHeight('.innerCatlistCard .card-body h5');
        $('.jQueryEqualHeight').jQueryEqualHeight('.innerCatlistCard .card-body');
        $('.jQueryEqualHeight').jQueryEqualHeight('.article_badge_wrap');
        
        var searchPadding = $(".filterSearchBoxWraper").innerHeight();
        $(".searchpadding").css({"padding-top": searchPadding + 10});
        $(".filterSearchBoxWraper").css({"bottom": - searchPadding});
        
        var collectionBreadcumb = $(".collection_breadcumb").innerHeight();
        $(".collectionbreadcumbPadding").css({"padding-top": collectionBreadcumb + 10});
        $(".collection_breadcumb").css({"bottom": - collectionBreadcumb});
        
        
        // $(document).ready(() => {
        // 	// console.log("working");
        // 	var $selectbox = $('.floating-select').select2({
        // 	    placeholder: "",
        //         allowClear: true,
        // 	})
        //     // .on('select2:select', function(){
        //     //       $('label[for="blogcategory"]').addClass('filled active');
        //     // })
        //     // .on('select2:unselect', function(){
        //     //     $('label[for="blogcategory"]').removeClass('filled');
        //     // });
        // });
        
        // $('.blogcategory').select2().on('select2:select', (elm) => {
        //   const targetLabel = $(elm.target).prev('label');
        //   targetLabel.addClass('filled active');
        // });
        
        // $('.blogcategory').select2().on('select2:unselect', (elm) => {
        //   const targetLabel = $(elm.target).prev('label');
        //   targetLabel.removeClass('filled active');
        // });
        
    </script>





<!--</body>-->

</html>
