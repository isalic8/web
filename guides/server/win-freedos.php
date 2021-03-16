<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>FreeDOS Installation</title>
</head>
<body>
	<div class="main">
		<div class="header">
			<p>
			<a href="../../index.php">
			Unixfandom.com
			<img src="../../files/pix/penguin.gif" alt="penguin_gif">
			</a>
			</p>
		</div>

		<nav>
			<?php include '../navigation.php';?>
		</nav>
	<h1>FreeDOS installation</h1>
	<h3>Preface</h3>
	<p>
	Alright, this isn't an actual installation walkthrough.
	I'm showing how to fully install freedos to a USB drive, without having to use a second USB to run this installation image. 
	We'll use Qemu (psst... <a href="qemu-basics.html">qemu tutorial</a>)
	</p>

	<h3>Downloading FreeDOS</h3>
	<p><a href="https://www.freedos.org/download/">https://www.freedos.org/download/</a></p>

	<h3>Virtualization stuffs</h3>
	<p>
	Make sure you have your USB drive connected to your machine and that the FreeDOS "FULL USB" zip file is downloaded and extracted.
	We'll run the FreeDOS virtual hard disk (F12FULL.vmdk) and also add our USB as a second drive in the virtual machine.
	From there it's a straight foward installation.
	</p>
<pre>
# Getting the name of our USB device
$ lsblk
[...]
<span style="color: red;">sdc</span> 8:32 1 28.7G 0 disk/dev/sdc

# Running the virtual machine with both the vmdk and usb device added
$ qemu-system-x86_64 -enable-kvm -cpu host -m 600 -hda FD12FULL.vmdk -hdb <span style="color: red;">/dev/sdc</span>
</pre>

	<img src="../pix/win-freedosinstall.png" alt="freedos install.">

	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
