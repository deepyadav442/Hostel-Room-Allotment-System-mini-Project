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
          <li class="selected"><a href="user.php">PROFILE</a></li>
          <li ><a href="roomallot_form.php">Room Allotment Form</a></li>
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
        <h3>Latest News</h3>
        <h4>Website Launched</h4>
        <h5>September 2014</h5>
        <p>Take a look around and let us know what you think.</p>
        <h3>Useful Links</h3>
        <ul>
           <li><a href="index.html" target="_self">Site Home</a></li>
          <li><a href="http://www.aitpune.com/" target="new">AIT Website</a></li>
          <li><a href="https://www.facebook.com/aitpune" target="new">AIT Facebook Page</a></li>
          <li><a href="https://www.facebook.com/pages/AIT-MESS/697808350268994?ref=br_rs" target="new">AIT Mess Facebook Page</a></li>
        </ul>
      </div>
      <div id="content">
        <!-- form contents -->
        
        <form action="user.php" method="post"">
        <p>
        <h1> WELCOME </h1>  
        <h2><div id="fullname1" align="justify"></div></h2>
        <h1> YOUR PROFILE: </h1>
        <table style="width:100%; border-spacing:0;">
          
          <tr><td>Full Name: </td><td id="fullname2"></td></tr>
          <tr><td>Reg. No.: </td><td id="regno"></td></tr>
          <tr><td>E-mail:</td><td id="email"></td></tr>
          <tr><td>Mobile Number:</td><td id="mobile"></td></tr>
          <tr><td>Current Year:</td><td id="year"></td></tr>
          <tr><td>Branch:</td><td id="branch"></td></tr>
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
if(isset($_SESSION['login_user']))
{
// connect to mongodb
$m = new MongoClient();

// select a database
$db = $m->HMS;

//select collection
$collection = $db->registration;

$query = array('regno'=>$current_user);

$cursor = $collection->find($query);

	foreach($cursor as $row)
	{
		$fullname = $row["fname"];
		$regno = $row["regno"];
		$email = $row["email"];
		$mobile = $row["mobile"];
		$year = $row["year"];
		$branch = $row["branch"];
	}
	echo
		"
		<script>
		document.getElementById('fullname1').innerHTML='$fullname';	
		document.getElementById('fullname2').innerHTML='$fullname';
		document.getElementById('regno').innerHTML='$regno';
		document.getElementById('email').innerHTML='$email';
		document.getElementById('mobile').innerHTML='$mobile';
		document.getElementById('year').innerHTML='$year';
		document.getElementById('branch').innerHTML='$branch';
		</script>
		";
}
else 
{
	header("Location: login.php");
}
?>