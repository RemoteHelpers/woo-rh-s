const singleProductPage = document.querySelector('.rh-single-product')
const faqPage = document.querySelector('.faq')
const privacyPage = document.querySelector('.privacy')
const pricingPage = document.querySelector('.pricing')
const affiliatePage = document.querySelector('.affiliate-page')
const aboutPage = document.querySelector('.about-us-page')

const backdrop = document.querySelector('.gallery-backdrop')
const img = document.querySelector('.gallery-image')
const thumbnailGallery = document.querySelector('.gallery-thumbnails')

let imgIndex = 0

onload = () => {

    if (singleProductPage) {
        const loader = document.querySelector('.loader')
        console.log('CV page')
        loader.style.display = 'none'
        singleProductPage.classList.remove('preload-fader')
        console.log('showing content on load...')
        // autoFontScale()
        coverIframe()
        startSlick()
        portfolioGallery()
    }

    if (faqPage) {
        console.log('faq page')
        faqAccordion()
    }

    if (privacyPage) {
        console.log('privacy page')
        privacyTabs()
    }

    if (pricingPage) {
        console.log('pricing page')
        pricingSwitch()
    }

    if (affiliatePage) {
        console.log('affiliate page')
        affiliateSlider()
    }

    if (aboutPage) {
        console.log('about us page')
        aboutSlider()
    }
}

onresize = () => {
    if (affiliatePage) {
        affiliateSlider()
    }
}

/* COVER IFRAME */
function coverIframe() {
    const cover = document.querySelector('.iframe-cover')
    const iframe = document.querySelector('.iframe-container > iframe')
    cover.addEventListener('click', () => {
        iframe.src += '?autoplay=1'
        setTimeout(() => {
            cover.classList.add('hide')
        }, 1000)
    })
}

/* RELATED PRODUCTS SLIDER */
function startSlick() {
    jQuery('.single-product ul.products').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1350,
                settings: {
                    slidesToShow: 3
                }
            },
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
    const portfolioItem = document.querySelectorAll('.portfolio-thumbnails figure')

    portfolioItem.forEach((item, index) => {
        item.addEventListener('click', (e) => {

            // gallery opens
            const close = document.querySelector('.gallery-close')
            const arrowBack = document.querySelector('.gallery-prev')
            const arrowNext = document.querySelector('.gallery-next')

            // get image array from acf
            const field = acf.get('designerPortfolio')
            const indexArr = Object.keys(field[index]['design_project_gallery'])
            const thumbnailArr = field[index]['design_project_gallery']


            image = new imageObject()

            image.field = field[index]
            image.indexArr = indexArr
            image.thumbnailArr = thumbnailArr

            openGallery()

            generateThumbnails(thumbnailArr)

            image.thumbImages = Array.from(thumbnailGallery.children)

            selectThumbnail(image.thumbImages[0])

            // set src for image from retrieved acf data
            img.setAttribute('src', field[index]['design_project_gallery'][imgIndex].url)

            // listeners
            document.addEventListener('wheel', preventScroll, {passive: false})
            document.addEventListener('keydown', handleKeypress)
            close.addEventListener('click', closeGallery)
            document.addEventListener('touchstart', handleTouchStart)
            document.addEventListener('touchend', handleTouchEnd)


            arrowBack.addEventListener('click', prevSlide)
            arrowNext.addEventListener('click', nextSlide)

            // put a timed listener on close, so that it doesn't close immediately on open
            setTimeout(() => {
                document.addEventListener('click', closeOnClick)
            }, 100)
        })
    })
}

function handleTouchStart(e) {
    image.touchStartX = e.changedTouches[0].screenX
    image.touchStartY = e.changedTouches[0].screenY
}

function handleTouchEnd(e) {
    image.touchEndX = e.changedTouches[0].screenX
    image.touchEndY = e.changedTouches[0].screenY
    const diffX = image.touchEndX - image.touchStartX
    const diffY = image.touchEndY - image.touchStartY
    const modalDiffX = Math.abs(diffX)
    const modalDiffY = Math.abs(diffY)
    if (modalDiffX < modalDiffY) {
        closeGallery()
        return
    }
    if (diffX > 0) {
        prevSlide()
    } else if (diffX < 0) {
        nextSlide()
    }
}

class imageObject {
    constructor() {
        this.imgIdx = 0
    }
}

function nextSlide() {
    if (image.field['design_project_gallery'][image.imgIdx + 1]) {
        image.imgIdx += 1
    } else {
        image.imgIdx = 0
    }
    fadeToImg(image.field['design_project_gallery'][image.imgIdx].url)
    selectThumbnail(image.thumbImages[image.imgIdx])
}

