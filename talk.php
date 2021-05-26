<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BMA</title>
	<link type="text/css" rel="stylesheet"href="assets/css/talk.css">
	<script src='https://unpkg.com/tesseract.js@v2.1.0/dist/tesseract.min.js'></script>
</head>
<body>
    
	<div class="container">
		<div class="chat">
			<div class="chat-header">
				<div class="profile">
					<div class="left">
						
						<img src="assets/img/pp.png" class="pp">
						<h2>Helen(BMA Chat Assistant)</h2>
						<span>online</span>
					</div>
					<div class="right">
						<img src="assets/img/video.png" onclick="extractocr()" class="icon">
						<!-- <img src="assets/img/phone.png" class="icon">
						<img src="assets/img/more.png" class="icon"> -->
					</div>
				</div>
			</div>
			<div class="chat-box">
                <div class="chat-l">
					<div class="mess">
						<p>
                            Hi I am Helen, Your BMA Assistant
						</p>
						<div class="check">
							<span>4:00 PM</span>
						</div>
					</div>
					<div class="sp"></div>
				</div>

                <div class="chat-l">
					<div class="mess">
						<p> 
                           I can help you with all your normal day tasks and booking the doctor appointment and I am Specifically Designed for the Blind People.
						</p>
						<div class="check">
							<span>4:00 PM</span>
						</div>
					</div>
					<div class="sp"></div>
				</div>

				
				<div class="chat-r">
					<div class="sp"></div>
					<div class="mess mess-r">
						<p name="message" id="usermsg" >
                            Hi, I Am Mathesh
						</p>
						<div class="check">
							<span>4:00 PM</span>
							<img src="assets/img/check-2.png">
						</div>
					</div>
				</div>


				<div class="chat-l">
					<div class="mess">
						<!-- <p id="botmsg">  -->
						<textarea id="botmsg" name="botmsg" >

						</textarea>
						<!-- </p> -->
						<div class="check">
							<span>4:00 PM</span>
						</div>
					</div>
					<div class="sp"></div>
				</div>

			</div>

			<div class="chat-footer">
				<!-- <img src="assets/img/emo.png" class="emo"> -->
				<textarea id="msgcmd" placeholder="Type a message"></textarea>
				<!-- <div class="icons">
					<img src="assets/img/attach file.png">
					<img src="assets/img/camera.png">
				</div> -->
				<img id="mic" id="txtcommand" onclick="processmsg()" src="assets/img/enter.png" class="mic">
			    <img id="mic" src="assets/img/mic.png" onclick="recognition.start();" class="mic"> 
			</div>
		</div>
	</div>

	<form style="display:none;" id="upload-file" method="post" enctype="multipart/form-data">
                
		<label for="file">Select a file</label>
		<input type="file" id="ocrimg">
   
	<br>
		<button id="upload-file-btn" type="button" onclick="extractocr()">Upload</button>
  
</form>
<a id="call" style="display:none;" href="tel:7305588158"></a>
	<script src="assets/jquery/jquery.min.js"></script>


	<script>
		
		
		
		//function speak(content)
         //{
		 	
           //  var msg = new SpeechSynthesisUtterance();
            // var voices = window.speechSynthesis.getVoices();
            // msg.voice = voices[2]; 
            // msg.volume = 1; // From 0 to 1
             //msg.rate = 1; // From 0.1 to 10
            // msg.pitch = 1; // From 0 to 2
             //msg.text = content;
             //msg.lang = 'en-GB';
             //speechSynthesis.speak(msg);
             //speechSynthesis.getVoices().forEach(function(voice) {
             //console.log(voice.name, voice.default ? voice.default :'');
         //});
        //}
		

        var message = document.getElementById('usermsg');


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
            message.textContent =  command;  
			
        };

        recognition.onspeechend = function() 
		{
            setTimeout(process, 2000);
			recognition.stop();
        };

		

        recognition.onerror = function(event) {
            message.textContent = 'Error occurred in recognition: ' + event.error;
        }        

     

		window.onload = function()
		{ 
			welcomespeech="Hi I am Helen, Your BMA Assistant.  I can help you with all your normal day tasks and booking the doctor appointment and I am Specifically Designed for the Blind People.";
			responsiveVoice.speak(welcomespeech);
			recognition.start();
	    };


		 //OCR

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
			 alert(text);
			 //speak(text);
			 localStorage.removeItem("ocrimg");
			 responsiveVoice.speak(text);
			 
		 })
		}

		function wikisearchvalue(searchresult)
        {
                document.getElementById("botmsg").value=searchresult;
                responsiveVoice.speak(searchresult);
        }
		function process()
		{
			var msg = document.getElementById('usermsg').textContent;
			command=msg.toLowerCase();
			responsiveVoice.speak(command);
			
			//speak(command);

			    query=command.toLowerCase();

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

		function delivermsg(pythoncontent)
		{
			document.getElementById("botmsg").innerHTML = pythoncontent;

		}
		

		function processmsg()
		{
			var msgcmd =document.getElementById("msgcmd").value 
			query=msgcmd.toLowerCase();

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

		
       



    </script>
	<script src="https://code.responsivevoice.org/responsivevoice.js?key=HdlQdSPC"></script>
</body>
</html>