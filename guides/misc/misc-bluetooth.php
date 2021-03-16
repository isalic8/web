<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Bluetooth</title>
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
	<h1>Bluetoothctl</h1>

	<h3>Preface</h3>
	<p>
	More things I cant remember....<a href="https://wiki.archlinux.org/index.php/Bluetooth">BluetoothCTL.</a>
	</p>

	<h3>Usage</h3>
	<pre>
<span class="emph">$ systemctl start bluetooth</span>

<span class="emph">$ bluetoothctl</span>

[bluetooth]$ power on

[bluetooth]$ scan [on|off] 
[CHG] Device 5B:14:5C:16:8B:BF RSSI: -92
[CHG] Device 65:51:C2:6A:07:5B RSSI: -62
[CHG] Device 7F:29:C6:0D:9F:5F Name: Bomb Ass TV
[CHG] Device 7F:29:C6:0D:9F:5F Alias: Bomb Ass TV
[NEW] Device B8:D5:0B:CC:2C:73 JBL Charge 3
[CHG] Device 48:7E:BB:E7:46:99 RSSI: -63
[CHG] Device 5B:14:5C:16:8B:BF RSSI: -81
[CHG] Device 7F:29:C6:0D:9F:5F RSSI: -102
[CHG] Device 65:51:C2:6A:07:5B RSSI: -79

[bluetooth]$ pair B8:D5:0B:CC:2C:73
Attempting to pair with B8:D5:0B:CC:2C:73
Pairing successful

[bluetooth]$ connect
	</pre>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
