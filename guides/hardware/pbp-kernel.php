<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>Pinebook Pro Kernel Compilation</title>
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
	<h1>Pinebook Pro Kernel Compilation (debian)</h1>
	<h3>Preface</h3>
	<p>
	Here's how to compile <a href="https://gitlab.manjaro.org/tsys/linux-pinebook-pro" target="_blank">tsys' mainline linux kernel for the Pinebook Pro</a><br>
	I'm using the "debian way" of installing the kernel.<br>
	When compiling the kernel, we can tell "make" to package the binaries as multiple debian archive files (.deb).<br>
	Afterwards we can simple run "dpkg -i <FILE>.deb" to install it.<br>
	</p>

	<h3>Setting up our enviroment</h3>
	<p>Here we'll download the dependencies and the linux sources.</p>
	<pre>
# Dependencies
$ sudo apt-get install linux-headers-$(uname -r) libncurses-dev gawk flex bison openssl libssl-dev dkms libelf-dev libudev-dev libpci-dev libiberty-dev autoconf bc fakeroot

# Linux sources
$ git clone --depth=1 https://gitlab.manjaro.org/tsys/linux-pinebook-pro
$ cd linux-pinebook-pro
	</pre>

	<h3>Compiling the kernel</h3>
	<p>
	The "ARCH" variable specifies the target machines architecture.<br>
	The "CROSS_COMPILE" variable specifies which compiler the system should use.<br>
	Running "make menuconfig" opens an ncurses menu which you can use to modify the kernel. You don't need to change anything.<br>
	Run the command and exit the ncurses menu to save to kernel configuration to "./.config"
	</p>

	<pre>
$ export ARCH=arm64
$ export CROSS_COMPILE=aarch64-linux-gnu

# Exit the ncurses menu to save the default config
$ make -j 6 menuconfig
$ make -j 6 deb-pkg
	</pre>

	<p>
	The compiling process should take about two hours. My pinebook was left on a desk and stayed consistently at 68.4-69.8 degrees Celsius.<br>
	The output deb files are in "../"
	</p>

	<h3>Installing the packages files</h3>
	<p>I forgot the exact names of the output deb files.</p>
	<pre>
$ sudo dpkg -i linux-headers-*.deb
$ sudo dpkg -i linux-image-*.deb
$ sudo dpkg -i linux-libc-*.deb
	</pre>

	<p>
	DON'T REBOOT YET! Turns out that uboot, at least from the debian installer, isn't compiled with a gzip decompressor.<br>
	If you haven't noticed, your linux kernel and initrd are actually both gzip archives!<br>
	This confused the heck out of me at first. All you need to do is decompress the files and put them back in /boot
	</p>

	<pre>
# We need to rename them with the suffix ".gz" or else gzip returns errors

$ cd ~
$ mv /boot/vmlinuz-5.10.0-rc5-1-pinebookpro-arm64+ ~/vmlinuz-5.10.0-rc5-1-pinebookpro-arm64+.gz
$ gzip -d ~/vmlinuz-5.10.0-rc5-1-pinebookpro-arm64+.gz
$ mv ~/vmlinuz-5.10.0-rc5-1-pinebookpro-arm64+ /boot/

$ mv /boot/initrd.img-5.10.0-rc5-1-pinebookpro-arm64+ ~/initrd.img-5.10.0-rc5-1-pinebookpro-arm64+.gz
$ gzip -d ~/initrd.img-5.10.0-rc5-1-pinebookpro-arm64+.gz
$ mv ~/initrd.img-5.10.0-rc5-1-pinebookpro-arm64+
	</pre>

	<p>DONE! You can boot into your new mainline kernel now.</p>

	<h3>Uboot (IMPORTANT)</h3>
	<p>
	Remove "maxcpus=4" from /boot/extlinux/extlinux.conf<br>
	This option was automatically added and is supposed to make boot times faster.<br>
	Just remove it from the uboot config. The boot times are fine without it and are infact LONGER if you keep it.<br>
	FYI: Normally the default kernel re-enables the two large cores once it's booted. For some reason this one does not.
	</p>

<pre>
## /boot/extlinux/extlinux.conf
default 10
menu title U-Boot menu
prompt 0
timeout 10


label l0
	menu label Debian GNU/Linux bullseye/sid 5.10.0-rc5-1-pinebookpro-arm64+
	linux /vmlinuz-5.10.0-rc5-1-pinebookpro-arm64+
	initrd /initrd.img-5.10.0-rc5-1-pinebookpro-arm64+
	fdt /rk3399-pinebook-pro.dtb
	append root=PARTLABEL=mmcblk1-RootFS console=ttyS2,1500000n8 console=tty0 ro quiet splash plymouth.ignore-serial-consoles maxcpus=6 coherent_pool=1M
</pre>

	<h3>Encryption</h3>
	<p>
	I couldn't boot from my encrypted debian install.<br>
	According to <a href="https://forum.pine64.org/showthread.php?tid=8765">this post</a>, you can update your initrd to include modules to decrypt the file system, but the display won't work.<br>
	When I tried this, I couldn't even get a prompt to appear using the serial console. I'm opting for an encrypted home partition instead.
	</p>

	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
