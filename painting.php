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
	include_once('include/db_connect_pdo.php');
	if (isset($_GET['title'])){
		//$title = $_GET['title'];	
		$title = filter_var($_GET['title'], FILTER_SANITIZE_STRING);
		try {
			$sql = "SELECT * FROM painting where title = '$title'";
			$result = $pdo->query($sql);			
		} catch(PDOException $e) {
			die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}
	} else {
		exit('Painting does not exist');
	}
	
  ?>
  	<main class="container">
	  <div class="bg-light p-3 rounded">
		<h1>Painting</h1> 
  <?php		
 			if ($result->rowCount()>0){				
				echo "<div class=\"row\">";
				$row = $result->fetch()
  ?>				
				<div class="card-columns">
					<div class="card">						
						<img class="card-img-top" src="data:image/png;base64, <?php echo base64_encode($row['Image']); ?>" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title">Title : <?=$row['Title']?></h5>
							<p class="card-text">Year : <?=$row['Year']?></p>
							<p class="card-text">Artist : <?=$row['ArtistName']?></p>
							<p class="card-text">Style : <?=$row['ArtStyle']?></p>
							<p class="card-text">Media : <?=$row['Medium']?></p>
						</div>						  
					</div>					
  <?php			
				unset($result);
				echo "</div>";
			} else {
  ?>					
				<div class="alert alert-warning " role="alert">				  				  
					Painting title not found 				  
				</div>
  <?php
			}
			include_once('include/db_close_pdo.php');			
  ?>
	</div>
	</main>  
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>  
  </body>
</html>