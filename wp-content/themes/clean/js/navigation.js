/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
    const siteNavigation = document.getElementById('site-navigation');

    // Return early if the navigation don't exist.
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.getElementsByTagName('button')[0];

    // Return early if the button don't exist.
    if ('undefined' === typeof button) {
        return;
    }
    const menu = siteNavigation.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    if (!menu.classList.contains('nav-menu')) {
        menu.classList.add('nav-menu');
    }

    // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
    button.addEventListener('click', function () {
        siteNavigation.classList.toggle('toggled');

        if (button.getAttribute('aria-expanded') === 'true') {
            button.setAttribute('aria-expanded', 'false');

            // disable body scroll. enable menu scroll. show social icons
            document.body.style.overflowY = 'initial'
            menu.style.overflowY = 'initial'
        } else {
            button.setAttribute('aria-expanded', 'true');
            document.body.style.overflowY = 'hidden'
            menu.style.overflowY = 'scroll'
        }
    });

    // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
    document.addEventListener('click', function (event) {
        const isClickInside = siteNavigation.contains(event.target);

        if (!isClickInside) {
            siteNavigation.classList.remove('toggled');
            button.setAttribute('aria-expanded', 'false');
            document.body.style.overflowY = 'initial'
            menu.style.overflowY = 'initial'
        }
    });

    // Get all the link elements within the menu.
    const links = menu.getElementsByTagName('a');

    // Get all the link elements with children within the menu.
    const linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

    // Toggle focus each time a menu link is focused or blurred.
    for (const link of links) {
        link.addEventListener('focus', toggleFocus, true);
        link.addEventListener('blur', toggleFocus, true);
    }

    // Toggle focus each time a menu link with children receive a touch event.
    for (const link of linksWithChildren) {
        link.addEventListener('touchstart', toggleFocus, false);
    }

    // Toggle accordeon on mobile (old - worked only on click, not touch
    // for (const parentLink of linksWithChildren) {
    //     parentLink.addEventListener('click', (e) => {
    //         if (window.innerWidth > 980) return
    //         e.preventDefault()
    //         console.log('opa')
    //
    //         // close all other submenus
    //         const submenus = menu.querySelectorAll('.sub-menu')
    //         submenus.forEach(item => {
    //             jQuery(item).slideUp()
    //         })
    //
    //         // if class 'sub-menu' is present - toggle submenu
    //         const submenu = e.target.nextElementSibling
    //         if (submenu.classList.contains('sub-menu')) {
    //             if (submenu.style.display === 'block') return
    //             jQuery(submenu).slideToggle()
    //         } else {
    //             console.error(`Element has no submenu`)
    //         }
    //     })
    // }

    // Toggle mini cart on cart icon (main menu)
    const menuCartBtn = document.querySelector('#menu-cart-btn')
    menuCartBtn.addEventListener('click', openMiniCart, false)

    function openMiniCart() {
        const miniCart = document.querySelector('.widget_shopping_cart_content')
        miniCart.classList.toggle('open')
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        if (event.type === 'focus' || event.type === 'blur') {
            let self = this;
            // Move up through the ancestors of the current link until we hit .nav-menu.
            while (!self.classList.contains('nav-menu')) {
                // On li elements toggle the class .focus.
                if ('li' === self.tagName.toLowerCase()) {
                    self.classList.toggle('focus');
                }
                self = self.parentNode;
            }
        }

        if (event.type === 'touchstart') {
            const menuItem = this.parentNode;
            event.preventDefault();
            for (const link of menuItem.parentNode.children) {
                if (menuItem !== link && link.id !== 'header-social-icons') {
                    link.classList.remove('focus');
                    const subMenu = link.querySelector('.sub-menu')
                    // close submenu
                    subMenu.style.maxHeight = 0
                }
            }
            const subMenu = menuItem.querySelector('.sub-menu')
            menuItem.classList.toggle('focus');
            // open submenu to calculated max-height if focused or close if not
            if (menuItem.classList.contains('focus')) {
                subMenu.style.maxHeight = subMenu.scrollHeight + 'px'
            } else {
                subMenu.style.maxHeight = 0
            }
        }
    }

    showSocial()

}());

onresize = showSocial

function showSocial() {

    // add social icons to mobile menu if < 980
    const siteNavigation = document.getElementById('site-navigation');
    const menu = siteNavigation.getElementsByTagName('ul')[0];
    const social = document.querySelector('#header-social-icons')
    if (window.innerWidth <= 980) {
        menu.append(social)
        social.style.display = 'flex'
    } else {
        social.style.display = 'none'
    }
}
