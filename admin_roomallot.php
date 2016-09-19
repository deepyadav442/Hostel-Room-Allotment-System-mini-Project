<?php
session_start();
if(!isset($_SESSION['admin_user']))
	header("Location: adminlogin.php");
$current_user = $_SESSION['admin_user'];
echo $current_user;
?>

<html>

<head>
  <title>ADMIN - DASHBOARD</title>
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
	
	function checkstatus()
	{
		var status = document.getElementById("status").value;
		if (status == null || status == "") 
		{
        	document.getElementById('checkstatus').innerHTML="<font style=\"color: red\">*Please Fill in the Status</font>";
			document.getElementById('status').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkstatus').innerHTML="";
			document.getElementById('status').style.border='grey 1px solid';	
			return true;
		}
	}
	
	function checkroomno()
	{
		var roomno = document.getElementById("roomno").value;
		if (roomno == null || roomno == "") 
		{
        	document.getElementById('checkroomno').innerHTML="<font style=\"color: red\">*Please Fill in the Room No.</font>";
			document.getElementById('roomno').style.border='red 1px solid';
			return false;
		}
		else 
		{
			document.getElementById('checkroomno').innerHTML="";
			document.getElementById('roomno').style.border='grey 1px solid';	
			return true;
		}
	}
	
	function checksubmit()
	{
		var a = checkregno();
		var b = checkstatus();
		var c = checkroomno();
		if(a&&b&&c)
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
          <h1><a href="admin.php">Hostel Management System<span class="logo_colour">&nbsp;ADMIN</span></a></h1>
          <h2>Redifining Room Allotment.</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li ><a href="admin.php">Profile</a></li>
          <li class="selected"><a href="admin_roomallot.php">Room Allotment</a></li>
          <li ><a href="admin_search.php">Search Entries</a></li>
          <li><a href="admin_logout.php">LOGOUT</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      
      <div id="content">
        <!-- insert the page content here -->
        <form action="admin_roomallot.php" method="post" onSubmit="return checksubmit()">
          <div id="warning" align="left"></div>
          <h2>Allot Rooms Here: </h2><br><br>
          <div class="form_settings">
            <p><span>Reg No.:</span><input class="contact" type="text" name="regno" id="regno" onKeyUp="checkregno()"/>
            <div id="checkregno" align="right"></div>
            </p><br>
            <p><span>Status:</span><input class="contact" type="text" name="status" id="status" onKeyUp="checkstatus()"/>
            <div id="checkstatus" align="right"></div>
            </p><br>
            <p><span>Room No.:</span><input class="contact" type="text" name="roomno" id="roomno" onKeyUp="checkroomno()"/>
            <div id="checkroomno" align="right"></div>
            </p><br>
            <p><input class="submit" type="submit" value="APPLY" name="submit"/></p><br><br>
            
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
$collection = $db->allotment;
//echo "Collection selected succsessfully<br>";
//insert the data into collection

$regno = $_POST['regno'];
$status = $_POST['status'];
$roomno = $_POST['roomno'];

$query = array('regno'=>$regno);

$cursor = $collection->find($query);

if($cursor->count() == 0)
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
	foreach($cursor as $row)
	{
		$old_status = $row["status"];
		$old_roomno = $row["roomno"];
	}
	
	$collection->update(array("status"=>"$old_status"),
	array('$set'=>array("status"=>"$status")));	
	
	$collection->update(array("roomno"=>"$old_roomno"),
	array('$set'=>array("roomno"=>"$roomno")));
	
	echo
	"
	<script>
	document.getElementById('warning').innerHTML='<font style=\'color: green\'>*APPLIED SUCCESSFULLY.</font>';	
	</script>
	";
}
}
?>