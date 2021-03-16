<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Aircrack</title>
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
	<h1>Aircrack</h1>
	<p>
	Aircrack is a package suite that can be used to analyze wifi networks and capture encrypted wireless handshakes.
	This isn't a tutorial. I use it for reference. There are dozens of other guides online on how to use it. 
	<pre>
# Prevents potential error messages
$ airmon-ng check kill

# Starting/Stopping monitor mode
$ airmon-ng [start|stop] wlan1

# Scanning local wifi networks
$ airodump-ng wlan1mon

# Capture wirless packets on a target network to a file
$ airodump-ng wlan1mon --bssid &lt;bssid&gt; -c &lt;channel&gt; -w &lt;file&gt;

# Deauthenticate the target network's hosts. The client mac address isn't required
$ aireplay-ng wlan1mon --deauth 0 -a &lt;bssid&gt; -c &lt;client mac address&gt;
	</pre>

	<h3>Using a word list</h3>
	<p>
	<a href="../files/pentest/mega.txt">Custom wordlist</a>
	<br>
	Depending on your system, running this wordlist against a capture file can take up to 17 hours! I can personally say that this works for most simple wireless passwords.
	</p>
	<pre>
$ aircrack-ng handshake.cap -w wordlist.txt
	</pre>
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
