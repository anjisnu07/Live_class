<?php
session_start();


	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
	{
		header ("location: loginfirst.php");
		 
	}
	
  $username = $_SESSION['username'];
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
 var username = "<?php echo $username; ?>";
    var script = document.createElement("script");
    script.type = "text/javascript";
  
    script.addEventListener("load", function (event) {
      const config = {
        name: username,
        meetingId: "sem4.php",
        apiKey: "73c20af7-2fbb-475f-b86e-da3618f9666a",
        containerId: null,
      participantCanToggleSelfMic: true,
      micEnabled: true,
      webcamEnabled: false,
      participantCanToggleSelfWebcam: true,
      participantCanToggleSelfMic: true,
      chatEnabled: true,
      screenShareEnabled: true,

        permissions: {
    
        canCreatePoll: true,
     
  },
  
        /*
  
       Other Feature Properties
        
        */
      };
  
      const meeting = new VideoSDKMeeting();
      meeting.init(config);
    });
  
    script.src =
      "https://sdk.videosdk.live/rtc-js-prebuilt/0.3.23/rtc-js-prebuilt.js";
       document.getElementsByTagName("head")[0].appendChild(script);

       const { participants } = useParticipant("<participant-id>");


  
 

  </script>
</body>
</html>