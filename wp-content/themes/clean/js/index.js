const isAdmin = document.querySelector('#wpadminbar')

const homePage = document.querySelector('.home-page')
const singleProductPage = document.querySelector('.rh-single-product')
const faqPage = document.querySelector('.faq')
const privacyPage = document.querySelector('.privacy')
const pricingPage = document.querySelector('.pricing')
const affiliatePage = document.querySelector('.affiliate-page')
const aboutPage = document.querySelector('.about-us-page')

const backdrop = document.querySelector('.gallery-backdrop')
const body = document.body
const img = document.querySelector('.gallery-image')
const thumbnailGallery = document.querySelector('.gallery-thumbnails')

const breadcrumbs = document.querySelector('.breadcrumb-container');
const skillset = document.querySelector('.product-skillset');

const sidebarContent = document.querySelector('.content-with-sidebar')

let imgIndex = 0

onload = () => {

    if (homePage) {
        heroScroller()
        clientsScroller()
        testimonialsScroller()
        canvasBackground()
    }

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
        ratingHover()
        bookMeeting()
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

    if (breadcrumbs) {
        const arrowLeft = breadcrumbs.querySelector('.breadcrumb-arrow-left')
        const arrowRight = breadcrumbs.querySelector('.breadcrumb-arrow-right')

        const breadcrumbWindow = breadcrumbs.querySelector('.breadcrumb-window')
        const breadcrumbText = breadcrumbs.querySelector('.woocommerce-breadcrumb')

        arrowLeft.addEventListener('click', breadcrumbArrowHandler.bind(null, 'left'), false)
        arrowRight.addEventListener('click', breadcrumbArrowHandler.bind(null, 'right'), false)

        function breadcrumbArrowHandler(param) {
            const coords = breadcrumbText.offsetWidth - breadcrumbWindow.offsetWidth
            if (param === 'left') {
                breadcrumbText.style.transform = 'translateX(0)'
            } else if (param === 'right') {
                breadcrumbText.style.transform = 'translateX(-' + coords + 'px)'
            }
        }
    }

    if (skillset) {
        const toggleCollapse = skillset.querySelector('.close-skills')
        const skills = skillset.querySelector('.employee-skills')
        // set initial scrollHeight for element
        skills.style.maxHeight = skills.scrollHeight + 'px'

        toggleCollapse.addEventListener('click', handleCollapse, false)
        document.addEventListener('scroll', handleScroll, false)

        function handleCollapse() {
            if (this.classList.contains('collapsed')) {
                this.innerText = '???'
                skills.style.maxHeight = skills.scrollHeight + 'px'
                skills.style.marginBlock = '1rem 2rem'
            } else {
                this.innerText = '+'
                skills.style.maxHeight = 0
                skills.style.marginBlock = '1rem 0'
            }
            this.classList.toggle('collapsed')
        }

        function handleScroll() {
            toggleCollapse.classList.toggle('collapsed')
            toggleCollapse.innerText = '+'
            skills.style.maxHeight = 0
            skills.style.marginBlock = '1rem 0'
        }
    }

    if (sidebarContent) {
        const btn = sidebarContent.querySelector('.hide-btn')
        const sidebar = sidebarContent.querySelector('.sidebar')
        const filter = sidebarContent.querySelector('.sticky-filter')
        btn.addEventListener('click', hideSidebar, false)

        function hideSidebar() {
            this.classList.toggle('hidden')
            filter.classList.toggle('hidden')
            sidebar.classList.toggle('closed')
        }
    }
}

onresize = () => {
    if (affiliatePage) {
        affiliateSlider()
    }
}

function noScroll() {
    body.classList.add('stop-scroll')
}

function addScroll() {
    body.classList.remove('stop-scroll')
}

function canvasBackground() {
    const canvas = document.querySelector('canvas')
    const ctx = canvas.getContext('2d')

    const options = acf.get('circleQuantity')

    let w = canvas.width = 640
    let h = canvas.height = 480

    const circles = []
    const colors = options.circle_colors.split(',')
    const circleNum = options.circle_number
    const minSpeed = options.min_speed
    const maxSpeed = options.max_speed
    const minRadius = options.min_radius
    const maxRadius = options.max_radius

    function calculateSize() {
        w = canvas.width = parseInt(getComputedStyle(canvas).width)
        h = canvas.height = parseInt(getComputedStyle(canvas).height)
    }

    onresize = calculateSize

    class Circle {
        constructor(x, y, vx, vy, diameter, color) {
            this.x = x
            this.y = y
            this.vx = vx
            this.vy = vy
            this.diameter = diameter
            this.color = color
        }

        drawSelf() {
            ctx.beginPath()
            ctx.fillStyle = this.color
            ctx.strokeStyle = this.color
            ctx.arc(this.x, this.y, this.diameter, 0, 2 * Math.PI)
            ctx.stroke()
            ctx.fill()
        }

        moveSelf() {
            if (this.x > (w + this.diameter) || this.x < (this.diameter * -1)) {
                this.vx *= -1
            }
            if (this.y > (h + this.diameter) || this.y < (this.diameter * -1)) {
                this.vy *= -1
            }
            this.x += this.vx
            this.y += this.vy
        }
    }

    function createCircles(quantity) {
        let counter = quantity

        while (counter > 0) {
            const randomX = Math.floor(Math.random() * w)
            const randomY = Math.floor(Math.random() * h)
            const randomVX = Math.random() * maxSpeed - minSpeed
            const randomVY = Math.random() * maxSpeed - minSpeed
            const randomRadius = Math.random() * maxRadius + minRadius
            const randomColor = Math.floor(Math.random() * colors.length)
            circles.push(new Circle(randomX, randomY, randomVX, randomVY, randomRadius, colors[randomColor]))
            counter--
        }
    }

    calculateSize()

    createCircles(circleNum)

    circles.forEach(c => {
        c.drawSelf()
    })

    setInterval(() => {
        ctx.clearRect(0, 0, w, h)
        circles.forEach(c => {
            c.moveSelf()
            c.drawSelf()
        })
    }, 50)

    console.log(`circle number: ${options.circle_number}`)
    console.log(`circle colors: ${options.circle_colors}`)
    console.log(`circle speed: ${options.min_speed} - ${options.max_speed}`)
    console.log(`circle radius: ${options.min_radius} - ${options.max_radius}`)
}

