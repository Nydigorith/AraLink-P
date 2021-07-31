<?php
// detect form submission
	    if (isset($_POST['submit'])) {
	    // set chosen colour values
		$select = $_POST["select"];
                setcookie("colour",$select, time()+60*60*24*30);
            // reload page so has new cookie variables
                header('Location: cookies.php');
		    }
				
//check is cookie is set
 if (isset($_COOKIE["colour"])) {
    $colourvalue = $_COOKIE["colour"];
  } else {
// if not set use default colour
   $colourvalue = "#0000FF";
  }
?>
<html>
<head>
<style>
body {background-color:<?php echo $colourvalue ?>;}
</style>
</head>
<body>
    <P>Choose a colour:</P>
    <form action="cookies.php" method="post">
        <select name="select">
                  <option value="#00FF00">Green</option>
		  <option value="#FFFF00">Yellow</option>
		  <option value="#FF0000">Red</option>
                  <option value="#0000FF">Blue</option>
		  </select> 
		  <input type="submit" name="submit" value="Submit" />
    </form>
  <p>This example needs to be hosted with PHP to see the cookies working!</p>
</body>
</html><?php
// detect form submission
	    if (isset($_POST['submit'])) {
	    // set chosen colour values
		$select = $_POST["select"];
                setcookie("colour",$select, time()+60*60*24*30);
            // reload page so has new cookie variables
                header('Location: cookies.php');
		    }
				
//check is cookie is set
 if (isset($_COOKIE["colour"])) {
    $colourvalue = $_COOKIE["colour"];
  } else {
// if not set use default colour
   $colourvalue = "#0000FF";
  }
?>
<html>
<head>
<style>
body {background-color:<?php echo $colourvalue ?>;}
</style>
</head>
<body>
    <P>Choose a colour:</P>
    <form action="cookies.php" method="post">
        <select name="select">
                  <option value="#00FF00">Green</option>
		  <option value="#FFFF00">Yellow</option>
		  <option value="#FF0000">Red</option>
                  <option value="#0000FF">Blue</option>
		  </select> 
		  <input type="submit" name="submit" value="Submit" />
    </form>
  <p>This example needs to be hosted with PHP to see the cookies working!</p>
</body>
</html>