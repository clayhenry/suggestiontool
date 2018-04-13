<?php
if(!empty($_POST)){


$lead_data["url"] = $_POST['url'];
$lead_data["post"] = isset($_POST['post']) ? $_POST['post'] : "";
$lead_data["tags"] = isset($_POST['tags']) ? $_POST['tags'] : "";
$lead_data["client_id"] = "c4e432c37799f525e8f55d5f31337cc4f3845c508d55";
$url = $lead_data["url"] ."?". http_build_query($lead_data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [                                                                          
        'Content-Type: application/json']                                                                       
    );                                                
//get the response here
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec ($ch);
echo $response;
}

?>