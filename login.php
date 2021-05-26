<?php
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BMA LOGIN FORM</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/login.css">
    </head>
    <body>
        
            <h1>
                BMA - Blind Men's Assistant App
            </h1>
        
            <form id="myform"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  autocomplete="off" required>
                  <label for="exampleFormControlInput1">Example Email ID</label>
                  <input type="email" class="form-control" id="Enter your Email ID" name="mail" onClick="getDetails(this.id)" placeholder="name@example.com">

                  <label for="exampleFormControlInput1">Example Password</label>
                  <input type="password" class="form-control" id="Enter Your Password" name="password" onClick="getDetails(this.id)" >
                
                  <label for="exampleFormControlSelect1">Explain the causes of your Impairment</label>
                  <select class="form-control" id="cause of your impairment" name="cause" onclick="selectdetails(this.id)">
                    <option value="" >Cause of your Impairment</option>
                    <option value="Birth related Disorder" >Birth related Disorder</option>
                    <option value="Uncorrected Refractive Errors" >Uncorrected Refractive Errors</option>
                    <option value="cataract">Cataract</option>
                    <option value="age-related macular degenerations">Age-related macular degeneration</option>
                    <option value="glaucoma">Glaucoma</option>
                    <option value="diabetic retinopathy">Diabetic Retinopathy</option>
                    <option value="corneal opacity">Corneal Opacity</option>
                    <option value="Trachoma">Trachoma</option>
                  </select>
               
                  <label for="exampleFormControlSelect2">Select Your Blood Group</label>
                  <select class="form-control" id="Your Blood Group" name="bloodgroup" onclick="selectdetails(this.id)"">
                    <option value="" >Your Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                  </select>

                  <label for="exampleFormControlSelect2">What Kind of Vision Impairment do you have?</label>
                  <select class="form-control" id="Your Vision Impairment" name="vision" onclick="selectdetails(this.id)">
                    <option value="" >Your Vision Impairment</option>
                    <option value="Distance vision impairment">Distance vision impairment</option>
                    <option value="Near vision impairment">Near vision impairment</option>
                  </select>

                  <label for="exampleFormControlTextarea1">Example Your Address</label>
                  <textarea class="form-control" id="Enter Your Address" name="address"  onClick="getDetails(this.id)"rows="3"></textarea>
           
                  <br>

                  <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit" id="submit">Submit</button>
               
              </form>
          

        
       
            <h2>
                Created By Mathesh T and Balaji P
                
            </h2>
       
     
        
        <script>

            
         
           

            function getDetails(detail)
            {
                responsiveVoice.speak(detail);

                var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
        
                var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
        
                var grammar = '#JSGF V1.0;'
        
                var recognition = new SpeechRecognition();
                var speechRecognitionList = new SpeechGrammarList();
                speechRecognitionList.addFromString(grammar, 1);
                recognition.grammars = speechRecognitionList;
                recognition.lang = 'en-US';
                recognition.interimResults = false;
        
                recognition.onresult = function(event) {
                    var last = event.results.length - 1;
                    var command = event.results[last][0].transcript;
                    alert(command);
                    document.getElementById(detail).value=command;
                    
                    
                };
        
                recognition.onspeechend = function() 
                {
                    recognition.stop();
                    alert("Speech Has Ended");
                };
        
                
        
                recognition.onerror = function(event) 
                {
                    //message.textContent = 'Error occurred in recognition: ' + event.error;
                    alert(event.error);
                }        
        
                    recognition.start();
                


                }

                function selectdetails(selectid)
                {
                    var uservalues = document.getElementById(selectid);
                    var selectedText = uservalues.options[uservalues.selectedIndex].innerHTML;
                    var selectedValue = uservalues.value;
                    responsiveVoice.speak(selectid+" is "+selectedValue);

                }


                window.onload = function()
              { 
                welcomespeech="Hi I am Helen, Your BMA Assistant. Please Login By Saying Your details to Me. I promise to keep it safe.";
                responsiveVoice.speak(welcomespeech);
              };

        </script>
        <script src="https://code.responsivevoice.org/responsivevoice.js?key=HdlQdSPC"></script>
        <script src="assets/jquery/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<?php

