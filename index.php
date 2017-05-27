<?php		
	include('_configure.php');

	function IsLogged() {
		if(!isset($_SESSION['login_user']))
			return FALSE;
		else return TRUE;
	}
	
	function IsRoot() {
		return $_SESSION['root'];
	}
	
	if ($_SERVER["REQUEST_METHOD"]=="POST")
		if (!IsLogged()) {
			if (empty($_POST["jmeno"])) { $nameErr = "Chybí jméno."; }
			if (empty($_POST["heslo"])) { $passErr = "Chybí heslo."; }
	
			if (empty($nameErr) & empty($passErr)) {
				$myusername = mysqli_real_escape_string($db,$_POST['jmeno']);
				$mypassword = mysqli_real_escape_string($db,$_POST['heslo']);
				
				$sql = "SELECT id, DATE_FORMAT(last_login, '%e. %c. %Y') AS last_date FROM users WHERE name = '$myusername' and password = '$mypassword'";
				$result = mysqli_query($db,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$count = mysqli_num_rows($result);
	     	
				// If result matched $myusername and $mypassword, table row must be 1 row
				
				if($count == 1) {
					$_SESSION['login_user'] = $myusername;
					$_SESSION['login_user_id'] = $row['id'];
					$_SESSION['last_login'] = $row['last_date'];

					$sql = "UPDATE users SET last_login = CURTIME() WHERE name = '$myusername'";
					$db->query($sql);

					$sql = "SELECT id FROM root WHERE user_name = '".$_SESSION['login_user']."'";
					$result = mysqli_query($db,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$count = mysqli_num_rows($result);

					if($count == 1) $_SESSION['root'] = TRUE; else $_SESSION['root'] = FALSE;

					header("Refresh:0");
				} else {
					$nameErr = "Špatné jméno nebo heslo.";
				}
			}
		} else {
			if (isset($_POST['add_new'])) {
				$nazev = mysqli_real_escape_string($db, $_POST["nazev"]);
				$popis = mysqli_real_escape_string($db, $_POST["popis"]);

				$sql = "INSERT INTO veci (nazev, popis, uzivatel, id_kategorie) VALUES ('".$nazev."','".$popis."','".(string)$_SESSION['login_user_id']."','".(string)$_POST['kategorie']."')";
	
				if (mysqli_query($db, $sql)) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($db);
				}
			}

			if (isset($_POST['remove_item'])) {
				$sql = "DELETE FROM veci WHERE id=".$_POST['item_id'];
				$db->query($sql);
			}
		}
?>

<html lang="cs">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">

	<title>Pošli to dál</title>
  </head>

  <body>
	<?php
		if (IsLogged())
			include('main.php');
		else include('login.php')
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  </body>
</html>
