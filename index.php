
<!DOCTYPE html>
<html>
      
<head>
    <title>
        How to call PHP function
        on the click of a Button ?
    </title>
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">
        Pisse fed aiia demo
    </h1>
      
    <h4>
        
    </h4>
      
    <?php
        echo "Code to get token pair: <br />";

        // Display result
        echo $_GET['code'];

        if(array_key_exists('button1', $_POST)) {
            button1();
        }

        function button1() {
            echo "This is Button1 that is selected";
        }
        
        // Method: POST, PUT, GET etc
        // Data: array("param" => "value") ==> index.php?param=value

        function CallAPI($method, $url, $data = false)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-sandbox.aiia.eu//v1/oauth/connect?client_id=aiiapoc-92cd7c26-3ca6-404d-9b1c-3dee11a15c81&scope=accounts%20offline_access%20payments%3Ainbound%20payments%3Aoutbound&redirect_uri=https%3A%2F%2Faiia-test-site.azurewebsites.net%2F&response_type=code',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 6e6c150ebcb36f90e8cd5c750c8c0ca42a8751b7d63f0110a465115dff4dec86'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
        }

    ?>
  
    <form method="post">
        <input type="submit" name="button1"
                class="button" value="Go to Aiia" />
    </form>
</body>
  
</html>