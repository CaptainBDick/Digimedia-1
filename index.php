<?php include "header.php"; ?>

    <div class="hero-unit">
        <h1>Voorraadbeheer</h1>
		<?php
		if(isset($_POST['submit']))
		{
			//test
			$query = $db->prepare("SELECT * FROM personeel WHERE email=:email AND wachtwoord=:wachtwoord");

			$query->bindParam(':email',$_POST['email']);
			$query->bindParam(':wachtwoord',sha1($_POST['wachtwoord']));

			$query->execute();

			if($query->rowCount() > 0)
			{
				$_SESSION['login'] = true;
				echo "<p>U word nu ingelogd...</p>";
				echo '<meta http-equiv="refresh" content="1">';
			}
			else
			{
				$message = '<div class="alert alert-error">Uw email of wachtwoord klopt niet.</div>';
			}
		}
		?>
		<?php if(!isset($_SESSION['login'])) { ?>
        <p>
            Gebruik het onderstaande formulier om in te loggen. MARCO
        </p>
		<?php if(isset($message)){echo $message;} ?>
        <form class="form-horizontal" method="post" action="">
            <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input type="email" required="required" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="wachtwoord">Wachtwoord</label>
                <div class="controls">
                    <input type="password" required="required" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="submit" class="btn">Inloggen</button>
                </div>
            </div>
        </form>
		<?php

		}
		elseif($_SESSION['login'])
		{
			//user is logged in
			echo "<p>U bent ingelogd</p>";
		}

		?>
    </div>

<?php include "footer.php"; ?>
