<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Tor browser script</title>
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
	<h1>Tor browser script</h1>
	<h3>Preface</h3>
	<p>
	Depends on: lynx wget firejail.<br><br>
	You need to have ownership of the /opt/ directory or just modify the script to your needs.
	</p>
	
	<h3>Optional installer</h3>
	<p>
	This installs the most recent version of the tor browser.
	This is wayyyyy faster than using the web browser and could also be executed from scripts.
	</p>
	<pre>
#!/bin/sh
cd /opt
case $(arch) in
	i386|i486|i586|i686)
		wget $(lynx -dump -hiddenlinks=listonly https://www.torproject.org/download/languages/ | grep linux32-.*en-US.tar.xz$ | cut -d' '  -f4)
		;;
	x86_64)
		wget $(lynx -dump -hiddenlinks=listonly https://www.torproject.org/download/languages/ | grep linux64-.*en-US.tar.xz$ | cut -d' '  -f4)
		;;
esac
tar -xJvf tor-browser*en-US.tar.xz
	</pre>

	<h3>Firejail wrapper</h3>
	<p>
	If you don't know, firejail is a container system for linux applications.
	It has hundreds of profiles in /etc/firejail. These permit and restrict specific permissions from applications.
	It happens to have a profile made for the tor browser.
	</p>

	<pre>
#!/bin/sh
# Little wrapper for running tor

cd /opt/tor-browser_*/
firejail --profile=/etc/firejail/tor-browser-en-us.profile ./start-tor-browser.desktop
	</pre>
	
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
