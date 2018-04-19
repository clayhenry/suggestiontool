var recurCount = 0;
var hastags = "";

function GetGeneratorData (tags){

    var url =  ( recurCount == 0 ) ? "https://api.ritekit.com/v1/stats/auto-hashtag" : "https://api.ritekit.com/v1/stats/multiple-hashtags";

    console.log(recurCount);
    $.ajax({
        url: "process.php",
        data: {
            post: field.value,
            tags: tags,
            url : url,
            maxHashtags: maxtags.value
        },
        type: "POST",
        dataType : "json",
        success: function(result) {

            if(result.hashtags){
                stats = "<div class='list-group'>";

                for(var j = 0; j < result.stats.length; j ++){
                    var calss ="stat list-group-item ";
                    switch(result.stats[j].color){

                        case 0:
                            calss += "unused " ;
                            break;

                        case 1:
                            calss += "overused ";
                            break;

                        case 2:
                            calss += "good ";
                            break;

                        case 3:
                            calss += "great ";
                            break;

                    }

                    var span = " <span class='badge badge-info'>";
                    if(result.stats[j].hashtag ){
                        stats +=  "<div class="  + "'" + calss + "'" + " >";
                        stats += "<h3>#" + result.stats[j].hashtag + "</h3>"
                            + " <div><strong>Exposure: </strong> " + span + result.stats[j].exposure + "</span></div>"
                            + " <div><strong>Images: </strong>" + span + result.stats[j].images  + "</span></div>"
                            + " <div><strong>Links: </strong>" + span + result.stats[j].links + "</span></div>"

                            + " <div><strong>Mentions: </strong>" + span + result.stats[j].mentions  + "</span></div>"
                            + " <div><strong>Retweets: </strong>" + span + result.stats[j].retweets + "</span></div>"
                            + " <div><strong>Tweets: </strong>" + span + result.stats[j].tweets+ "</span></div>"

                            + "</div>"

                    }
                }
                stats += "</div>"
                hastags = "";
                statsdiv.innerHTML = stats;

            } else {

                var post = result.post;

                resultsdiv.innerHTML = post;
                hiddentext.value = post;

                var postTags = post.split(" ");
                for(var i= 0; i<postTags.length; i++ ){

                    if(postTags[i].indexOf("#") != -1){
                        hastags +=postTags[i].replace("#", " ").replace(".", "").replace(",","") + ",";
                    }
                }


                recurCount++;

            }
            if(recurCount == 1){
                GetGeneratorData(hastags)

                recurCount++;


                setTimeout(scrollToResults(), 3000 )
            }

            if(recurCount > 1){
                recurCount= 0;

            }



        }
    });

}

function SubmitUserData(){




}