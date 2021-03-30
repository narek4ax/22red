// Core JS Content
import "jquery";
import 'bootstrap';
import 'slick-carousel';
window.jQuery = $;
require("@fancyapps/fancybox");
//var Cookies = require('cookies')
//import * as PhotoSwipe from 'photoswipe';
//import * as PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default'

window.theme = window.theme || {};

theme.init = () => {
  theme.bb();
  theme.globalSite();
  theme.homePage();
}

theme.bb = () => { 
 if ("Chrome" || "Firefox") {
    var e = ["%c Development - https://dirango.com ", "display:block; padding:5px; background: #111; line-height:40px; color:#fff;"];
    window.console.log.apply(console, e);
  } else {
    window.console.log("Development - https://dirango.com ");
  }
}

theme.globalSite = () => {
    
    var w = window,
        wH = w.innerHeight;
    w.requestAnimationFrame = w.requestAnimationFrame || w.mozRequestAnimationFrame || w.webkitRequestAnimationFrame || w.msRequestAnimationFrame || function(f) {
        setTimeout(f, 1000 / 60)
    };
    var sections = $('[data-animate-section]');
    $('body').addClass('loaded');

    function revealSections() {
        var scrollPos = w.pageYOffset;
        sections.each(function() {
            var offset = this.pOffset;
            var triggerPoint = 150;
//            if($('#header').hasClass('stiky')){
//                triggerPoint = triggerPoint - $('#header').outerHeight();
//            }
            var adjustedTrigger = $(this).data('animateOffset') ? triggerPoint + $(this).data('animateOffset') : triggerPoint;
            if(scrollPos > offset - (wH - adjustedTrigger)){
                $(this).addClass('animate');
            }
        })
    }
    w.addEventListener('scroll', function() {
        requestAnimationFrame(revealSections);
    }, false);
    setOffsetValues();
    revealSections();

    function setOffsetValues() {
        sections.each(function() {
            this.pOffset = $(this).offset().top;
        });
    }
    $(w).on('load', function() {
        setOffsetValues();
        requestAnimationFrame(revealSections);
    });
    $('.home-secondary').on('slideIn', function() {
        setTimeout(function() {
            setOffsetValues();
        }, 1550);
    });
    var timer;
    $(w).on('resize', function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            setOffsetValues();
            wH = w.innerHeight;
        }, 50);
    });
    
    if(!$('body').hasClass('home')){
        
        if($('#inside_banner').length > 0){
            $(window).resize(function(){
                $('body main').css('padding-top',$('#inside_banner').outerHeight());                
            }).resize();
        }
        
        if($('#lauret_non_section').length > 0){
            $(window).resize(function(){
                $('body main').css('padding-top',$('#lauret_non_section').outerHeight());                
            }).resize();
        }        
        $(window).scroll(function(){
                if($(window).scrollTop() > $('#header').outerHeight() + 50){
                    $('#header').addClass('stiky');
                }else{
                    $('#header').removeClass('stiky');
                }
        }).scroll();
    }
    
    if($('.firewall_wrapper').length > 0){
        console.log('1111111');
        console.log($.fancybox);
        $.fancybox.open({
            'autoScale': true,
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 500,
            'speedOut': 300,
            'autoDimensions': true,
            'centerOnScroll': true,
            'type': 'html',
            'src' : $('.firewall_wrapper'),
            'clickSlide':false,
            'touch' : false
        });
        $(document).on('click','.firewall_wrapper .left_col_link,.firewall_wrapper .left_col_img a',function(e){
            e.preventDefault();
            jQuery.ajax({
		url : ajax_info.ajax_url,
		type : 'post',
		data : {
			action : 'hide_firewall_popup',
			hide : true
		},
		success : function( response ) {
                    if(response){
                        console.log(ajax_info);
                        $('.firewall_wrapper .fancybox-button').trigger('click');
			console.log(response);
                    }
		}
	});
//            var cookies = new Cookies()
//            cookies.set('firewall_popup', false);      
        });
    }
    
},
theme.homePage = () => {
    
    var thresholdTimer = null;

    function thresholdLogging(start) {
        if (start) {
            console.time('threshold time');
            if (thresholdTimer) {
                clearTimeout(thresholdTimer);
            }
            thresholdTimer = setTimeout(function() {
                console.log('Giving up on threshold');
                console.timeEnd('threshold time');
            }, 100);
        } else {
            console.timeEnd('threshold time')
            if(thresholdTimer) {
                clearTimeout(thresholdTimer);
            }
        }
    };
    
    $(function() {
        var $window = $(window);
        var $document = $(document);
        var $body = $('body');
        var $header = $('.header');
        var $overview = $('.home-secondary');
        $('.full-page-slides').each(function() {
            var $this = $(this);
            var $slides = $('.full-page-slide', this);
            var $controlPoints = $('.control-nav li', this);
//            var $indicatorNav = $('.indicator-nav', this);
            var $navigationHelper = $('.navigation-helper_new', this);
            var delta = 0;
            var currentSlideIndex = 0;
            var scrollThreshold = 10;
            var isAnimating = false;
            var scrollTimer = null;
            var touchStartY = null;
            var calculateDelta = function(scrollUp) {
                if (scrollUp) {
                    delta--;
                    if (Math.abs(delta) >= scrollThreshold) {
                        showPrevious();
                        thresholdLogging(false);
                    } else {
                        thresholdLogging(true);
                    }
                } else {
                    delta++;
                    if (delta >= scrollThreshold) {
                        showNext();
                        thresholdLogging(false);
                    } else {
                        thresholdLogging(true);
                    }
                }
            };
            var showPrevious = function() {
                currentSlideIndex--;
                if (currentSlideIndex < 0) {
                    currentSlideIndex = 0;
                }
                showSlide();
            };
            var showNext = function() {
                currentSlideIndex++;
                showSlide();
            };
            var slideOut = function() {
                $slides.each(function(i) {
                    $(this).toggleClass('slideOut', i < currentSlideIndex);
                });
            };
            var slideIn = function() {
                $slides.each(function(i) {
                    $(this).toggleClass('slideIn', i === currentSlideIndex);
                });
            };
            var showSlide = function() {
                delta = 0;
                if (currentSlideIndex === $slides.length) {
                    $overview.addClass('slideIn');
                    $overview.trigger('slideIn');
                    $body.addClass('end-of-slides');
                    $slides.each(function(i) {
                        $(this).toggleClass('skipSlide', !$(this).hasClass('slideIn') && !$(this).hasClass('slideOut'));
                    });
                    slideOut();
                    setControlNav(currentSlideIndex);
                    setIndicatorNav(currentSlideIndex);
                } else {
                    $overview.removeClass('slideIn');
                    $body.removeClass('end-of-slides');
                    $header.removeClass('opaque');
                    slideIn();
                    slideOut();
                    setControlNav(currentSlideIndex);
                    setIndicatorNav(currentSlideIndex);
                }
                $body.toggleClass('page-with-top-hero', currentSlideIndex !== $slides.length || $window.scrollTop() < 100);
                isAnimating = true;
                if (scrollTimer) {
                    clearTimeout(scrollTimer);
                }
                scrollTimer = setTimeout(function() {
                    isAnimating = false;
                    scrollTimer = null;
                    $slides.removeClass('skipSlide')
                }, Math.round(1000));
            };
            var setControlNav = function(index) {
                $controlPoints.removeClass('active').eq(index).addClass('active');
            };
            var setIndicatorNav = function(index) {
                /*$indicatorNav.attr('data-slide', index);*/
            };
            function onScroll(e) {
                if (isAnimating) {
                    e.preventDefault();
                    return;
                }
                var isScrollUp = e.detail < 0 || e.wheelDelta > 0;
                var isScrollUpAtTop = isScrollUp === true && $window.scrollTop() === 0;
                var isScrollDownInSlides = isScrollUp === false && currentSlideIndex < $slides.length;
                if (isScrollUpAtTop || isScrollDownInSlides) {
                    e.preventDefault();
                    calculateDelta(isScrollUp);
                }
                if(currentSlideIndex > 0){
                    $('#header').addClass('stiky');
                }else{
                    $('#header').removeClass('stiky');
                }
            }
            document.addEventListener('wheel', onScroll, {
                passive: false
            });
            document.addEventListener('mousewheel', onScroll, {
                passive: false
            });
            document.addEventListener('DOMMouseScroll', onScroll, {
                passive: false
            });
//            $document.on('DOMMouseScroll.full-page-slides mousewheel.full-page-slides MozMousePixelScroll.full-page-slides', function(e) {
//                if (isAnimating) {
//                    e.preventDefault();
//                    return;
//                }
//                var isScrollUp = e.originalEvent.detail < 0 || e.originalEvent.wheelDelta > 0;
//                var isScrollUpAtTop = isScrollUp === true && $window.scrollTop() === 0;
//                var isScrollDownInSlides = isScrollUp === false && currentSlideIndex < $slides.length;
////                    console.log(e);
//                if (isScrollUpAtTop || isScrollDownInSlides) {
//                    console.log('scrolling down');
//                    e.preventDefault();
//                    calculateDelta(isScrollUp);
//                }
//                if(currentSlideIndex > 0){
//                    $('#header').addClass('stiky');
//                }else{
//                    $('#header').removeClass('stiky');
//                }
//            });
            $window.on('scroll',function(){
                if ($window.scrollTop() > 0 && !$('.home-secondary').hasClass('slideIn')) {
                    console.log('scrolling down');
                    $('.full-page-slides .article').removeClass('slideIn');
                    $('.full-page-slides .article').addClass('slideOut');
                    $('.home-secondary').addClass('slideIn');
                    currentSlideIndex = $slides.length;
                    if(!$('#header').hasClass('stiky')){
                        $('#header').addClass('stiky');
                    }
                }                
            }).scroll();
            $this[0].addEventListener('touchstart', function(e) {
                if ($window.scrollTop() === 0) {
                    touchStartY = e.changedTouches[0].pageY;
                }
            }, {
                passive: false
            });
            $this[0].addEventListener('touchmove', function(e) {
                if ($window.scrollTop() === 0) {
                    e.preventDefault();
                }
            }, {
                passive: false
            });
            $this[0].addEventListener('touchend', function(e) {
                if ($window.scrollTop() === 0) {
                    var distance = e.changedTouches[0].pageY - touchStartY;
                    console.log('touch distance', distance);
                    if (Math.abs(distance) > 80) {
                        e.preventDefault();
                        if (distance > 0) {
                            showPrevious();
                        } else {
                            showNext();
                        }
                    }
                }
            }, {
                passive: false
            });
            $overview[0].addEventListener('touchstart', function(e) {
                if ($window.scrollTop() === 0) {
                    touchStartY = e.changedTouches[0].pageY;
                }
            });
            $overview[0].addEventListener('touchend', function(e) {
                if ($window.scrollTop() < 0) {
                    e.preventDefault();
                    showPrevious();
                }
            }, {
                passive: false
            });
            
            $document.on('keydown.full-page-slides', function(e) {
                if ((e.which === 38 && $window.scrollTop() === 0) || (e.which === 40 && currentSlideIndex < $slides.length)) {
                    e.preventDefault();
                    if (e.which === 38) {
                        showPrevious();
                    } else {
                        showNext();
                    }
                    if(currentSlideIndex > 0 && !$('#header').hasClass('stiky')){
                        $('#header').addClass('stiky');
                    }else if(currentSlideIndex == 0){
                        $('#header').removeClass('stiky');
                    }
                    console.log(currentSlideIndex);
                }
            });
            
            document.addEventListener('scroll', function(e) {
                if ($window.scrollTop() > $this.offset().top + $this.height()) {
                    currentSlideIndex == $slides.length;
                } else if ($window.scrollTop() === 0 && currentSlideIndex === $slides.length) {
                    currentSlideIndex = $slides.length;
                }
            }, {
                passive: false
            });
            $controlPoints.find('a').on('click.full-page-slides', function(e) {
                e.preventDefault();
                currentSlideIndex = $controlPoints.find('a').index(this);
                if($(this).parent().is(':last-child')){
                    $('#header').addClass('stiky');                    
                }
                showSlide();
            });
            $navigationHelper.on('click.full-page-slides', function(e) {
                e.preventDefault();
                if (currentSlideIndex < $slides.length - 1) {}
                currentSlideIndex = currentSlideIndex + 1;
                $('#header').addClass('stiky');
                showSlide();
            });
            var resizeTimer = null;
            var resizeTimerThreshold = 100;
            var updateSlidesHeight = function() {
                clearTimeout(resizeTimer);
                resizeTimer = null;
                $this.height($window.get(0).innerHeight);
                $overview.css({
                    'margin-top': -$window.get(0).innerHeight,
                    '-webkit-transform': 'translate3d(0, ' + $window.get(0).innerHeight + 'px, 0) scale(0.85)',
                    '-moz-transform': 'translate3d(0, ' + $window.get(0).innerHeight + 'px, 0) scale(0.85)',
                    '-ms-transform': 'translate3d(0, ' + $window.get(0).innerHeight + 'px, 0) scale(0.85)',
                    '-o-transform': 'translate3d(0, ' + $window.get(0).innerHeight + 'px, 0) scale(0.85)',
                    'transform': 'translate3d(0, ' + $window.get(0).innerHeight + 'px, 0) scale(0.85)'
                });
                console.log('updateSlidesHeight', $this.height());
            };
            $window.on('resize.full-page-slides', function() {
                console.log('resize.full-page-slides', $window.get(0).innerHeight);
                if (resizeTimer) {
                    clearTimeout(resizeTimer);
                }
                resizeTimer = setTimeout(updateSlidesHeight, resizeTimerThreshold);
            });
            updateSlidesHeight();
            checkScrollTop();
            setTimeout(function() {
                checkScrollTop()
            }, 150);

            function checkScrollTop() {
                if ($window.scrollTop() > 0) {
                    currentSlideIndex = $slides.length;
                    $body.addClass('end-of-slides');
                    $overview.addClass('slideIn');
                    $overview.trigger('slideIn');
                    if ($window.scrollTop() > $this.offset().top + $this.height()) {
                        currentSlideIndex = $slides.length;
                        $body.removeClass('page-with-top-hero');
                    }
                    $slides.each(function(i) {
                        $(this).toggleClass('slideOut', i < currentSlideIndex);
                    });
                }
            }
        });
    });
    
    
    if($('#home_blog .posts_wrapper').length > 0){
        $('#home_blog .posts_wrapper').slick();
    }    
    
}

document.addEventListener("DOMContentLoaded", () => {
  theme.init();
});
