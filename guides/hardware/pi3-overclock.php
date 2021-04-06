<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Raspberry Pi 3 Overclock</title>
</head>
<body>
	<div class="main">
	<div class="header">
		<p>
		Unixfandom.com
		<img src="../../files/pix/penguin.gif" alt="penguin_gif">
		</p>
	</div>

	<nav>
		<?php include '../navigation.php';?>
	</nav>
	<h1>Overclocking the Raspberry Pi Model 3b+</h1>
	<h3>Preface</h3>
	<p>
	Make sure you have a powersupply for the raspberry pi and some type of active cooling.<br>
	Using a standard phone charging brick is just going to cause the pi to power on and off.
	</p>

	<h3>Copy and paste me</h3>
	<p>Append this to /boot/config.txt and then reboot.</p>
<pre>
core_freq=500
arm_freq=1300
over_voltage=4
disable_splash=1
</pre>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
