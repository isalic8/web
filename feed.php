<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="files/pix/icon.gif"/>
	<link rel="stylesheet" href="style.css"/>
	<title>Feed</title>
</head>
<body>
	<div class="main">
		<div class="header">
			<p>
			<a href="index.php">
			Unixfandom.com
			<img src="files/pix/penguin.gif" alt="penguin_gif">
			</a>
			</p>
		</div>

		<nav>
			<?php include 'navigation.php';?>
		</nav>

	<h1>Feed</h1>
	<div class="grid-container">
		<div class="grid-item-border">
		<h3>Server</h3>
			<li>Linux of things</li>
			<li><a href="guides/server/linux-secure-users.php">Securing remote user accounts</a></li>
			<li>Searx</li>
			<li><a href="guides/server/searx-install.php">Installation (docker+nginx)</a></li>
			<li><a href="guides/server/searx-engine.php">Setting default search engine</a></li>
			<li>Nginx</li>
			<li><a href="guides/server/nginx-letsencrypt.php">SSL with letsencrypt</a></li>
			<li><a href="guides/server/nginx-php.php">Installing with PHP support</a></li>
			<li><a href="guides/server/nginx-tor.php">Setting up a hidden tor service</a></li>
			<li><a href="guides/server/nginx-tor-urlv3.php">Generating a vanity onionv3 domain</a></li>
			<li>Git</li>
			<li><a href="guides/server/git-server.php">Creating personal git server</a></li>
			<li>OpenSMTPD</li>
			<li><a href="guides/server/opensmtpd-debian.php">Compiling OpenSMTPD on Debian 10</a></li>
			<li>OpenBSD</li>
			<li><a href="guides/server/obsd-ssl.php">Generating ssl certificates with Let's Encrypt</a></li>
			<li><a href="guides/server/obsd-php.php">PHP with httpd</a></li>
		</div>
		<div class="grid-item-border">
		<h3>Software</h3>
			<li>BSPWM</li>
			<li><a href="guides/software/bspwm-lemonbar.php">BSPWM with lemonbar</a></li>
			<li><a href="guides/software/bspwm-dynamic-borders.php">BSPWM dynamically change borders</a></li>
			<li><a href="guides/software/bspwm-scratchpad.php">BSPWM A GOOD scratchpad</a></li>
			<li>Wine</li>
			<li><a href="guides/software/wine-dll.php">Installing .dll files</a></li>
			<li><a href="guides/software/wine-office.php">Microsoft Office 2010</a></li>
			<li><a href="guides/software/wine-haloce.php">Halo Combat Evolved</a></li>
			<li>Qemu</li>
			<li><a href="guides/software/qemu-basics.php">Basic tutorial</a></li>
			<li><a href="guides/software/qemu-smb.php">Sharing files between host and guest</a></li>
			<li>FFMPEG</li>
			<li><a href="guides/software/ffmpeg-dummy.php">Creating a dummy webcam and output videos/images to it</a></li>
			<li><a href="guides/software/ffmpeg-flac-conversion.php">Converting flac collection to 320Kb/s MP3</a></li>
			<li><a href="guides/software/ffmpeg-record-selection.php">Recording a selected area of the screen</a></li>
			<li>Random</li>
			<li><a href="guides/software/radio.php">Listening to your radio stations in the terminal</a></li>
			<li><a href="guides/software/w3m.php">The awesomeness of the W3M terminal web browser</a></li>
			<li><a href="guides/software/urxvt.php">A basic urxvt config</a></li>
			<li><a href="guides/software/gnu-parallel.php">GNU Parallel to run commands in parallel</a></li>
			<li>Scripts (some mine; some not)</li>
			<li><a href="guides/software/sh-sw.php">Portable swallow script</a></li>
			<li><a href="guides/software/sh-torbrowser.php">Tor browser install script + firejail wrapper</a></li>
		</div>
		<div class="grid-item-border">
		<h3>Hardware</h3>
			<li>Pinebook Pro</li>
			<li><a href="guides/hardware/pbp-kernel.php">Compiling mainline kernel (debian)</a><li>
			<li><a href="guides/hardware/pbpspi.php">Booting from NVME (spi flash method)</a><li>
			<li><a href="guides/hardware/pbpnvmeroot.php">Using NVME as root partition</a><li>
			<li><a href="guides/hardware/pbpnetbsd.php">Installing Netbsd</a><li>
			<li><a href="guides/hardware/pbpzram.php">Configuring ZRAM</a><li>
			<li><a href="guides/hardware/pbpkeyboard.php">Keyboard updater</a><li>
			<li><a href="guides/hardware/pbp-troubleshooting.php">Troubleshooting</a><li>
			<li>Libreboot</li>
			<li><a href="guides/hardware/libreboot-general.php">General things to know.</a></li>
			<li>Digispark</li>
			<li><a href="guides/hardware/digispark.php">Digispark installation</a></li>
			<li>Raspberry Pi</li>
			<li><a href="guides/hardware/pi3-overclock.php">Overclock profile 3B+</a></li>
		</div>
		<div class="grid-item-border">
		<h3>Misc</h3>
			<li><a href="guides/misc/misc-netcat.php">Transfering files with Netcat</a></li>
			<li><a href="guides/misc/misc-ssh.php">Generating ssh keys</a></li>
			<li><a href="guides/misc/misc-bluetooth.php">Bluetoothctl</a></li>
			<li><a href="guides/misc/misc-grub.php">Booting from grub</a></li>
			<li><a href="guides/misc/misc-gpg-graphical.php">GTK prompt for GPG</a></li>
			<li><a href="guides/misc/misc-raspberrypi-nonet.php">RPI fix: Internet randomly not working with static ip</a></li>
		</div>
	</div>

	<div class="footer">
			<?php include 'footer.php';?>
	</div>
</body>
</html>
