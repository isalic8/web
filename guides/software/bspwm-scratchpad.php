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
	The scratchpad scripts I found for bspwm SUCK.<br>
	Some either stop working if you kill the terminal or bug out when you manage your window states.<br>
	Here's a script I wrote that get's the job done RIGHT!
	</p>

	<img src="../pix/bspwm-scratch.png" alt="bspwm-scratch.png">
	<p>I'm running tmux if you were wondering.</p>

	<h3>Setup stuff</h3>
	<p>
	The "scratchy" script checks to see if a terminal with the classname "scratchy" exists.<br>
	If it doesn't exist, it creates it. If it does exist, it hides it.
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
	Next we'll assign special attributes for the window with the classname scratchy in our BSPWMRC.<br>
	I have it configured to automatically adjust the window position based on the size of the monitor.<br>
	To get the window to be exactly centered, just do (1/2 monitor width) - (1/2 window width) as the X offset
	</p>
	<pre>
&gt;&gt; /path/to/bspwmrc

# Calculate the center of the screen for a 600x400 scratchpad
scratchpad_xy="600x400"
display_xy=$(xdpyinfo | grep -i dimensions | awk '{ print $2 }')
half_display=$(echo $display_xy | tr 'x' ' ' | cut -f1 -d' ' | xargs -I _ echo _/2 | bc)
half_scratchpad=$(echo $scratchpad_xy | tr 'x' ' ' | cut -f1 -d' ' | xargs -I _ echo _/2 | bc)
offset=$(echo ${half_display}-${half_scratchpad} | bc)

# rectangle=WidthxHeight+Xoffset+Yoffset
bspc rule -a scratchy sticky=on state=floating rectangle=${scratchpad_xy}+${offset}+0
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
