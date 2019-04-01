var swipers = [];
var CarrouselModule = {
    content: $('[data-module="product_carrousel"] .swiper-container'),
    setupCarrousel: function(index, el){
        console.log(index, el)
        swipers[index] = new Swiper(el, {
            // Default parameters
            slidesPerView: 'auto',
            touchRatio:2,
            loop:true,
            speed:1000,
            parallax:true,
            grabCursor:true,
            touchRatio:2,
            threshold:1,
            // allowTouchMove:false,
            slideToClickedSlide:true,
            navigation: {
                nextEl: '.button-next',
                prevEl: '.button-prev',
            },
            keyboard: {
                enabled: true
            },
            breakpoints: {
                9999: {
                    parallax:true
                },
                768: {
                    parallax:false
                }
            }
        })

        // $(swipers[index].el).on('mousemove',function(event){
        //     console.log(event.screenX)
        //     if(event.screenX < swipers[index].width*.5){
        //         var move = event.screenX*-.125;
        //     }else{
        //         var move = event.screenX*-.125;
        //         console.log('right')
        //     }
        //     swipers[index].setTranslate(move)
        // })
        // $(el).find('.swiper-slide').on('click',function(event){
        //     event.preventDefault()
        //     swipers[index].slideTo($(this).index())
        // });
    },
    init: function(){
        $('[data-module="product_carrousel"] .swiper-container').each(function(index, el){
            CarrouselModule.setupCarrousel(index, el);
    })
    }



};