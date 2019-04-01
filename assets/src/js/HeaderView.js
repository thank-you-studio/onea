var HeaderView = {
    content: $('.main-header'),
    menuTrigger: $('.menu-trigger'),
    triggerNavTransition: function(){
        this.setMenuWidth()
        var dataColor = $('.main-header').data('color');
        if(this.menuTransition.progress()){
            this.menuTransition.reverse()
            $('.main-header').attr('data-color',dataColor)
            $('body').removeClass('nav-active')
        }else{
            $('.main-header').attr('data-color','dark')
            this.menuTransition.play()
            $('body').addClass('nav-active')
        }
    },
    setMenuWidth: function(){
        var menuWidth = $(window).width() - $('.language-switcher').outerWidth();
        if($(window).width() < 416){
            menuWidth = $(window).width();
        }
        $('.bg-layer').eq(1).width(menuWidth)
        $('.main-nav').width(menuWidth)
    },
    setupMenuTrigger: function(){
        this.menuTrigger.on('click touchstart',function(event){
            event.preventDefault()
            HeaderView.triggerNavTransition()
        });
    },
    setupMenuTransition: function(){
        var $layers = this.content.find('.bg-layer');
        this.menuTransition = new TimelineMax({
            onStart:function(){
                HeaderView.menuTrigger.addClass('active')
                $('.main-nav').addClass('active')
            },
            onReverseComplete:function(){
                HeaderView.menuTrigger.removeClass('active')
                $('.main-nav').removeClass('active')
            }
        })
        .staggerFromTo($layers, .75, {
            xPercent: 100
        },{
            xPercent:0,
            ease: Quart.easeInOut
        },.125,'start')
        .fromTo('.menubar li:not(:last-of-type)',.75,{
            autoAlpha:1
        },{
            autoAlpha:0,
            ease: Quart.easeInOut
        },'start')
        .fromTo('.language-switcher li',.75,{
            autoAlpha:0
        },{
            autoAlpha:1,
            delay:.5,
            ease: Quart.easeInOut
        },'start')
        .staggerFrom('.main-nav h4, .main-nav li',.375,{
            autoAlpha:0,
            x:-8,
            delay:.25,
            ease: Quart.easeInOut
        },-.05,'start')
        .pause()

        this.setupMenuTrigger()

    },
    init: function(){
        this.setupMenuTransition()
    }
};