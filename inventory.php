<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Low Kok Wei">    
    <title>Painting</title>

	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">        
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  
  <body>    		    
  <?php
	include_once('include/navbar.php');
	include_once('include/db_connect_oop.php');
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "SELECT id, question from QueDef where id = '$id'";
			$result = $mysqli->query($sql);						
	} else {
		exit('Painting does not exist');
	}
	
  ?>
  	<main class="container">
	  <div class="bg-light p-3 rounded">
		<h1>Painting</h1> 
  <?php		
			if ($result->num_rows>0){
				echo "<div class=\"row row-cols-2 g-3\">";
				$row = $result->fetch_assoc()
  ?>				
					<div class="card-columns">
					  <div class="card">
						<img class="card-img-top" src="..." alt="Card image cap">
						<div class="card-body">
						  <h5 class="card-title">Card title</h5>
						  <p class="card-text">Title : <?=$row["question"]?></p>
						  <p class="card-text"><small class=\"text-muted\">Last updated 3 mins ago</small></p>
						</div>						
					  </div>						  
					</div>					
  <?php									  
				echo "</div>";
			}
			include_once('include/db_close_oop.php');			
  ?>
	</div>
	</main>  
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>  
  </body>
</html>