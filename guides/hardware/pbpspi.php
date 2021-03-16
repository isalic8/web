<html>
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>SPI flash</title>
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
	<h1>Booting from NVME with SPI Flash</h1>
	<h3><span style="color:#FF0000;">WARNING</span></h3>
	<p>
	<span style="color:#FF0000;">
	Be prepared to recover your broken SPI flash if an error occurs.
	<br/>
	When a binary is written to the SPI flash, the SPI flash will be what chooses which drives to boot from.
	<br/>
	Any problems when writing to the SPI can render your machine soft bricked.
	<br/><br/>
	Learn about the SPI flash and recovery options here:
	<br/>
	<a href="https://wiki.pine64.org/index.php/Pinebook_Pro_SPI" target="_blank">https://wiki.pine64.org/index.php/Pinebook_Pro_SPI</a>
	<br/>
	<a href="https://wiki.pine64.org/index.php/Pinebook_Pro#Using_the_SPI_flash_device" target="_blank">https://wiki.pine64.org/index.php/Pinebook_Pro#Using_the_SPI_flash_device</a>
	</span>
	</p>
<!--break-->
	<h3>Preface</h3>
	<p>
	This guide is a simpler rewrite of
	<a href="https://forum.pine64.org/showthread.php?tid=8439" target="_blank">pcm72's</a>
	forum post. I'd recommend reading that whole thread before proceeding.
	<br/>
	We're going to be flashing the Pinebook Pro's SPI flash so that it contains boot code for the nvme. 
	<br/>
	Your kernel needs to be compiled with SPI support.
	A simple check will be to see if /dev/mtd0 exists.
	<br/>
	<br/>
	I'm using Manjaro Arm.
	</p>
<!--break-->
	<h3>Downloading files</h3>
	<p>
	You can either download them from 
		<a href="https://github.com/pcm720/rockchip-u-boot/releases" target="_blank">pcm72's git release</a>
	<br/>
	Or you can download them from my 
	<a href="https://unixfandom.com/files" target="_blank">website.</a>
	<br/>
	The ones from my website will be the same that I'm using for this tutorial.
	</p>
<!--break-->
	<h3>Flashing the SPI</h3>
	<pre>
$ dd if=spiflash.bin of=/dev/mtd0 status=progress
	</pre>
	<p>
	Done....that was a lot easier than I thought...
	</p>
<!--break-->
	<h3>Important details</h3>
	<p>
	In pc72's post, he explained why booting from micro-sd will fail. You basically have to remove all boot code from your micro-sd to have the SPI boot from it. Here's how you do that:
	</p>
	<pre>
$ dd if=/dev/zero bs=32k seek=1 count=1 of=&lt;microSD&gt;
$ dd if=/dev/zero bs=64k seek=128 count=64 of=&lt;microSD&gt;
$ dd if=/dev/zero bs=64k seek=192 count=64 of=&lt;microSD&gt;
	</pre>
	<h4>Boot order</h4>
	<ul class="mainli">
		<li>micro-sd</li>
		<li>nvme</li>
		<li>emmc</li>
	</ul>

	<p>
	I'm not sure if it's capable of USB boot.
	</p>
</div>
</body>
</html>
