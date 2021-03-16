<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>BSPWM Better Scratchpad</title>
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

	<h1>Better scratchpad bspwm</h1>
	<h3>Preface</h3>
	<p>
	The scratchpad scripts I found for bspwm SUCK.
	Some either stop working if you kill the terminal or bug out when you manage your window states.
	Here's a script I wrote that get's the job done RIGHT!
	</p>

	<img src="../pix/bspwm-scratch.png" alt="bspwm-scratch.png">
	<p>I'm running tmux if you were wondering.</p>

	<h3>Setup stuff</h3>
	<p>
	The following script checks to see if classname "Scratchy" exists.<br>
	If it doesn't exist, it opens the terminal.<br>
	If it does exists, it either hides or shows the terminal accordingly.
	</p>
	<pre>
&gt;&gt; /path/to/scratchy

#!/bin/sh

id=$(xdotool search --class scratchy);
if [ -z "$id" ]; then
	st -c scratchy;
else
	if [ ! -f /tmp/hide_scratch ]; then
		touch /tmp/hide_scratch && xdo hide "$id"
	elif [ -f /tmp/hide_scratch ]; then
		rm /tmp/hide_scratch && xdo show "$id"
	fi
fi
	</pre>

	<p>
	This next part tells bspwm that the window with the class name "scratcy" will be a sticky window, floating, and have the given dimensions.<br>
	To get the window to be exactly centered, just do (1/2 monitor width) - (1/2 window width) as the X offset
	</p>
	<pre>
&gt;&gt; /path/to/bspwmrc

# rectangle=WidthxHeight+Xoffset+Yoffset
bspc rule -a scratchy sticky=on state=floating rectangle=1200x400+360+0
	</pre>

	<pre>
&gt;&gt; /path/to/sxhkdrc

super + semicolon
	scratchy
	</pre>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
