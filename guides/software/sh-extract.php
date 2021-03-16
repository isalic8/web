<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Extract script</title>
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
	<h1>Extract script</h1>
	<h3>Preface</h3>
	<p>It extracts things. I forgot the names of the packages that it uses.</p>
	<pre>
#!/bin/sh
# Extract script
case "$1" in
	*.zip) unzip "$1" ;;
	*.tar.gz) tar -xzvf "$1" ;;
	*.tar.bz2) tar -xjvf "$1" ;;
	*.tar.xz) tar -xJvf "$1" ;;
	*.tar.zst) tar -I zstd -xvf "$1" ;;
	*.tar.lz) tar --lzip -xf "$1" ;;
	*.tar) tar -xvf "$1" ;;
	*.xz) xz -d "$1";;
	*.gz) gzip -d "$1";;
	*.bzip2|*.bz2) bzip2 -d "$1";;
	*.7z|*.iso) 7z x "$1" ;;
	*.lzma) xz -d --format=lzma "$1";;
	*.rar) unrar x "$1";;
	*) echo "Unsupported format" ;;
esac
	</pre>
	
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
