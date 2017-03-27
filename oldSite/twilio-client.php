<?php

include '../Services/Twilio/Capability.php';
include '../vendor/autoload.php';
 
// put your Twilio API credentials here
$accountSid = 'ACaf07fd2c2b5e4d4abcc9aa54ad08ef9c';
$authToken  = '9d46a7c7fc5caab85121b8b1955b7b69';

// put your Twilio Application Sid here
$appSid     = 'AP25569eb550c76ec59bd9ba771636bd2e';
// put your default Twilio Client name here

$clientName = 'null';

// get the Twilio Client name from the page request parameters, if given
if (isset($_REQUEST['client'])) {
    $clientName = $_REQUEST['From'];
}


DB::insert('twilio_log', array(
  'account_sid' => $_REQUEST['AccountSid'],
  'call_sid' => $_REQUEST['CallSid'],
  'caller' => $_REQUEST['From'],
  'called' => $_REQUEST['To'],
  'direction' => $_REQUEST['Direction'],
  'status' => $_REQUEST['CallStatus'],
  'content_url' => $_REQUEST['client'],
  'content_text' => $_REQUEST['client'],
  'forwarded_from' => $_REQUEST['ForwardedFrom'],
  'caller_name' => $_REQUEST['CallerName'],
  'from_city' => $_REQUEST['FromCity'],
  'from_zip' => $_REQUEST['FromZip'],
  'from_country' => $_REQUEST['FromCountry'],
  'recording_url' => $_REQUEST['RecordingUrl'],
  'recording_sid' => $_REQUEST['RecordingSid'],
  'recording_duration' => $_REQUEST['RecordingDuration'],
  'call_duration' => $_REQUEST['CallDuration'],
  'friendly_name' => $_REQUEST['FriendlyName']                  
));

 
$capability = new Services_Twilio_Capability($accountSid, $authToken);
$capability->allowClientOutgoing($appSid);
$capability->allowClientIncoming($clientName);
$token = $capability->generateToken();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>iThinqWare</title>

    <script type="text/javascript"
            src="//media.twiliocdn.com/sdk/js/client/v1.3/twilio.min.js"></script>
    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>

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

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.resizable.js"></script>

<script type="text/javascript" src="js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.uniform.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.autotab.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.ibutton.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>

<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.validate.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.form.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fileTree.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="js/plugins/others/jquery.fullcalendar.js"></script>
<script type="text/javascript" src="js/plugins/others/jquery.elfinder.js"></script>

<script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="js/files/bootstrap.js"></script>
<script type="text/javascript" src="js/files/functions.js"></script>

</head>

<body>

<!-- Top line begins -->
<div id="top">
	<div class="wrapper">
    	<a href="#" title="" class="logo"><img src="images/logo.png" alt="" /></a>
        
        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
            </ul>
        </div>
    </div>
</div>
<!-- Top line ends -->


<!-- Main content wrapper begins -->
<div class="loginWrapper">
<button class="buttonM bLightBlue grid6" onclick="call();">
    Call
</button>
<button class="buttonM bRed grid6" onclick="hangup();">
    Hangup
</button>
<input type="text" id="number" name="number"
       placeholder="Forward call to line 1"/>
       <input type="text" id="number" name="number"
       placeholder="Forward call to line 2"/>
       
       <div class="loginWrapper"><button class="buttonM bGreen grid6" onclick="call();"> 
    Forward call to line 1
</button></div>
       

<div class="nNote nInformation" id="log">Loading...</div>

        </div>
        </div>
    </div>    
<!-- Main content wrapper ends -->

</body>
</html>
