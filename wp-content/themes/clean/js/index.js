
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


function autoFontScale() // auto scale title font based on letter quantity
{
    const max = 32
    const min = 18
    const k = 270
    const title = document.querySelector('.single-product-sidebar .product_title')

    const titleText = title.innerText
    const titleLength = titleText.length
    const newSize = k / titleLength

    if (newSize > max) {
        title.style.fontSize = max  + 'px'
    } else if (newSize < min) {
        title.style.fontSize = min  + 'px'
    } else {
        title.style.fontSize = newSize  + 'px'
    }
}

autoFontScale();

