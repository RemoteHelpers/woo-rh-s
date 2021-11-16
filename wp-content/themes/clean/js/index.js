
/* RELATED PRODUCTS SLIDER */
jQuery(document).ready(function(){
    jQuery('.single-product ul.products').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1050,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
});
});

/* AUTOMATIC CV-TITLE FONT SCALER */
(function( $ ){

    $.fn.fitText = function( kompressor, options ) {

        // Setup options
        var compressor = kompressor || 1,
            settings = $.extend({
                'minFontSize' : Number.NEGATIVE_INFINITY,
                'maxFontSize' : Number.POSITIVE_INFINITY
            }, options);

        return this.each(function(){

            // Store the object
            var $this = $(this);

            // Resizer() resizes items based on the object width divided by the compressor * 10
            var resizer = function () {
                $this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
            };

            // Call once to set.
            resizer();

            // Call on resize. Opera debounces their resize by default.
            $(window).on('resize.fittext orientationchange.fittext', resizer);

        });

    };

})( jQuery );

jQuery('.single-product-sidebar .product_title').fitText(.5);