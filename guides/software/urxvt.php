<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>URXVT</title>
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
	<h1>URXVT</h1>
	<h3>Preface</h3>
	<p>
	This isn't a tutorial or anything.
	You could copy and paste this config to get a functional URXVT setup.
	It think this is just about everything you'd need to get a usable terminal setup.
	</p>
	<pre>
! URXVT
URxvt.font: xft:TerminessTTF Nerd Font Mono:bold:pixelsize=19
urxvt*termName: rxvt
urxvt*scrollBar: false
urxvt*matcher.button: 1
urxvt.transparent: false
urxvt.boldFont:
URxvt.letterSpace: -1
Xft*dpi: 96
Xft*antialias: true
Xft*hinting: true
Xft*hintstyle: hintfull
URxvt*cursorUnderline: false
Xft*rgba: rgb
URxvt*geometry: 85x20
*internalBorder: 26
URxvt*fading: 0
URxvt*tintColor: #ffffff
URxvt*shading: 0
URxvt*inheritPixmap: False
URxvt.internalBorder: 6
! Copy paste support
URxvt.keysym.Shift-Control-V: eval:paste_clipboard
URxvt.keysym.Shift-Control-C: eval:selection_to_clipboard
URxvt.keysym.Shift-Up: command:\033]720;5\007
URxvt.keysym.Shift-Down: command:\033]721;5\007⎋
! Control keys
URxvt.keysym.Control-Up:    \033[1;5A
URxvt.keysym.Control-Down:  \033[1;5B
URxvt.keysym.Control-Left:  \033[1;5D
URxvt.keysym.Control-Right: \033[1;5C

! special
*.foreground:   #c6c6c6
*.background:   #1f1c1e
*.cursorColor:  #585858

! black
*.color0:       #1f1c1e
*.color8:       #36353a

! red
*.color1:       #b3655b
*.color9:       #fb8e91

! green
*.color2:       #eed7a1
*.color10:      #0087af

! yellow
*.color3:       #e1977e
*.color11:      #c3aa81

! blue
*.color4:       #008787
*.color12:      #00d7d7

! magenta
*.color5:       #503d50
*.color13:      #483440

! cyan
*.color6:       #77899f
*.color14:      #0087af

! white
*.color7:       #707880
*.color15:      #c5c8c6
	</pre>

	<h3>Keybindings</h3>
	<li>Copy/Paste: C-S-c C-S-v </li>
	<li>Scroll up: S-UP S-DOWN</li>

	<p>
	I added a couple comments explaining what each line does.
	The best advice I could give you is to google the features you need or don't need.
	Use <a href="https://terminal.sexy" target=_blank>terminal.sexy</a> to get your initial colorscheme setup.
	</p>

	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