require("config.php");
require("shaping.php");
if(isset($_POST['submit']))
{
  $count = 0;

  $email =$_POST['mail'];
  $email = htmlspecialchars(strip_tags(($email)));
  $email =  mysqli_real_escape_string($conn, $email);
  

  $pass =$_POST['password'];
  $pass = htmlspecialchars(strip_tags(($pass)));
  $pass =  mysqli_real_escape_string($conn, $pass);
  

  $cause =$_POST['cause'];
  $cause = htmlspecialchars(strip_tags(($cause)));
  $cause =  mysqli_real_escape_string($conn, $cause);
  

  $bloodgroup =$_POST['bloodgroup'];
  $bloodgroup = htmlspecialchars(strip_tags(($bloodgroup)));
  $bloodgroup =  mysqli_real_escape_string($conn, $bloodgroup);

  $vision =$_POST['vision'];
  $vision = htmlspecialchars(strip_tags(($vision)));
  $vision =  mysqli_real_escape_string($conn, $vision);

  $address =$_POST['address'];
  $address = htmlspecialchars(strip_tags(($address)));
  $address =  mysqli_real_escape_string($conn, $address);


    $email_pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
        preg_match($email_pattern, $email, $email_matches);
        if (!$email_matches[0])
        {
        echo"<script>window.alert('Pls Enter Valid Email Id')</script>;";
        }
        else
        {
        $count=$count+1;
        }

        if (strlen($pass) < '4') 
        {
        echo"<script>window.alert('Pls Enter Password with atleast 4 characters')</script>;";
        } 
        else 
        {
            $count=$count+1;
        }


        if(strlen($cause)>0)
        {
            $count=$count+1;
        }
        else
        {
            echo"<script>window.alert('Pls Enter Valid Cause')</script>;";
        }

        if(strlen($vision)>0)
        {
            $count=$count+1;
        }
        else
        {
            echo"<script>window.alert('Pls Enter Valid Vision')</script>;";
        }

        if(strlen($address)>0)
        {
            $count=$count+1;
        }
        else
        {
            echo"<script>window.alert('Pls Enter Address')</script>;";
        }

        if(strlen($bloodgroup)>0)
        {
            $count=$count+1;
        }
        else
        {
            echo"<script>window.alert('Pls Enter Valid Blood Group')</script>;";
        }


      if($count==6)
      {
        $email=cryptfun('encrypt',$email);
        $pass=cryptfun('encrypt',$pass);  
        $cause=cryptfun('encrypt',$cause);    
        $bloodgroup=cryptfun('encrypt',$bloodgroup);  
        $vision=cryptfun('encrypt',$vision);  
        $address=cryptfun('encrypt',$address);  

      $sqli = "INSERT INTO user_details(user_email,user_password,user_cause,user_bg,user_vi,user_addr) VALUES ('$email','$pass','$cause','$bloodgroup','$vision','$address')";
      $sqlresult = mysqli_query($conn,$sqli);
      if($sqlresult == TRUE)
        {
            $sql = "SELECT `user_email` FROM `user_details` WHERE `s.no`=(select max(`s.no`) from `user_details` )";
            $result = mysqli_query($conn, $sql);
            
            
            $row = mysqli_fetch_assoc($result);
                
            $user_email= $row["user_email"];
            
            $_SESSION["username"] = $user_email;
            echo"<script>window.alert('Record Created Successfully')</script>;";

            // $cookie_name = "allen";
            // $cookie_value = $user_email;
            // $_COOKIE['allen'] = $cookie_value;
            
            echo "<script>location.replace('braille.php')</script>;";
        
      }
      else
      {
        echo"<script>window.alert('Try Again'+ mysqli_error($conn))</script>;";
      }
      }
      else
      {
        echo"<script>window.alert('Fill the Form Again')</script>;";
      }

  
  

  

mysqli_close($conn);
}

?>
