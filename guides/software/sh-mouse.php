<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Mouse script</title>
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
	<h1>Mouse script</h1>
	<h3>Preface</h3>
	<p>
	Changes the mouse acceleration of an input device. No clue why I decided to use printf instead of echo.
	</p>
	<pre>
#!/bin/sh
# Change mouse accel

mouse_devices=$(xinput list | grep -Ei 'mouse|trackpoint|synaptics|2.4G')
clear
printf "$mouse_devices\n"
read -p "Enter device ID: " mouse_id
prop_id=$(xinput --list-props $mouse_id | grep -i "accel speed" | grep -iv "default" | awk '{ printf $4 }' | sed 's/(//g' | sed 's/)//g')
read -p "Enter speed value (neg1-1): " speed_factor
xinput --set-prop "$mouse_id" "libinput Accel Speed" "$speed_factor"
	</pre>

	<h3>Usage</h3>
	<pre>
# The speed value could be a float number.

⎜   ↳ HAILUCK CO.,LTD USB KEYBOARD Mouse        id=11   [slave  pointer  (2)]
Enter device ID: 11
Enter speed value (neg1-1): 0
	</pre>
	
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
