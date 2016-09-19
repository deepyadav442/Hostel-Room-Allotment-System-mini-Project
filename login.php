<?php
session_start();
if(isset($_SESSION['login_user']))
	header('Location: user.php', true);
?>
<html>
<head>

  <title>HMS</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />

  
  <script language="javascript">

  function checkregno()
	{
		var regno = document.getElementById("regno").value;	
		
		if(isNaN(regno))
		{
			document.getElementById('checkregno').innerHTML="<font style=\"color: red\">*Please Fill in the Correct Reg. Number(invalid characters).</font>";
			document.getElementById('regno').style.border='red 1px solid';
			return false;
		}
		else if(regno.length != 5 || regno.length == 0)
		{
			document.getElementById('checkregno').innerHTML="<font style=\"color: red\">*Please Fill in the Correct Reg. Number(5-digits).</font>";
			document.getElementById('regno').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkregno').innerHTML="";
			document.getElementById('regno').style.border='grey 1px solid';	
			return true;
		}
	}
  
  	function checkpass()
	{
		var pass = document.getElementById("password").value;
		if (pass == null || pass == "") 
		{
        	document.getElementById('checkpass').innerHTML="<font style=\"color: red\">*Please Fill in the Password</font>";
			document.getElementById('password').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkpass').innerHTML="";
			document.getElementById('password').style.border='grey 1px solid';	
			return true;
		}
	}
	function checksubmit()
	{
			var a = checkregno();
			var b = checkpass();
		if(a&&b)
		return true;
		else 
		return false;
		
	}  
  </script>
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">Hostel Management<span class="logo_colour">&nbsp;System</span></a></h1>
          <h2>Redifining Room Allotment.</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.html">Home</a></li>
          <li class="selected"><a href="login.php">LOGIN</a></li>
          <li><a href="register.php">REGISTER</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div class="sidebar">
        <!-- insert your sidebar items here -->
        <h3>Why Login?</h3>
        
        <p>To give each and every student a personalised facility and to make system Better.<br>and we value your privacy.</p>
      
        </div>
      <div id="content">
      
      <form  action="login.php" method="post" onSubmit="return checksubmit()">
          <div id="warning" align="left"></div>
          <h2>Already Registered? </h2><h4> Then Login Here. </h4>
          <div class="form_settings">
            <p><span>Reg No.</span><input class="contact" type="text" name="regno" id="regno" onKeyUp="checkregno()"/>
            <div id="checkregno" align="right"></div>
            </p><br>
            <p><span>Password</span><input class="contact" type="password" name="password" id="password" onKeyUp="checkpass()"/>
  			<div id="checkpass" align="right"></div>
            </p><br>
            <p><input class="submit" type="submit" name="submit" value="LOGIN" />
            
            </p><br><br>
            <p><h3> OR.... <a href="register.php">Register Here.</h3></a></p>
          </div>
        </form>
        </div>
    </div>
    
    
    <div id="content_footer"></div>
    <div id="footer">
       | DBMS Mini Project |
    </div>
  </div>
</body>
</html>
<?php
if((isset($_POST['submit'])) && ($_POST['submit']))
{
	// connect to mongodb
$m = new MongoClient();

// select a database
$db = $m->HMS;

//select collection
$collection = $db->registration;

//insert the data into collection


$regno = $_POST['regno'];
$pass = $_POST['password'];
$counter = 0;

$query = array('regno'=>$regno);

$cursor1 = $collection->find($query);

if($cursor1->count() == 0)
{
echo
"
<script>
document.getElementById('warning').innerHTML='<font style=\'color: red\'>*NO SUCH USER EXISTS</font>';	
</script>
";
//session_destroy();
}
else
{
	foreach($cursor1 as $row)
	{
		$passfetch = $row["pass"];
	}

	if($passfetch == $pass)
	{
		$_SESSION['login_user'] = $regno;
		header('Location: user.php', true);
	}
	else if($passfetch != $pass)
		{
			echo
		"
		<script>
		document.getElementById('warning').innerHTML='<font style=\'color: red\'>*WRONG PASSWORD</font>';	
		</script>
		";
		//session_destroy();
		}
}
}

?>