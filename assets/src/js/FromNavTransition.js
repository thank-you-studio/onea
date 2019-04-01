var FromNavTransition = Barba.BaseTransition.extend({
    start: function() {
        Promise
        .all([this.newContainerLoading, this.fadeOut()])
        .then(this.fadeIn.bind(this));
    },

    fadeOut: function() {
        var _this = this;
        var deferred = Barba.Utils.deferred()
        TweenMax.set(window, {
            scrollTo:0,
            onComplete:function(){
                deferred.resolve()
            }
        });

        return deferred.promise;
    },

    fadeIn: function() {
        $(this.oldContainer).hide()
        $(this.newContainer).css({
            'visibility':'visible'
        })
        this.done()
    }
});