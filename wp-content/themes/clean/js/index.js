onload = () => {
    const singleProductPage = document.querySelector('.single-product')

    if (singleProductPage) {
        console.log('CV page')
        autoFontScale()
        startSlick()
        portfolioGallery()
    }
}

/* RELATED PRODUCTS SLIDER */
function startSlick() {
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
}

/* AUTO SCALE CARD TITLE FONT */
function autoFontScale() {
    const max = 32
    const min = 18
    const k = 270
    const title = document.querySelector('.single-product-sidebar .product_title')

    const titleText = title.innerText
    const titleLength = titleText.length
    const newSize = k / titleLength

    if (newSize > max) {
        title.style.fontSize = max + 'px'
    } else if (newSize < min) {
        title.style.fontSize = min + 'px'
    } else {
        title.style.fontSize = newSize + 'px'
    }
}

/* PORTFOLIO GALLERY */
function portfolioGallery() {
    const portfolioItem = document.querySelectorAll('.designer-portfolio-item')

    portfolioItem.forEach((item , index) => {
        item.addEventListener('click', (e) => {
            const backdrop = document.querySelector('.gallery-backdrop') // backdrop
            const close = document.querySelector('.gallery-close')
            const scrollY = window.scrollY
            const arrowBack = document.querySelector('.gallery-back')
            const arrowNext = document.querySelector('.gallery-next')
            let imgIndex = 0

            document.body.style.position = 'relative'
            backdrop.style.top = scrollY + 'px'
            backdrop.style.display = 'block'

            const field = acf.get('designerPortfolio') // image
            const indexArr = Object.keys(field[index]['design_project_gallery'])
            let img = document.querySelector('.gallery-image')
            img.setAttribute('src', field[index]['design_project_gallery'][imgIndex].url)
            document.addEventListener('wheel', preventScroll,  {passive: false}) // listeners
            document.addEventListener('keydown', preventKeyScroll,  {passive: false})
            close.addEventListener('click', () => {
                backdrop.style.display = 'none'
                document.removeEventListener('wheel', preventScroll,  {passive: false})
                document.removeEventListener('keydown', preventKeyScroll,  {passive: false})
            })
            arrowBack.addEventListener('click', () => {
                if ((imgIndex - 1) >= indexArr[0]) {
                    imgIndex -= 1
                } else {
                    imgIndex = indexArr.length - 1
                }
                console.log(imgIndex)
                img.setAttribute('src', field[index]['design_project_gallery'][imgIndex].url)
            })
            arrowNext.addEventListener('click', () => {
                if ((imgIndex + 1) <= indexArr[indexArr.length - 1]) {
                    imgIndex += 1
                } else {
                    imgIndex = 0
                }
                console.log(imgIndex)
                img.setAttribute('src', field[index]['design_project_gallery'][imgIndex].url)
            })
        })
    })
}

function preventScroll(e) {
    e.preventDefault();
    e.stopPropagation();
    return false;
}

function preventKeyScroll(e) {
    let keys = [32, 33, 34, 35, 37, 38, 39, 40];
    if (keys.includes(e.keyCode)) {
        e.preventDefault();
        return false;
    }
}




