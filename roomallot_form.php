<?php
session_start();
if(!isset($_SESSION['login_user']))
	header("Location: login.php");
$current_user = $_SESSION['login_user'];
echo $current_user;
?>

<html>
<head>
  <title>DASHBOARD</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
  
  <script type="text/javascript" >
  	function checkper()
	{
		var per = document.getElementById("per").value;
		if (per == null || per == "") 
		{
       	 	document.getElementById('checkper').innerHTML="<font style=\"color: red\">*Please Fill in the Percentage</font>";
			document.getElementById('per').style.border='red 1px solid';
			return false;
		}
		else if(per<1 || per>100)
		{
			document.getElementById('checkper').innerHTML="<font style=\"color: red\">*Check Percentage</font>";
			document.getElementById('per').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkper').innerHTML="";
			document.getElementById('per').style.border='grey 1px solid';	
			return true;
		}
	}
   function checksubmit()
	{
		var a = checkper();
		if(a)
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
          <li ><a href="user.php">PROFILE</a></li>
          <li class="selected"><a href="roomallot_form.php">Room Allotment Form</a></li>
         <li ><a href="roomallot_status.php">Allotment Status</a></li>
          <li ><a href="edit_profile.php">EDIT PROFILE</a></li>
          <li><a href="user_logout.php">LOGOUT</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      
      <div class="sidebar">
        <!-- insert your sidebar items here -->
        <h3>Fill Carefully!!!</h3>
        <p>Each and every field is to be filled with appropriate preferences.</p>
        <p>Check your current year. If not correct then to change <br><a href="edit_profile.php">click here</a></p>
      </div>
      <div id="content">
      	<form name="roomallot_form" action="roomallot_form.php" method="post"  onSubmit="return checksubmit()" >
          <div id="warning" align="left"></div>
          <h2>Have you Applied? ...Not Yet?</h2><h4> Then Apply Here. </h4>
         
          <div class="form_settings">
            <p><span>Percentage in last SEM: </span><input class="contact" type="number" name="per" id="per" onKeyUp="checkper()"/>
            <div id="checkper" align="right"></div>
            </p><br>
       
            <p>
              <input class="submit" type="submit" value="SUBMIT" id="submit" name="submit"/>   
            </p>
            <p><br><br><br><br> </p>
          </div>
        </form>
      
      </div>
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
$collection1 = $db->registration;
$collection2 = $db->allotment;
//insert the data into collection

$per = $_POST['per'];

$query = array('regno'=>$current_user);

$cursor1 = $collection1->find($query);
$cursor2 = $collection2->find($query);
if($cursor2->count() != 0)
{
echo
"
<script>
document.getElementById('warning').innerHTML='<font style=\'color: red\'>*ALREADY APPLIED</font>';	
</script>
";
}
else
{
	foreach($cursor1 as $row)
	{
		$fname = $row["fname"];
		$year = $row["year"];
		$branch = $row["branch"];
	}

$document = array(
"regno" => $current_user,
"name" => $fname,
"year" => $year,
"branch" => $branch,
"percentage" => $per,
"status" => "",
"roomno" => ""
);

$collection2->insert($document);
echo
"
<script>
document.getElementById('warning').innerHTML='<font style=\'color: green\'>*APPLIED SUCCESSFULLY.</font>';	</script>
";
}
}
?>