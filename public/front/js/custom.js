(function ($, window, Typist) {
    // Dropdown Menu Fade
    jQuery(document).ready(function () {
        $(".dropdown").hover(
            function () {
                $(".dropdown-menu", this).fadeIn("fast");
            },
            function () {
                $(".dropdown-menu", this).fadeOut("fast");
            }
        );
    });

    /*-------active---------*/

    $(document).ready(function () {
        $(".nav-link").click(function () {
            $(".nav-link").removeClass("active");
            $(this).addClass("active");
        });
    });

    /*-------------headder_fixed-------------*/

    $(window).scroll(function () {
        var sticky = $(".header"),
            scroll = $(window).scrollTop();

        if (scroll >= 20) sticky.addClass("fixed");
        else sticky.removeClass("fixed");
    });

    /*------------slider-------------*/

    var swiper = new Swiper(".smplace", {
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 0,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 0,
            },
        },
    });

    var swiper = new Swiper(".Bestdeals", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            1366: {
                slidesPerView: 4,
                spaceBetween: 15,
            },
        },
    });
    
    var swiper = new Swiper(".top_dect", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });

    $(".toggle").click(function (e) {
        e.preventDefault();

        var $this = $(this);

        if ($this.next().hasClass("show")) {
            $this.next().removeClass("show");
            $this.next().slideUp(350);
        } else {
            $this.parent().parent().find("li .inner").removeClass("show");
            $this.parent().parent().find("li .inner").slideUp(350);
            $this.next().toggleClass("show");
            $this.next().slideToggle(350);
        }
    });

    $(".toggle").click(function (e) {
        var $child = $(this).find(".plus-sign");
        if ($child.hasClass("fa-plus")) {
            $child.removeClass("fa-plus");
            $child.addClass("fa-minus");
        } else if ($child.hasClass("fa-minus")) {
            $child.removeClass("fa-minus");
            $child.addClass("fa-plus");
        }
    });

    // sign up form placeholder
    $(".form-field .form-control")
        .on("focus", function () {
            $(this).data("placeholder", $(this).attr("placeholder")); // Store for blur
            $(this).attr("placeholder", $(this).attr("title"));
        })
        .on("blur", function () {
            $(this).attr("placeholder", $(this).data("placeholder"));
        });

    $("#add-social").on("click", function () {
        $("#social-container").append(`<div class="form-field">
		<div class="form-icon">
			<img src="img/tick.png" alt="">
		</div>
		<div class="form-group">
			<i class="fas fa-hashtag"></i>
			<input type="text" placeholder="Others">
		</div>
	</div>`);
    });

    // Show the first tab and hide the rest
    $("#tabs-nav li:first-child").addClass("active");
    $(".tab-content").hide();
    $(".tab-content:first").show();

    // Click function
    $("#tabs-nav li").click(function () {
        $("#tabs-nav li").removeClass("active");
        $(this).addClass("active");
        $(".tab-content").hide();

        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn();
        return false;
    });


    $(".details_tabs li").click(function () {
        $(".details_tabs li").removeClass("active");
        $(this).addClass("active");



        var targetTab = $(this).find("a").attr("href");
        var targetBox = $(targetTab);
        $(".tab-pane").not(targetBox).removeClass('active show');
        $(targetBox).addClass('active show');
        return false;
    });
  


})(jQuery, window);
