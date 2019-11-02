$(document).ready(function () {
    'use strict'

    const slick_campaign = $('.slick_campaign');

    slick_campaign.slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true,
        speed: 600,
        centerMode: false
    });

});
