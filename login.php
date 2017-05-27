<div class="login-wrapper">
	<div class="login-wrapper-inner">
		<div class="login-container">
			<div class="inner cover">
				<h1 class="cover-heading ozdobne velke">Pošli to dál...</h1>
	
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<input type="text" name="jmeno" placeholder="Jméno"><br><br>
					<input type="password" name="heslo" placeholder="Heslo"><br><br>
					<input type="submit" value="Přihlásit"><br><br>
					<input type="hidden" name="login_post">
				</form><br>
	
				<p class="lead">	
					<?php
						echo $nameErr."<br>";
						echo $passErr."<br>";
						echo $loginErr."<br>";
					?>
				</p>
			</div>
	
			<div class="mastfoot">
				<div class="inner">
					<p>Cover template for <a href="http://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
				</div>
			</div>
		</div>
	</div>
</div>
