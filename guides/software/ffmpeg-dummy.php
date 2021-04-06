<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Dummy webcam</title>
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
	<h1>Setting up a dummy webcam</h1>
	<h3>Preface</h3>
	<p>
	I experienced my first proctored exam today.<br>
	Being that I'm a technologist, I thought it'd be pretty fun to pre-record myself and have that recording output to a virtual webcam.<br>
	Here's a not so descriptive guide on using ffmpeg with the v4l2loopback kernel module to create a virtual dummy webcam.
	</p>
	

	<h3>Installing v4l2loopback kernel module</h3>
	<p>This module allows for the creation of virtual video devices.</p>
	<pre>
# Dependencies
$ sudo apt install -y build-essential linux-headers-$(uname -r) v4l-utils

# Installation
$ git clone https://github.com/umlaeute/v4l2loopback.git
$ cd v4l2loopback
$ sudo make install
$ sudo cp v4l2loopback.ko /lib/modules/$(uname -r)
$ sudo depmod -a
$ sudo modprobe v4l2loopback

# Testing. You should see "Dummy video devices"
$ v4l2-ctl --list-device
	</pre>

	<h3>Outputting a video/image to the dummy cam</h3>
	<p>Subsitute /dev/video3 for whatever devices your dummy webcam is using.</p>
	<pre>
# For video
$ ffmpeg -re -stream_loop -1 -i "video.mp4" -f v4l2 /dev/video3


# For image
$ ffmpeg -framerate 1 -loop 1 -re -i "image.png" -f v4l2 -vcodec rawvideo -pix_fmt yuv420p /dev/video3
	</pre>

	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
