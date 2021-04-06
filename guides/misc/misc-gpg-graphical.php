<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>GPG GTK</title>
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
	<h1>GPG with GTK prompt</h1>
	<h3>Preface</h3>
	<p>
	You may have experienced a problem where you want a graphical prompt to appear when decrypting files, but instead a tty prompt appears.<br>
	Your gpg agent uses "pinentry" to display this prompt.<br>
	All we need to do is tell gpg agent to use pinentry-gtk instead of pinentry-tty<br>
	</p>

	<pre>
# Create the file if it doesn't exist
# GPG-AGENT.CONF IS WHITESPACE SENSITIVE
$ vim ~/.gnupg/gpg-agent.conf

pinentry-program /usr/bin/pinentry-gtk-2

# Restart the GPG agent
$ gpg-connect-agent reloadagent /bye
	</pre>
	<p>A graphical password prompt should now appear.</p>

	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
