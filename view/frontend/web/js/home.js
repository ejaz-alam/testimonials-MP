require(["jquery","owlcarousel"],function($) {

    var sliderOptions = {
        items:3,
        nav:false,
        loop:false,
        autoWidth: false,
        autoplayHoverPause: true,
        autoplay:false,
        responsive : {
    // breakpoint from 0 up
    0 : {
        items:1
    },
    // breakpoint from 480 up
    480 : {
        items:1
    },
    // breakpoint from 768 up
    768 : {
       items:3
    }
},
        autoplayTimeout:3000
    };
    $(document).ready(function(){
        if ($("#testimonial-slider > .testimonial").length > 3) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
	       sliderOptions.nav = true;
        }
        else if ($("#testimonial-slider > .testimonial-10").length > 3) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
	       sliderOptions.nav = true;
        }
        else if ($("#testimonial-slider > .testimonial-11").length > 3) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
	       sliderOptions.nav = true;
        }
         else if ($("#testimonial-slider > .testimonial-12").length > 3) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
	       sliderOptions.nav = true;
        }
        $("#testimonial-slider").owlCarousel(sliderOptions);
    });
});

 
