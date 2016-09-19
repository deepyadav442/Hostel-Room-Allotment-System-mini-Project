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
  
  <script>
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
	
	function checksubmit()
	{
		var submit = document.getElementById("submit").value;
			var a = checkmobile();
			var b = checkselect1();
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
          <li ><a href="user.php">PROFILE</a></li>
          <li ><a href="roomallot_form.php">Room Allotment Form</a></li>
         <li ><a href="roomallot_status.php">Allotment Status</a></li>
          <li class="selected"><a href="edit_profile.php">EDIT PROFILE</a></li>
          <li><a href="user_logout.php">LOGOUT</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
  
      <div id="content">
        <!-- insert the page content here -->
        <form  action="edit_profile.php" method="post"  onSubmit="return checksubmit()" >
          <div id="warning" align="left"></div>
          <h2>Completed a year? or Changed your mobile?...</h2><h4> Then Update Here. </h4>
          <div id="div1" name="div1" align="right"></div>
          <div class="form_settings">
          
            <p><span>
            Mobile No.</span><input class="contact" type="text" name="mobile" id="mobile" onKeyUp="checkmobile()"/>
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
              <input class="submit" type="submit" value="SUBMIT" id="submit" name="submit"/>
            </p><br><br><br><br>
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

$mobile = $_POST['mobile'];
$year_no = $_POST['year'];
if($year_no == 1)
	 $year = "SE";
else if($year_no == 2)	 
	$year = "TE";
else if($year_no == 3)	 
	$year = "BE";
	
$query = array('regno'=>$current_user);

$cursor = $collection->find($query);

foreach($cursor as $row)
{
	$old_mobile = $row["mobile"];
	$old_year = $row["year"];
}
	
	$collection->update(array("mobile"=>"$old_mobile"),
	array('$set'=>array("mobile"=>"$mobile")));	
	
	$collection->update(array("year"=>"$old_year"),
	array('$set'=>array("year"=>"$year")));
	
	echo
	"
	<script>
	document.getElementById('warning').innerHTML='<font style=\'color: green\'>*UPDATED SUCCESSFULLY.</font>';	
	</script>
	";
}

?>