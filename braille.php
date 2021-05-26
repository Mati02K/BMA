<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/braille.css">
        <script src='https://unpkg.com/tesseract.js@v2.1.0/dist/tesseract.min.js'></script>
    </head>
    <body>
        <div class="bma">
            <h1>
                B-Blind
                <br>
                M-Men's
                <br>
                A-Assistant App
            </h1>
        </div>
        
                <img class="design1" src="assets/img/leftellipse.svg" />
         
                <img class="design2" src="assets/img/rightellipse.svg" />



        <div class="smartphone">
            <div class="row">
                <div class="col-8">
                  <h1>
                     B M A 
                   </h1>
                </div>
                <div class="col-4">
                    <img height="25" width="25" onclick="alert('Hi')" src="assets/img/camera.png">
                </div>
            </div>
            
                <textarea id="botmsg" name="botmsg" class="bottxt">Hi I am Helen, Your BMA Assistant. 
                    I can help you with all your normal day tasks and booking the doctor appointment. 
                    I am Specifically Designed for the Blind People.</textarea>

              
                <textarea id="usermsg" name="usermsg" class="usertxt"></textarea>
            

           <div class="row">
               <div class="col-6">
                   <div class="numpanel">
                       <h3 id="1" onclick="braille_keyboard(this.id)">1</h3>
                   </div>
               </div>
               <div class="col-6">
                <div class="numpanel">
                    <h3 id="4" onclick="braille_keyboard(this.id)">4</h3>
                </div>
            </div>
           </div>

           <div class="row">
            <div class="col-6">
                <div class="numpanel1">
                    <h3 id="2" onclick="braille_keyboard(this.id)">2</h3>
                </div>
            </div>
            <div class="col-6">
             <div class="numpanel1">
                 <h3 id="5" onclick="braille_keyboard(this.id)">5</h3>
             </div>
         </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="numpanel2">
                    <h3 id="3" onclick="braille_keyboard(this.id)">3</h3>
                </div>
            </div>
            <div class="col-6">
             <div class="numpanel2">
                 <h3 id="6" onclick="braille_keyboard(this.id)">6</h3>
             </div>
         </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="numpanel3">
                    <img src="assets/img/letters-and-numbers-.png"  onclick="evokenum()">
                </div>
            </div>
            <div class="col-4">
                <div class="numpanel3">
                   <img src="assets/img/braille.png" onclick="braille_converter()" >
                </div>
            </div>
            <div class="col-4">
             <div class="numpanel3">
                <img src="assets/img/enter.png" onclick="process()">
             </div>
         </div>
        </div>

        </div>

        <div class="author">
            <h2>
                Created By
                <br>
                Mathesh T 
                <br>
                Balaji P
                
            </h2>
        </div>

        <form style="display:none;" id="upload-file" method="post" enctype="multipart/form-data">
                
            <input type="file" name="myImage" accept="image/x-png,image/gif,image/jpeg" id="ocrimg">

      
    </form>
    <a id="call" style="display:none;" href="tel:7305588158"></a>

        <script src="https://code.responsivevoice.org/responsivevoice.js?key=HdlQdSPC"></script>
        <script src="assets/jquery/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
     
        
        <script>
            braille_key_value="";
    
            localStorage.setItem("braille_value", "alphabet");
    
            function braille_keyboard(clicked) 
            {
                responsiveVoice.speak("You Have Clicked"+ clicked);
                    if(typeof(Storage) !== "undefined") 
                    {
                        // Store
                        braille_key_value=braille_key_value+clicked;
                        localStorage.setItem("key_value", braille_key_value);
                    } 
                    else 
                    {
                       window.alert("Does not support Web Storage API")
                    }
    
            } 
    
            function evokenum()
            {
                var x=localStorage.getItem("braille_value");
                if(x == "alphabet")
                {
                    localStorage.setItem("braille_value", "num");
                }
                else
                {
                    localStorage.setItem("braille_value", "alphabet");
                }
                
            }

            function getCookie(cname) 
            {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
            }
            
            
            function braille_converter()
            {

                var userinput=document.getElementById("usermsg").value;
                var braille_value = localStorage.getItem("key_value");
                if(braille_value=="")
                {
                    userinput= userinput+ "  ";
                    document.getElementById("usermsg").value = userinput;
                }
                braille_letter="";
                braille_number=-1;
                var x=localStorage.getItem("braille_value");
                if(x=="alphabet")
                {
                switch(parseInt(braille_key_value))
                        {
                            case 1:
                                braille_letter="A";
                                break;
                            case 12:
                                braille_letter="B";
                                break;
                            case 14:
                                braille_letter="C";
                                break;
                            case 145:
                                braille_letter="D";
                                break;
                            case 15:
                                braille_letter="E";
                                break;
                            case 124:
                                braille_letter="F";
                                break;
                            case 1245:
                                braille_letter="G";
                                break;
                            case 125:
                                braille_letter="H";
                                break;
                            case 24:
                                braille_letter="I";
                                break;
                            case 245:
                                braille_letter="J";
                                break;
                            case 13:
                                braille_letter="K";
                                break;
                            case 123:
                                braille_letter="L";
                                break;
                            case 134:
                                braille_letter="M";
                                break;
                            case 1345:
                                braille_letter="N";
                                break;
                            case 135:
                                braille_letter="O";
                                break;
                            case 1234:
                                braille_letter="P";
                                break;
                            case 12345:
                                braille_letter="Q";
                                break;
                            case 1235:
                                braille_letter="R";
                                break;
                            case 234:
                                braille_letter="S";
                                break;
                            case 2345:
                                braille_letter="T";
                                break;
                            case 136:
                                braille_letter="U";
                                break;
                            case 1236:
                                braille_letter="V";
                                break; 
                            case 2456:
                                braille_letter="W";
                                break;
                            case 1346:
                                braille_letter="X";
                                break;
                            case 13456:
                                braille_letter="Y";
                                break;
                            case 1356:
                                braille_letter="Z";
                                break;
                            default:
                                braille_letter="";
                        
                        }
                    }
                    else
                    {
                        switch(parseInt(braille_key_value))
                        {
                            case 1:
                                braille_number=1;
                                break;
                            case 12:
                                braille_number=2;
                                break;
                            case 14:
                                braille_number=3;
                                break;
                            case 145:
                                braille_number=4;
                                break;
                            case 15:
                                braille_number=5;
                                break;
                            case 124:
                                braille_number=6;
                                break;
                            case 1245:
                                braille_number=7;
                                break;
                            case 125:
                                braille_number=8;
                                break;
                            case 24:
                                braille_number=9;
                                break;
                            case 245:
                                braille_number=0;
                                break;
                            default:
                                braille_letter="Space";
                        
                        }
                    }
                    if(braille_letter!="Space" && braille_number==-1)
                    {
                        responsiveVoice.speak("You have entered"+ braille_letter);
                        userinput = userinput + braille_letter;
                        document.getElementById("usermsg").value = userinput;

                    }
                    else if(braille_letter!="Space" && braille_number!=-1)
                    {
                        responsiveVoice.speak("You have entered"+ braille_number);
                        userinput = userinput + braille_number;
                        document.getElementById("usermsg").value = userinput;

                    }
                braille_key_value="";
                localStorage.setItem("key_value", ""); 
                
            }

            function wikisearchvalue(searchresult)
            {
                document.getElementById("botmsg").value=searchresult;
                responsiveVoice.speak(searchresult);
            }

            document.getElementById('ocrimg').addEventListener("change",function()
            {
                
                const reader= new FileReader();
                reader.addEventListener("load",()=>
                {
                    localStorage.setItem("ocrimg",reader.result);

                });

                reader.readAsDataURL(this.files[0]);
                
            }
            );

            function extractocr()
            {
            x=localStorage.getItem("ocrimg");
            console.log(x);
            Tesseract.recognize(
                x,
                'eng',
                { logger: m => console.log(m) }
            ).then(({ data: { text } }) => {
                console.log(text);
                //speak(text);
                // localStorage.removeItem("ocrimg");
                text="The Image Says " + text;
                wikisearchvalue(text);
                
            })
           }
     
          
            function process()
            {
                
                botcmd = document.getElementById("botmsg");
                usercmd = document.getElementById("usermsg").value.trim();
                query=usercmd.toLowerCase();

                const greeting = ['hi','hai','what is your name','what you can do'];
                const login = ['i want to login', 'add me to the network'];
                const search =['what','search','can you tell me about'];
                const ocr=['ocr','what is on the book','read the text'];
                const doctor=['book me a doctor appoinment', 'i want to see a doctor'];
                const location=['locate','locate nearby','get'];
                const call=['call','make a call','phone'];

                if(new RegExp(greeting.join("|")).test(query))
                {
                    botmsg.value="Hi I am Helen, Your BMA Assistant. I can help you with all your normal day tasks and booking the doctor appointment. I am Specifically Designed for the Blind People.";
                    responsiveVoice.speak("Hi I am Helen, Your BMA Assistant. I can help you with all your normal day tasks and booking the doctor appointment. I am Specifically Designed for the Blind People.");
                }
                else if(new RegExp(search.join("|")).test(query))
                {
                   searchstring=query.replace("search","");
                    $.ajax({
                        url:'process.py',
                        method:'post',
                        data:{message_py : searchstring.trim()},
                        dataType:'text',
                        success:function(data)
                        {
                            wikisearchvalue(data);
                        }
                        
                    });
                }
                else if(new RegExp(ocr.join("|")).test(query))
                {
                    $('input').click();
                    extractocr();
                }
                else if(new RegExp(login.join("|")).test(query))
                {
                    // location.replace('login.php');
                    window.location = "login.php";
                }
                else if(new RegExp(doctor.join("|")).test(query))
                {
                    $.ajax({
                        url:'doctor.php',
                        method:'post',
                        data:{doctor : query},
                        dataType:'text',
                        success:function(data)
                        {
                            if(data=="Invalid Request")
                            {
                                responsiveVoice.speak("Pls Login First TO book Doctor Appoinment");
                                location.replace('login.php');
                            }
                            else
                            {
                            wikisearchvalue(data);
                            }
                        }
                        
                    });
                }
                else if(new RegExp(location.join("|")).test(query))
                {
                   searchstring=query.replace("locate","");
                    $.ajax({
                        url:'location.py',
                        method:'post',
                        data:{message_py : searchstring.trim()},
                        dataType:'text',
                        success:function(data)
                        {
                            wikisearchvalue(data);
                        }
                        
                    });
                }
                else if(new RegExp(call.join("|")).test(query))
                {
                    let callstring="";
                    callstring=query.replace("call","");
                    document.getElementById("call").href = "tel:" + callstring;
                    document.getElementById("call").click();
                }
                else
                {
                    wikisearchvalue("Cant Understand what you are saying Please Repeat it");
                }
                
              }

           

            window.onload = function()
		   { 
			welcomespeech="Hi I am Helen, Your BMA Assistant. I can help you with all your normal day tasks and booking the doctor appointment. I am Specifically Designed for the Blind People.";
			responsiveVoice.speak(welcomespeech);
	       };

        </script>
       
    </body>
</html>