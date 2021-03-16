<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Move fast</title>
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
	<h1>Navigate your system efficiently</h1>
	<h3>Preface</h3>
	<p>
	Set the $TERMINAL variable in your bashrc<br>
	This dmenu script lists various directories in your system and runs certain actions depending on the type of file it's given.<br>
	If you pass a directory it opens the directory in the terminal, otherwise it passes the file to your file opening script<br>
	</p>

	<h3>The good stuff</h3>
	<p>
	Here are the three scripts which make this possible
	</p>

	<p>
	FILE LISTER:<br>
	For modularity's sake, I chose to create a separate script which lists useful files/directories<br>
	I denote a name using NAME ; PATH/TO/FILE
	</p>

	<pre>
&lt;&lt; ~/.bin/files
#!/bin/sh
cat &lt;&lt;OEM | grep -Ev ".git|^#.*$"
todo ; $HOME/dox/todo
#VIM
vim ; $XDG_CONFIG_HOME/nvim/init.vim
#BASH
bash ; $HOME/.bashrc
bash functions ; $XDG_CONFIG_HOME/bash/functions
bash aliases ; $XDG_CONFIG_HOME/bash/aliases
bash exports ; $XDG_CONFIG_HOME/bash/exports
#VIFM
vifm ; $XDG_CONFIG_HOME/vifm/vifmrc
vifm commands ; $XDG_CONFIG_HOME/vifm/commands.vim
vifm fileopeners ; $XDG_CONFIG_HOME/vifm/fileopeners.vim
vifm options ; $XDG_CONFIG_HOME/vifm/options.vim
vifm icons ; $XDG_CONFIG_HOME/vifm/icons.vim
#POLYBAR
polybary ; $XDG_CONFIG_HOME/polybar/config
#W3M
w3m ; $HOME/.w3m/cgi-bin/keymap
w3m ; $HOME/.w3m/cgi-bin/config
#SXHKD
sxhkd ; $XDG_CONFIG_HOME/sxhkd/sxhkdrc
#BSPWM
bspwm ; $XDG_CONFIG_HOME/bspwm/bspwmrc
#MPV
mpv ; $XDG_CONFIG_HOME/mpv/mpv.conf
#NEWSBOAT
newsboat config ; $XDG_CONFIG_HOME/newsboat/config
newsboat urls ; $XDG_CONFIG_HOME/newsboat/urls
#PICOM
picom ; $XDG_CONFIG_HOME/picom/picom.conf
#TMUX
tmux ; $XDG_CONFIG_HOME/tmux/tmux.conf
tmux bindings ; $XDG_CONFIG_HOME/tmux/bindings.conf
tmux statusbar ; $XDG_CONFIG_HOME/tmux/statusbar.conf
tmux features ; $XDG_CONFIG_HOME/tmux/features.conf
#ZSH
zsh; $XDG_CONFIG_HOME/zsh/.zshrc
zsh env; $XDG_CONFIG_HOME/zsh/.zshenv
#ZATHURA
zathura ; $XDG_CONFIG_HOME/zathura/zathurarc
#OPENBOX
openbox ; $XDG_CONFIG_HOME/openbox/rc.xml
#DUNST
dunst ; $XDG_CONFIG_HOME/dunst/dunstrc
profile ; $HOME/.profile
fstab ; /etc/fstab
bootstrap ; /opt/bootstrap/Makefile
bootstrap packages ; /opt/bootstrap/assets/packages-deb
bootstrap arm64 ; /opt/bootstrap/assets/packages-arm64-deb
$(find $HOME/.bin/)
# List contents of $HOME without dotfiles
$(find $HOME -not -path '*/[@.]*')
$(find $XDG_CONFIG_HOME/bin-config/)
$(find /opt/installers/)
$(find /opt/ -maxdepth 1)
ssh ; $HOME/.ssh/config
OEM
	</pre>

	<p>
	FILE OPENER:<br>
	All it does is openfiles
	</p>
	<pre>
&lt;&lt; ~/.bin/o
#!/bin/bash
# Opens files

case "$1" in
	*.pdf) setsid $READER "$1" &amp;;;
	*.epub) setsid FBReader "$1" &amp;;;
	*.jpg|*.jpeg|*.png) setsid feh --zoom 50% "$1" &amp;;;
	#*.avi|*.mp4|*.wmv|*.dat|*.3gp|*.ogv|*.mkv|*.mpg|*.mpeg|*.vob|*.m2v|*.mov|*.webm|*.ts|*.mts|*.m4v) setsid ffplay -vf "drawtext=text='%{pts\:hms}':box=1:x=(w-tw)/2:y=h-(2*lh)" "$1" &amp;;;
	*.avi|*.mp4|*.wmv|*.dat|*.3gp|*.ogv|*.mkv|*.mpg|*.mpeg|*.vob|*.m2v|*.mov|*.webm|*.ts|*.mts|*.m4v|*.gif) setsid mpv "$1" &amp;;;
	*.mp3|*.flac) setsid $TERMINAL -e mpv "$1" &amp;;;
	*.docx|*.doc|*.rtf|*.pptx) setsid libreoffice "$1" &amp;;;
	*.iso|*.img|*.zip|\
		*.tar.gz|*.tar.bz2|*.tar.xz|\
		*.tar.zst|*.tar.lz|*.tar|\
		*.xz|*.gz|*.bzip2|\
		*.bz2|*.7z|*.lzma|\
		*.rar) setsid $TERMINAL -d $(dirname "$1") &amp;;;
	*) setsid $TERMINAL -e $EDITOR "$1" &amp;;;
esac
	</pre>

	<p>
	FAST FILE THING:<br>
	Either open the file using the "opener" script or open a terminal in the same directory as the file.<br>
	</p>
	<pre>
&lt;&lt; ~/.bin/dedit
#!/bin/sh
file=$(files | dmenu -i -l 30 -p "Edit: " | cut -d';' -f2 | sed 's/^ *//')
[ -n "$file" ] &amp;&amp; [ -f "$file" ] &amp;&amp; o "$file"
[ -n "$file" ] &amp;&amp; [ -d "$file" ] &amp;&amp; setsid $TERMINAL -d "$file"
	</pre>

	<h3>Example usage</h3>
	<p>Here's a screen capture</p>
	
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
