<!DOCTYPE html>
<html>
      
<head>
    <title>
        KPMG Aiia Demo
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
            echo "This is your to get token pair:";
            echo '<br />';
            echo $_GET['code'];
            echo '<br />';

            //Using "Code", retrieve access-token and 1 hour refresh-token (Code Exchange)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api-sandbox.aiia.eu/v1/oauth/token");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'X-Client-Id: aiiapoc-92cd7c26-3ca6-404d-9b1c-3dee11a15c81',
                'X-Client-Secret: 6e6c150ebcb36f90e8cd5c750c8c0ca42a8751b7d63f0110a465115dff4dec86',
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["grant_type" => "authorization_code", "redirect_uri" => "https://aiia-test-site.azurewebsites.net/", "code" => utf8_decode($_GET['code'])]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
            $code_exchange = curl_exec($ch);
            $decoded_exchange = json_decode($code_exchange);
            echo $code_exchange;
            curl_close($ch);
            




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