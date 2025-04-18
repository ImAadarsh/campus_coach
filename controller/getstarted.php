<?php
// Assuming this code is in phoneEmail.php

include "../include/connect.php";
session_start();

function parseQueryString($url) {
    $parsedUrl = parse_url($url);
    $queryString = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';
    // echo "Query string: $queryString<br>"; 

    $queryParams = array();
    
    // Split query string by '&' to handle multiple parameters
    $parts = explode('?', $queryString);
    foreach ($parts as $part) {
        // Split each part by '=' to get key-value pairs
        $param = explode('=', $part);
        if (count($param) == 2) {
            $key = $param[0];
            $value = $param[1];
            $queryParams[$key] = $value;
        }
    }
    // print_r($queryParams);
    return $queryParams;
}


// Get the current URL
$currentUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// echo $currentUrl;

// Parse the query string parameters from the URL
$params = parseQueryString($currentUrl);

// Check if both ws_id and access_token are set in the URL parameters
if(isset($params['ws_id']) && isset($params['access_token'])){
    echo $params['ws_id'];
    echo "<br>dwf";
    echo $params['access_token'];
    
    $ws_id = $params['ws_id']; // Get ws_id from the URL parameters
    $access_token = $params['access_token']; // Get access_token from the URL parameters

    $CLIENT_ID = '13155789032170991970';
    $ch = curl_init();
    $url = "https://eapi.phone.email/getuser";
    $postData = array(
        'access_token' => $access_token,
        'client_id' => $CLIENT_ID
    );

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url); // URL to submit the POST request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it directly
    curl_setopt($ch, CURLOPT_POST, true); // Set the request type to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Set the POST data
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL certificate verification (not recommended in production)

    $response = curl_exec($ch);
        // print_r($response);
    if ($response === false) {
        // echo "cURL error: " . curl_error($ch);
        // header('Location: ../index.php');
    }

    curl_close($ch);

    $json_data = json_decode($response,true);
    $country_code = $json_data['country_code'];
    $phone_no = $json_data['phone_no'];
    $ph_email_jwt = $json_data['ph_email_jwt'];
    setcookie('ph_email_jwt', $ph_email_jwt, time() + (86400 * 30), "/"); // 86400 = 1 day
   
    $data_array = array(
        "mobile" => $phone_no,
        "country_code" => $country_code
    );

    $make_call = callAPI('POST', 'getstarted', json_encode($data_array), NULL);
    $response = json_decode($make_call, true);
    print_r($response);

    if($response['data']['id']){
        echo "<script>alert('".$response['message']."')</script>";
    }

    if($response['status'] == false){
        echo "<script>alert('".$response['message']."'); window.location.href='../index.php';</script>";
    }

    if ($response['status'] == true && $response['data']['remember_token']&&$response['data']['is_data']==1) {
        $_SESSION['email'] =  $response['data']['email'];
        $_SESSION['name'] = $response['data']['first_name'];
        $_SESSION['mobile'] = $response['data']['mobile'];
        $_SESSION['token'] = $response['data']['remember_token'];
        $_SESSION['userid'] = $response['data']['id'];
        $_SESSION['profile'] = $response['data']['icon'];
        $_SESSION['banner'] = $response['data']['banner'];
        $_SESSION['is_data'] = $response['data']['is_data'];
        $_SESSION['is_email'] = $response['data']['email_verified'];
        $_SESSION['cart_id'] = $response['cart_id'];
        $_SESSION['type'] = 'user';
        
        if(!empty($ws_id)){
            header('location: ../../workshop-details.php?id='.$ws_id);
        } else {
            header('location: ../dashboard/index.php');
        }
    }
    if ($response['status'] == true && $response['data']['remember_token']&&$response['data']['is_data']==0) {
        $_SESSION['mobile'] = $response['data']['mobile'];
        $_SESSION['token'] = $response['data']['remember_token'];
        $_SESSION['userid'] = $response['data']['id'];
        $_SESSION['is_data'] = $response['data']['is_data'];
        $_SESSION['cart_id'] = $response['cart_id'];
        $_SESSION['type'] = 'user';
        header('location: ../dashboard/registration.php');
    }
} else {
    // Redirect to index.php if ws_id or access_token is not provided in the URL
    header('Location: ../index.php');
}
?>
