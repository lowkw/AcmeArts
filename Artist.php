<?php
// Team      : ALE (Atit, Ellena, Low)
// Developer : Low, Kok Wei
// Date      : Oct 2022
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Low Kok Wei">        
	<title>Artist</title>

	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">       
	<!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  
  <body>    	
  <?php
	include_once('include/navbar.php');
	include_once('include/db_connect_pdo.php');	
  ?>	

  
	<main class="container">
	  <div class="bg-light p-3 rounded">
		<h1>Artist</h1>				
			<!-- Prompt user to select an artist and submit the form -->
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
				<select name="ArtistName" class="form-select">
					<option selected>Select an artist</option>
  <?php		
					try {
						$sql = "SELECT * FROM Artist";
						$result = $pdo->query($sql);			
						if ($result->rowCount()>0){							
							while($row = $result->fetch()){																
								echo '<option value="'. $row["ArtistName"].'">' .$row["ArtistName"].'</option>';
							}
							unset($result);
						}												
					} catch(PDOException $e) {
						die("ERROR: Could not able to execute $sql. " . $e->getMessage());
					}																		
  ?>
				</select>			
			<button type="submit" class="btn btn-primary" name="Select">Submit</button>
			</form>
  <?php		
			//Processing selected artist after self-call is submitted
			if (isset($_POST['Select'])) {
				if(!empty($_POST['ArtistName'])) {
					$selected = $_POST['ArtistName'];
					
					try {
						$sql = "SELECT * FROM Painting WHERE ArtistName = '$selected'";
						$result = $pdo->query($sql);			
						if ($result->rowCount()>0){
										
							echo "<div class=\"row row-cols-3 g-3 p-3\">";
							while($row = $result->fetch()){
							//Load paintings of selected artist
  ?>
								<div class="card-columns">
								  <div class="card">
									<img class="card-img-top" src="data:image/png;base64, <?php echo base64_encode($row['Thumbnail']); ?>" alt="Card image cap">
									<div class="card-body">
									  <h5 class="card-title">Title : <?=$row['Title']?></h5>
									  <p class="card-text">Year : <?=$row['Year']?></p>
									  <p class="card-text">Artist : <?=$row['ArtistName']?></p>
									  <p class="card-text">Style : <?=$row['ArtStyle']?></p>
									  <p class="card-text">Media : <?=$row['Medium']?></p>
									  <a href="Painting.php?&title=<?=$row['Title']?>" class="btn btn-primary">View</a>
									</div>
								  </div>						  
								</div>				
  <?php															
							}
							unset($result);
							echo "</div>";							
						}
					} catch(PDOException $e) {
						die("ERROR: Could not able to execute $sql. " . $e->getMessage());
					}
				}
			}
			include_once('include/db_close_pdo.php');		  					
  ?>
	</div>
	</main>  
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  
  </body>
</html>