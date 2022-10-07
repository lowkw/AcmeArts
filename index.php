<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Low Kok Wei">    
    <title>About</title>

	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">        
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  
  <body>    		    
  <?php
	include_once('include/navbar.php');
	include_once('include/db_init_oop.php');
	include_once('include/db_connect_oop.php');
  ?>
  	<main class="container">
	  <div class="bg-light p-3 rounded">
		<h1>Paintings</h1> 
  <?php		
			$sql = "SELECT id, question from QueDef";
			$result = $mysqli->query($sql);			
			if ($result->num_rows>0){
				echo "<div class=\"row row-cols-3 g-3\">";
				while($row = $result->fetch_assoc()){					
					echo "<div class=\"card-columns\">";
					  echo "<div class=\"card\">";
						echo "<img class=\"card-img-top\" src=\"...\" alt=\"Card image cap\">";
						echo "<div class=\"card-body\">";
						  echo "<h5 class=\"card-title\">Card title</h5>";
						  echo "<p class=\"card-text\">Title :". $row["question"]."</p>";
						  echo "<p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>";
						echo "</div>";						
					  echo "</div>";						  
					echo "</div>";					
				}
				echo "</div>";
			}
			include_once('include/db_close_oop.php');			
  ?>
	</div>
	</main>  
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>  
  </body>
</html>