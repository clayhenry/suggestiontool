<!doctype html>

<html lang="en">


<head>
<meta charset="utf-8">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<body>
<style>

body {
    margin-top:5%;
  font-family: 'Raleway', sans-serif;
}

textarea {
    width:90%;
    height:100px;
}
    .good{
            color: green;
    }

    .unused {

        color: gray;
    }

    .great {
        color: yellow;

    }
    .overused {

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

</style>
<div class="container">

    <div class=form-group>
        <textarea id="field" class="form-control"></textarea>
    </div>
    <div class=form-group style="text-align:center">
        <input type="submit" id="submit" class="btn btn-primary" value="Generate Post with Hastags" onclick="submit()" />
    </div>


<div id="spinner" style=" display: none;">
    <img src="animated-loader-gif.gif">

</div>

<div id ="results" class="alert alert-primary" style="font-size:21px; text-align:center">Is #ArtificialIntelligence the future of #CustomerService?</div>
<div id ="suggestions"></div>
<div id="stats">
    <ul class="list-group">
        <li class=" list-group-item good "><h3>#artificialintelligence</h3> <strong>Exposure:</strong> <span class="badge badge-info">200279</span>  Images: 0.1012658 Links: 0.1012658 Mentions: 0.4177215 Retweets: 125 Tweets: 79</li>
        <li class=" list-group-item overused "><h3>#customerservice</h3> <strong>Exposure:</strong>: 66088 Images: 0.0434783 Links: 0.0434783 Mentions: 0 Retweets: 12 Tweets: 92</li>
    </ul>

</div>


<script>
    var field = document.getElementById("field");
    var resultsdiv = document.getElementById("results");
    var statsdiv = document.getElementById("stats");

    var spinner = document.getElementById("spinner");


var recurCount = 0;
var hastags = "";


function callApi(tags = ""){

    spinner.setAttribute("style", "display:block; position:absolute; width:100%; text-align: center; top:20%; z-index:999");

    var url =  ( recurCount == 0 ) ? "https://api.ritekit.com/v1/stats/auto-hashtag" : "https://api.ritekit.com/v1/stats/multiple-hashtags";

    $.ajax({
        url: "http://localhost.test/suggestion/process.php",
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
                           + " <strong>Links: </strong>" + span + result.stats[j].links + "</span><br />"
                           + " <strong>Mentions: </strong>" + span + result.stats[j].mentions  + "</span>"
                           + " <strong>Retweets: </strong>" + span + result.stats[j].retweets + "</span>"
                           + " <strong>Tweets: </strong>" + span + result.stats[j].tweets+ "</span>"

                           + "</li>"

                   }
               }
               stats += "</ul>"

                statsdiv.innerHTML = stats;
                spinner.style.display = "none";

            }

            if(recurCount == 0){
            var post = result.post;

            resultsdiv.innerHTML = post;

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

          callApi();
  
  
 

    }


</script>
</div>
</body>
</html>
