
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
const title = document.querySelector('.single-product-sidebar .product_title')
const titleText = title.innerText
const titleLength = titleText.length
const k = 270
console.log(titleText.length)
title.style.fontSize = k / titleLength + 'px'
console.log( k / titleLength )