<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>SSH Keys</title>
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
	<h1>Generating SSH Keys</h1>
	<p>....I just can't seem to remember....</p>
	<pre>
ssh-keygen -t rsa  [ -b &lt;bits&gt; ]
ssh-copy-id -i &lt;/path/to/idrsa.pub&gt; example@10.0.0.1
	</pre>

	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
