<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>GNU Parallel</title>
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
	<h1>Running commands in parallel</h1>
	<h3>Preface</h3>
	<p>
	I found a tool called "parallel" that lets you run commands in parallel instead of sequentially<br>
	It's easier to explain using examples
	</p>

	<h3>Usage</h3>
	<p>
	The three colons get substituted for the arguments received from stdin<br>
	The "-j" option denotes how many individual processes will be created.
	</p>
	<pre>
$ apt install parallel

# Recursivley search for all zip files and unzip four at a time
$ find -name "*.zip" | parallel -j 4 unzip ::: -d ./extracted/

# Run multiple grep commands on several files
$ find -name "*.txt" | parallel -j 8 grep -i "parallel" :::
	</pre>

	<p>
	GNU parallel also takes stdin from a file.<br>
	You also don't have to worry about parallel creating two different processes which act on the same file<br>
	An example would be "grep" being run on "file.txt" twice.
	</p>

	<pre>
# Example of how parallel would work	
$ find .
file.zip
something.zip
three.zip
four.zip

# Running two instances of unzip at a time
$ find . | parallel -j2 unzip :::

PROCESS1: unzip file.zip
PROCESS2: unzip something.zip
	</pre>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
