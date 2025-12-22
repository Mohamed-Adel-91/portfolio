$(function() {

    'use strict';

    $('.fakeLoader').fakeLoader({

        timeToHide: 1200, //Time in milliseconds for fakeLoader disappear

        zIndex: "999",//Default zIndex

        spinner: "spinner3",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'

        bgColor: "#212121" //Hex, RGB or RGBA colors

    });

    // smooth scroll
    $("a").on("click", function(event) {

        if (this.hash !== "") {
            event.preventDefault();

            var hash = this.hash;

            $("html, body").animate({

                scrollTop: $(hash).offset().top - 50

            }, 850);

        }

    });

    // hide navbar on mobile after click
    $('.navbar-nav a').on('click', function() {
        $('.navbar-collapse').collapse('hide');
    });

    // carousel resume
    var $resume = $('.resume-carousel');
    if ($resume.length) {
        var timeout = parseInt($resume.attr('data-autoplay-timeout'), 10) || 10000;

        $resume.owlCarousel({
            items: 1,
            margin: 10,
            loop: true,
            autoplay: true,
            autoplayTimeout: timeout,
            autoplayHoverPause: true,
            autoHeight: true,
            smartSpeed: 600
        });

        function syncResumeHeight() {
            var $active = $resume.find('.owl-item.active .content');
            if (!$active.length) {
                return;
            }
            var height = $active.outerHeight(true);
            $resume.find('.owl-stage-outer').css('height', height + 'px');
        }

        $resume.on('initialized.owl.carousel', function () {
            setTimeout(syncResumeHeight, 0);
        });

        $resume.on('changed.owl.carousel translated.owl.carousel refreshed.owl.carousel', function () {
            setTimeout(syncResumeHeight, 0);
        });

        $(window).on('resize', function () {
            syncResumeHeight();
        });
    }

    // collapse show on resume
    $('.collapse-show').collapse();

    // porfolio filterizr
    $('.filtr-container').imagesLoaded( function() {
        var filterizr = $('.filtr-container').filterizr();
    });

    // portfolio filter
    $('.portfolio-filter-menu li').on('click', function() {
        $('.portfolio-filter-menu li').removeClass('active');
        $(this).addClass('active');
    });

    // portfolio magnific popup
    $('.portfolio').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: '.portfolio-popup', // the selector for portfolio item
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

    // navbar on scroll
    $(window).on("scroll", function() {

        var vScroll = $(this).scrollTop();

        if( vScroll > 100) {
            $(".navbar").addClass("fix");
        }
        else {
            $(".navbar").removeClass("fix");
        }

    });


});
