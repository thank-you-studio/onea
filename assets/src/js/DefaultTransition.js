var DefaultTransition = Barba.BaseTransition.extend({
    setup: function(){
        this.$layers = $('.load-layer');
        TweenMax.set(this.$layers,{
            yPercent:-100
        })
    },
    start: function() {
        Promise
        .all([this.newContainerLoading, this.fadeOut()])
        .then(this.fadeIn.bind(this));
    },

    fadeOut: function() {
        var _this = this;
        var deferred = Barba.Utils.deferred()
        TweenMax.staggerFromTo('.load-layer', .75, {
            yPercent: 100
        },{
            yPercent:0,
            ease: Quart.easeInOut,
            onComplete:function(){
                deferred.resolve()
            }
        },.125)

        return deferred.promise;
    },

    fadeIn: function() {
        var _this = this;

        $(this.newContainer).css({
            'visibility':'visible'
        })

        TweenMax.set('.load-layer', {
            yPercent:100,
        })

        TweenMax.fromTo('#content-area', 1, {
            yPercent: 100,
        },{
            yPercent:0,
            ease: Quart.easeInOut
        }, _this.done())

        TweenMax.set(window, {
            scrollTo:0
        })
    }
});