<?php
session_start();
if(isset($_SESSION['login_user']))
	header("Location: user.php");
?>

<html>
<head>
  <title>REGISTER</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />

<script type="text/javascript" >
function checkname()
{
	var fname = document.getElementById("fname").value;
	if (fname == null || fname == "") 
	{
        document.getElementById('checkname').innerHTML="<font style=\"color: red\">*Please Fill in the Full Name</font>";
		document.getElementById('fname').style.border='red 1px solid';
		return false;
	}
	else if((fname.search(/[^A-Za-z\s]/) != -1))
	{
		document.getElementById('checkname').innerHTML="<font style=\"color: red\">*Please Fill valid Characters</font>";
		document.getElementById('fname').style.border='red 1px solid';
		return false;
	}
	else 
	{
		document.getElementById('checkname').innerHTML="<font style=\"color: green\"></font>";
		document.getElementById('fname').style.border='grey 1px solid';	
		return true;
	}
}

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
			document.getElementById('checkregno').innerHTML="<font style=\"color: green\"></font>";
			document.getElementById('regno').style.border='grey 1px solid';	
			return true;
		}
	}

function checkemail() {
	var email = document.getElementById("email").value;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
    	if (email == null || email == "") 
		{
        	document.getElementById('checkemail').innerHTML="<font style=\"color: red\">*Please Fill in the E-Mail</font>";
			document.getElementById('email').style.border='red 1px solid';
			return false;
		}
		else if(atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length)
		{
			document.getElementById('checkemail').innerHTML="<font style=\"color: red\">*Please Fill the Correct E-Mail</font>";
			document.getElementById('email').style.border='red 1px solid';
			return false;
		}
		else
		{
		document.getElementById('checkemail').innerHTML="<font style=\"color: green\"></font>";
		document.getElementById('email').style.border='grey 1px solid';
		return true;
		}
	}
	function checkmobile()
	{
		var mobile = document.getElementById("mobile").value;	
		
		if(isNaN(mobile))
		{
			document.getElementById('checkmobile').innerHTML="<font style=\"color: red\">*Please Fill in the Correct Mobile Number(invalid characters).</font>";
			document.getElementById('mobile').style.border='red 1px solid';
			return false;
		}
		else if(mobile.length != 10 || mobile.length == 0)
		{
			document.getElementById('checkmobile').innerHTML="<font style=\"color: red\">*Please Fill in the Correct Mobile Number.</font>";
			document.getElementById('mobile').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkmobile').innerHTML="<font style=\"color: green\"></font>";
			document.getElementById('mobile').style.border='grey 1px solid';	
			return true;
		}
	}
	
	function checkselect1()
	{
		var select1 = document.getElementById("id1").value;
		if(select1 == 0)
		{
			document.getElementById('checkselect1').innerHTML="<font style=\"color: red\">*Please Select Year.</font>";
			document.getElementById('id1').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkselect1').innerHTML="";
			document.getElementById('id1').style.border='grey 1px solid';
			return true;
		}
	}
	
	function checkselect2()
	{
		var select2 = document.getElementById("id2").value;
		if(select2 == 0)
		{
			document.getElementById('checkselect2').innerHTML="<font style=\"color: red\">*Please Select Branch.</font>";
			document.getElementById('id2').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkselect2').innerHTML="";
			document.getElementById('id2').style.border='grey 1px solid';
			return true;
		}
	}
	
	function checkpass1()
	{
		var pass = document.getElementById("pass").value;
		if(pass.length >= 6 && pass.length<=10)
		{
			document.getElementById('pass1').innerHTML="";
			document.getElementById('pass').style.border='grey 1px solid';
			return true;
		}
		else 
		{
			document.getElementById('pass1').innerHTML="<font style=\"color: red\">*Enter Password within the specified Limit.</font>";
			document.getElementById('pass').style.border='red 1px solid';
			return false;
		}
	}
	
	function checkpass2()
	{
		var pass1 = document.getElementById("pass").value;
		var pass2 = document.getElementById("cpass").value;
		if(pass1 == pass2)
		{
			document.getElementById('pass2').innerHTML="";
			document.getElementById('cpass').style.border='grey 1px solid';
			return true;
		}
		else 
		{
			document.getElementById('pass2').innerHTML="<font style=\"color: red\">*Password Mismatch.</font>";
			document.getElementById('cpass').style.border='red 1px solid';
			return false;
		}
	}
	
	function clearfields()
	{
		document.getElementById('checkname').innerHTML="";
		document.getElementById('fname').style.border='grey 1px solid';
		
		document.getElementById('checkregno').innerHTML="";
		document.getElementById('regno').style.border='grey 1px solid';
		
		document.getElementById('checkemail').innerHTML="";
		document.getElementById('email').style.border='grey 1px solid';
		
		document.getElementById('checkmobile').innerHTML="";
		document.getElementById('mobile').style.border='grey 1px solid';
		
		document.getElementById('checkselect1').innerHTML="";
		document.getElementById('id1').style.border='grey 1px solid';
		
		document.getElementById('checkselect2').innerHTML="";
		document.getElementById('id2').style.border='grey 1px solid';
		
		document.getElementById('pass1').innerHTML="";
		document.getElementById('pass').style.border='grey 1px solid';
		
		document.getElementById('pass2').innerHTML="";
		document.getElementById('cpass').style.border='grey 1px solid';
	}
	
	function checksubmit()
	{
		var submit = document.getElementById("submit").value;
			var a = checkname();
			var b = checkregno();
			var c = checkemail();
			var d = checkmobile();
			var e = checkselect1();
			var f = checkselect2();	
			var g = checkpass1();
			var h = checkpass2();
		if(a&&b&&c&&d&&e&&f&&g&&h)
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
          <li><a href="login.php">LOGIN</a></li>
          <li class="selected"><a href="register.php">REGISTER</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div class="sidebar">
        <!-- insert your sidebar items here -->
        <h3>Why Register?</h3>
        <p>To Provide You a More Personalised Experience and it also help us to Improve.</p>
       
      </div>
      <div id="content">
        <!-- insert the page content here -->
        <form  action="register.php" method="post"  onSubmit="return checksubmit()" >
          <div id="warning" align="left"></div>
          <h2>Registered? ...Not Yet?</h2><h4> Then Register Here. </h4>
          <div id="div1" name="div1" align="right"></div>
          <div class="form_settings">
            <p><span>Full Name</span><input class="contact" type="text" name="name" id="fname" onKeyUp="checkname()"/>
            <div id="checkname" align="right"></div>
            </p><br>
            
            <p><span>Reg No.</span><input class="contact" type="text" name="regno" id="regno" onKeyUp="checkregno()"/>
            <div id="checkregno" align="right"></div>
            </p><br>
            <p><span>E-Mail</span><input class="contact" type="email" name="email" id="email" onKeyUp="checkemail()"/>
            <div id="checkemail" align="right"></div>
            </p><br>
            <p><span>Mobile No.</span><input class="contact" type="text" name="mobile" id="mobile" onKeyUp="checkmobile()"/>
            <div id="checkmobile" align="right"></div>
            </p><br>
            <p>
            <span>Select Year</span>
            <select id="id1" name="year" onChange="checkselect1()">
            <option value="0" disabled="true" selected="true">--SELECT HERE--</option>
            <option value="1">SE</option>
            <option value="2">TE</option>
            <option value="3">BE</option>
            </select>
            <div id="checkselect1" align="right"></div>
            </p><br>
            <p>
            <span>Select Branch</span>
            <select id="id2" name="branch" onChange="checkselect2()">
            <option value="0" disabled="true" selected="true">--SELECT HERE--</option>
            <option value="1">IT</option>
            <option value="2">E&TC A</option>
            <option value="3">E&TC B</option>
            <option value="4">Comp</option>
            <option value="5">Mech</option>
            </select>
            <div id="checkselect2" align="right"></div>
            </p><br>
            <p><span>Password (6-10 digits)</span><input class="contact" type="password" name="password" id="pass" onKeyUp="checkpass1()"/>
            <div id="pass1" align="right"></div>
            </p><br>
            <p><span>Confirm Password</span><input class="contact" type="password" name="cpassword" id="cpass" onKeyUp="checkpass2()"/>
            <div id="pass2" align="right"></div>
            </p><br>
            <p>
              <input class="submit" type="submit" value="SUBMIT" id="submit" name="submit"/>
              <input class="submit" type="reset" value="RESET" onClick="clearfields()"/>
              
            </p>
            <br><br>
            <p><h3> OR.... <a href="login.php">Login Here.</h3></a></p>
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
//echo "Connection to database successfully<br>";
// select a database
$db = $m->HMS;
//echo "Database mydb selected <br>";
//select collection
$collection = $db->registration;
//echo "Collection selected succsessfully<br>";
//insert the data into collection

$name = $_POST['name'];
$regno = $_POST['regno'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$year_no = $_POST['year'];
if($year_no == 1)
	 $year = "SE";
else if($year_no == 2)	 
	$year = "TE";
else if($year_no == 3)	 
	$year = "BE";
	
$branch_no = $_POST['branch'];
if($branch_no == 1)
	$branch = "IT";
else if($branch_no == 2)	 
	$branch = "E&TC A";
else if($branch_no == 3)	 
	$branch = "E&TC B";
else if($branch_no == 4)	 
	$branch = "COMP";
else if($branch_no == 5)	 
	$branch = "MECH";
	
$pass = $_POST['password'];

$document = array(
"fname" => $name,
"regno" => $regno,
"email" => $email,
"mobile" => $mobile,
"year" => $year,
"branch" => $branch,
"pass" => $pass
);
try
{
$collection->insert($document);
echo
"
<script>
document.getElementById('warning').innerHTML='<font style=\'color: green\'>*USER REGISTERED SUCCESSFULLY.<br>LOGIN NOW.</font>';	</script>
";
}
catch(MongoCursorException $e)
{
echo
"
<script>
document.getElementById('warning').innerHTML='<font style=\'color: red\'>*USER ALREADY EXISTS / CLICK ON THE REGISTER TAB AND TRY AGAIN.</font>';	</script>
";
}
}

?>