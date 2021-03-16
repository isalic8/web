<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Netcat</title>
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
	<h1>Transfering files with netcat</h1>
	<h3>Preface</h3>
	<p>MORE THINGS I CAN'T REMEMBER! 
	Transfering unencrypted files through netcat:
	</p>
	<pre>
<!--https://youtube.com/watch?v=Vh0wXXWZ4kQ-->
# On the sender machine
nc -v -w 30 -p 31337 -l &lt; file.txt

# On the recipient machine
nc -v -w 2 10.0.0.5 31337 > file.txt

# Key
-v	verbosity

-w	In connect mode and in tunnel mode this specifies the timeout for the connecting socket
	In listen mode it specifies the time to wait for a VALID incoming connection

-p	Port

-l	Listen
	</pre>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
