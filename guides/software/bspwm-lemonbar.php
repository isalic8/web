<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Lemonbar with BSPWM</title>
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
	<h1>Using lemonbar with bspwm</h1>
	<h3>Preface</h3>
	<p>
	The Arch Wiki doesn't provide any information on how to get lemonbar setup with workspace switching, window titles, etc.<br>
	Most people have their custom bars run on a timer.<br>
	We're going to do them one better and have our script only update PARTS of our bar when necessary.<br>
	This is going make things run so much more efficiently and make displaying workspaces possible.<br>
	I'm citing these two pages:<br>
	https://gitlab.com/protesilaos/dotfiles/-/blob/v2.2.0/bin/bin/melonpanel<br>
	https://raw.githubusercontent.com/BrodieRobertson/scripts/master/lemonbar/lemonconfig<br>
	</p>

	<h3>Adding XFT support</h3>
	<p>
	Lemonbar doesn't work with glyph fonts, such as the NerdFonts.<br>
	Compile <a href="https://github.com/drscream/lemonbar-xft.git">this fork</a> of lemonbar to get your fonts working.<br>
	This is optional.
	</p>

	<pre>
$ git clone https://github.com/drscream/lemonbar-xft.git
$ cd lemonbar-xft
$ sudo make install
	</pre>

	<h3>The lemonconfig script</h3>
	<p>
	This is my fork of BrodieRobertson's lemonbar script.<br>
	I'll explain the nitty gritty of the script at the end of this page
	</p>

	<pre>
#!/bin/bash
#A fork of Brodie Robertsons lemonbar script with ideas taken from Protesilaos' "melonpanel"
#https://gitlab.com/protesilaos/dotfiles/-/blob/v2.2.0/bin/bin/melonpanel
#https://raw.githubusercontent.com/BrodieRobertson/scripts/master/lemonbar/lemonconfig
#https://gitlab.com/protesilaos/lemonbar-xft.git

#background="#efefef"
_Format() {
	echo "%{+u}%{B$background} "$@" %{B}%{-u}"
}

_Workspaces() {
	desktops=$(bspc query -D --names)
	focused=$(bspc query -D --names -d focused)

	for desktop in $desktops; do
		nodes=$(bspc query -N -d $desktop)
		if [ ! -z "$nodes" ]; then
			desktops=$(echo $desktops | sed "s/$desktop/%{F#f48888}$desktop%{F-}/")
		fi

	done

	desktops=$(echo $desktops | sed "s/$focused/%{B$background}%{+u}_$focused\_%{-u}%{B-}/")
	echo $desktops | sed "s/_/ /g"
}

_WindowName(){
	xdotool getwindowfocus getwindowname
}

_CurrentWorkspace(){
	bspc query -D --names -d
}


_Clock(){
	TIME=$(date "+%H:%M")
	#_Format "${TIME}"
	echo ${TIME}
}

_Battery(){
	#_Format $(bat)
	echo $(bat)
}

_Modules(){
	while true; do
		echo "B: $(_Battery)"
		echo "C: $(_Clock)"
		sleep 5s
	done
}

lemonbar_fifo='/tmp/lemonbar.fifo'
[ -e "$lemonbar_fifo" ] && rm "$lemonbar_fifo"
mkfifo "$lemonbar_fifo"

_Modules &gt; "$lemonbar_fifo" &
bspc subscribe desktop&gt; "$lemonbar_fifo" &
bspc subscribe node&gt; "$lemonbar_fifo" &

# This function takes stdin from the fifo file.
_Main(){
	wm=$(_CurrentWorkspace)
	while read -r report; do
		case $report in
			B*) batt="$(echo $report | cut -d':' -f2-)";;
			C*) clock="$(echo $report | cut -d':' -f2-)";;
			node*) window_name=$(_WindowName);;
			desktop*) wm=$(_CurrentWorkspace) window_name=$(_WindowName);;
		esac
		echo -e "%{l} $wm %{c} $window_name %{r} $batt $clock "
	done
}

_Main &lt; "$lemonbar_fifo"
	</pre>

	<h3>Usage</h3>
	<p>Here's a launcher script that I have run with bspwm.</p>
	<pre>
#!/bin/sh
killall -q lemonbar
lemonconfig | lemonbar -p \
	-f 'TerminessTTF Nerd Font Mono:size=13' \
	-g x27
	</pre>

	<h3>How does it work?</h3>
	<p>
	Modules:<br>
	Each of your modules is just a function that ends outputting plain text.<br>
	The "_Format" modules was written by Brodie, and it adds some lemonbar syntax to arguments passed to, allowing for some more stylish modules.<br>
	The "_Format" function isn't used in my fork, but it's still included.<br>
	You'll notice the "_Modules" function echoes out a character and then the output of a module.<br>
	The reason for this is that our loop in "_Main" uses a simple regex to run a particular command if a line contains a specific pattern.<br>
	Adding a letter to the beginning of each line makes parsing the line A LOT simpler.<br>
	<br>
	Fifo file (named pipe):<br>
	A named pipe acts the same a traditional pipe, except it stores the stdout into a file which can be used as stdin.<br>
	Every time one of our modules updates, it outputs the content to the named pipe<br>
	The same goes for bspwm. We output data to the same named pipe whenever we select different nodes or switch desktops.<br>
	The "_Main" function uses a "read" prompt to run a case statement on each line that is sent to the named pip<br>
	If the line contains text with the pattern "node*", the case statement updates the variable "window_name" and echoes out the string to lemonbar<br>
	So if our "_Modules" function hasn't looped yet, but our current desktop has changed, then the variables which store the output of our modules remain the same and ONLY the variable containing our current desktop gets updated.<br>
	<br>
	FYI:<br>
	The "_Workspaces" function was from BrodieRobertson and it really sucks (no offense).<br>
	I only use "_CurrentWorkspace". You have to tweak these to match your needs.<br>
	The battery module sources an external script to show my battery status.<br>
	</p>

	<pre>
#!/bin/sh

batteries=$(find -P /sys/class/power_supply/ | grep -iE "*bat*")

for battery in $batteries; do
	status=$(cat $battery/status)
	capacity=$(cat "$battery"/capacity 2>/dev/null || break)
	case "$status" in
		Discharging) echo ": ${capacity}%" ;;
		Full) echo ": ${capacity}%" ;;
		Charging) echo ": ${capacity}%" ;;
		Unknown) echo ": ${capacity}%";;
	esac
done
	</pre>

	<h3>Image</h3>
	<img src="../pix/bspwm-lemonbar.png" alt="bspwm-lemonbar.png">

	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
