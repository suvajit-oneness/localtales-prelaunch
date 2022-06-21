(function ($, window, Typist) {
    
	//community slider
$('.community-list').slick({
	dots: true,
	infinite: false,
	speed: 300,
	slidesToShow: 3,
	slidesToScroll: 1,
	responsive: [
	  {
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
	responsive: [
	  {
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
  
  /*--------event-list-slid---------*/

  $('.event-list').slick({
	dots: true,
	//infinite: false,
	speed: 300,
	centerMode: true,
	centerPadding: '60px',
	slidesToShow: 3,
	slidesToScroll: 1,
	responsive: [
	  {
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
  
  // counter
  var a = 0;
  $(window).scroll(function() {
  
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
  
  
  
  $(document).ready(function(){
	  $('.ham').click(function(e){
		  e.stopPropagation();
		  $('.navigation').toggleClass('slide');
	  });
  
	  $(document).click(function(){
		  $('.navigation').removeClass('slide');
	  });
  
	  $('.navigation').click(function(e){
		  e.stopPropagation();
	  });
  
  });

/*----------dashboard_header-----------*/

(function(){
	$('#msbo').on('click', function(){
	  $('body').toggleClass('msb-x');
	});
}());

/*-------------------login-----------------*/


	
})(jQuery, window);