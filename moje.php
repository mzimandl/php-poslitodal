<h1>Toto jsou moje věci:</h1>

<div class="row">
	<?php
		$sql = "SELECT veci.id, veci.nazev, veci.popis, veci.datum, users.name AS name, kategorie.glyphicon AS glyphicon FROM veci JOIN users ON veci.uzivatel = users.id JOIN kategorie ON veci.id_kategorie = kategorie.id WHERE name = '".$_SESSION['login_user']."' ORDER BY veci.datum DESC";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<div data-item='".(string)$row['id']."' class='col-sm-3 inner'><div class='item_box'>
					<h2><span class='glyphicon glyphicon-".$row['glyphicon']."'>&nbsp;</span>".$row["nazev"]."</h2>
					<p>".$row["popis"]."</p>
					<p>".$row["datum"]."</p>													
					<form method='post'>
						<input type='hidden' name='item_id' class='btn btn-danger' value='".(string)$row['id']."'>
						<input type='submit' name='remove_item' class='btn btn-danger' value='Odebrat'>
					</form>
				</div></div>";
			}
		} else {
			echo "Nemám nic";
		}
	?>
</div>
