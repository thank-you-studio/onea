var SupportView = Barba.BaseView.extend({
    namespace: 'support',
    toggleDropdownState: function(el){
        var $el = el;
        $('.dropdown-item').addClass('inactive');
        if ($el.hasClass('inactive')){
            $el.removeClass('inactive');
        }else{
            $el.addClass('inactive');
        }
    },
    setupDropdowns: function(){
        var $dropDownLink = $('.dropdown-link');

        $dropDownLink.on('click',function(event){
            event.preventDefault();

            $dropdownItem = $(this).parent().parent();
            SupportView.toggleDropdownState($dropdownItem);
        })

        var $firstDropDownLink = $dropDownLink.eq(0);

        console.log($firstDropDownLink,$firstDropDownLink.parent().parent())

        this.toggleDropdownState($firstDropDownLink.parent());
    },
    setupDeepLinks: function(){
        $('.deep-link').on('click',function(event){
            event.preventDefault();

            var $deeplink = $(this).closest('a');

            TweenMax.to(window, .75,{
                scrollTo:$deeplink.attr('href'),
                ease: Quart.easeInOut
            })
        })
    },
    onEnter: function() {
        this.setupDeepLinks()
        this.setupDropdowns()
        // The new Container is ready and attached to the DOM.
    },
    onEnterCompleted: function() {
        // The Transition has just finished.
    },
    onLeave: function() {
        // A new Transition toward a new page has just started.
    },
    onLeaveCompleted: function() {
        // The Container has just been removed from the DOM.
    }

});

SupportView.init()