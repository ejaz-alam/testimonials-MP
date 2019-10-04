require(["jquery","owlcarousel"],function($) {

    var sliderOptions = {
        items:1,
        nav:false,
        loop:false,
        autoWidth: false,
        autoplayHoverPause: true,
        autoplay:false,
        autoplayTimeout:3000 
    };
    $(document).ready(function(){  
        if ($("#testimonial-slider > .testimonial-10").length > 1) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
        }
        else if ($("#testimonial-slider > .testimonial").length > 1) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
        }
        else if ($("#testimonial-slider > .testimonial-5").length > 1) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
        }
         else if ($("#testimonial-slider > .testimonial-11").length > 1) {
            sliderOptions.loop = true;
        sliderOptions.autoplay = true;
        sliderOptions.autoWidth = false;
        sliderOptions.autoHeight = true;
        }
        $("#testimonial-slider").owlCarousel(sliderOptions);
    });
});

