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
          <li ><a href="admin.php">Profile</a></li>
          <li ><a href="admin_roomallot.php">Room Allotment</a></li>
          <li class="selected"><a href="admin_search.php">Search Entries</a></li>
          <li><a href="admin_logout.php">LOGOUT</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
     
      <div id="content">
        <!-- form contents -->
        
        <h2>Entries</h2>
        <p>Select year Below to see Entries:
        <form action="admin_search.php" method="post">
          
            <select id="id1" name="year">
            <option value="0"  selected="true">--SELECT HERE--</option>
            <option value="1">SE</option>
            <option value="2">TE</option>
            <option value="3">BE</option>
            </select>
            
            <input type="submit" value="SEARCH">
            
            <div id='warning1'></div>
            <div id='warning2'></div>
            <div id='recordstotal'></div>
          </p>
          
          <table style="width:100%; border-spacing:0;" name="table">
          <tr><th>Reg. No.</th><th>Name</th><th>Branch</th><th>Percentage</th><th>Status</th><th>Room No.</th></tr>
           </form>
          <?php
			// connect to mongodb
			$m = new MongoClient();

			// select a database
			$db = $m->HMS;
			
			//select collection
			$collection = $db->allotment;
			
		
			$year_no = $_POST['year'];
			
			if($year_no == 0)
			{
				echo
				"
				<script>
				document.getElementById('warning1').innerHTML='<font style=\'color: red\'>*Please Selct Year.</font>';											</script>
				";
				$query = array('year'=>"FE");
				$cursor = $collection->find($query);
			}
			else if($year_no == 1)
			{
				$year_get = "SE";
				$query = array('year'=>$year_get);
				$cursor = $collection->find($query);
			}
			else if($year_no == 2)	 
			{
				$year_get = "TE";
				$query = array('year'=>$year_get);
				$cursor = $collection->find($query);
			}
			else if($year_no == 3)	 
			{
				$year_get = "BE";
				$query = array('year'=>$year_get);
				$cursor = $collection->find($query);
			}
				
				
				if($cursor->count() == 0)
				{
				echo
				"
				<script>
				document.getElementById('warning2').innerHTML='<font style=\'color: red\'>*NO RECORDS FOUND.</font>';	
				</script>
				";
				
				}
				$cursor -> sort(array('percentage'=>-1));
				if($year_no!=0)
				{
				foreach($cursor as $row)
				{
					$name = $row["name"];
					$regno = $row["regno"];
					$branch = $row["branch"];
					$per = $row["percentage"];
					$year1 = $row["year"];
					$status = $row["status"];
					$roomno = $row["roomno"];
					if($year1 == $year_get)// && $status==NULL)
					echo
					"<tr>
					<td>$regno</td>
					<td>$name</td>
					<td>$branch</td>
					<td>$per</td>
					<td>$status</td>
					<td>$roomno</td>
					</tr>";
				}
				$total = $cursor->count();
				echo
				"
				<font style=\'color: green\'>
				<div id='recordstotal'>*Total Records = $total</div>
				</font>
				";
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


