<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Home</title>
</head>
<body>
	<div class="main">
		<div class="header">
			<p>
			<a href="../../index.php">
			unixfandom.com
			<img src="../../files/pix/penguin.gif" alt="penguin_gif">
			</a>
			</p>
		</div>

		<nav>
			<?php include '../navigation.php';?>
		</nav>
	<h1>Microsoft Office in Linux</h1>
	<h3>Preface</h3>
	<p>
	I'm using Microsoft Office 2010 32Bit for this tutorial.
	Get your <a target="_blank" href="https://thepiratebay.org/description.php?id=5624753">pirate hat</a> on if you haven't already.
	We'll be using Wine (5.13 in my case) and Arch Linux.
	</p>

	<h3>Installing dependencies</h3>
	<pre>
# If using Debian/Ubuntu, install "winbind" instead of "samba"
$ pacman -S wine wine-gecko wine-mono samba cabextract winetricks zenity
	</pre>

	<h3>Setting up wine</h3>
	<p>
	We're going to tell wine which architecture to use for our windows enviroment. We'll also tell it where to install the enviroment to.
	</p>

	<pre>
# Setting architecture and file location
$ WINEARCH=win32 WINEPREFIX=~/.wine/office2010

# Creating the enviroment (click "ok")
$ winecfg

# Installing microsoft core services
$ winetricks msxml4 msxml6

# Running executable
$ wine office2010-setup.exe
	</pre>

	<p>The installer should run normally and microsoft office should be installed.</p>

	<h3>Post installation</h3>
	<p>
	To run office, you have to manually run wine on the executable file.
	I suggest creating a shortcut of some kind.
	</p>

	<pre>
$ wine ~/.wine/office2010/Program\ Files/Microsoft\ Office/Office14/EXEL.EXE
	</pre>

	<img src="../pix/excel.png" alt="exel-image">
	<img src="../pix/word.png" alt="word-setup-image">
	<img src="../pix/word1.png" alt="word-image">
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
