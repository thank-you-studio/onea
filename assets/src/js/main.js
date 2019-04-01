window.lazySizesConfig = window.lazySizesConfig || {};
lazySizesConfig.loadMode = 3;

function is_touch_device() {
    var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
    var mq = function (query) {
        return window.matchMedia(query).matches;
    }

    if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
        return true;
    }

    // include the 'heartz' as a way to have a non matching MQ to help terminate the join
    // https://git.io/vznFH
    var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
    return mq(query);
}

$(function () {
    PageTransitions.init()
    HeaderView.init()
    LoaderView.init()
    HeroView.init()
});

$(window).on('load', function () {
    LoaderView.loaded()
})