var PageTransitions = {
    content : $('#content'),
    setupBarbaJs: function(){
        Barba.Pjax.Dom.wrapperId = 'content-area'
        Barba.Pjax.Dom.containerClass = 'content-container'

        Barba.Pjax.start();
        Barba.Prefetch.init();

        this.preventLoadingTheCurrentUrl()
        this.onTransitionCompleted()
        this.onLinkClicked()

        DefaultTransition.setup()
        Barba.Pjax.getTransition = function() {
            return DefaultTransition;
        };
    },
    checkColorScheme: function(el){
        colorScheme = $(el).find('.hero').data('color');
        if(!colorScheme){
            colorScheme = $('.content-container').data('dark')
        }
        if(colorScheme == 'light'){
            $('.main-header').attr('data-color', 'light')
        } else{
            $('.main-header').attr('data-color', 'dark')
        }

    },
    setCurrentUrlClass: function(){
        this.currentUrl = $('.content-container').data('url');
        $('a').each(function(){
            $(this).removeClass('current-url')
            this.url = $(this).attr('href');
            if(PageTransitions.currentUrl == this.url){
                if(location.pathname != '/' && location.pathname != '/de/'){
                    $(this).addClass('current-url')
                }
            }
        })
    },
    onTransitionCompleted: function(){
        Barba.Dispatcher.on('newPageReady', function() {
            if(HeaderView.menuTransition.progress()){
                HeaderView.menuTransition.reverse()
            }
        });
        Barba.Dispatcher.on('transitionCompleted', function(currentStatus, prevStatus) {
            PageTransitions.setCurrentUrlClass()
            PageTransitions.checkColorScheme($('.content-container'))
            $('body').removeClass('nav-active')
            if(!is_touch_device()){
                ElementInView.init()
            }
            ArticleModule.init()
            CarrouselModule.init()
        });
    },
    preventLoadingTheCurrentUrl: function() {
        var links = document.querySelectorAll('a[href]');
        var cbk = function(e) {
            if(e.currentTarget.href === window.location.href) {
                e.preventDefault();
                e.stopPropagation();
            }
        };

        for(var i = 0; i < links.length; i++) {
            links[i].addEventListener('click', cbk);
        }
    },
    onLinkClicked: function(){
        Barba.Dispatcher.on('linkClicked', function() {
            if(HeaderView.menuTransition.progress()){
                Barba.Pjax.getTransition = function() {
                    return FromNavTransition;
                };
            }else{
                Barba.Pjax.getTransition = function() {
                    return DefaultTransition;
                };
            }
        });
    },
    init: function(){
        this.setupBarbaJs()
        this.setCurrentUrlClass()
        this.checkColorScheme($('.content-container'))
        if(!is_touch_device()){
            ElementInView.init()
        }
        ArticleModule.init()
        CarrouselModule.init()
    }
};