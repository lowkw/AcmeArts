<?php
	echo "<nav class=\"navbar navbar-expand-md navbar-dark fixed-top bg-dark\">";
	  echo "<div class=\"container-fluid\">";
			echo "<a class=\"navbar-brand\" href=\"#\">Acme Arts</a>";
			
			echo "<button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarCollapse\" aria-controls=\"navbarCollapse\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">";
			  echo "<span class=\"navbar-toggler-icon\"></span>";
			echo "</button>";
			
			echo "<div class=\"collapse navbar-collapse\" id=\"navbarCollapse\">";
			  echo "<ul class=\"navbar-nav me-auto mb-2 mb-md-0\">";
				echo "<li class=\"nav-item\">";
				  echo "<a class=\"nav-link active\" aria-current=\"page\" href=\"about.php\">About</a>";
				echo "</li>";
				echo "<li class=\"nav-item\">";
				  echo "<a class=\"nav-link\" href=\"index.php\">Paintings</a>";
				echo "</li>";
				echo "<li class=\"nav-item\">";
				  echo "<a class=\"nav-link\" href=\"artist.php\">Artist</a>";
				echo "</li>";
				echo "<li class=\"nav-item\">";
				  echo "<a class=\"nav-link\" href=\"style.php\">Style</a>";
				echo "</li>";
				echo "<li class=\"nav-item\">";
				  echo "<a class=\"nav-link\" href=\"contact.php\">Contact</a>";
				echo "</li>";
			  echo "</ul>";
			echo "</div>";
	  echo "</div>";
	echo "</nav>";			
?>