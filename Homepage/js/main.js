'use strict';

// Slider function
function sliderInit() {
    var swiper = new Swiper('.block_main-content__slider-container', {
        nextButton: '.block_main-content__slider-button-next',
        prevButton: '.block_main-content__slider-button-prev',
        speed: 1000,
        // More Animation class see in animate.css
        // Animation on loading page
        onInit: function (swiper) {
            $('.swiper-slide').each(function () {
                if ($(this).index() === swiper.activeIndex) {
                    // Animation in active slides
                    $(this).find('.block_main-content__slider__content, .block_main-content__slider__caption').removeClass('fadeOut IEhide').addClass('animated fadeIn');
                } else {
                    // Animation in inactive slides
                    $(this).find('.block_main-content__slider__content, .block_main-content__slider__caption').removeClass('fadeIn').addClass('fadeOut IEhide');
                }
            });
        },
        // Animation on slider move
        onSliderMove: function (swiper) {
            $('.swiper-slide').each(function () {
                if ($(this).index() === swiper.activeIndex) {
                    // Animation in active slide
                    $(this).find('.block_main-content__slider__content, .block_main-content__slider__caption').removeClass('fadeOut IEhide').addClass('animated fadeIn');
                } else {
                    // Animation in inactive slides
                    $(this).find('.block_main-content__slider__content, .block_main-content__slider__caption').removeClass('fadeIn').addClass('fadeOut IEhide');
                }
            });
        },
        // animation on slider move end
        onSlideChangeEnd: function (swiper) {
            $('.swiper-slide').each(function () {
                if ($(this).index() === swiper.activeIndex) {
                    // Animation in active slide
                    $(this).find('.block_main-content__slider__content, .block_main-content__slider__caption').removeClass('fadeOut IEhide').addClass('animated fadeIn');
                } else {
                    // Animation in inactive slides
                    $(this).find('.block_main-content__slider__content, .block_main-content__slider__caption').removeClass('fadeIn').addClass('fadeOut IEhide');
                }
            });
        },
    });
}

// MailChimp AJAX sending form function to customize it see in documentation
function AJAXMailChimpSending() {
    function callbackFunction (resp) {
        if (resp.result === "success") {
            $('.block_main-footer__form-button__text-normal').removeClass('block_main-footer__form-button__text-active');
            $('.block_main-footer__form-button__text-error ').removeClass('block_main-footer__form-button__text-active');
            $('.block_main-footer__form-button__text-success').addClass('block_main-footer__form-button__text-active');
            $('.block_main-footer__form-button').addClass('block_main-footer__form-button__success');
            setTimeout(function() {
                $('.block_main-footer__form-button__text-success').removeClass('block_main-footer__form-button__text-active');
                $('.block_main-footer__form-button').removeClass('block_main-footer__form-button__success');
                $('.block_main-footer__form-button__text-normal').addClass('block_main-footer__form-button__text-active');
            }, 3000);
        }
        else {
            $('.block_main-footer__form-button__text-normal').removeClass('block_main-footer__form-button__text-active');
            $('.block_main-footer__form-button__text-success').removeClass('block_main-footer__form-button__text-active');
            $('.block_main-footer__form-button__text-error ').addClass('block_main-footer__form-button__text-active');
            $('.block_main-footer__form-button').addClass('block_main-footer__form-button__error');
            setTimeout(function() {
                $('.block_main-footer__form-button__text-error ').removeClass('block_main-footer__form-button__text-active');
                $('.block_main-footer__form-button').removeClass('block_main-footer__form-button__error');
                $('.block_main-footer__form-button__text-normal').addClass('block_main-footer__form-button__text-active');
            }, 3000);
        }
    }
    $('.block_main-footer__form').ajaxChimp({
        url: '', // yourlink
        callback: callbackFunction
    })
};

// Countdown Function
function countdownInit() {
    // Paste Your date in .countdown('')
    $('.block_main-header__countdown').countdown('2017/01/01').on('update.countdown', function(event) {
        var $this = $(this).html(event.strftime(''
            + '<div class="block_main-header__countdown-item"><div class="block_main-header__countdown-counter">%D</div> <div>Day%!d</div></div>' // Days
            + '<div class="block_main-header__countdown-item"><div class="block_main-header__countdown-counter">%H</div> <div>Hours</div></div>' // Hours
            + '<div class="block_main-header__countdown-item"><div class="block_main-header__countdown-counter">%M</div> <div>Min</div></div>' // Minutes
            + '<div class="block_main-header__countdown-item"><div class="block_main-header__countdown-counter">%S</div> <div>Sec</div></div>' // Seconds
            ));
 });
};

$(document).ready(function() {
    countdownInit();
    AJAXMailChimpSending();
    sliderInit();
});