function prevSlide() {
    if (image.field['design_project_gallery'][image.imgIdx - 1]) {
        image.imgIdx -= 1
    } else {
        image.imgIdx = image.indexArr.length - 1
    }
    fadeToImg(image.field['design_project_gallery'][image.imgIdx].url)
    selectThumbnail(image.thumbImages[image.imgIdx])
}

function generateThumbnails(thumbnails) {

    thumbnails.forEach((item, index) => {

        // for each item in "thumbnails" generate an imb element, set it's src to item[url],
        // add to thumbnailGallery and set an event listener
        const thumb = document.createElement('img')
        thumb.setAttribute('src', thumbnails[index].url)
        thumbnailGallery.append(thumb)

        // listener
        thumb.addEventListener('click', (e) => {
            if (index === image.imgIdx) return
            fadeToImg(e.target.src)
            image.imgIdx = index
            selectThumbnail(e.target)

        })
    })
}

function selectThumbnail(nextThumbnail) {

    // remove class "selected" from all thumbnails
    // const imgArray = Array.from(thumbnailGallery.children)
    image.thumbImages.forEach(item => {
        item.classList.remove('selected')
    })

    // add class "selected" to selected thumbnail
    nextThumbnail.classList.add('selected')
}

function fadeToImg(src) {

    img.classList.add('fade')
    setTimeout(() => {
        img.setAttribute('src', src)
        img.onload = () => {
            img.classList.remove('fade')
        }
    }, 200)
}

function openGallery() {
    const scrollY = window.scrollY
    document.body.classList.add('modal-gallery-open')
    backdrop.style.top = scrollY + 'px'
    backdrop.style.display = 'grid'
}

function closeGallery() {
    img.classList.add('fade')
    setTimeout(() => {
        backdrop.style.display = 'none'
        document.body.classList.remove('modal-gallery-open')
        document.removeEventListener('wheel', preventScroll, {passive: false})
        document.removeEventListener('keydown', handleKeypress, {passive: false})
        document.removeEventListener('touchstart', handleTouchStart)
        document.removeEventListener('touchend', handleTouchEnd)
        // arrowBack.removeEventListener('click', prevSlide)
        // arrowNext.removeEventListener('click', nextSlide)
        thumbnailGallery.innerHTML = ''
    }, 150)

}

function preventScroll(e) {
    e.preventDefault();
    e.stopPropagation();
    return false;
}

function handleKeypress(e) {

    if (e.keyCode === 37) {
        prevSlide()
    }

    if (e.keyCode === 39) {
        nextSlide()
    }

    let keys = [32, 33, 34, 35, 37, 38, 39, 40];
    if (keys.includes(e.keyCode)) {
        e.preventDefault();
        return false;
    }

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

/* END PORTFOLIO GALLERY */

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

/* PRIVACY */
function privacyTabs() {
    const tabs = document.querySelectorAll('.privacy-tab')
    const contents = document.querySelectorAll('.content')

    tabs.forEach(item => {

        item.addEventListener('click', e => {
            const content = Array.from(contents)

            tabs.forEach(item => {
                item.classList.remove('active')
            })
            e.target.classList.add('active')

            content.forEach(item => {
                item.classList.remove('shown')
            })

            const found = content.find(item => {
                return item.dataset.content === e.target.dataset.tab
            })
            found.classList.add('shown')
        })
    })
}

/* PRICING */
function pricingSwitch() {
    const priceSwitch = document.querySelector('.switch')
    const switchDesc = document.querySelectorAll('.switch-desc')
    const spans = document.querySelectorAll('.pricing-switch>span')

    priceSwitch.addEventListener('click', () => {
        switchDesc.forEach(item => {
            item.classList.toggle('active')
        })
        spans.forEach(item => {
            item.classList.toggle('active')
        })
    })
}

/* AFFILIATE PAGE SLIDER */
function affiliateSlider() {
    jQuery('.affiliate-cards').slick({
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        mobileFirst: true,
        responsive: [
            {
                breakpoint: 767,
                settings: "unslick"
            }
        ]
    });
}

/* ABOUT US SLIDER */
function aboutSlider() {
    jQuery('.gallery-viewport').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.about-gallery'
    });
    jQuery('.about-gallery').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.gallery-viewport',
        dots: true,
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3
                }
            }
        ]
    });
    jQuery('.gallery-gallery-mobile').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        mobileFirst: true,
        adaptiveHeight: true
    });
}