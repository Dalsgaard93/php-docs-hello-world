<!DOCTYPE html>
<html>
      
<head>
    <title>
       2KPMG Aiia Demo
    </title>
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">
        Pisse fed aiia demo
    </h1>
      
    <h4>
        
    </h4>
      
    <?php

        if (isset($_GET['code'])) {
            // If code is present, display that
            echo "This is your code to get token pair:";
            echo '<br />';
            echo $_GET['code'];
            echo '<br />';

            //Using "Code", retrieve access-token and 1 hour refresh-token (Code Exchange)
            $ch = curl_init();
            echo 'api ongoing';
            curl_setopt($ch, CURLOPT_URL, "https://api-sandbox.aiia.eu/v1/oauth/token");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'X-Client-Id': 'aiiapoc-92cd7c26-3ca6-404d-9b1c-3dee11a15c81',
                'X-Client-Secret': '6e6c150ebcb36f90e8cd5c750c8c0ca42a8751b7d63f0110a465115dff4dec86',
                'Content-Type': 'application/json'
            ]);
            echo 'api ongoing 2';
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["grant_type" => "authorization_code", "redirect_uri" => "https://aiia-test-site.azurewebsites.net/", "code" => utf8_decode($_GET['code'])]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            echo 'api ongoing 3';
            $raw = curl_exec($ch);  
            echo 'raw: ';
            echo $raw;
            $code_exchange = json_decode($raw);
            curl_close($ch);
            
            if (isset($code_exchange)) {
                echo 'code exchange exists';
            } else {
                echo 'no code exchange';
            }
            
            
            //Using "Refresh" token, refresh access-token and get a 14 day refresh-token (Refresh Token Exchange)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api-sandbox.aiia.eu/v1/oauth/token");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'X-Client-Id: aiiapoc-92cd7c26-3ca6-404d-9b1c-3dee11a15c81',
                'X-Client-Secret: 6e6c150ebcb36f90e8cd5c750c8c0ca42a8751b7d63f0110a465115dff4dec86',
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["grant_type" => "refresh_token", "refresh_token" => $code_exchange->refresh_token]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            $refresh_token_exchange = json_decode(curl_exec($ch));
            curl_close($ch);
            echo $refresh_token_exchange;

            try {
                $serverName = "server-for-web-db.database.windows.net"; //serverName\instanceName
                $connectionInfo = array( "Database"=>"consent-token-db", "UID"=>"integrationadmin", "PWD"=>"AE55965F58D2CA359FB9A8B094850537a!");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
                if( $conn ) {
                    echo "Connection established.<br />";
                }else{
                    echo "Connection could not be established.<br />";
                    die( print_r( sqlsrv_errors(), true));
                }
    
/*
            
                $sql = "INSERT INTO [dbo].[code_exchange_to_token_pair]
                    ([access_token]
                    ,[expires_in]
                    ,[redirect_uri]
                    ,[refresh_token]
                    ,[token_type]
                    ,[consent_id])
                VALUES
                    ('$refresh_token_exchange->access_token'
                    ,'$refresh_token_exchange->expires_in'
                    ,'$refresh_token_exchange->redirect_uri'
                    ,'$refresh_token_exchange->refresh_token'
                    ,'$refresh_token_exchange->token_type'
                    ,'$_GET['consentId']')";

                echo $sql;
            /*
                $stmt = sqlsrv_query( $conn, $sql);
                if( $stmt === false ) {
                        die( print_r( sqlsrv_errors(), true));
                }
    */
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

/*
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "INSERT INTO dbo.code_e (Created,Host,ConsentID,AccessToken,RefreshToken,Client) VALUES (now(),'Frontpage','".$_GET['consentId']."','".$refresh_token_exchange->access_token."','".$refresh_token_exchange->refresh_token."','https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]')";
            echo($sql);
            $conn->query($sql);
            $conn->close();
*/
        } else {
   
            //Generate connect-link
            $client_id="aiiapoc-92cd7c26-3ca6-404d-9b1c-3dee11a15c81";
            $redirect_uri="https://aiia-test-site.azurewebsites.net/";
            $connect_link="https://api-sandbox.aiia.eu/v1/oauth/connect?client_id=".$client_id."&redirect_uri=".$redirect_uri."&response_type=code";
            
            //echo "Please follow this link to give consent to aiia: <br />";
            //echo $connect_link;
            echo "<a href=$connect_link title='Aiia Link' class='whatEver'>Click here to give consent to aiia</a>";
        }
    ?>
  
   <!-- <form method="post">
        <input type="submit" name="button1"
                class="button" value="Go to Aiia" />
    </form> -->
</body>
  
</html>