/* POPUP CALENDAR */

function bookMeeting() {
    const interviewButton = document.querySelector('.setup-interview')
    const whiteBackdrop = document.querySelector('.white-backdrop')
    const close = document.querySelector('.white-backdrop > i')


    interviewButton.addEventListener('click', (e) => {
        e.preventDefault()
        body.style.position = 'relative'
        if (isAdmin) {
            whiteBackdrop.style.top = (window.scrollY - 32) + 'px'
        } else {
            whiteBackdrop.style.top = window.scrollY + 'px'
        }
        noScroll()
        whiteBackdrop.style.display = 'grid'
    })

    close.addEventListener('click', () => {
        addScroll()
        whiteBackdrop.style.display = 'none'
    })

}

/* RATING HOVER */
function ratingHover() {
    const stars = document.querySelectorAll('.comment-form-rating i')
    const container = document.querySelector('.comment-form-rating')

    stars.forEach((star, index) => {
        star.addEventListener('mouseover', function () {
            addStars(stars, index)
        })
        star.addEventListener('click', function () {
            freezeStars(container)
        })
        container.addEventListener('mouseout', removeAllStars, false)
    })
}

function addStars(stars, index) {
    Array.from(stars).forEach((item, idx) => {
        if (idx <= index) {
            item.classList.add('yellow')
        } else {
            item.classList.remove('yellow')
        }
    })
}

function removeAllStars() {
    const stars = document.querySelectorAll('.comment-form-rating i')
    stars.forEach(star => {
        star.classList.remove('yellow')
    })
}

function freezeStars(container) {
    container.removeEventListener('mouseout', removeAllStars, false)
}

/* HERO SCROLLER */
function heroScroller() {
    const scroller = document.querySelector('.scroller')
    const words = ['Designers', 'Developers', 'Managers', 'Employees', 'Assistants']
    let counter = 1
    setInterval(() => {
        if (counter > words.length - 1) {
            counter = 0
        }
        scroller.textContent = words[counter]
        counter++
    }, 3000)
}

/* CLIENTS SCROLLER */
function clientsScroller() {
    jQuery('.clients-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        draggable: true,
        infinite: true,
        swipeToSlide: true,
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
}

/* TESTIMONIALS SCROLLER */
function testimonialsScroller() {
    jQuery('.testimonials-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        draggable: true,
        infinite: true,
        swipeToSlide: true,
        adaptiveHeight: true,
    })
}

/* COVER IFRAME */
function coverIframe() {
    const cover = document.querySelector('.iframe-cover')
    const iframe = document.querySelector('.iframe-container > iframe')
    if (cover) {
        cover.addEventListener('click', () => {
            iframe.src += '?autoplay=1'
            setTimeout(() => {
                cover.classList.add('hide')
            }, 1000)
        })
    }
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
// function autoFontScale() {
//     const max = 32
//     const min = 18
//     const k = 270
//     const title = document.querySelector('.single-product-sidebar .product_title')
//
//     const titleText = title.innerText
//     const titleLength = titleText.length
//     const newSize = k / titleLength
//
//     if (newSize > max) {
//         title.style.fontSize = max + 'px'
//     } else if (newSize < min) {
//         title.style.fontSize = min + 'px'
//     } else {
//         title.style.fontSize = newSize + 'px'
//     }
// }

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
    body.classList.add('modal-gallery-open')
    if (backdrop.parentElement !== body) {
        body.insertBefore(backdrop, document.body.firstChild)
    }
    if (isAdmin) {
        backdrop.style.top = (window.scrollY - 32) + 'px'
    } else {
        backdrop.style.top = window.scrollY + 'px'
    }
    backdrop.style.display = 'grid'
}

function closeGallery() {
    img.classList.add('fade')
    setTimeout(() => {
        backdrop.style.display = 'none'
        body.classList.remove('modal-gallery-open')
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

//CARDS
const cards = document.querySelectorAll('.card');
console.log(cards);
for (let i = 0; i < cards.length; i++) {
    const skillContainer = cards[i]
        .querySelector('.card_content')
        .querySelector('.skill-items');
    console.log(skillContainer);
    const counterFunction = () => {
        // console.log(skillContainer.childElementCount);
        console.log(skillContainer.querySelectorAll('a').length);
        tagNum = skillContainer.querySelectorAll('a').length;
        if (tagNum > 6) {
            console.log('+');
            skillContainer.querySelector('.count').textContent += `+${tagNum - 6}`;
        } else {
            console.log('-');
            skillContainer.querySelector('.count').style = 'display: none';
        }
    };
    counterFunction();
}