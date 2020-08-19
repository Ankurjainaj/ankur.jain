(function($) { 
  'use strict';

    /**
     * News Ticker
     */  
    let wpbEaProNewsTicker = function( $scope, $ ) {

        var $_wpb_ea_news_ticker = $scope.find(".wpb-ea-pro-news-ticker");

        if ( $.isFunction($.fn.breakingNews) ) {  
            $_wpb_ea_news_ticker.each(function() {
                let t             = $(this),
                auto              = t.data("autoplay") ? !0 : !1,
                the_effect        = t.data("animation") ? t.data("animation") : '',                                   
                fixed_bottom      = t.data("bottom_fixed") ? t.data("bottom_fixed") : '',                                   
                pause_on_hover    = t.data("pause_on_hover") ? t.data("pause_on_hover") : '',                                   
                animation_speed   = t.data("animation_speed") ? t.data("animation_speed") : '',                                   
                autoplay_interval = t.data("autoplay_interval") ? t.data("autoplay_interval") : '',                                   
                ticker_height     = t.data("ticker_height") ? t.data("ticker_height") : '',                                   
                direction         = t.data("direction") ? t.data("direction") : ''; 

                $(this).breakingNews({
                    position: fixed_bottom,
                    play: auto,
                    direction: direction,
                    scrollSpeed: animation_speed,
                    stopOnHover: pause_on_hover,
                    effect: the_effect,
                    delayTimer: autoplay_interval,                    
                    height: ticker_height,
                    fontSize: "default",
                    themeColor: "default",
                    background: "default",                       
                });    
            });
        }
    };

    /**
     * Counter Up
     */   

    var WPB_CounterUp = function( $scope, $ ) {

        var $_wpb_ea_counterup_number = $scope.find(".wpb-ea-counterup-number");

        if ( $.isFunction($.fn.counterUp) ) {
            $_wpb_ea_counterup_number.counterUp({
                delay: 15,
                time: 2000
            });
        }
    };



    /**
    * content box slider
    */ 
    var WPB_ContentBox = function( $scope, $ ) {
        if ( $.isFunction($.fn.owlCarousel) ) {
            $(".wpb-ea-content-items-slider").each(function() {
                var t = $(this),
                stop          = t.data("stop") ? !0 : !1,
                auto          = t.data("autoplay") ? !0 : !1,
                loop          = t.data("loop") ? !0 : !1,
                slidergap     = t.data("slidergap") ? parseInt(t.data("slidergap")) : '',
                items         = t.data("items") ? parseInt(t.data("items")) : '',
                desktopsmall  = t.data("desktopsmall") ? parseInt(t.data("desktopsmall")) : '',
                tablet        = t.data("tablet") ? parseInt(t.data("tablet")) : '',
                mobile        = t.data("mobile") ? parseInt(t.data("mobile")) : '',
                nav           = t.data("navigation") ? !0 : !1,
                pag           = t.data("pagination") ? !0 : !1,
                navTextLeft   = t.data("direction") ? 'right' : 'left',
                navTextRight  = t.data("direction") ? 'left' : 'right',
                rtl           = t.data("direction");

                $(this).owlCarousel({
                    responsive:{
                        0:{
                            items: mobile,
                        },
                        480:{
                            items: mobile,
                        },
                        768:{
                            items: tablet,
                        },
                        1170:{
                            items: desktopsmall,
                        },
                        1200:{
                            items: items,
                        }
                    },
                    items : items,
                    responsiveClass: true,
                    loop: loop,
                    margin: slidergap,
                    rtl: rtl,
                    autoplay: auto,
                    autoplayHoverPause: stop,
                    dots: pag,
                    nav: nav,
                    navText : ['<i class="lni-chevron-'+navTextLeft+'" aria-hidden="true"></i>','<i class="lni-chevron-'+navTextRight+'" aria-hidden="true"></i>'],
                });
            }); 
        }
    };


    /**
    * logo slider
    */ 
    var WPB_LogoSlider = function( $scope, $ ) {
        if ( $.isFunction($.fn.owlCarousel) ) {
            $(".wpb-ea-logo-sliders").each(function() {
                var t = $(this),
                stop          = t.data("stop") ? !0 : !1,
                auto          = t.data("autoplay") ? !0 : !1,
                loop          = t.data("loop") ? !0 : !1,
                slidergap     = t.data("slidergap") ? parseInt(t.data("slidergap")) : '',
                items         = t.data("items") ? parseInt(t.data("items")) : '',
                desktopsmall  = t.data("desktopsmall") ? parseInt(t.data("desktopsmall")) : '',
                tablet        = t.data("tablet") ? parseInt(t.data("tablet")) : '',
                mobile        = t.data("mobile") ? parseInt(t.data("mobile")) : '',
                nav           = t.data("navigation") ? !0 : !1,
                pag           = t.data("pagination") ? !0 : !1,
                navTextLeft   = t.data("direction") ? 'right' : 'left',
                navTextRight  = t.data("direction") ? 'left' : 'right',
                rtl           = t.data("direction");
              
                $(this).owlCarousel({
                    responsive:{
                        0:{
                            items: mobile,
                        },
                        480:{
                            items: mobile,
                        },
                        768:{
                            items: tablet,
                        },
                        1170:{
                            items: desktopsmall,
                        },
                        1200:{
                            items: items,
                        }
                    },
                    items : items,
                    responsiveClass: true,
                    loop: loop,
                    margin: slidergap,
                    rtl: rtl,
                    autoplay: auto,
                    autoplayHoverPause: stop,
                    dots: pag,
                    nav: nav,
                    navText : ['<i class="lni-chevron-'+navTextLeft+'" aria-hidden="true"></i>','<i class="lni-chevron-'+navTextRight+'" aria-hidden="true"></i>'],
                });
            }); 
        }
    };


    /**
    * image filterable gallery
    */ 

    var WPB_FilterableGallery = function( $scope, $ ) {

        var $_wpb_ea_portfolio_container = $scope.find('.xt-project-gallery-init');
        var $_wpb_ea_portfolio_nav       = $scope.find('.xt-project-gallery-nav');
        

        if ( $.isFunction($.fn.imagesLoaded) ) {
            $_wpb_ea_portfolio_container.imagesLoaded( function() {
                if ( $.isFunction($.fn.isotope) ) {
                    $_wpb_ea_portfolio_container.isotope({
                        filter: '*',
                        itemSelector: '.xt-project-gallery-grid-item',
                    });
                }
            });
        }

        $_wpb_ea_portfolio_nav.on( 'click', 'li', function() {
            $_wpb_ea_portfolio_nav.find('.current').removeClass('current');
            $(this).addClass('current');

            if ( $.isFunction($.fn.isotope) ) {
                var selector = $(this).attr('data-filter');
                $_wpb_ea_portfolio_container.isotope({
                    filter: selector,
                });
                return false;
            }
        }); 

    };



    /**
    * Post slider
    */ 

    var WPB_PostSlider = function( $scope, $ ) {
        if ( $.isFunction($.fn.owlCarousel) ) {
            $(".wpb-ea-posts-slider").each(function() {
                var t = $(this),
                stop          = t.data("stop") ? !0 : !1,
                auto          = t.data("autoplay") ? !0 : !1,
                loop          = t.data("loop") ? !0 : !1,
                slidergap     = t.data("slidergap") ? parseInt(t.data("slidergap")) : '',
                items         = t.data("items") ? parseInt(t.data("items")) : '',
                desktopsmall  = t.data("desktopsmall") ? parseInt(t.data("desktopsmall")) : '',
                tablet        = t.data("tablet") ? parseInt(t.data("tablet")) : '',
                mobile        = t.data("mobile") ? parseInt(t.data("mobile")) : '',
                nav           = t.data("navigation") ? !0 : !1,
                pag           = t.data("pagination") ? !0 : !1,
                navTextLeft   = t.data("direction") ? 'right' : 'left',
                navTextRight  = t.data("direction") ? 'left' : 'right',
                rtl           = t.data("direction");
              
                $(this).owlCarousel({
                    responsive:{
                        0:{
                            items: mobile
                        },
                        480:{
                            items: mobile
                        },
                        768:{
                            items: tablet
                        },
                        1170:{
                            items: desktopsmall
                        },
                        1200:{
                            items: items
                        }
                    },
                    items : items,
                    responsiveClass: true,
                    loop: loop,
                    margin: slidergap,
                    rtl: rtl,
                    autoplay: auto,
                    autoplayHoverPause: stop,
                    dots: pag,
                    nav: nav,
                    navText : ['<i class="lni-chevron-'+navTextLeft+'" aria-hidden="true"></i>','<i class="lni-chevron-'+navTextRight+'" aria-hidden="true"></i>']
                });
            }); 
        }
    };


    /**
    * main slider
    */ 
    var WPB_MainSlider = function( $scope, $ ) {

        if ( $.isFunction($.fn.owlCarousel) ) {  
            $(".theme-main-slider").each(function() {
                var t = $(this),
                auto          = t.data("autoplay") ? !0 : !1,
                loop          = t.data("loop") ? !0 : !1,
                rtl           = t.data("direction") ? !0 : !1,
                nav           = t.data("navigation") ? !0 : !1,
                pag           = t.data("pagination") ? !0 : !1;
                        
                $(this).owlCarousel({
                    autoHeight: true,
                    items: 1,
                    loop: loop,
                    autoplay: false,
                    dots: pag,
                    nav: nav,
                    autoplayTimeout: 7000,
                    navText: ["<i class='lni-chevron-left'></i>", "<i class='lni-chevron-right'></i>"],
                    animateIn: 'zoomIn',
                    animateOut: 'fadeOut',
                    autoplayHoverPause: false,
                    touchDrag: true,
                    mouseDrag: true,
                    rtl: rtl
                });

                $(this).on("translate.owl.carousel", function () {
                    $(this).find(".owl-item .slide-text > *").removeClass("fadeInUp animated").css("opacity","0");
                    $(this).find(".owl-item .slide-img").removeClass("fadeInRight animated").css("opacity","0");
                }); 
                         
                $(this).on("translated.owl.carousel", function () {
                    $(this).find(".owl-item.active .slide-text > *").addClass("fadeInUp animated").css("opacity","1");
                    $(this).find(".owl-item.active .slide-img").addClass("fadeInRight animated").css("opacity","1");
                });
            });
        }

        // SLIDER Preloader
        jQuery(document).ready( function($) {
            $('.slider_preloader_status').fadeOut();
            $('.slider_preloader').delay(350).fadeOut('slow');
            $('.header-slider').removeClass("header-slider-preloader");
        });
    };

    
    /**
    * team slider
    */ 
    var WPB_TeamSlider = function( $scope, $ ) {
        if ( $.isFunction($.fn.owlCarousel) ) {
            $(".wpb-ea-member-items-slider").each(function() {
                var t = $(this),
                stop          = t.data("stop") ? !0 : !1,
                auto          = t.data("autoplay") ? !0 : !1,
                loop          = t.data("loop") ? !0 : !1,
                slidergap     = t.data("slidergap") ? parseInt(t.data("slidergap")) : '',
                items         = t.data("items") ? parseInt(t.data("items")) : '',
                desktopsmall  = t.data("desktopsmall") ? parseInt(t.data("desktopsmall")) : '',
                tablet        = t.data("tablet") ? parseInt(t.data("tablet")) : '',
                mobile        = t.data("mobile") ? parseInt(t.data("mobile")) : '',
                nav           = t.data("navigation") ? !0 : !1,
                pag           = t.data("pagination") ? !0 : !1,
                navTextLeft   = t.data("direction") ? 'right' : 'left',
                navTextRight  = t.data("direction") ? 'left' : 'right',
                rtl           = t.data("direction");

                $(this).owlCarousel({
                    responsive:{
                        0:{
                            items: mobile,
                        },
                        480:{
                            items: mobile,
                        },
                        768:{
                            items: tablet,
                        },
                        1170:{
                            items: desktopsmall,
                        },
                        1200:{
                            items: items,
                        }
                    },
                    items : items,
                    responsiveClass: true,
                    loop: loop,
                    margin: slidergap,
                    rtl: rtl,
                    autoplay: auto,
                    autoplayHoverPause: stop,
                    dots: pag,
                    nav: nav,
                    navText : ['<i class="lni-chevron-'+navTextLeft+'" aria-hidden="true"></i>','<i class="lni-chevron-'+navTextRight+'" aria-hidden="true"></i>'],
                });
            }); 
        }
    };

    /**
    * testimonial slider
    */ 
    var WPB_Testimonial = function( $scope, $ ) {

        if ( $.isFunction($.fn.owlCarousel) ) {
            $(".wpb-ea-testimonial-items-slider").each(function() {
                var t = $(this),
                stop          = t.data("stop") ? !0 : !1,
                auto          = t.data("autoplay") ? !0 : !1,
                loop          = t.data("loop") ? !0 : !1,
                slidergap     = t.data("slidergap") ? parseInt(t.data("slidergap")) : '',
                items         = t.data("items") ? parseInt(t.data("items")) : '',
                desktopsmall  = t.data("desktopsmall") ? parseInt(t.data("desktopsmall")) : '',
                tablet        = t.data("tablet") ? parseInt(t.data("tablet")) : '',
                mobile        = t.data("mobile") ? parseInt(t.data("mobile")) : '',
                nav           = t.data("navigation") ? !0 : !1,
                pag           = t.data("pagination") ? !0 : !1,
                navTextLeft   = t.data("direction") ? 'right' : 'left',
                navTextRight  = t.data("direction") ? 'left' : 'right',
                rtl           = t.data("direction");

                $(this).owlCarousel({
                    responsive:{
                        0:{
                            items: mobile,
                        },
                        480:{
                            items: mobile,
                        },
                        768:{
                            items: tablet,
                        },
                        1170:{
                            items: desktopsmall,
                        },
                        1200:{
                            items: items,
                        }
                    },
                    items : items,
                    responsiveClass: true,
                    loop: loop,
                    margin: slidergap,
                    rtl: rtl,
                    autoplay: auto,
                    autoplayHoverPause: stop,
                    dots: pag,
                    nav: nav,
                    navText : ['<i class="lni-chevron-'+navTextLeft+'" aria-hidden="true"></i>','<i class="lni-chevron-'+navTextRight+'" aria-hidden="true"></i>'],
                });
            }); 
        }
    };

    /**
     * Timeline
     */
    var WPB_Timeline = function( $scope, $ ) {
        var $timeline_block = $('.wpb-timeline-block');

        //hide timeline blocks which are outside the viewport
        $timeline_block.each(function(){
            if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
                $(this).find('.wpb-timeline-icon, .wpb-timeline-content').addClass('is-hidden');
            }
        });

        //on scolling, show/animate timeline blocks when enter the viewport
        $(window).on('scroll', function(){
            $timeline_block.each(function(){
                if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.wpb-timeline-icon').hasClass('is-hidden') ) {
                    $(this).find('.wpb-timeline-icon, .wpb-timeline-content').removeClass('is-hidden').addClass('bounce-in');
                }
            });
        });
    };

    /**
     * video popup
     */ 

    var WPB_VideoPopUp = function( $scope, $ ) {
        if ( $.isFunction($.fn.fancybox) ) {
            $("[data-fancybox]").fancybox({});
        }
    };

    // Elementor FrontEnd Hooks
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-counterup-settings.default', WPB_CounterUp );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-pro-bio.default', WPB_CounterUp );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-our-content-box.default', WPB_ContentBox );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-image-gallery.default', WPB_FilterableGallery );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-logo-slider.default', WPB_LogoSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-post-grid-slider.default', WPB_PostSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-slider-item.default', WPB_MainSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-team-members.default', WPB_TeamSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-testimonial.default', WPB_Testimonial );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-timeline.default', WPB_Timeline );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-pro-post-timeline.default', WPB_Timeline );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-video-popup.default', WPB_VideoPopUp );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-pro-fancy-section.default', WPB_VideoPopUp );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-news-ticker.default', wpbEaProNewsTicker );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/wpb-ea-pro-news-ticker.default', wpbEaProNewsTicker );
    } );

} )(jQuery);