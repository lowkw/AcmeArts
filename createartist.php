<?php

include_once('include/db_connect_pdo.php');	
 
// Define variables and initialize with empty values
$name = "";
$name_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
            
    // Check input errors before inserting in database
    if(empty($name_err)){
		try {        
			$sql = "INSERT INTO artist (ArtistName) VALUES (?)";			 
			if($stmt = $pdo -> prepare($sql)){
				if($stmt->execute([$name])){
					// Records created successfully. Redirect to landing page
					header("location: artisttable.php");
					exit();
				} else{
					echo "Something went wrong. Please try again later.";
				}
			}
			unset($stmt);
		} catch(PDOException $e) {
			die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}			
    }        
	include_once('include/db_close_pdo.php');    
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Low Kok Wei">    
    <title>Create Artist</title>

	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">        
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  
  <body>    		    
  <?php
	include_once('include/navbar.php');	
  ?>
	<main class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add artist record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Artist Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="artisttable.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>    
	</main> 
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>  
  </body>
</html>