<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Compress script</title>
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
	<h1>Compress script</h1>
	<h3>Preface</h3>
	<p>It compresses things. I forgot the names of the packages that it uses.</p>
	<pre>
#!/bin/sh
# Compress things

file="$1"
base="${file%.*}"

clear
cat &lt;&lt;OEM 
[1]	tar
[2]	tar.gz
[3]	tar.xz
[4]	tar.bz2
[5]	zip
OEM
read -p "Compression: " ans

case $ans in
	1) tar cvf "$base.tar" "$file" ;;
	2) tar czvf "$base.tar.gz" "$file" ;;
	3) tar cJvf "$base.tar.xz" "$file" ;;
	4) tar cjvf "$base.tar.bz2" "$file" ;;
	5) zip "$base" "$file" ;;
	*) echo STOP;;
esac
	</pre>
	
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
