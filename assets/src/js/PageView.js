var PageView = Barba.BaseView.extend({
    namespace: 'page',
    onEnter: function() {
        console.log('hello from page')
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

PageView.init()