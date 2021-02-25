// var controller = new ScrollMagic.Controller();

// var headerShrinkTween = new TweenMax.fromTo('#header', 1, {scaleY: 1}, {scaleY: 0.25});
// // var navbarMoveTween = new TweenMax.to('#sticky-navbar', 1, {y: -100});

// new ScrollMagic.Scene({
//         // duration: 100,
//         offset: 50     // start animation at this scroll position
//         // triggerElement: '#sticky-navbar'
//     })
//     .setTween(headerShrinkTween)
//     // .setTween([headerShrinkTween, navbarMoveTween])
//     // .addIndicators()
//     // .setPin("#header")
//     .addTo(controller);

var newsItems = [
    {
        date: "Jan 2021",
        headline: "Purchase of new CNC machine",
    },
    {
        date: "Jan 2021",
        headline: "New PC for Photogrammetry",
    },
    {
        date: "Nov 2020",
        headline: "Seeking new consultancy contracts",
    },
    {
        date: "Nov 2020",
        headline: "QuEST contract complete",
    },
    {
        date: "Feb 2019",
        headline: "New contract with QuEST",
    },
];

// add news items to page
var newsTickerList = document.getElementById("news-ticker-list");

newsItems.forEach(newsItem => {
    var listItemNode = document.createElement("li");
    listItemNode.classList.add("news");

    var timeNode = document.createElement("time");
    timeNode.classList.add("news__date");
    var timeText = document.createTextNode(newsItem.date);
    timeNode.appendChild(timeText);

    var newsLinkNode = document.createElement("a");
    newsLinkNode.setAttribute("href", "news.html");
    newsLinkNode.innerText = newsItem.headline;

    var pNode = document.createElement("p");
    pNode.classList.add("news__title");
    pNode.appendChild(newsLinkNode);

    // link elements together
    listItemNode.appendChild(timeNode);
    listItemNode.appendChild(pNode);    
    newsTickerList.appendChild(listItemNode);
});
