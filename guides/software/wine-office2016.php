<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>MS Office 2016</title>
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
	<h1>MS Office 2016 in Wine</h1>
	<h3>Preface</h3>
	<p>
	The installer is pain in the behind to complete. May this guide make your installation experience....tolerable.
	</p>

	<h3>Prerequisites</h3>
	<p>
	Microsoft Office 2016 <strike><a target="_blank" href="https://thepiratebay.org/description.php?id=12499831">Pirate Bay</a></strike>.
	<br>
	A fresh Wine prefix.
	<br>
	32 bit wine arch.
	<br>
	Possibly wine-mono and wine-gecko packages. Not sure if they're needed.
	</p>

	<h3>DLL</h3>
	<pre>
# Give this time 
winetricks -q gdiplus msxml6 dotnet20 riched20
	</pre>

	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
