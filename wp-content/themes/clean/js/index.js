const singleProductPage = document.querySelector('.single-product')
const faqPage = document.querySelector('.faq')
const backdrop = document.querySelector('.gallery-backdrop')
const img = document.querySelector('.gallery-image')
const thumbnailGallery = document.querySelector('.gallery-thumbnails')

onload = () => {

    if (singleProductPage) {
        console.log('CV page')
        autoFontScale()
        startSlick()
        portfolioGallery()
    }

    if (faqPage) {
        console.log('faq page')
        faqAccordion()
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
    portfolioItem.forEach((item, index) => {
        item.addEventListener('click', (e) => {

            // gallery opens
            const close = document.querySelector('.gallery-close')
            const arrowBack = document.querySelector('.gallery-prev')
            const arrowNext = document.querySelector('.gallery-next')

            let imgIndex = 0

            openGallery()

            const field = acf.get('designerPortfolio') // get image array from acf
            const indexArr = Object.keys(field[index]['design_project_gallery'])
            const thumbnailArr = field[index]['design_project_gallery']

            generateThumbnails(thumbnailArr)

            img.setAttribute('src', field[index]['design_project_gallery'][imgIndex].url) // set src for image

            // listeners
            document.addEventListener('wheel', preventScroll, {passive: false})
            document.addEventListener('keydown', preventKeyScroll)
            document.addEventListener('keydown', closeOnEsc)
            close.addEventListener('click', closeGallery)
            arrowBack.addEventListener('click', () => {
                if ((imgIndex - 1) >= indexArr[0]) {
                    imgIndex -= 1
                } else {
                    imgIndex = indexArr.length - 1
                }
                img.setAttribute('src', field[index]['design_project_gallery'][imgIndex].url)
            })
            arrowNext.addEventListener('click', () => {
                if ((imgIndex + 1) <= indexArr[indexArr.length - 1]) {
                    imgIndex += 1
                } else {
                    imgIndex = 0
                }
                img.setAttribute('src', field[index]['design_project_gallery'][imgIndex].url)
            })

            // put a timed listener on close, so that it doesn't close immediately on open
            setTimeout(() => {
                document.addEventListener('click', closeOnClick)
            }, 200)
        })
    })
}

function generateThumbnails(thumbnails) {

    thumbnails.forEach((item, index) => {
        const thumb = document.createElement('img')
        thumb.setAttribute('src', thumbnails[index].url)
        thumbnailGallery.append(thumb)
        thumb.addEventListener('click', (e) => {
            img.setAttribute('src', e.target.src)
        })
    })
}

function openGallery() {
    const scrollY = window.scrollY
    document.body.style.position = 'relative'
    document.body.style.overflowY = 'hidden'
    backdrop.style.top = scrollY + 'px'
    backdrop.style.display = 'grid'
}

function closeGallery() {
    backdrop.style.display = 'none'
    document.body.style.overflowY = 'visible'
    document.removeEventListener('wheel', preventScroll, {passive: false})
    document.removeEventListener('keydown', preventKeyScroll, {passive: false})
    thumbnailGallery.innerHTML = ''
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

function closeOnEsc(e) {
    if (e.keyCode === 27) {
        closeGallery()
        return false;
    }
}

function closeOnClick(e) {
    if (e.target.classList.contains('gallery-backdrop')) {
        // console.log(e.target)
        closeGallery()
        document.removeEventListener('click', closeOnClick)
    }
}

/* FAQ */
function faqAccordion() {
    const accordionHeaders = document.querySelectorAll('.accordion-header')
    const accordionBodies = document.querySelectorAll('.accordion-body')

    accordionHeaders.forEach(item => {
        item.addEventListener('click', (e) => {

            //close all items
            const accordionBody = e.target.nextElementSibling
            const accordionOpen = getComputedStyle(accordionBody, null).getPropertyValue('display')
            if (accordionOpen === 'none') {
                accordionHeaders.forEach(item => {
                    item.firstElementChild.classList.remove('rotate')
                })
                accordionBodies.forEach(item => {
                    jQuery(item).slideUp('fast')
                })
            }

            // toggle current item
            const body = e.target.nextElementSibling
            const arrow = e.target.firstElementChild
            arrow.classList.toggle('rotate')
            jQuery(body).slideToggle('fast')
        })
    })
}