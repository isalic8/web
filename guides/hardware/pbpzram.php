<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Zramctl</title>
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
<!--<small>5/23/20</small>-->
<h1>Configuring ZRAM on the Pinebook Pro</h1>

<h3>Preface</h3>
<p>
ZRAM is essentially compressed memory. Your system uses some of it's CPU cycles to compress redundant data into a reserved area of your ram. Think of it as swap space, but without writing to your drive.<br/><br/>
I've tested this on both Manjaro Arm and Archlinux Arm.
</p>

<h3>Checking if ZRAM is supported</h3>
<pre>
$ insmod | grep zram <br/>
Output: zram	????? ?
</pre>
<p>If you get similar results, zram should be supported.</p>

<h3>Setting up ZRAM</h3>
<pre>
$ sudo modprobe zram && sudo zramctl -a lzo-rle -s 12G zram0
</pre>
<p>
Here we are choosing the compression algorithm and size of the zram device.<br/>
Next we tell our system to use it as swap.
</p>
<pre>
$ sudo mkswap /dev/zram0 && sudo swapon /dev/zram0
</pre>
<p>We should be good to go. Here's how you can verify zram is in fact being used.</p>
<pre>
$ free -h

		total        used        free      shared  buff/cache   available 

		Mem:          3.7Gi       429Mi       2.7Gi        30Mi       562Mi       3.2Gi 

		Swap:          11Gi          0B        11Gi
</pre>

<h3>Starting ZRAM on boot</h3>
<p>
After rebooting, the zram device will be removed. We can bandaid this by setting a zram script to run on boot.<br/>
I'm choosing to use rc-local. You can use a cronjob if you'd like.
</p>
<pre>
$ sudo yay -S rc-local && systemctl enable rc-local
$ sudo chmod +x /etc/rc.local
$ vim /path/to/script.sh
</pre>
<pre>
<code>
#/path/to/script.sh

#!/bin/sh 
modprobe zram && zramctl --algorithm lzo-rle --size 12G zram0 --streams $(nproc) && \
mkswap /dev/zram0 && swapon /dev/zram0 
</code>
</pre>
<p>Finally we add the script to /etc/rc.local</p>
<pre>
$ chmod +x /path/to/script.sh
$ vim /etc/rc.local
</pre>
<pre>
<code>
#/etc/rc.local

#This is what the file should look like...
#By default this script does nothing 
/path/to/script.sh 
exit 0 
</code>
</pre>
</div>
</body>
</html>
