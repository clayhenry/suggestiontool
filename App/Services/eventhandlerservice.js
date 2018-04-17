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
        resultsdiv.innerHTML = spinner
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


var shootEvent =1;
function scrollEvent(){

    var currentScroll = window.scrollY + 600;
    var bottomPossition = bottomDiv.offsetTop;

    if(currentScroll >= bottomPossition){

        if(shootEvent == 1){
            shootEvent = 0;

            gtag('event', 'scroll', {
                event_category: 'Page',
                event_label: 'ScrollToBottom',
                value : 'Version-1'
            });

            console.log("bottom");
        }



    }
}

function scrollToResults(){
    resultsdiv.scrollIntoView({
        behavior: 'smooth', block: 'start'
    });
}

