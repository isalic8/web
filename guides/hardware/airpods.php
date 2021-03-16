<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Airpods fix</title>
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
	<h1>Low audio airpods</h1>
	<h3>Preface</h3>
	<p>
	Airpods are stuck at low volume. Here's a fix
	Referencing <a href="https://bbs.archlinux.org/viewtopic.php?id=236209">https://bbs.archlinux.org/viewtopic.php?id=236209</a>
	</p>
	<pre>
# Edit the bluetooth service
$ vim /etc/systemd/system/bluetooth.target.wants/bluetooth.service

# Modify the ExecStart line to look like this
ExecStart=/usr/lib/bluetooth/bluetoothd --plugin=a2dp

# Reload daemons and restart the service
sudo systemctl daemon-reload
sudo systemctl restart bluetooth.service
	</pre>
	
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
