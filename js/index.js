var controller = new ScrollMagic.Controller();

var blockTween = new TweenMax.fromTo('#header', 1, {scaleY: 1}, {scaleY: 0.8});

new ScrollMagic.Scene({
        // duration: 100,
        offset: 100
        // triggerElement: '#sticky-navbar'
    })
    .setTween(blockTween)
    // .addIndicators()
    // .setPin("#header")
    .addTo(controller);