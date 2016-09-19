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
          <li ><a href="user.php">PROFILE</a></li>
          <li ><a href="roomallot_form.php">Room Allotment Form</a></li>
         <li class="selected"><a href="roomallot_status.php">Allotment Status</a></li>
          <li ><a href="edit_profile.php">EDIT PROFILE</a></li>
          <li><a href="user_logout.php">LOGOUT</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      
      <div id="content">
        <!-- insert the page content here -->
        <h2>Updates </h2>
        <p>Here are some updates :
        <form action="roomallot_status.php" method="post">
         
            <div id='warning1'></div>
          </p>
          
          <table style="width:100%; border-spacing:0;" name="table">
          <tr><th>Status</th><th>Room No.</th></tr>
           </form>
          <?php
			// connect to mongodb
			$m = new MongoClient();

			// select a database
			$db = $m->HMS;
			
			//select collection
			$collection = $db->allotment;
			
			$query = array('regno'=>$current_user);

			$cursor = $collection->find($query);
			
			if($cursor->count() == 0)
				{
				echo
				"
				<script>
				document.getElementById('warning1').innerHTML='<font style=\'color: red\'>*APPLY FIRST.</font>';	
				</script>
				";
				
				}
			else
				{
				foreach($cursor as $row)
				{
					$status = $row["status"];
					$roomno = $row["roomno"];
					if($status != NULL)// && $status==NULL)
					echo
					"<tr>
					<td>$status</td>
					<td>$roomno</td>
					</tr>";
				}
				}

			?>
            
        </table>
      </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">
      | DBMS Mini Project |
    </div>
  </div>
</body>
</html>
