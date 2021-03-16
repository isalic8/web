<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Troubleshooting PBP</title>
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
	<h1>Troubleshooting PBP problems</h1>
	<h3>Preface</h3>
	<p>
	I'm addressing common problem with the pbp more than anything. Go down the list until you find something that's relevant to you.
	</p>

	<h3>Powerkey shuts off machine</h3>
	<p>The powerkey is not in the most ideal locations. Edit /etc/systemd/logind.conf and change "HandlePowerKey=poweroff" to "HandlePowerKey=ignore"</p>

	<h3>Can't boot at all after flashing EMMC</h3>
	<p>
	You could either use an emmc to usb adapter to reflash your EMMC (LAME).<br>
	You could use your official pine64 UART cable to see if you could fix the problem that way (EH).<br><br>
	The third option is that you carefully remove the pinebooks back plate with the display opened.<br>
	It's important to open the display before removing the back panel to prevent the flimsy plastic or chassis from cracking (yup, that could happen).<br>
	Once opened, flip the emmc switch to disable the emmc (<a href="https://wiki.pine64.org/wiki/Pinebook_Pro#Key_Internal_Parts" target="_blank">reference</a>).<br>
	With the laptop still open, begin the booting from your microsd.<br>
	Once you see the LED turn green, quickly flip the switch to turn on the emmc again.<br>
	Since the EMMC is not present, the pinebook first boots from the micro-sd.<br>
	Our goal is to turn on the EMMC early on in the kernel's boot up phase, so this way the emmc gets recognized.<br>
	If you flip the switch to late, the EMMC will not appear as a drive.<br>
	Once booted, you could either reflash a new pinebook image or remove the bootloader from the emmc.
	</p>

	<h3>Removing the bootloader</h3>
	<p>
	Uboot resides within the first 35 or so megabytes of the drive.
	This is why you end up seeing free space preceding the boot partition of your drive.
	Without this free space, uboot would be overwriting your bootfiles, so it's important you add it if you're ever doing any manual partitioning (i.e installing Gentoo).<br><br>
	I'm including two methods.
	The first blindly overwrites the beginning of the drive - potentially damaging the boot partition.
	The second specifically removes the parts of the drive containing uboot, keeping your boot parition safe.
	If you don't care about being able to boot from the emmc, use the first method.
	</p>
	<pre>
# I forgot how many megabytes of space uboot takes
# Method 1 (destructive...maybe)
dd if=/dev/zero of=/dev/BLKDEV bs=1M count=35 conv=fsync

# Method 2 (non-destructive)
dd if=/dev/zero of=/dev/BLKDEV bs=32k seek=1 conv=fsync &>/dev/null
dd if=/dev/zero of=/dev/BLKDEV bs=64k seek=128 conv=fsync &>/dev/null
dd if=/dev/zero of=/dev/BLKDEV bs=64k seek=192 conv=fsync &>/dev/null
	</pre>

	<h3>Flashing the bootloader</h3>

	<h3>Loose screws that fall out</h3>
	<p>
	Some people reported that their screws to the bottom plate would fall out after sometime.
	I've never experienced this, but I still took the liberty of preventing it from happening.<br><br>
	Go to the auto parts section of any store and get yourself either low strength or medium strength threadlocker.
	Avoid getting high strength threadlocker since you obviously still want to be able to easily unscrew them in the future.
	Add that to your Pinebook Pro's screws and you're good to go.<br><br>
	I used Permatex Threadlocker Blue (Medium Strength) 24200 which I bought from Walmart. It works just fine.
	</p>

	<h3>(blinking) Red light and not booting</h3>
	<p>
	Pretty sure this is indicative of a kernel panic.
	Nothing will be displayed on the screen. The only way to tell what's going on is to use the UART cable for the pinebook pro. Buy it if you don't have it. It's useful.
	</p>

	<h3>Damaged thermal pad. Getting a replacement.</h3>
	<p>Purchase yourself a 4mm thermal pad from Amazon and you'll be all set. Cut a 1 inch by 1 inch square.</p>

	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
