<h1>Toto jsou čerstvé přírůstky</h1>

<div class="row">
	<?php
		if (isset($_GET['filter'])) {
			mysqli_real_escape_string($db, $_POST["nazev"]);
			$sql = "SELECT id FROM kategorie WHERE oznaceni = '".mysqli_real_escape_string($db, $_GET["filter"])."'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
				
			if($count == 1) $filter = $row['id'];
		}	

		if (isset($filter))		
			$sql = "SELECT veci.id, veci.nazev, veci.popis, veci.datum, users.name AS name, kategorie.glyphicon AS glyphicon FROM veci JOIN users ON veci.uzivatel = users.id JOIN kategorie ON veci.id_kategorie = kategorie.id WHERE veci.id_kategorie='".(string)$filter."' ORDER BY veci.datum DESC";
		else
			$sql = "SELECT veci.id, veci.nazev, veci.popis, veci.datum, users.name AS name, kategorie.glyphicon AS glyphicon FROM veci JOIN users ON veci.uzivatel = users.id JOIN kategorie ON veci.id_kategorie = kategorie.id ORDER BY veci.datum DESC";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<div data-item='".(string)$row['id']."' class='col-sm-3 inner'><div class='item_box'>
					<h2><span class='glyphicon glyphicon-".$row['glyphicon']."'>&nbsp;</span>".$row["nazev"]."</h2>
					<p>".$row["popis"]."</p>
					<p>Nabízí: ".$row["name"]." - ".$row["datum"]."</p>
					<form method='post'>
						<input type='hidden' name='item_id' class='btn btn-danger' value='".(string)$row['id']."'>";
				if ($_SESSION['login_user']==$row["name"])
					echo "<input type='submit' name='remove_item' class='btn btn-danger' value='Odebrat'>";
				else echo "<input type='submit' name='zajem' class='btn btn-default' value='Mám zájem'>";
				
				echo "</form></div></div>";
			}
		} else {
			echo "0 results";
		}
	?>
</div>
