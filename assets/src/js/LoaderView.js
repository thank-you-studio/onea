var storageObj = {};
var LoaderView = {
    init:function(){
        $(window).scrollTop(0)
        $listEl = $('#preloader ul')
        // console.log($(window).height() - $('.hero').height() - $('.hero .wrapper .inner').height())
        this.loaderTimeline = new TimelineMax()
        .set($('.hero'),{
            height:$(window).height()
        })
        .set($listEl,{
            opacity:1
        })
        .fromTo($listEl, 3,{
            y:$listEl.height()
        },{
            y:$listEl.height()*-1 + $(window).height()*.5 + $('.hero .wrapper .inner').height()*.756097561,
            ease:Power4.easeInOut
        },'intro').
        to($('#preloader li:not(:last-child)'),1,{
            autoAlpha:0,
            ease:Quart.easeInOut,
            delay:1.75
        },'intro').
        from($('#preloader li:last-child span'),1,{
            width:0,
            opacity:0,
            ease:Quart.easeInOut,
            delay:2.5
        },'intro').
        // to($($listEl),1,{
        //     autoAlpha:0,
        //     ease:Quart.easeInOut,
        //     delay:3.5
        // },'intro').
        to($('#preloader'),1,{
            autoAlpha:0,
            ease:Quart.easeInOut,
            delay:3.5
        },'intro').
        fromTo($('.hero .image-wrapper'),3,{
            autoAlpha:0
        },{
            autoAlpha:1,
            ease:Quart.easeInOut,
            delay:3.5
        },'intro').
        fromTo($('.main-header'),1,{
            autoAlpha:0,
            y:-8
        },{
            y:0,
            autoAlpha:1,
            ease:Quart.easeOut,
            delay:3.5,
            onComplete:function(){
                $('html').removeClass('loading')
            }
        },'intro').
        staggerFromTo($('.hero .wrapper .inner > *'),1,{
            autoAlpha:0,
        },{
            autoAlpha:1,
            ease:Quart.easeOut,
            delay:3,
        },-.25,'intro')
        .to($('.hero'),1,{
            height:$(window).height() - $('.main-header').height(),
            delay:4.5,
            ease:Quart.easeOut
        },'intro').pause()
    },
    setLocalStorage:function(){
        storageObj = {
            loaded: true,
            timestamp: new Date().getTime()
        }
        localStorage.setItem("loader", JSON.stringify(storageObj));
    },
    compareLocalStorageTimestramp:function(){
        if(!storageObj.length){
            return true;
        }else{
            var object =
                JSON.parse(localStorage.getItem("loader")),
                localDate = object.timestamp,
                now = new Date().getTime();

            return (now - (24 * 60 * 60 * 1000)) >= localDate;

        }
    },
    loaded:function(){
        var _this = this;
        $(window).scrollTop(0)
        if(this.compareLocalStorageTimestramp()){
            setTimeout(function(){
                _this.loaderTimeline.play()
            },1000)
            this.setLocalStorage()
        }else{
            _this.loaderTimeline.progress(1)
        }
    }
}