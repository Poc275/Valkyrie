var controller = new ScrollMagic.Controller();

var headerShrinkTween = new TweenMax.fromTo('#header', 1, {scaleY: 1}, {scaleY: 0.25});
// var navbarMoveTween = new TweenMax.to('#sticky-navbar', 1, {y: -100});

new ScrollMagic.Scene({
        // duration: 100,
        offset: 50     // start animation at this scroll position
        // triggerElement: '#sticky-navbar'
    })
    .setTween(headerShrinkTween)
    // .setTween([headerShrinkTween, navbarMoveTween])
    // .addIndicators()
    // .setPin("#header")
    .addTo(controller);