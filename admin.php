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
          <li class="selected"><a href="admin.php">Profile</a></li>
          <li ><a href="admin_roomallot.php">Room Allotment</a></li>
          <li ><a href="admin_search.php">Search Entries</a></li>
          <li><a href="admin_logout.php">LOGOUT</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
     
      <div id="content">
        <!-- form contents -->
        
        <form action="admin.php" method="post">
        <p>
        <h1> WELCOME </h1>  
        <h2><div id="fullname1" align="justify"></div></h2>
        <h1> YOUR PROFILE: </h1>
        <table style="width:100%; border-spacing:0;">
          
          <tr><td>Full Name: </td><td id="fullname2"></td></tr>
          <tr><td>Unique ID: </td><td id="uid"></td></tr>
          <tr><td>Your Role:</td><td id="role"></td></tr>
        </table>    
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
// connect to mongodb
$m = new MongoClient();

// select a database
$db = $m->HMS;

//select collection
$collection = $db->admin;

$query = array('unique_id'=>$current_user);

$cursor = $collection->find($query);

	foreach($cursor as $row)
	{
		$name = $row["name"];
		$uid = $row["unique_id"];
		$role = $row["role"];
	}
	echo
		"
		<script>
		document.getElementById('fullname1').innerHTML='$name';	
		document.getElementById('fullname2').innerHTML='$name';
		document.getElementById('uid').innerHTML='$uid';
		document.getElementById('role').innerHTML='$role';
		</script>
		";
}
else 
{
	
	header("Location: adminlogin.php");
}
?>