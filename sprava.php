<div class="row">
	<div class="col-sm-2">
		<a href="?go=root&section=category" class="btn btn-info btn-block" role="button">Kategorie</a>
		<a href="?go=root&section=users" class="btn btn-info btn-block" role="button">Uživatelé</a>
		<a href="?go=root&section=things" class="btn btn-info btn-block" role="button">Věci</a>
	</div>
	
	<div class="col-sm-10">
		<?php
			switch ($_GET['section']) {
				case 'category':
					if (isset($_POST['remove_cat'])) {
						$sql = "DELETE FROM kategorie WHERE id=".$_POST['cat_id'];
						$db->query($sql);
					}

					if (isset($_POST['add_cat'])) {
						$sql = "INSERT INTO kategorie (nazev, glyphicon, oznaceni) VALUES ('".$_POST['cat_nazev']."','".$_POST['cat_glyphicon']."','".$_POST['cat_oznaceni']."')";
	
						if (mysqli_query($db, $sql)) {
							echo "New record created successfully";
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($db);
						}
					}

					if (isset($_POST['update_cat'])) {
						if (!empty($_POST['cat_nazev'])) {
							$sql = "UPDATE kategorie SET nazev='".$_POST['cat_nazev']."' WHERE id=".$_POST['cat_id'];
							$db->query($sql); }
						if (!empty($_POST['cat_glyphicon'])) {
							$sql = "UPDATE kategorie SET glyphicon='".$_POST['cat_glyphicon']."' WHERE id=".$_POST['cat_id'];
							$db->query($sql); }
						if (!empty($_POST['cat_oznaceni'])) {
							$sql = "UPDATE kategorie SET oznaceni='".$_POST['cat_oznaceni']."' WHERE id=".$_POST['cat_id'];
							$db->query($sql); }
					}
					
					echo "<table class='table'>
						<thead>
							<tr>
								<th>id</th>
								<th>nazev</th>
								<th>glyphicon</th>
								<th>oznaceni</th>
								<th></th>
							</tr>
						</thead>
						<tbody>";

					$sql = "SELECT id, nazev, glyphicon, oznaceni FROM kategorie";
					$result = $db->query($sql);

					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>
								<td>".(string)$row['id']."</td>
								<td>".(string)$row['nazev']."</td>
								<td><span class='glyphicon glyphicon-".(string)$row['glyphicon']."'>&nbsp;".(string)$row['glyphicon']."</span></td>
								<td>".(string)$row['oznaceni']."</td>
								<td><form method='post'>
									<input type='hidden' name='cat_id' class='btn btn-danger' value='".(string)$row['id']."'>
									<input type='submit' name='remove_cat' class='btn btn-danger' value='Odebrat'>
								</form></td>
							</tr>";
						}
					} else {
						echo "0 results";
					}
					echo " <tr><form method='post'>
						<td><input type='number' name='cat_id'></td>
						<td><input type='text' name='cat_nazev'></td>
						<td><input type='text' name='cat_glyphicon'></td>
						<td><input type='text' name='cat_oznaceni'></td>
						<td><input type='submit' name='update_cat' value='Změň'></td>
					</form></tr>";
					echo " <tr><form method='post'>
						<td></td>
						<td><input type='text' name='cat_nazev'></td>
						<td><input type='text' name='cat_glyphicon'></td>
						<td><input type='text' name='cat_oznaceni'></td>
						<td><input type='submit' name='add_cat' value='Přidej'></td>
					</form></tr>";					
					echo " </tbody></table><br>";
					break;
				
				case 'users':
					if (isset($_POST['remove_user'])) {
						$sql = "DELETE FROM users WHERE id=".$_POST['user_id'];
						$db->query($sql);
					}

					if (isset($_POST['add_user'])) {
						$name = mysqli_real_escape_string($db, $_POST["name"]);
						$password = mysqli_real_escape_string($db, $_POST["password"]);

						$sql = "INSERT INTO users (name, password) VALUES ('".$name."','".$password."')";
		
						if (mysqli_query($db, $sql)) {
							echo "New record created successfully";
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($db);
						}
					}
					
					echo "<table class='table'>
						<thead>
							<tr>
								<th>id</th>
								<th>name</th>
								<th>password</th>
								<th>registration</th>
								<th>last_login</th>
								<th></th>
							</tr>
						</thead>
						<tbody>";

					$sql = "SELECT id, name, password, registration, last_login FROM users";
					$result = $db->query($sql);

					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>
								<td>".(string)$row['id']."</td>
								<td>".(string)$row['name']."</td>
								<td>".(string)$row['password']."</td>
								<td>".(string)$row['registration']."</td>
								<td>".(string)$row['last_login']."</td>
								<td><form method='post'>
									<input type='hidden' name='user_id' class='btn btn-danger' value='".(string)$row['id']."'>
									<input type='submit' name='remove_user' class='btn btn-danger' value='Odebrat'>
								</form></td>
							</tr>";
						}
					} else {
						echo "0 results";
					}
					echo " <tr><form method='post'>
						<td></td>
						<td><input type='text' name='name'></td>
						<td><input type='text' name='password'></td>
						<td></td>
						<td></td>
						<td><input type='submit' name='add_user' value='Přidat'></td>
					</form></tr>";
					echo " </tbody></table>";
					break;
				
				case 'things':
					echo "<table class='table'>
						<thead>
							<tr>
								<th>id</th>
								<th>nazev</th>
								<th>popis</th>
								<th>uzivatel</th>
								<th>datum</th>
								<th>id_kategorie</th>
								<th></th>
							</tr>
						</thead>
						<tbody>";

					$sql = "SELECT id, nazev, popis, uzivatel, datum, id_kategorie FROM veci";
					$result = $db->query($sql);

					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>
								<td>".(string)$row['id']."</td>
								<td>".(string)$row['nazev']."</td>
								<td>".(string)$row['popis']."</td>
								<td>".(string)$row['uzivatel']."</td>
								<td>".(string)$row['datum']."</td>
								<td>".(string)$row['id_kategorie']."</td>
								<td><form method='post'>
									<input type='hidden' name='item_id' class='btn btn-danger' value='".(string)$row['id']."'>
									<input type='submit' name='remove_item' class='btn btn-danger' value='Odebrat'>
								</form></td>
							</tr>";
						}
					} else {
						echo "0 results";
					}
					echo " </tbody></table>";
					break;
				default:
			}		
		?>
	</div>
</div>
