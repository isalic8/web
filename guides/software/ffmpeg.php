<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Unixfandom</title>
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
	<h1>Screen recording with ffmpeg</h1>
	<h3>Preface</h3>
	<p>
	A wrapper script for recording with ffmpeg.
	It parses a file that holds preconfigured options.
	Just add your ffmpeg arguments to the file and you're good to go!
	</p>
	<h3>Script</h3>
	<p>
	Depends on: ffmpeg v4l-utils
	</p>
	<pre>
#!/bin/sh
profile_list="$HOME/.config/bin-config/rec-config"

case $1 in
	--help|-h)
		cat &lt;&lt;OEM
--list				List capture devices
--list-formats /dev/video0	List available formats for an input device
--list-profiles			List preconfigured profiles

[SYNTAX]
commmand profile_name [output.mp4|output.wav]
OEM
	;;
	--list)
		# Printing the video and audio devies
		# Using grep to add colors to important text.
		printf "\e[0;33mVideo devices:\e[0m\n"
		v4l2-ctl --list-devices | grep -C 3 -E --color "/dev/.*"
		printf "\e[0;33mAudio Devices:\e[0m\n"
		arecord -l | grep -C 3 -E --color "card .."
		;;
	--list-formats)
		ffmpeg -f v4l2 -list_formats all -i "$2" ;;
	--list-profiles)
		cat $profile_list | sed '/#.*/d'
		;;
	*)
		selection=$(cat $profile_list | sed '/#.*/d' | grep "\"$1\"")
		[ -z "$selection" ] && echo "Invalid profile. Use --list-profiles or --help" && exit
		output="${!#}"
		ffmpeg $(echo -n $selection | cut -d';' -f2) $output
		;;
esac
	</pre>
	
	<h3>Config file</h3>
	<p>
	Modify the profile_list variable to point to your new config file.
	</p>
	<pre>
~/.config/bin-config/rec-config"
#
# Profiles for recording script
# name;ffmpeg stuff
"1080";-video_size 1920x1080 -framerate 25 -f x11grab -i :0.0+0,0 -c:v libx264 -preset ultrafast -c:a acc
	</pre>

	<h3>Usage</h3>
	<pre>
# List video capture and audio capture devices
$ rec --list

# List video formats for video capture device
$ rec -list-formats /dev/video0

# Record using a premade profile
$ rec 1080 output.mp4
	</pre>
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
