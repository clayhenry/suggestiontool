
<!doctype html>

<html lang="en">


<head>
<meta charset="utf-8">
    <title>Hashtag Generator For All Mayor Social Media Platforms - Hashtag My Post</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<body>
<style>

body {
  font-family: 'Raleway', sans-serif;
}

h1 {

    font-family: 'Rajdhani', sans-serif;
    color: #205ea0
}

.subs {

    font-family: 'Rajdhani', sans-serif;
    color: #205ea0;
    font-size: 20px;
}

h2 {
    font-family: 'Rajdhani', sans-serif;
    color: #205ea0;
    font-size: 24px;
}



p {

    font-size: 20px;
    color: black;

    padding: 5px 80px;
}

textarea {
    width:90%;
    height:100px;
}
    .good h3{
            color: green;
    }

    .unused h3 {

        color: gray;
    }

    .great h3{
        color: yellow;

    }
    .overused h3{

        color: darkred;
    }
    .spinner {


        display: block;
        position: absolute;
        width: 100%;
        text-align: center;
        top: 20%;
        z-index: 99;
    }
ul.list-group li {padding: 30px 50px;}
.badge-info {
    background-color: #00438a;
    margin: 5px;
    font-size: 85%
}


</style>
<div class="container">
    <div style="text-align: center; padding: 20px;">
        <h1>Hashtag My Post</h1>
        <span class="subs">Get the best, most effective <strong> #hashtags </strong>for your post</span>
        <br><br>
    </div>
    <div class=form-group>
        <textarea id="field" class="form-control" placeholder="Your Post here..." ></textarea>
    </div>
    <div class=form-group style="text-align:center">
        <input type="submit" id="submit" class="btn btn-primary" value="Generate You Post With Hashtags" onclick="submit()" />
    </div>




<div id ="results" class="alert alert-primary" style="font-size:21px; text-align:center">I can't <strong>#change</strong> the direction of the <strong>#wind</strong>, but I can adjust my sails to always reach my destination.</div>

    <div style="float: right">
    <input type="submit" id="submit" class="btn btn-light" value="Copy To Clipboard" onclick="copyToClipboard()" />
    </div>

    <div style="clear: both"></div>
    <div style="text-align: center; padding: 10px;">
        <h2>In the last hour...</h2>
    </div>
<div id="stats">
    <ul class="list-group" style="/* text-align: center */"><li class=" list-group-item good "><h3>#thankyou</h3> <strong>Exposure: </strong>  <span class="badge badge-info">120562</span> <strong>Images: </strong> <span class="badge badge-info">0.2151899</span> <strong>Links: </strong> <span class="badge badge-info">0.2151899</span> <strong>Mentions: </strong> <span class="badge badge-info">0.4810127</span> <strong>Retweets: </strong> <span class="badge badge-info">79</span> <strong>Tweets: </strong> <span class="badge badge-info">79</span></li><li class=" list-group-item good "><h3>#change</h3> <strong>Exposure: </strong>  <span class="badge badge-info">166467</span> <strong>Images: </strong> <span class="badge badge-info">0.137931</span> <strong>Links: </strong> <span class="badge badge-info">0.137931</span> <strong>Mentions: </strong> <span class="badge badge-info">0.0689655</span> <strong>Retweets: </strong> <span class="badge badge-info">4</span> <strong>Tweets: </strong> <span class="badge badge-info">58</span></li></ul>

</div>

    <div style="text-align: center; padding: 20px;">
        <h2>Nice, but how are my post hashtags generated?</h2>
    </div>

    <p>As great as Hastagmypost is, </p>


        <input type="text" style="display: none" id="hiddentext">
        




<script>
    var field = document.getElementById("field");
    var resultsdiv = document.getElementById("results");
    var statsdiv = document.getElementById("stats");
    var hiddentext = document.getElementById("hiddentext");

var recurCount = 0;
var hastags = "";


function callApi(tags = ""){

  //  spinner.setAttribute("style", "display:block");

    var url =  ( recurCount == 0 ) ? "https://api.ritekit.com/v1/stats/auto-hashtag" : "https://api.ritekit.com/v1/stats/multiple-hashtags";

    $.ajax({
        url: "http://localhost/hashiffy/process.php",
        data: {
            post: field.value,
            tags: tags,
            url : url
        },
        type: "POST",
        dataType : "json",
        success: function(result) {

            if(result.hashtags){
                stats = "<ul class='list-group'>";

               for(var j = 0; j < result.stats.length; j ++){
                var calss =" list-group-item ";
                   switch(result.stats[j].color){

                         case 0: 
                            calss = "unused " ;
                            break;
                        
                        case 1: 
                            calss = "overused ";
                            break;
                        
                        case 2: 
                            calss += "good ";
                            break;

                        case 3: 
                            calss = "great ";
                            break;
 
                   }

                   console.log(calss);

                   var span = " <span class='badge badge-info'>";
                   if(result.stats[j].hashtag ){
                       stats +=  "<li class="  + "'" + calss + "'" + " >"
                           + "<h3>#" + result.stats[j].hashtag + "</h3>"
                           + " <strong>Exposure: </strong> " + span + result.stats[j].exposure + "</span>"
                           + " <strong>Images: </strong>" + span + result.stats[j].images  + "</span>"
                           + " <strong>Links: </strong>" + span + result.stats[j].links + "</span>"
                           + " <strong>Mentions: </strong>" + span + result.stats[j].mentions  + "</span>"
                           + " <strong>Retweets: </strong>" + span + result.stats[j].retweets + "</span>"
                           + " <strong>Tweets: </strong>" + span + result.stats[j].tweets+ "</span>"

                           + "</li>"

                   }
               }
               stats += "</ul>"

                statsdiv.innerHTML = stats;

            }

            if(recurCount == 0){
            var post = result.post;

            resultsdiv.innerHTML = post;
                hiddentext.value = post;

                console.log(post)

            var postTags = post.split(" ");
                for(var i= 0; i<postTags.length; i++ ){

                        if(postTags[i].indexOf("#") != -1){
                            hastags +=postTags[i].replace("#", " ").replace(".", "").replace(",","") + ",";
                        }
                }
            recurCount ++;
            }

              if(recurCount == 1) {
                  callApi(hastags)

                    recurCount++;
              } 

              recurCount++;


        }
    });


}

    function submit() {

    var spinner = "<div id=\"spinner\" style=\"text-align: center;\">\n" +
        "    <img src=\"animated-loader-gif.gif\"  style=\"width:100px; height:100px;\">\n" +
        "    <span style=\"font-weight: bold; color:#007bff\">Generating your hashtag post with some cool additional info ...</span>\n" +
        "\n" +
        "</div>";

        resultsdiv.innerHTML = spinner;
        statsdiv.innerHTML = "";
          callApi();

    }


    function copyToClipboard(){
        hiddentext.select();
        document.execCommand("Copy");
    }


</script>
</div>
</body>
</html>
