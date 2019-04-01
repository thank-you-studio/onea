var ElementInView = {
    destroyInView: function(){
        if(this.controller){
            this.controller = this.controller.destroy(true);
            this.controller = new ScrollMagic.Controller();
        }
        if(ElementInView.pageScene){
            ElementInView.pageScene = ElementInView.pageScene.destroy(true);
        }
        if(ElementInView.scenes){
            for(i = 0; i < ElementInView.scenes.length; i++){
                ElementInView.scenes[i] = ElementInView.scenes[i].destroy(true);
            }
        }
    },
    setActiveDeeplink: function(id){
        $('.filter-nav a').each(function(){
            if ($(this).attr('href') == '#'+id){
                $(this).removeClass('faded')
            }else{
                $(this).addClass('faded')
            }
        })
    },
    filterNavDeeplink:function(){
        $('.filter-nav a').on('click touchstart', function(event){
            event.preventDefault();

            TweenMax.to(window, .75,{
                scrollTo: $(this).attr('href'),
                ease: Quart.easeInOut
            })
        });
    },
    setupInView: function(){
        this.scenes = []
        this.nestedScenes = []
        this.animatableScenes = []

        var $inViewEls = $('[data-inview]');
        var $gridEls = $('[data-module="grid"]');

        $gridEls.each(function(index, el){
            this.filterNavTransition = new TimelineMax()
            .fromTo($(this).find('.filter-nav'), .5,{
                autoAlpha:0,
                yPercent:-100
            },{
                autoAlpha:1,
                yPercent:0,
                force3D:true,
                ease: Quart.easeInOut
            },'intro')
            .staggerFromTo($(this).find('.filter-nav a'), .5,{
                autoAlpha:0,
                yPercent:-100
            },{
                autoAlpha:1,
                yPercent:0,
                force3D:true,
                ease: Quart.easeInOut
            },.125,'intro').pause()

            var _this = this;
            ElementInView.scenes[index] = new ScrollMagic.Scene({
                duration: $(this).height(),
                offset: $(window).height()*.5,
                reverse:true,
                triggerElement: this,
            })
            .on('enter', function (event) {
                if($(_this).hasClass('module--grid')){
                    $(_this).addClass('active')
                    _this.filterNavTransition.play()
                }
            })
            .on('leave', function (event) {
                if($(_this).hasClass('module--grid')){
                    $(_this).removeClass('active')
                    _this.filterNavTransition.reverse()
                }
            })
            ElementInView.scenes[index].addTo(ElementInView.controller)

            var $nestedGridEls = $(this).find('.grid-item');

            $nestedGridEls.each(function(index,el){
                var invertedEl = false;
                if($(el).data('color') == 'light'){
                    var invertedEl = true;
                }
                ElementInView.nestedScenes[index] = new ScrollMagic.Scene({
                    duration: $(el).height(),
                    offset: $(window).height()*.5,
                    reverse:true,
                    triggerElement: el,
                })
                .on('enter', function (event) {
                    ElementInView.setActiveDeeplink($(el).attr('id'))
                    console.log($(el).data('color'))
                    if(invertedEl){
                        $('.filter-nav').addClass('dark')
                    }
                })
                .on('leave', function (event) {
                    if(invertedEl){
                        $('.filter-nav').removeClass('dark')
                    }
                })
                ElementInView.nestedScenes[index].addTo(ElementInView.controller)
            })
        })




        $inViewEls.each(function(index, el){
            var $animatables = $(this).find('.text');
            var $animatablesImg = $(this).find('img');
            var _this = this;

            $animatablesImg.on('click',function(){
                $link = $(this).offsetParent().find('a').attr('href');
                if($link.length > 0){
                    Barba.Pjax.goTo($(this).offsetParent().find('a').attr('href'))
                }
            })
            $animatablesImg.on('mouseenter',function(){
                $link = $(this).offsetParent().find('a').attr('href');
                if($link.length > 0){
                    $(this).addClass('pointer')
                }
            })

            this.animateEls = new TimelineMax()
            // .fromTo($animatables, 1,{
            //     yPercent:10
            // },{
            //     yPercent:0,
            //     ease: Linear.easeNone
            // },'start')
            // .fromTo($animatablesImg, 1,{
            //     yPercent:-10,
            //     scale:1.25
            // },{
            //     yPercent:0,
            //     scale:1.25,
            //     ease: Linear.easeNone
            // },'start')

            ElementInView.animatableScenes[index] = new ScrollMagic.Scene({
                    triggerElement: this,
                    reverse:true,
                    duration:'150%',
                    triggerHook: 1,
                })
                .setTween( this.animateEls )
                // .addIndicators()
            ElementInView.animatableScenes[index].addTo(ElementInView.controller)


        })

    },
    init: function(){
        this.destroyInView()
        this.controller = new ScrollMagic.Controller();
        setTimeout(function(){
            ElementInView.setupInView()
        },500)
        PageTransitions.checkColorScheme($('.content-container'));
        this.filterNavDeeplink()
        this.setupGrid
    }
};