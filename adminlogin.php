<?php
session_start();
?>

<html>
<head>
  <title>ADMIN LOGIN</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
  <script language="javascript">

  function checkid()
	{
		var id = document.getElementById("uid").value;	
		
		if(isNaN(id))
		{
			document.getElementById('checkid').innerHTML="<font style=\"color: red\">*Please Fill in the Correct ID(invalid characters).</font>";
			document.getElementById('uid').style.border='red 1px solid';
			return false;
		}
		else if(id.length != 10 || id.length == 0)
		{
			document.getElementById('checkid').innerHTML="<font style=\"color: red\">*Please Fill in the Correct ID(10-digits).</font>";
			document.getElementById('uid').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkid').innerHTML="";
			document.getElementById('uid').style.border='grey 1px solid';	
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
			var a = checkid();
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
          <h1><a href="adminlogin.php">Hostel Management System<span class="logo_colour">&nbsp;ADMIN</span></a></h1>
          <h2>Redifining Room Allotment.</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          
          <li class="selected"><a href="adminlogin.php">ADMINISTRATOR</a></li>
          
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div class="sidebar">
        <!-- insert your sidebar items here -->
        <h3>Open Website Here</h3>
        <ul>
          <li><a href="index.html">Home Page</a></li>
          <li><a href="login.php">Student Login</a></li>
          <li><a href="register.php">Student Registration</a></li>
          
        </ul>
        </div>
      <div id="content">
      
      <form action="adminlogin.php" method="post" onSubmit="return checksubmit()">
          <div id="warning" align="left"></div>
          <h2>Only Administrator Allowed </h2><br><br>
          <div class="form_settings">
            <p><span>Unique ID.(10 digits)</span><input class="contact" type="text" name="uid" id="uid" onKeyUp="checkid()"/>
            <div id="checkid" align="right"></div>
            </p><br>
            <p><span>Password</span><input class="contact" type="password" name="password" id="password" onKeyUp="checkpass()"/>
            <div id="checkpass" align="right"></div>
            </p><br>
            <p><input class="submit" type="submit" value="LOGIN" name="submit"/></p><br><br>
            <p><h3> If you are not an Admin Then<br><a href="login.php">Click here</a> to Exit Now.</h3></p>
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
if(isset($_SESSION['admin_user']))
{
	header("Location: admin.php");
}
else
{
if((isset($_POST['submit'])) && ($_POST['submit']))
{
	// connect to mongodb
$m = new MongoClient();

// select a database
$db = $m->HMS;

//select collection
$collection = $db->admin;

//insert the data into collection


$uid = $_POST['uid'];
$pass = $_POST['password'];
$counter = 0;

$query = array('unique_id'=>$uid);

$cursor1 = $collection->find($query);

if($cursor1->count() == 0)
{
echo
"
<script>
document.getElementById('warning').innerHTML='<font style=\'color: red\'>*NO SUCH USER EXISTS</font>';	
</script>
";

}
else
{
	foreach($cursor1 as $row)
	{
		$passfetch = $row["password"];
	}

	if($passfetch == $pass)
	{
		$_SESSION['admin_user'] = $uid;
		header("Location: admin.php");
	}
	else if($passfetch != $pass)
		{
			echo
		"
		<script>
		document.getElementById('warning').innerHTML='<font style=\'color: red\'>*WRONG PASSWORD</font>';	
		</script>
		";
		}
}
}
}


?>