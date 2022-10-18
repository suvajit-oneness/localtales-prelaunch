<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Local Tales</title>
        <link rel="icon" type="image/x-icon"  href="{{ asset('favicon.png') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?ver=5.9.3' />
        <link rel="stylesheet" type="text/css" href="{{ asset('front/css/swiper-bundle.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('front/css/main.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('front/css/responsive.css')}}">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4&libraries=places"></script>
    </head>

    <body>

        <section class="inner_banner articles_inbanner">
            <div class="container">
                <div class="row m-0 justify-content-center">
                    <div class="col-12">
                        <h1> Advocate Registration</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="form_b_sec">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                    </div>
                </div>
                <div class="row justify-content-center py-4 py-lg-5">
                    <div class="col-lg-8">
                        <form action="{{ route('advocate.registration.store') }}" method="POST"   enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="longitude" id="selectedLongitude" value="">
                                <input type="hidden" name="latitude" id="selectedLatitude" value="">

                                <div class="div1" id="">
                                    <h6> Information:</h6>
                                    <div class="did-floating-label-content">
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"  class="did-floating-input" autofocus required>
                                    @error('name')
                                    <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                        <label class="did-floating-label">Name</label>
                                    </div>
                                    <div class="did-floating-label-content">
                                    <input class="did-floating-input @error('email') is-invalid @enderror" type="text"  name="email" id="email" value="{{ old('email') }}" >
                                                    @error('email')
                                                    <p class="small text-danger">{{ $message }}</p>
                            				@enderror
                                        <label class="did-floating-label"> Email</label>
                                    </div>
                                    <div class="did-floating-label-content">
                                    <input class="did-floating-input @error('postcode') is-invalid @enderror" type="text" name="postcode" id="postcode"  value="{{ old('postcode') }}" >
                                                    @error('postcode')
                                                    <p class="small text-danger">{{ $message }}</p>
                           		             @enderror
                                        <label class="did-floating-label"> Postcode</label>
                                    </div>
                                    <div class="did-floating-label-content">
                                        <input class="did-floating-input @error('suburb') is-invalid @enderror" type="text" name="suburb" id="suburb"  value="{{ old('suburb') }}" >
                                                        @error('suburb')
                                                        <p class="small text-danger">{{ $message }}</p>
                                                    @enderror
                                            <label class="did-floating-label"> Suburb</label>
                                        </div>
                                        <div class="did-floating-label-content">
                                            <input class="did-floating-input @error('platform') is-invalid @enderror" type="text" name="platform" id="platform"  value="{{ old('platform') }}" >
                                                            @error('platform')
                                                            <p class="small text-danger">{{ $message }}</p>
                                                        @enderror
                                                <label class="did-floating-label"> Platforms Used
                                                </label>
                                            </div>
                                    <div class="d-flex justify-content-end mt-4 mb-4">
                                        <!-- <button id="pvst3" class="btn priview-btn mr-2">Preview</button> -->
                                        <button  type="submit" class="btn main-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </section>



        <script type="text/javascript" src="{{ asset('front/js/jquery-3.6.0.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('front/js/popper.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('front/js/swiper-bundle.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('front/js/custom.js')}}"></script>
        <script>

        </script>
        <script>
            $(document).ready(function(){
                $('#opening_hour').mdtimepicker(); //Initializes the time picker
                $('#closing_hour').mdtimepicker(); //Initializes the time picker
            });
            </script>

            <script>
            function display() {
               document.getElementById("council_name").style.wordSpacing = "25px";
            }

            <script>
                // AutoComplete Start

                google.maps.event.addDomListener(window,'load',initialize);

                function initialize(){

                    var autocomplete= new google.maps.places.Autocomplete(document.getElementById('inputSearchTextFilter'));

                    autocomplete.setComponentRestrictions({'country': ['au']});

                    google.maps.event.addListener(autocomplete, 'place_changed', function(){

                        var places = autocomplete.getPlace();
                        console.log(places);
                        // console.log(places.formatted_address);
                        // console.log(places.address_components.length);
                        addressObj = places.address_components;
                        // console.log(addressObj);
                        addressObjLength = places.address_components.length;
                        // console.log(addressObj.addressObjlength);
                        for (let index = 0; index < addressObjLength; index++) {
                            if(index = addressObjLength-1) {
                                const pinCode = addressObj[index].long_name;
                                // console.log(pinCode);
                                $("#pin").val(pinCode)
                            }
                        }
                        // console.log(places.website);
                        $('#inputSearchTextFilter').val(places.name);
                        $('#website').val(places.website);
                        $('#email').val(places.email);
                        $('#address').val(places.formatted_address);

                        if(places.formatted_phone_number){
                            function phpneNumberFormatted(phNum){
                                var i,newValue='';
                                for(i = 0; i < phNum.length; i++){
                                    if($.isNumeric(phNum[i])){
                                        newValue+=phNum[i];
                                    }
                                }
                                return newValue;
                            }
                            var phNum = phpneNumberFormatted(places.formatted_phone_number);
                            // console.log(phNum);

                            $('#mobile').val(phNum);
                        } else {
                            $('#mobile').val('');
                        }

                        $('#selectedLongitude').val(places.geometry.location.lng());

                        $('#selectedLatitude').val(places.geometry.location.lat());

                    });

                }

            </script>

            <script>
                $('.textbox').on('keyup keydown keypress change paste', function() {
                    if ($(this).val() == '') {
                        $(this).parent().removeClass('label_up');
                    } else {
                        $(this).parent().removeClass('label_up');
                    }
                });

                var input = document.getElementById('image');
                var infoArea = document.getElementById('file-upload-filename');

                input.addEventListener('change', showFileName);

                function showFileName(event) {

                    // the change event gives us the input it occurred in
                    var input = event.srcElement;

                    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
                    var fileName = input.files[0].name;

                    // use fileName however fits your app best, i.e. add it into a div
                    infoArea.textContent = 'File name: ' + fileName;
                }

                $(document).ready(function() {
                    // $("#course_butt").click(function() {
                    //             var business_search = $("#business_search").val();
                    //             if (business_search != '') {
                    //                 window.location = "/business_search/" + business_search;
                    //             }
                    //         });
                });
            </script>
            <script>
                function autocomplete(inp, arr) {
                    /*the autocomplete function takes two arguments,
                     the text field element and an array of possible autocompleted values:*/
                    var currentFocus;
                    /*execute a function when someone writes in the text field:*/
                    inp.addEventListener("input", function(e) {
                        var a, b, i, val = this.value;
                        //alert(val.length);
                        /*close any already open lists of autocompleted values*/
                        closeAllLists();
                        if (!val) {
                            return false;
                        }
                        if (val.length < 2) {
                            return false;
                        }
                        currentFocus = -1;
                        /*create a DIV element that will contain the items (values):*/
                        a = document.createElement("DIV");
                        a.setAttribute("id", this.id + "autocomplete-list");
                        a.setAttribute("class", "autocomplete-items");
                        // a.setAttribute("class", "");
                        /*append the DIV element as a child of the autocomplete container:*/
                        this.parentNode.appendChild(a);
                        /*for each item in the array...*/
                        for (i = 0; i < arr.length; i++) {
                            /*check if the item starts with the same letters as the text field value:*/
                            var arr_val = arr[i].toUpperCase();
                            var vall = val.toUpperCase();
                            var res = arr_val.match(vall);

                            if (res != null) {
                                var searched_item = arr[i];
                                var strong_val = "<span style='font-weight:bolder;color: #2579d3;' >" + val + "</span>"
                                var after_search = searched_item.replace(val, strong_val);

                                /*create a DIV element for each matching element:*/
                                b = document.createElement("DIV");

                                /*make the matching letters bold:*/
                                // b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                                b.innerHTML = after_search;
                                /*insert a input field that will hold the current array item's value:*/
                                b.innerHTML += "<input type='hidden' value='" + arr[i] + "' >";
                                /*execute a function when someone clicks on the item value (DIV element):*/
                                b.addEventListener("click", function(e) {

                                    /*insert the value for the autocomplete text field:*/
                                    inp.value = this.getElementsByTagName("input")[0].value;
                                    /*close the list of autocompleted values,
                                     (or any other open lists of autocompleted values:*/
                                    closeAllLists();
                                    // window.location = "/business_search/" + inp.value;
                                });
                                a.appendChild(b);
                            }
                        }
                    });
                    /*execute a function presses a key on the keyboard:*/
                    inp.addEventListener("keydown", function(e) {
                        var x = document.getElementById(this.id + "autocomplete-list");
                        if (x)
                            x = x.getElementsByTagName("div");
                        if (e.keyCode == 40) {
                            /*If the arrow DOWN key is pressed,
                             increase the currentFocus variable:*/
                            currentFocus++;
                            /*and and make the current item more visible:*/
                            addActive(x);
                        } else if (e.keyCode == 38) { //up
                            /*If the arrow UP key is pressed,
                             decrease the currentFocus variable:*/
                            currentFocus--;
                            /*and and make the current item more visible:*/
                            addActive(x);
                        } else if (e.keyCode == 13) {
                            /*If the ENTER key is pressed, prevent the form from being submitted,*/
                            e.preventDefault();
                            if (currentFocus > -1) {
                                /*and simulate a click on the "active" item:*/
                                if (x)
                                    x[currentFocus].click();
                            }
                        }
                    });

                    function addActive(x) {
                        /*a function to classify an item as "active":*/
                        if (!x)
                            return false;
                        /*start by removing the "active" class on all items:*/
                        removeActive(x);
                        if (currentFocus >=document.getElementById('googlemapaddress') x.length)
                            currentFocus = 0;
                        if (currentFocus < 0)
                            currentFocus = (x.length - 1);
                        /*add class "autocomplete-active":*/
                        x[currentFocus].classList.add("autocomplete-active");
                    }

                    function removeActive(x) {
                        /*a function to remove the "active" class from all autocomplete items:*/
                        for (var i = 0; i < x.length; i++) {
                            x[i].classList.remove("autocomplete-active");
                        }
                    }

                    function closeAllLists(elmnt) {
                        /*close all autocomplete lists in the document,
                         except the one passed as an argument:*/
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                            if (elmnt != x[i] && elmnt != inp) {
                                x[i].parentNode.removeChild(x[i]);
                            }
                        }
                    }
                    /*execute a function when someone clicks in the document:*/
                    document.addEventListener("click", function(e) {
                        closeAllLists(e.target);

                    });
                }
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "/business-signup/create",
                    type: "post",
                    data: {
                        '_token': token
                    },
                    success: function(response) {
                        autocomplete(document.getElementById("business_search"), response);

                    }
                });
            </script>
            <script>
                function isNumberKey(evt){
                    if(evt.charCode >= 48 && evt.charCode <= 57){
                        return true;
                    }
                    return false;
                }
            </script>
            <script>
                (function ($, window, Typist) {

    // Dropdown Menu Fade
    jQuery(document).ready(function () {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).fadeIn("fast");
            },
            function () {
                $('.dropdown-menu', this).fadeOut("fast");
            });
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
        var sticky = $('.header'),
            scroll = $(window).scrollTop();

        if (scroll >= 20) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
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
                spaceBetween: 30,
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

    $('.toggle').click(function (e) {
        e.preventDefault();

        var $this = $(this);

        if ($this.next().hasClass('show')) {
            $this.next().removeClass('show');
            $this.next().slideUp(350);
        } else {
            $this.parent().parent().find('li .inner').removeClass('show');
            $this.parent().parent().find('li .inner').slideUp(350);
            $this.next().toggleClass('show');
            $this.next().slideToggle(350);
        }
    });

    $('.toggle').click(function(e){
        var $child = $(this).find('.plus-sign');
        if($child.hasClass('fa-plus')){
            $child.removeClass('fa-plus');
            $child.addClass('fa-minus')
        }else if($child.hasClass('fa-minus')){
            $child.removeClass('fa-minus');
            $child.addClass('fa-plus');
        }
    })

    // email validation function
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }

    $("#step2").click(function(){
        // validation
        if($('#name').val() == "") {
            $('#businessNameErr').text('Please enter Name');
        } else if ($('#email').val() == "") {
            $('#businessEmailErr').text('Please enter  Email');
        } else if (!validateEmail($('#email').val())) {
            $('#businessEmailErr').text('Please enter a valid email address');
        } else if($('#postcode').val() == "") {
            $('#PostcodeErr').text('Please enter Business Phone');
        } else if($('#suburb').val() == "") {
            $('#SuburbErr').text('Please enter Business Phone');
        } else if($('#platform').val() == "") {
            $('#platformErr').text('Please enter Business Address');
        } else {
            $("#st2").show();
            $('html, body').animate({
            scrollTop: $("#st2").offset().top - 50
            }, 1000);
            $(this).attr('disabled', true);
            $(".registerWizard li").removeClass("active");
            $(".registerWizard li:nth-child(2)").addClass("active");
        }
    })

    })(jQuery, window);
    </script>
    </body>

    </html>
