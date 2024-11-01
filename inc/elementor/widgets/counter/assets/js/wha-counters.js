var $ = jQuery;

function init_odometer(el) {
    if ($('.wha-counter-odometer', el).size() == 0)
        return;
    var odometer = $('.wha-counter-odometer', el).get(0);
    var format = $(el).closest('.wha-counter-box').data('number-format');

    format = format ? format : '(ddd).ddd';

    var od = new Odometer({
        el: odometer,
        value: $(odometer).text(),
        format: format
    });
    setTimeout(function () {
        od.update($(odometer).data('to'));
    }, 700);
}


$(document).ready(function () {

    window.odetrs_ar = [];

    $('.wha-counter').each(function (index) {
        if ($('.wha-counter-odometer', this).size() == 0)
            return;
        var odometer = $('.wha-counter-odometer', this).get(0);
        var format = $($('.wha-counter')[index]).parent().data('number-format');
        format = format ? format : '(ddd).ddd';
        window.odetrs_ar.push({
            od: new Odometer({
                el: odometer,
                value: $(odometer).text(),
                format: format
            }),
            i: index, el: $('.wha-counter')[index]
        });
    });

    var handler = function (entries, observer) {
        for (entry of entries) {
            if (entry.isIntersecting) {
                for (var i = 0; i < window.odetrs_ar.length; i++) {
                    if (window.odetrs_ar[i].el == entries[0].target) {
                        window.odetrs_ar[i].od.update($(window.odetrs_ar[i].el).find('.wha-counter-odometer').data('to'));

                    }
                }
            }
        }
    };

    for (var i = 0; i < window.odetrs_ar.length; i++) {
        let observer = new IntersectionObserver(handler);
        observer.observe(document.querySelectorAll(".wha-counter")[window.odetrs_ar[i].i]);
    }

});


$(window).on( 'elementor/frontend/init', function() {

    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope, $) {
        setTimeout(()=>{
            $scope.find('.wha-container-element .wha-counter-container').css({'opacity':1});
            $scope.find('.wha-container-element .lds-ripple').remove();
        },500);

    });

});