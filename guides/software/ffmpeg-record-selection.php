<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>FFMPEG record selection</title>
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
	<h1>Recording the selected part of the screen with ffmpeg</h1>
	<h3>Preface</h3>
	<p>
	Depends: slop ffmpeg<br>
	Here's a script I wrote that lets you select a window or portion of the screen and record it.<br>
	It uses the ultrafast libx264 video codec to reduce resource consumption.<br>
	Audio bitrate is capped at 128kb/s and the video is scaled to 720p to further conserve processing power.
	</p>

	<pre>
#!/bin/sh
# Depends: slop ffmpeg
# Records the selected part of the screen

output="$1"
dimensions=$(slop 2>/dev/null)
size=$(echo "$dimensions" | sed 's/+.*//')
offset=$(echo "$dimensions" | cut -d'+' -f2- | sed 's/+/,/g')

[ -z "$output" ] &amp;&amp; output="output"
ffmpeg -video_size "$size" \
	-framerate 25 \
	-f x11grab -i :0.0+"${offset}" \
	-crf 28 \
	-b:a 128k \
	-c:v libx264 -preset ultrafast \
	-c:a acc \
	-vf scale=-2:720,format=yuv420p \
	"$output.mp4"
	</pre>

	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
