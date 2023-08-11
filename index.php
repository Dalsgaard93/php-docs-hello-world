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