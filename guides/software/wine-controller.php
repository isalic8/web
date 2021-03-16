<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Wine Controller</title>
</head>
<body>
	<div class="main">
		<div class="header">
			<p>
			<a href="../../index.php">
			Unixfandom.com
			<img src="../../files/pix/penguin.gif" alt="penguin_gif">
			</a>
			</p>
		</div>

		<nav>
			<?php include '../navigation.php';?>
		</nav>
	<h1>Using controller in wine</h1>
	<h3>Preface</h3>
	<p>
	Here's how to hookup an xbox360 controller in wine.
	
	</p>

	<pre>
echo "blacklist xpad" | sudo tee -a /etc/modprobe.d/blacklist.conf
sudo rmmod xpad  # unload module if already loaded

yay -S joystick xboxdrv
sudo xboxdrv --silent 
	</pre>

	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
