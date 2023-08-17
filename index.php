<!DOCTYPE html>
<html>
      
<head>
    <title>
       KPMG Aiia Demo!
    </title>
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">
        Pisse fed aiia demo!
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
            curl_setopt($ch, CURLOPT_URL, "https://api-sandbox.aiia.eu/v1/oauth/token");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Basic YWlpYXBvYy05MmNkN2MyNi0zY2E2LTQwNGQtOWIxYy0zZGVlMTFhMTVjODE6NmU2YzE1MGViY2IzNmY5MGU4Y2Q1Yzc1MGM4YzBjYTQyYTg3NTFiN2Q2M2YwMTEwYTQ2NTExNWRmZjRkZWM4Ng=='
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["grant_type" => "authorization_code", "redirect_uri" => "https://aiia-test-site.azurewebsites.net/", "code" => utf8_decode($_GET['code'])]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $code_exchange = json_decode(curl_exec($ch));
            curl_close($ch);
            //echo '$code_exchange[0]'
            

            /*
            if (isset($code_exchange)) {
                echo 'code exchange exists';
            } else {
                echo 'no code exchange';
            }
            */
            
            //Using "Refresh" token, refresh access-token and get a 14 day refresh-token (Refresh Token Exchange)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api-sandbox.aiia.eu/v1/oauth/token");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Basic YWlpYXBvYy05MmNkN2MyNi0zY2E2LTQwNGQtOWIxYy0zZGVlMTFhMTVjODE6NmU2YzE1MGViY2IzNmY5MGU4Y2Q1Yzc1MGM4YzBjYTQyYTg3NTFiN2Q2M2YwMTEwYTQ2NTExNWRmZjRkZWM4Ng==',
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["grant_type" => "refresh_token", "refresh_token" => $code_exchange->refresh_token]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            $refresh_token_exchange = json_decode(curl_exec($ch));
            curl_close($ch);

            if (isset($refresh_token_exchange)) {
                echo 'refresh token exists';
                echo $refresh_token_exchange->access_token;
            } else {
                echo 'no refresh token';
            }

            try {
                $serverName = "server-for-web-db.database.windows.net"; //serverName\instanceName
                $connectionInfo = array( "Database"=>"consent-token-db", "UID"=>"integrationadmin", "PWD"=>"AE55965F58D2CA359FB9A8B094850537a!");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
                if( $conn ) {
                    echo "Connection established.<br />";
               
                    /*
                    $sql = "INSERT INTO [dbo].[token_table_aiia]
                                ([access_token]
                                ,[refresh_token])
                            VALUES
                                ($refresh_token_exchange->access_token
                                ,$refresh_token_exchange->refresh_token)";

                    $stmt = sqlsrv_query( $conn, $sql);
                    if( $stmt === false ) {
                            die( print_r( sqlsrv_errors(), true));
                    }
    */
                }else{
                    echo "Connection could not be established.<br />";
                    die( print_r( sqlsrv_errors(), true));
                }

            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        
        

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