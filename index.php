<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Low Kok Wei">    
    <title>Index</title>

	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">        
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  
  <body>    		    
  <?php
	include_once('include/navbar.php');
	//include_once('include/db_init_oop.php');	
	include('include/db_connect_pdo.php');		
  ?>
  	<main class="container">
	  <div class="bg-light p-3 rounded">
		<h1>Paintings</h1> 
  <?php		
			try {
				$sql = "SELECT * FROM painting";
				$result = $pdo->query($sql);			
				if ($result->rowCount()>0){
  ?>
				<div class="row row-cols-3 g-3">
  <?php				while($row = $result->fetch()){					?>
						<div class="card-columns">
						  <div class="card">
							<img class="card-img-top" src="data:image/png;base64, <?php echo base64_encode($row['Thumbnail']); ?>" alt="Card image cap">
							<div class="card-body">
							  <h5 class="card-title">Title : <?=$row['Title']?></h5>
							  <p class="card-text">Year : <?=$row['Year']?></p>
							  <p class="card-text">Artist : <?=$row['ArtistName']?></p>
							  <p class="card-text">Style : <?=$row['ArtStyle']?></p>
							  <p class="card-text">Media : <?=$row['Medium']?></p>
							  <a href="painting.php?&title=<?=$row['Title']?>" class="btn btn-primary">View</a>
							</div>
						  </div>						  
						</div>					
  <?php				
					}
					unset($result);
  ?>
				</div>
  <?php				
				}  					
			} catch(PDOException $e) {
				die("ERROR: Could not able to execute $sql. " . $e->getMessage());
			}
			include_once('include/db_close_pdo.php');			
  ?>
	  </div>
	</main>  
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>  
  </body>
</html>