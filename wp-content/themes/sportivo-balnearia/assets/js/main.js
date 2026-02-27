/**
 * Scripts principales — Club Sportivo Balnearia
 * @version 1.0.0
 */

(function () {
    'use strict';

    /**
     * Navegación móvil: toggle del menú hamburguesa.
     */
    function initMobileNav() {
        var toggle = document.querySelector('.csb-nav-toggle');
        var nav = document.querySelector('.main-navigation ul');

        if (!toggle || !nav) return;

        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.contains('is-open');
            nav.classList.toggle('is-open', !isOpen);
            toggle.setAttribute('aria-expanded', String(!isOpen));
        });
    }

    /**
     * Cierra el menú móvil al hacer clic fuera de él.
     */
    function initClickOutsideNav() {
        document.addEventListener('click', function (e) {
            var nav = document.querySelector('.main-navigation');
            var toggle = document.querySelector('.csb-nav-toggle');
            var menu = document.querySelector('.main-navigation ul');

            if (!nav || !menu) return;
            if (!nav.contains(e.target)) {
                menu.classList.remove('is-open');
                if (toggle) toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /**
     * Header sticky: agrega clase cuando la página hace scroll.
     */
    function initStickyHeader() {
        var header = document.querySelector('.site-header');
        if (!header) return;

        window.addEventListener('scroll', function () {
            header.classList.toggle('is-scrolled', window.scrollY > 50);
        }, { passive: true });
    }

    /**
     * Animación de entrada para tarjetas con IntersectionObserver.
     */
    function initCardAnimations() {
        if (!('IntersectionObserver' in window)) return;

        var cards = document.querySelectorAll(
            '.csb-deporte-card, .csb-player-card, .csb-fixture'
        );

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        cards.forEach(function (card) {
            card.classList.add('csb-animate');
            observer.observe(card);
        });
    }

    /**
     * Inicialización cuando el DOM está listo.
     */
    document.addEventListener('DOMContentLoaded', function () {
        initMobileNav();
        initClickOutsideNav();
        initStickyHeader();
        initCardAnimations();
    });

}());
