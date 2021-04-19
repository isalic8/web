<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>BSPWM Dynamic Borders</title>
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
	<h1>BSPWM Dynamic Borders</h1>
	<h3>Preface</h3>
	<p>
	Dynamically change the border size when there is either a single node or multiple nodes on the focused desktop<br>
	Add "/path/to/script &" to your BSPWMRC to make use of this script
	</p>

	<pre>
#!/bin/sh

# Border size when there is one node on desktop and when there are multiple nodes
single_node="0"
multi_node="3"

# Create named pipe
dynamicborder_fifo='/tmp/dynamic-border.fifo'
[ -e "$dynamicborder_fifo" ] &amp;&amp; rm "$dynamicborder_fifo"
mkfifo "$dynamicborder_fifo"

# Subscribe to bspc events
bspc subscribe desktop &gt; "$dynamicborder_fifo" &amp;
bspc subscribe node &gt; "$dynamicborder_fifo" &amp;

# Change border size if there is one node or multiple nodes on focused desktop
_DynamicBorder(){
	focused=$(bspc query -D --names -d focused)
	node=$(bspc query -N -d $focused | wc -l)
	[ $node -eq 1 ] &amp;&amp; bspc config border_width $single_node || bspc config border_width $multi_node
}

# Reading stdin from named pipe
_Main(){
	while read -r report; do
		case $report in
			*) _DynamicBorder;;
		esac
	done
}

_Main &lt; "$dynamicborder_fifo"
	</pre>

	<h3>Example</h3>
	<p>
	<a href="../pix/bspwm-dynamic-borders.gif" target="_blank">Here's a gif showcasing how it works</a>
	</p>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
