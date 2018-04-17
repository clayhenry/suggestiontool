function triggerGenerator() {

    gtag('event', 'click', {
        event_category: 'Generator',
        event_label: 'Submit',
        value : 'Version-1'
    });

    var spinner = "<div id=\"spinner\" style=\"text-align: center;\">\n" +
        "<img src=\"animated-loader-gif.gif\"  style=\"width:100px; height:100px;\">\n" +

        "\n" +
        "</div>";


    if(field.value.length > 0){
        spinnerDiv.innerHTML = spinner
        stats.innerHTML = "Fetching..."
        GetGeneratorData();


    } else{

        alert("Your post is empty")
    }
}


function copyToClipboard(){

    gtag('event', 'click', {
        event_category: 'Generator',
        event_label: 'Clipboard'
    });

    hiddentext.select();
    document.execCommand("Copy");
}

function copyOnArticle(){
    gtag('event', 'click', {
        event_category: 'Generator',
        event_label: 'Article'
    });

}


var shootEvent =1;
function scrollEvent(type){

    var currentScroll = window.scrollY + 600;
    var bottomPossition = bottomDiv.offsetTop;

    if(currentScroll >= bottomPossition){

        if(shootEvent == 1){
            shootEvent = 0;

            gtag('event', 'scroll', {
                event_category: 'Page',
                event_label: type,
                value : 'Version-1'
            });

            console.log("bottom");
        }



    }
}

function scrollToResults(){
    spinnerDiv.innerHTML = "";

    promoDiv.scrollIntoView({
        behavior: 'smooth', block: 'start'
    });
}

