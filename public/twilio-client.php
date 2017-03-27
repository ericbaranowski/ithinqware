<?php

include '../Services/Twilio/Capability.php';
 
// put your Twilio API credentials here
$accountSid = 'ACaf07fd2c2b5e4d4abcc9aa54ad08ef9c';
$authToken  = '9d46a7c7fc5caab85121b8b1955b7b69';

// put your Twilio Application Sid here
$appSid     = 'AP25569eb550c76ec59bd9ba771636bd2e';
$client     = 'jenny';
 
$capability = new Services_Twilio_Capability($accountSid, $authToken);
$capability->allowClientOutgoing($appSid);
$capability->allowClientIncoming($client);
$token = $capability->generateToken();
?>

<!DOCTYPE html>
<html>
<head>
    <title>iThinqWare</title>
    <script type="text/javascript"
            src="//media.twiliocdn.com/sdk/js/client/v1.3/twilio.min.js"></script>
    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <link href="css/client.css"
          type="text/css" rel="stylesheet" />
    <script type="text/javascript">

        Twilio.Device.setup("<?php echo $token; ?>");

        Twilio.Device.ready(function (device) {
            $("#log").text("Ready");
        });

        Twilio.Device.error(function (error) {
            $("#log").text("Error: " + error.message);
        });

        Twilio.Device.connect(function (conn) {
            $("#log").text("Successfully established call");
        });
        Twilio.Device.disconnect(function (conn) {
            $("#log").text("Call ended");
        });
        Twilio.Device.incoming(function (conn) {
            $("#log").text("Incoming connection from " + conn.parameters.From);
            // accept the incoming connection and start two-way audio
            conn.accept();
        });

        function call() {
            Twilio.Device.connect();
        }
        function hangup() {
            Twilio.Device.disconnectAll();
        }
    </script>
</head>
<body>
<button class="call" onclick="call();">
    Call
</button>
<button class="hangup" onclick="hangup();">
    Hangup
</button>

<div id="log">Loading...</div>
</body>
</html>