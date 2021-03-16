<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Swallow script</title>
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
	<h1>Swallow script</h1>
	<h3>Preface</h3>
	<p>
	I didn't write this. Window swallowing means that the window disappears when an application is run from it.
	It's pretty useful. It's a builtin feature with some window managers, such as dwm, but you can get the same effect anywhere with this script.
	</p>
	<pre>
#! /bin/bash

file="$HOME/.local/share/unhide"
app="$1"

tid=$(xdo id)


hidecurrent() {
    echo $tid+$app &gt;&gt; $file &amp; xdo hide
}

showlast() {
    sid=$(grep "$app" $file | awk -F "+" 'END{print $1}')
    xdo show -r $sid
}

hidecurrent &amp; "$@" ; showlast
	</pre>

	<h3>Usage</h3>
	<p>
	I didn't want to embed a huge gif on this page. You can view the gif by clicking <a href="../pix/swallow.gif" target="_blank">here.</a>
	Notice how the terminal disappears when I open the image with the script.
	</p>
	
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
