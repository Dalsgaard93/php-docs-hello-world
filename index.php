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
        echo "Code to get token pair: updated <br />";

        // Display result
        echo $_GET['code'];

        if(array_key_exists('button1', $_POST)) {
            CallAPI();
        }

        function button1() {
            echo "This is Button1 that is selected";
        }

        function GenerateConnectLink()
        {   
            //Generate connect-link
            $client_id="aiiapoc-92cd7c26-3ca6-404d-9b1c-3dee11a15c81";
            $redirect_uri="https://aiia-test-site.azurewebsites.net/";
            $connect_link="https://api-sandbox.aiia.eu/v1/oauth/connect?client_id=".$client_id."&redirect_uri=".$redirect_uri."&response_type=code";

            header('location : $connect_link')
        }


        

    ?>
  
    <form method="post">
        <input type="submit" name="button1"
                class="button" value="Go to Aiia" onClick="window.location = ' />
    </form>
</body>
  
</html>