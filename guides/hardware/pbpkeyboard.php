<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Keyboard Updater</title>
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
<!--<small>5-27-20</small>-->
<h1>Updating the Pinebook Pros keyboard</h1>

<h3>Preface</h3>
<p>This is a verbatim copy of the directions written on 
<a href="https://github.com/jackhumbert/pinebook-pro-keyboard-updater" target="_blank">jackhumbert's git.</a>
</p>

<h3>Installtion</h3>
<pre>
# compile
git clone https://github.com/jackhumbert/pinebook-pro-keyboard-updater
cd pinebook-pro-keyboard-updater
sudo apt-get install build-essential libusb-1.0-0-dev xxd 
make

# For ISO keyboard
# step-1
sudo ./updater step-1 iso
sudo reboot

# after reboot, step-2
sudo ./updater step-2 iso
sudo reboot

# For ANSI keyboard
# step-1
sudo ./updater step-1 ansi
sudo reboot

# after reboot, step-2
sudo ./updater step-2 ansi
sudo reboot

# updating to the revised ansi firmware after steps 1 and 2
sudo ./updater flash-kb firmware/default_ansi.hex

# updating to the revised iso firmware after steps 1 and 2
sudo ./updater flash-kb firmware/default_iso.hex
</pre>

<h3>Modifications</h3>
<ol>
	<li>Corrected Fn+F9-12 keys for ANSI (ISO version didn't have this issue)</li>
	<li>Arrow (and other) keys work with the Pine (GUI) key</li>
	<li>NumLock is respected only in the Fn layer, i.e. NumLock can be left on all the time</li>
	<li>Privacy switches now send keycodes when being enabled/disabled, for working into scripts/notifications</li>
</ol>

<pre>
# KEY CODES
F14: Microphone Enabled
F18: Microphone Disabled
F13: Wifi Enabled
F17: Wifi Disabled
F15: Camera Enabled
F19: Camera Disabled
</pre>

</div>
</body>
</html>
