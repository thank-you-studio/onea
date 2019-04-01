var FrontPageView = Barba.BaseView.extend({
    namespace: 'frontpage',
    onEnter: function() {
        console.log('hello from frontpage')
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

FrontPageView.init()