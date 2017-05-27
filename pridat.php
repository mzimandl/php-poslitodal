<h1>Nabízím vám toto:</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
	Název: <input type="text" name="nazev">
	Kategorie: <select name="kategorie">
		<?php
			$sql = "SELECT id, nazev FROM kategorie";
			$result = $db->query($sql);

			if ($result->num_rows > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<option value=".(string)$row['id'].">".$row['nazev']."</option>";
				}
			}
		?>
	</select><br>
	Popis: <br>
	<textarea name="popis"></textarea><br><br>
	<input type="submit" name="add_new" value="Přidat věc">
</form>
