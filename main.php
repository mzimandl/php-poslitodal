<div class="content-wrapper">

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
      				</button>
				<a class="navbar-brand ozdobne" href="index.php"><b> Pošli to dál... </b></a>
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategorie<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?php
							$sql = "SELECT id, nazev, glyphicon, oznaceni FROM kategorie";
							$result = $db->query($sql);

							if ($result->num_rows > 0) {
							// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<li><a href='?filter=".$row['oznaceni']."'><span class='glyphicon glyphicon-".$row['glyphicon']."'></span> ".$row['nazev']."</a></li>";
								}
							}
							?>
						</ul>
					</li>
					
					<li><a href="?go=moje">Moje věci</a></li>
					<li><a href="?go=přidat">Nabídnout věc</a></li>
				</ul>
    	
				<ul class="nav navbar-nav navbar-right">
					<li><a href="?go=user"><span class="glyphicon glyphicon-user"></span> Ty jsi <?php echo $_SESSION['login_user'] ?>, poslední přihlášení <?php echo $_SESSION['last_login'] ?> </a></li>
					<li><a href="?go=zpravy"><span class="glyphicon glyphicon-envelope"></span> Zprávy </a></li>
					<li><a href="_logout.php"><span class="glyphicon glyphicon-off"></span> Odhlásit </a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<?php
		switch ($_GET['go']) {
			case "přidat":
				include('pridat.php');
				break;
			case "moje":
				include('moje.php');
				break;
			case "root":
				if (IsRoot())				
					include('sprava.php');
				else echo "Přístup zakázán.";
				break;
    			default:
				include('novinky.php');
		}
	?>	
	
	

</div>
