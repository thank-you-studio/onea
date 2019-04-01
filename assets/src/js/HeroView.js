var HeroView = {
    content : $('.hero').eq(0),
    setupArrowClick: function(){
        HeroView.content.find('.hero-arrow').on('click touchstart',function(event){
            event.preventDefault()
            TweenMax.to(window, 1.5, {
                scrollTo:HeroView.content.next().offset().top,
                ease: Quart.easeInOut
            });
        })
    },
    init: function(){
        this.setupArrowClick()
    }
};