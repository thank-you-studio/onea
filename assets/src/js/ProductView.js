var ProductView = Barba.BaseView.extend({
    namespace: 'product',
    productCarrousel: null,
    setCarrouselLandscapeSlide: function(){
      var landscapeWidth = $('.swiper-container').find('.swiper-slide:not(.landscape)').eq(0).width()*2;
      $('.swiper-container').find('.landscape').each(function(){
        $(this).width($('.swiper-container').find('.swiper-slide:not(.landscape)').eq(0).width()*2)
      })    },
    setupShopCarrousel: function(){
        this.productCarrousel = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            speed:500,
            loop:true,
            touchRatio:2,
            threshold:1,
            grabCursor:true,
            slideToClickedSlide:true,
            keyboard: {
              enabled: true
            },
            on: {
              init: function (event) {
                ProductView.setCarrouselLandscapeSlide()
              }
            }
        }).on('change',function(event){
          Productview.setCarrouselLandscapeSlide()
        }).on('resize',function(event){
          Productview.setCarrouselLandscapeSlide()
        })
    },
    setActiveTab: function(li){
        if(!li.hasClass('active')){
            $('.tabs li').removeClass('active')
            $('.tabs .line-link').removeClass('active')
            $(li).addClass('active')
            $(li).find('.line-link').addClass('active')
        }else{
            li.removeClass('active')
            li.find('.line-link').removeClass('active')
        }
        TweenMax.to(window, .75,{
            scrollTo:'.shop',
            ease: Quart.easeInOut
        })
    },
    setupShopTabs: function(){
        $('.tab-title').on('click touchstart', function(event){
            event.preventDefault()
            ProductView.setActiveTab($(event.target).closest('li'))
        });
    },
    setupShopifyBuy: function(){
        productElId = this.$buyBtn.attr('id');
        productId = this.$buyBtn.data('shopify');
        console.log(productId)
        this.client = ShopifyBuy.buildClient({
            domain: 'oneadk.myshopify.com',
            apiKey: '920ccd429a53a08ad8c1978dac5ac73f',
            appId: '6'
        });
        this.ui = ShopifyBuy.UI.init(this.client).createComponent('product', {
            id: productId,
            node: this.$buyBtn[0],
            options: {
                "product": {
                "variantId": "all",
                "width": "100%",
                "contents": {
                    "img": false,
                    "imgWithCarousel": false,
                    "title": false,
                    "variantTitle": false,
                    "price": false,
                    "description": false,
                    "buttonWithQuantity": false,
                    "quantity": false
                  },
                  "styles": {
                    "product": {
                      "@media (min-width: 601px)": {
                        "max-width": "100%",
                        "margin-left": "0",
                        "margin-bottom": "50px"
                      }
                    },
                    "button": {
                      "width": "100%",
                      "background-color": "#000000",
                      "font-size": "16px",
                      "padding-top": "16px",
                      "padding-bottom": "16px",
                      "font-family":"Futura PT, Futura",
                      ":hover": {
                        "background-color": "#000000"
                      },
                      "border-radius": "0px",
                      ":focus": {
                        "background-color": "#000000"
                      }
                    },
                    "title": {
                      "font-size": "26px"
                    },
                    "price": {
                      "font-size": "18px"
                    },
                    "quantityInput": {
                      "font-size": "13px",
                      "padding-top": "14.5px",
                      "padding-bottom": "14.5px"
                    },
                    "compareAt": {
                      "font-size": "15px"
                    }
                  }
                },
                "cart": {
                  "contents": {
                    "button": true
                  },
                  "styles": {
                    "button": {
                      "background-color": "#000000",
                      "font-size": "13px",
                      "padding-top": "14.5px",
                      "padding-bottom": "14.5px",
                      ":hover": {
                        "background-color": "#000000"
                      },
                      "border-radius": "0px",
                      ":focus": {
                        "background-color": "#000000"
                      }
                    },
                    "footer": {
                      "background-color": "#ffffff"
                    }
                  }
                },
                "modalProduct": {
                  "contents": {
                    "img": false,
                    "imgWithCarousel": true,
                    "variantTitle": false,
                    "buttonWithQuantity": true,
                    "button": false,
                    "quantity": false
                  },
                  "styles": {
                    "product": {
                      "@media (min-width: 601px)": {
                        "max-width": "100%",
                        "margin-left": "0px",
                        "margin-bottom": "0px"
                      }
                    },
                    "button": {
                      "background-color": "#000000",
                      "font-size": "13px",
                      "padding-top": "14.5px",
                      "padding-bottom": "14.5px",
                      "padding-left": "30px",
                      "padding-right": "30px",
                      ":hover": {
                        "background-color": "#000000"
                      },
                      "border-radius": "0px",
                      ":focus": {
                        "background-color": "#000000"
                      }
                    },
                    "quantityInput": {
                      "font-size": "13px",
                      "padding-top": "14.5px",
                      "padding-bottom": "14.5px"
                    }
                  }
                },
                "toggle": {
                  "styles": {
                    "toggle": {
                      "background-color": "#000000",
                      ":hover": {
                        "background-color": "#000000"
                      },
                      ":focus": {
                        "background-color": "#000000"
                      }
                    },
                    "count": {
                      "font-size": "13px"
                    }
                  }
                },
                "productSet": {
                  "styles": {
                    "products": {
                      "@media (min-width: 601px)": {
                        "margin-left": "-20px"
                      }
                    }
                  }
                }
              }
          });
    },
    onEnter: function() {
        console.log('hello from product');
        // The new Container is ready and attached to the DOM.
    },
    onEnterCompleted: function() {
        this.$buyBtn = $('#buy-btn')
        this.setupShopCarrousel()
        this.setupShopTabs()
        this.setupShopifyBuy()
        // The Transition has just finished.
    },
    onLeave: function() {

        // A new Transition toward a new page has just started.
    },
    onLeaveCompleted: function() {
        console.log(Barba.HistoryManager.currentStatus().namespace)
        // The Container has just been removed from the DOM.
    }

});

ProductView.init()