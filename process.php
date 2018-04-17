<?php



if(!isset($_SERVER['SERVER_ADDR']) || $_SERVER['SERVER_ADDR'] == "127.0.0.1"){

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
}
else {

    $servername = "localhost";
    $username = "root";
    $password = "Osieczna1@";
}

$dbname = "hashtagmypost";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//$v = $pdo->query("select * from generatorusage")->fetch();


if(!empty($_POST)){

$lead_data["post"] = isset($_POST['post']) ? $_POST['post'] : "";
$lead_data["tags"] = isset($_POST['tags']) ? $_POST['tags'] : "";
$lead_data["maxHashtags"] = !empty($_POST['maxHashtags']) ? $_POST['maxHashtags'] : 2;



$lead_data["client_id"] = "c4e432c37799f525e8f55d5f31337cc4f3845c508d55";
$url = $_POST['url'] ."?". http_build_query($lead_data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json']
    );
//get the response here
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec ($ch);

curl_close($ch);

$ip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : "";
$post = filter_var(trim($lead_data["post"], FILTER_SANITIZE_STRING);
$refferal = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
$createdOn = date("Y-m-d H:i:s");

try {
    $stmt = $pdo->prepare("INSERT INTO visitors (ip, post,referral,created_on) VALUES (:ip, :post,:referral,:created_on)");
    $stmt->bindParam(':ip', $ip);
    $stmt->bindParam(':post', $post);
    $stmt->bindParam(':referral', $refferal);
    $stmt->bindParam(':createdOn ', $createdOn);
    $stmt->execute();
}

catch (PDOException $e){

    echo $e->getMessage();
}


echo $response;
};


function setVisitorData(){

//

}

?>