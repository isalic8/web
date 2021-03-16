<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Anbox Arch Installation</title>
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
	<h1>Installing Anbox in Arch Linux</h1>
	<h3>Preface</h3>
	<p>
	<span style="color: red;">I realize after writing this guide that there's already a zen kernel compiled with support for anbox in the AUR. Derp.</span>
	<br>
	<br>
	I'm going off the <a href="https://wiki.archlinux.org/index.php/Anbox" target="_blank">Arch Wiki page</a>, but I hope to make it more friendly to the average joe.
	We'll be using the terminal quite a bit here. I'm sorry if I don't explain certain things. We'll be compiling a custom linux kernel.
	</p>

	<h3>Dependencies</h3>
	<pre>
# Error occurs if pahole isn't installed with Linux 5.7 and 5.8 (current)
$ pacman -S base-devel pahole
	</pre>

	<h3>Rebuilding Linux kernel</h3>
	<p>
	Instead of downloading the anbox dkms modules, we'll instead rebuild the kernel to have support for them.
	The Arch Wiki recommends we do this for kernel versions equal to or greater than 5.7.
	If you're not sure what linux kernel version you're using, you can run <span style="color: red;">"uname -a"</span> to get your running kernel information.
	<br>
	<br>
	I didn't verify the file with gpg. Shame on me. I'll take the risk
	</p>
	<pre>
# Download and extract linux kernel sources
$ cd /opt/
$ wget https://mirrors.edge.kernel.org/pub/linux/kernel/v5.x/linux-5.8.tar.xz
$ tar -xvJf linux-5.8.tar.xz
$ cd linux-5.8/

# Cleaning the kernel tree before anything else
$ make mrproper
	</pre>

	<p>
	Next we'll copy Arch Linux's default kernel configurations and then append some additional settings at the bottom of the file.
	<br>
	<strong>This is a good time to check that you're still in the same working directory of the kernel source code.</strong>
	</p>

	<pre>
# Copying default kernel config
$ zcat /proc/config.gz &gt; .config

$ vim .config
# Change the CONFIG_LOCALVERSION variable to something non-default, or else you risk overwriting one of your system's other kernels.
CONFIG_LOCALVERSION="CUSTOM"

# Appending the custom kernel settings for anbox
CONFIG_ASHMEM=y
CONFIG_ANDROID=y
CONFIG_ANDROID_BINDER_IPC=y
CONFIG_ANDROID_BINDERFS=y
CONFIG_ANDROID_BINDER_DEVICES="binder,hwbinder,vndbinder"
	</pre>

	<p>
	Now we can get to the fun stuff: compiling the kernel. This can take a while depending on your processors speed.
	<br>
	<br>
	You'll notice during the compilation process that your systems builds A LOT of drivers for devices that you likely don't even own. These are drivers for mac computers, miscellaneous displays, wifi devices, etc. We're using a default Arch Linux configuration that's built to work on almost every system. It took me a few hours to compile on my T400. The unnecessary bloat and size of the kernel is one of the reasons why tailoring your own custom kernel is beneficial.
	</p>
	<pre>
# Build the kernel using the system's max cpu/thread count
$ make -j $(nproc)
	</pre>

	<h3>Compile the modules</h3>
	<p>This will copy the compiled modules into /lib/modules/&lt;kernel version&gt;-&lt;config local version&gt;</p>
	<pre>
# As root...
$ make -j $(nproc) modules_install
	</pre>

	<h3>Copy the kernel to /boot</h3>
	<p>
	The kernel name does not matter, so long as it's prefaced with "vmlinuz-"
	</p>
	<pre>
# 32-bit (i686) kernel:
$ cp -v arch/x86/boot/bzImage /boot/vmlinuz-custom

# 64-bit (x86_64) kernel:
$ cp -v arch/x86_64/boot/bzImage /boot/vmlinuz-custom
	</pre>

	<h3>Generate the initramfs</h3>
	<p>Mkinitcpio is a bash script that creates the initial ramdisk. The Initial ramdisk (initrd) is a temporary root filesystem that's loaded to ram when the system first boots. It loads any kernel modules the PC would need before passing control over to the init system.</p>
	<pre>
$ ls -l /lib/modules
[...]
<span style="color: red;">5.8.0CUSTOM/</span>

# Keep the suffix as your kernels name.
$ mkinitcpio -k <span style="color: red;">5.8.0CUSTOM/</span> -g /boot/initramfs-custom.img
	</pre>

	<h3>Copy system.map</h3>
	<p>
	Arch wiki: "The System.map file is not required for booting Linux. It is a type of "phone directory" list of functions in a particular build of a kernel. The System.map contains a list of kernel symbols (i.e function names, variable names etc) and their corresponding addresses."
	<br>
	<br>
	On file systems that support symbolic links, you can use symbolic links. On file sytems that don't, I'd image you'd have to make copy the system map instead of create a link.
	</p>
	<pre>
# cp System.map /boot/System.map-YourKernelName
# ln -sf /boot/System.map-YourKernelName /boot/System.map
	</pre>

	<h3>Updating grub</h3>
	<p>This is the last step for setting up our new kernel. We'll update grub so it see's there a new kernel to boot from</p>
	<pre>
$ grub-mkconfig -o /boot/grub/grub.cfg
	</pre>

	<h3>Setting up Anbox</h3>
	<pre>
# Let's enable binder. This is one of the modules we compiled our kernel with.
$ mkdir /dev/binderfs
$ mount -t binder binder /dev/binderfs

# Now let's install anbox
$ yay -S anbox-git anbox-houdini
	</pre>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
