<?php
if (isset($_GET['code'])) {
    
    //Using "Code", retrieve access-token and 1 hour refresh-token (Code Exchange)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.aiia.eu/v1/oauth/token");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic Y29ubmVjdGVkX2NsaWVudHMtMjdkNGMyZjQtNmVmMy00OGE0LTkzZDYtZTA3OGVmYzcwNWQ4OjhmNTg4NDhmYWMzYTE5NTJkZjE2ZWY3MDY2ODVlYTkxZDJmNDlhYjM4MmMwZjJlMjljMjg0MmYxN2Q3OGQxZGU=',
        'Cache-Control: no-cache',
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["grant_type" => "authorization_code", "redirect_uri" => "https://connected-clients.com", "code" => utf8_decode($_GET['code'])]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    $code_exchange = json_decode(curl_exec($ch));
    curl_close($ch);
    
    //Using "Refresh" token, refresh access-token and get a 14 day refresh-token (Refresh Token Exchange)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.aiia.eu/v1/oauth/token");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic Y29ubmVjdGVkX2NsaWVudHMtMjdkNGMyZjQtNmVmMy00OGE0LTkzZDYtZTA3OGVmYzcwNWQ4OjhmNTg4NDhmYWMzYTE5NTJkZjE2ZWY3MDY2ODVlYTkxZDJmNDlhYjM4MmMwZjJlMjljMjg0MmYxN2Q3OGQxZGU=',
        'Cache-Control: no-cache',
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["grant_type" => "refresh_token", "refresh_token" => $code_exchange->refresh_token]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    $refresh_token_exchange = json_decode(curl_exec($ch));
    curl_close($ch);
     
    //Save credentials in database
    $servername = "connected-clients.com.mysql";
    $username = "connected_clients_comconnected_clients";
    $password = "xxx";
    $dbname = "connected_clients_comconnected_clients";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO Tokens (Created,Host,ConsentID,AccessToken,RefreshToken,Client) VALUES (now(),'Frontpage','".$_GET['consentId']."','".$refresh_token_exchange->access_token."','".$refresh_token_exchange->refresh_token."','https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]')";
    echo($sql);
    $conn->query($sql);
    $conn->close();

} else {

    //Generate connect-link
    $client_id="connected_clients-27d4c2f4-6ef3-48a4-93d6-e078efc705d8";
    $redirect_uri="https%3A%2F%2Fconnected-clients.com";
    $connect_link="https://api.aiia.eu/v1/oauth/connect?client_id=".$client_id."&redirect_uri=".$redirect_uri."&response_type=code";
    //https://api.aiia.eu/v1/oauth/connect?client_id=connected_clients-27d4c2f4-6ef3-48a4-93d6-e078efc705d8&redirect_uri=https%3A%2F%2Fconnected-clients.com&response_type=code

}?>