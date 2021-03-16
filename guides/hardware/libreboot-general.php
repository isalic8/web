<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Libreboot General</title>
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
	<h1>General notes</h1>
	<h3>General</h3>
	<p>
	If full disk encryption keeps failing, it's likely because your version of libreboot doesn't support luks2.
	Boot into a live environment to change your luks header from version 2 to version 1.
	</p>

	<pre>
https://cryptsetup-team.pages.debian.net/cryptsetup/encrypted-boot.html#downgrading-luks2-to-luks1
https://web.archive.org/web/20200716054743/https://cryptsetup-team.pages.debian.net/cryptsetup/encrypted-boot.html
	</pre>

	<h3>T400</h3>
	<p>
	I learned pretty quickly that the 16pin Pomona 5252 or 8pin Pomona 5250 required to flash the thinkpad t400 IS A PAIN to find. The only Pomona 5250 I found online was selling for $200 on ebay which is absurd for a $40 clip. I think it might be better to solder wires directly to the bios chip than rely on finding the clip.
	</p>

	<h3>X60</h3>
	The (presumably hal) sensors, which is attached to the display cable, is INCREDIBLY easy to break.
	Like a dummy, I decided to put electrical tape over the display cable and I think this caused me to tear off a trace.
	</div>
</body>
</html>
