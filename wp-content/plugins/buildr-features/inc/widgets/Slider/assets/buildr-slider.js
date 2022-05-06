jQuery(document).ready(function ($) {

    $.each( slider_widget_instances, function( index, value ) {

        $('.buildr-module .slider.instance-' + value.slider_id ).slick({
            dots: value.slider_dots,
            arrows: value.slider_arrows,
            pauseOnHover: value.slider_pause_hover,
            pauseOnFocus: false,
            infinite: true,
            speed: value.slider_trans_speed,
            fade: value.slider_fade,
            autoplay: value.slider_autoplay,
            autoplaySpeed: value.slider_autoplay_speed,
            cssEase: 'linear',
            prevArrow: '<span class="slick-prev slick-arrow"><svg version="1.1" id="prevArrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 407.437 407.437" style="enable-background:new 0 0 407.437 407.437;" xml:space="preserve"><g><polygon points="203.718,84.507 386.258,266.453 407.437,245.205 203.718,42.15 0,245.205 21.179,266.453 	"/><polygon points="0,344.039 21.179,365.287 203.718,183.341 386.258,365.287 407.437,344.039 203.718,140.984 "/></g></svg></span>',
            nextArrow: '<span class="slick-next slick-arrow"><svg version="1.1" id="nextArrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 407.437 407.437" style="enable-background:new 0 0 407.437 407.437;" xml:space="preserve"><g><polygon points="203.718,84.507 386.258,266.453 407.437,245.205 203.718,42.15 0,245.205 21.179,266.453 	"/><polygon points="0,344.039 21.179,365.287 203.718,183.341 386.258,365.287 407.437,344.039 203.718,140.984 "/></g></svg></span>'
        });
        
    });
        
});
