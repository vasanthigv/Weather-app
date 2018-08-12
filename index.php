<?php

    function curl($url) {
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $data = curl_exec($ch);
            curl_close($ch);
  
            return $data;
        } 

    if ($_GET['city']) {
        
        $urlContents = curl("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&type=accurate&appid=096204b8644fd4faa381c10457a53c86");
        
        $weatherArray = json_decode($urlContents, true);
        
        $weather = "The weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description'].".";
        
         $tempInCel = intval($weatherArray['main']['temp']-273.15);
        
         $speedInKMPH = intval($weatherArray['wind']['speed']*3.6);
        
        $weather .=" The temperature is ".$tempInCel."&deg;C  with a wind speed of ".$speedInKMPH." KMPH.";
        

        
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
      
 
      
  </head>
  <body>
      
     <div class="container">
         
        <h1>Find Out The Weather In Your Area</h1>
         
         <form>
          <div class="form-group">
            <h3><label for="city">Enter the name of a city</label></h3>
            <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. Hyderabad, Bangalore" value="<?php echo $_GET['city']; ?>">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
             
        </form>
         
         <div id="weather" >
          
         <?php 
          if(preg_match("/.*cloud.*/",$weatherArray['weather'][0]['description'])){ 
            echo '<style>
            body{
              background:url(cloudy.jpg) no-repeat center center fixed;
            }
            </style>';
          ?>
          <!-- <div class="cloudy"> -->
          <?php

          }
          else if(preg_match("/.*haze.*/",$weatherArray['weather'][0]['description'])){
             // echo "haze";
             echo '<style>
            body{
              background:url(haze.jpg) no-repeat center center fixed;
            }
            </style>';
          ?>

          <!-- <div class="haze"> -->
          <?php

          }
          else if(preg_match("/.*rain.*/",$weatherArray['weather'][0]['description'])){
          echo '<style>
            body{
              background:url(rainy.jpg) no-repeat center center fixed;
            }
            </style>'; 
          ?>
                <!-- <div class="rainy"> -->
          <?php
          }
          else if(preg_match("/.*sunny.*/",$weatherArray['weather'][0]['description'])){ 
             echo '<style>
            body{
              background:url(sunny.jpg) no-repeat center center fixed;
            }
            </style>'; 
          ?>
               <!-- <div class="sunny"> -->
          <?php
          }
          else if(preg_match("/.*sky.*/",$weatherArray['weather'][0]['description'])){ 
             echo '<style>
            body{
              background:url(sky.jpg) no-repeat center center fixed;
            }
            </style>'; 
          ?>
               <!-- <div class="sunny"> -->
          <?php
          }
          else if(preg_match("/.*drizzle.*/",$weatherArray['weather'][0]['description'])){ 
             echo '<style>
            body{
              background:url(rainy.jpg) no-repeat center center fixed;
            }
            </style>'; 
          ?>
               <!-- <div class="sunny"> -->
          <?php
          }
          else if(preg_match("/.*snow.*/",$weatherArray['weather'][0]['description'])){ 
             echo '<style>
            body{
              background:url(snow.jpg) no-repeat center center fixed;
            }
            </style>'; 
          ?>
               <!-- <div class="sunny"> -->
          <?php
          }
          else if(preg_match("/.*mist.*/",$weatherArray['weather'][0]['description'])){ 
             echo '<style>
            body{
              background:url(haze.jpg) no-repeat center center fixed;
            }
            </style>'; 
          ?>
               <!-- <div class="sunny"> -->
          <?php
          }
          else if(preg_match("/.*fog.*/",$weatherArray['weather'][0]['description'])){ 
             echo '<style>
            body{
              background:url(haze.jpg) no-repeat center center fixed;
            }
            </style>'; 
          ?>
               <!-- <div class="sunny"> -->
          <?php
          }
          else{
             echo '<style>
            body{
              background:url(background.jpg) no-repeat center center fixed;
            }
            </style>'; 
          
          }
            
            if($weather) {
                
                // echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
              echo '<div class="middle">'.$weather.'</div>';
                
            } else {
                
                if ($_GET['city'] !="") {
                    
                    echo '<div class="alert alert-danger" role="alert">Sorry, that city could not be found.</div>';
                }
            }
          
          ?>
        </div>
      
      </div>
         
      
      
      
      

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>