<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>NVME Root</title>
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
<!--<small>5/26/20</small>-->
<h1>Using NVME as os root</h1>
<h3>Preface</h3>
<p>
I assume that you have an nvme drive with a formatted ext4 partition present.<br/>
I'm using Manjaro Arm. I've tested this on Alarm and I'd imagine it would work on debian aswell.
<br/>
We take advantage of /boot/extlinux/extlinux.conf to choose our root drive.
</p>

<h3>Preparing our nvme</h3>
<pre>
$ mount /dev/nvme0n1p1 /mnt
$ cd /mnt
$ mkdir dev sys proc mnt
</pre>

<h3>Copying root files</h3>
<p>
It's important to exclude the psuedo filesystems and /mnt, when copying your root files.
</p>
<pre>
$ rsync -aHxv --numeric-ids --progress /* /mnt --exclude=/dev --exclude=/proc --exclude=/sys --exclude=/mnt
</pre>

<h3>Changing the root to nvme</h3>
<pre>
$ mv /mnt/boot /mnt/boot.old
$ vim /boot/extlinux/extlinux.conf
	
# Change "root=LABEL=ROOT" to "root=/dev/nvme0n1p1"
</pre>

<h3>Work arounds</h3>
<p>
If the boot partition is "read only", you can remount it with rw permissions as so:
</p>

<pre>
$ mount /dev/mmcblk1p1 /boot -o remount,rw
</pre>

<h3>Closing thoughts</h3>
<p>
It's a quick and easy process. Have fun :D
</p>
</div>
</body>
</html>
