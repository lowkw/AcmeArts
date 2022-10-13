	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	  <div class="container-fluid">
			<a class="navbar-brand" href="#">Acme Arts</a>
			
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarCollapse">
			  <ul class="navbar-nav me-auto mb-2 mb-md-0">
				<li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="about.php">About</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="index.php">Paintings</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="artist.php">Artist</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="style.php">Style</a>
				</li>			
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Inventory
				  </a>
				  <ul class="dropdown-menu dropdown-menu-dark">
					<li><a class="dropdown-item" href="ArtistTable.php">Artist</a></li>
					<li><a class="dropdown-item" href="StyleTable.php">Style</a></li>
					<li><a class="dropdown-item" href="MediaTable.php">Media</a></li>
					<li><a class="dropdown-item" href="PaintingTable.php">Painting</a></li>
				  </ul>
				</li>				
				<li class="nav-item">
				  <a class="nav-link" href="contact.php">Contact</a>
				</li>
			  </ul>
			  <form action="painting.php" class="d-flex" role="search">
					<input class="form-control me-2" type="search" placeholder="Title Search" aria-label="Search" name="title">
					<button class="btn btn-outline-success" type="submit">Search</button>
			  </form>
			</div>
	  </div>
	</nav>			
