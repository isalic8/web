<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title></title>
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
	<h1>Raspberry pi no network</h1>
	<h3>Problem</h3>
	<p>
	Raspeberry pi is configured with a static ip. It's able to fetch files from raspbian servers. It can't access the internet outside that.
	</p>

	<h3>Fix</h3>
	<p>
	I'm not entirly sure HOW this fixes the problem, but apparently all you need to do is run dhclient on the machine. I don't know what causes your static ip setup to suddenly stop working, even when the right addressing information is set.
	<br>
	</p>

	<pre>
$ dhclient
	</pre>

	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
