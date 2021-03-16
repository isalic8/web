<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Openvpn LAN</title>
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
	<h1>Accessing devices on vlan</h1>
	<h3>Preface</h3>
	<p>Here's how you give VLAN hosts access to other hosts on the vlan. I used <a href="https://github.com/Nyr/openvpn-install.git">this install script</a></p>

	<pre>
$ vim /etc/openvpn/server.conf

[...]
push "route 10.8.0.2 255.255.255.0"
push "route 10.8.0.3 255.255.255.0"
	</pre>

	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
