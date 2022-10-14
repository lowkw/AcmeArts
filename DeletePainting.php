<?php
// Team      : ALE (Atit, Ellena, Low)
// Developer : Low, Kok Wei
// Date      : Oct 2022
?>
<?php

include_once('include/db_connect_pdo.php');	 
 
// Proces delete operation after confirmation
if(isset($_POST["title"]) && !empty($_POST["title"])){    
    $title = $_POST["title"];
		          
	try {        		
		$sql = "DELETE FROM Painting WHERE Title=?";
		if($stmt = $pdo -> prepare($sql)){
			if($stmt->execute([$title])){
				// Record deleted successfully. Redirect to landing page
				header("location: PaintingTable.php");
				exit();
			} else{
				echo "Something went wrong. Please try again later.";
			}
		}
		unset($stmt);
	} catch(PDOException $e) {
		die("ERROR: Could not able to execute $sql. " . $e->getMessage());
	}			            
	include_once('include/db_close_pdo.php');    
} else {
	if(empty(trim($_GET["title"]))){
		//Redirect to landing page					
		header("location: PaintingTable.php");
		exit();					
	}
}     		
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Low Kok Wei">    
    <title>Delete Painting</title>

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>                    
					<!-- Avoid PHP_SELF exploit -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<div class="alert alert-danger">
                            <input type="hidden" name="title" value="<?php echo trim($_GET["title"]); ?>"/>
                            <p>Are you sure you want to delete this art record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
								<!-- No button to redirect to landing page -->
                                <a href="PaintingTable.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>    
	</main> 
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>  
  </body>
</html>