<?php

include_once('include/db_connect_pdo.php');	
 
// Define variables and initialize with empty values
$title = $year = $name = $style = $media = "";
$title_err = $year_err = $name_err = $style_err = $media_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";
    } elseif(!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $title_err = "Please enter a valid title.";
    } else{
        $title = $input_title;
    }
	// Validate year
    $input_year = trim($_POST["year"]);
    if(empty($input_year)){
        $year_err = "Please enter the year.";     
    } elseif(!ctype_digit($input_year)){
        $year_err = "Please enter a positive integer value.";
    } else{
        $year = $input_year;
    }
	
	// Validate name	
	$input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please select an artist.";
    } else{
        $name = $input_name;
    }
	
	// Validate style
	$input_style = trim($_POST["style"]);
    if(empty($input_style)){
        $style_err = "Please select art style.";
    } else{
        $style = $input_style;
    }
	
	// Validate media
	$input_media = trim($_POST["media"]);
    if(empty($input_media)){
        $media_err = "Please select a media.";
    } else{
        $media = $input_media;
    }	
			
	if(isset($_FILES['thumbnail'])) {
		if (is_uploaded_file($_FILES['thumbnail']['tmp_name'])) {
			$thumbnailData = file_get_contents($_FILES['thumbnail']['tmp_name']);			
		}
	}
	
	if(isset($_FILES['image'])) {
		if (is_uploaded_file($_FILES['image']['tmp_name'])) {
			$imageData = file_get_contents($_FILES['image']['tmp_name']);			
		}
	}
            
    // Check input errors before inserting in database
    if(empty($title_err)&& empty($year_err)){
		try {        
			$sql = "INSERT INTO painting (Title,Year,ArtistName,ArtStyle,Medium,Thumbnail,Image) VALUES (?,?,?,?,?,?,?)";			 
			if($stmt = $pdo -> prepare($sql)){
				if($stmt->execute([$title,$year,$name,$style,$media,$thumbnailData,$imageData])){
					// Records created successfully. Redirect to landing page
					header("location: paintingtable.php");
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
    <title>Create Painting</title>

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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add painting record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>                        
						<div class="form-group">
                            <label>Year</label>
                            <input type="text" name="year" class="form-control <?php echo (!empty($year_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $year; ?>">
                            <span class="invalid-feedback"><?php echo $year_err;?></span>
                        </div>      												
						<label for="name">Select an artist</label>
						<select name="name" class="form-select"">													
  <?php		 
						if(empty($name)){
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
						} else {													 
							echo '<option value=" '.$name.'" selected> '.$name.'</option>';
						}		
  ?>                        
						</select>			
						<label for="style">Select art style</label>
						<select name="style" class="form-select">
  <?php		
						if(empty($style)){
							try {
								$sql = "SELECT * FROM Style";
								$result = $pdo->query($sql);			
								if ($result->rowCount()>0){							
									while($row = $result->fetch()){																
										echo '<option value="'. $row["ArtStyle"].'">' .$row["ArtStyle"].'</option>';
									}
									unset($result);
								}												
							} catch(PDOException $e) {
								die("ERROR: Could not able to execute $sql. " . $e->getMessage());
							}
						} else {							
							echo '<option value="'. $style.'" selected>' . $style.'</option>';
						}															
  ?>
						</select>
						<label for="media">Select media</label>
						<select name="media" class="form-select">							
  <?php	
						if(empty($media)){
							try {
								$sql = "SELECT * FROM Media";
								$result = $pdo->query($sql);			
								if ($result->rowCount()>0){							
									while($row = $result->fetch()){																
										echo '<option value="'. $row["Medium"].'">' .$row["Medium"].'</option>';
									}
									unset($result);
								}												
							} catch(PDOException $e) {
								die("ERROR: Could not able to execute $sql. " . $e->getMessage());
							}
						} else {							
							echo '<option value="'. $media.'" selected>' . $media.'</option>';
						}											
  ?>
						</select>						
						<div class="form-group">
                            <label>Upload thumbnail file</label>
                            <input type="file" name="thumbnail" class="full-width">                            
                        </div>      						
						<div class="form-group">
                            <label>Upload image file</label>
                            <input type="file" name="image" class="full-width">                            
                        </div>      						
                        <input type="submit" class="btn btn-primary" value="Submit">						
                        <a href="paintingtable.php" class="btn btn-secondary ml-2">Cancel</a>
  <?php					include_once('include/db_close_pdo.php');		  					?>
                    </form>
                </div>
            </div>        
        </div>    
	</main> 
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>  
  </body>
</html>