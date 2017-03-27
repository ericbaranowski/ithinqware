
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>jQuery Pop-Up Window Examples</title>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
    <style type="text/css">body{font-family: verdana,arial,sans-serif;font-size:13px;}</style>

    <!-- STEP 1: If you don't have jQuery on your page then use this line or one similar -->
    <script type="text/javascript" src="js/jquery-latest.min.js"></script>

    <!-- STEP 2: Add this to your page or preferably to an external javascript file -->
    <script type="text/javascript">

        //initialize the 3 popup css class names - create more if needed
        var matchClass=['popup1','popup2','popup3'];
        //Set your 3 basic sizes and other options for the class names above - create more if needed
        var popup2 = 'width=800,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=20,top=20';

        //The pop-up function
        function tfpop(){
            var x = 0;
            var popClass;
            //Cycle through the class names
            while(x < matchClass.length){
                popClass = "'."+matchClass[x]+"'";
                //Attach the clicks to the popup classes
                $(eval(popClass)).click(function() {
                    //Get the destination URL and the class popup specs
                    var popurl = $(this).attr('href');
                    var popupSpecs = $(this).attr('class');
                    //Create a "unique" name for the window using a random number
                    var popupName = Math.floor(Math.random()*10000001);
                    //Opens the pop-up window according to the specified specs
                    newwindow=window.open(popurl,popupName,eval(popupSpecs));
                    return false;
                });
                x++;
            }
        }

        //Wait until the page loads to call the function
        $(function() {
            tfpop();
        });
    </script>

</head>
<body>
<h1>Pop-up Window</h1>

<!-- STEP 3: Add one of the three classes to your link -->
<p><a href="twilio-client.php" class="popup2">Click here to open the caller interface</a></p>

<p>&nbsp;</p>


</body>
</html>
