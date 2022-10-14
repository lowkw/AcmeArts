<?php
try {  	
	$pdo = new PDO ("mysql:host=localhost","root","");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "CREATE DATABASE IF NOT EXISTS acmeArtsDB";
	executeStmt($pdo,$sql);
					
	$sql = "USE acmeArtsDB";
	executeStmt($pdo,$sql);
	
	$sql = "DROP TABLE IF EXISTS Painting";
	executeStmt($pdo,$sql);

	$sql = "DROP TABLE IF EXISTS Artist";
	executeStmt($pdo,$sql);
		
	$sql = "CREATE TABLE Artist(
			ArtistName VARCHAR(255) NOT NULL,
			PRIMARY KEY(ArtistName)
			)";
	executeStmt($pdo,$sql);
					
	$sql = "INSERT INTO Artist(ArtistName)
			VALUES 
				('August Renoir'),
				('Michelangelo'),
				('Vincent Van Gogh'),
				('Leonardo da Vinci'),
				('Claude Monet'),
				('Pablo Picasso'),
				('Salvador Dali'),
				('Paul Cezanne')";
	executeStmt($pdo,$sql);
	
	$sql = "DROP TABLE IF EXISTS Style";
	executeStmt($pdo,$sql);
					
	$sql = "CREATE TABLE Style(
			ArtStyle VARCHAR(255) NOT NULL,
			PRIMARY KEY(ArtStyle)
			)";
	executeStmt($pdo,$sql);
	
	$sql = "INSERT INTO Style(ArtStyle)
			VALUES 
				('Impressionism'),
				('Mannerism'),
				('Still-life'),
				('Portrait'),
				('Realism'),
				('Cubism'),
				('Surrealism')";
	executeStmt($pdo,$sql);
	
	$sql = "DROP TABLE IF EXISTS Media";
	executeStmt($pdo,$sql);
	
	$sql = "CREATE TABLE Media(
			Medium VARCHAR(255) NOT NULL,
			PRIMARY KEY(Medium)
			)";
	executeStmt($pdo,$sql);
	
	$sql = "INSERT INTO Media(Medium)
			VALUES 
				('oil'),
				('pen-ink')";
	executeStmt($pdo,$sql);

	
	$sql = "CREATE TABLE Painting(
			Title VARCHAR(255) NOT NULL,
			Year INT NOT NULL,
			Thumbnail BLOB,
			Image LONGBLOB,
			ArtistName VARCHAR(255),
			ArtStyle VARCHAR(255),
			Medium VARCHAR(255),
			PRIMARY KEY(Title),
			FOREIGN KEY(ArtistName) REFERENCES Artist(ArtistName),
			FOREIGN KEY(ArtStyle) REFERENCES Style(ArtStyle),
			FOREIGN KEY(Medium) REFERENCES Media(Medium)
			)";
	executeStmt($pdo,$sql);
	
	$sql = array(
		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Bal du moulin de la Galette', '1876', NULL, NULL, 'August Renoir', 'Impressionism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Doni Tondo (Doni Madonna)', '1507', NULL, NULL, 'Michelangelo', 'Mannerism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Vase with Twelve Sunflowers', '1888', NULL, NULL, 'Vincent Van Gogh', 'Still-life', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Mona Lisa', '1503', NULL, NULL, 'Leonardo da Vinci', 'Portrait', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('The Potato Eaters', '1885', NULL, NULL, 'Vincent Van Gogh', 'Realism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Sunrise', '1972', NULL, NULL, 'Claude Monet', 'Impressionism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Weaver', '1884', NULL, NULL, 'Vincent Van Gogh', 'Realism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Nature morte au compotier', '1914', NULL, NULL, 'Pablo Picasso', 'Cubism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Houses of Parliament', '1899', NULL, NULL, 'Claude Monet', 'Impressionism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Cafe Terrace at Night', '1888', NULL, NULL, 'Vincent Van Gogh', 'Impressionism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('At the Lapin Agile', '1905', NULL, NULL, 'Pablo Picasso', 'Impressionism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('The Persistence of Memory', '1931', NULL, NULL, 'Salvador Dali', 'Surrealism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('The Hallucinogenic Toreador', '1970', NULL, NULL, 'Salvador Dali', 'Surrealism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Jaz de Bouffan', '1877', NULL, NULL, 'Paul Cezanne', 'Impressionism', 'oil');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('Vitruvian Man', '1490', NULL, NULL, 'Leonardo da Vinci', 'Realism', 'pen-ink');",

		"INSERT INTO `painting` (`Title`, `Year`, `Thumbnail`, `Image`, `ArtistName`, `ArtStyle`, `Medium`) VALUES ('The Kingfisher', '1495', NULL, NULL, 'Vincent Van Gogh', 'Realism', 'pen-ink');",
	);
	foreach($sql as $insert) {
		executeStmt($pdo,$insert);
	}				
} catch(PDOException $e) {
	die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}			
unset($pdo);

function executeStmt($pdo, $sql) {
	if($stmt = $pdo -> prepare($sql)){
		if($stmt->execute()){
			unset($stmt);}}
}