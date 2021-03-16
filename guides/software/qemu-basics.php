<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Home</title>
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
		<h1>Qemu-basics creating a virtualization work station</h1>
		<h3>Preface</h3>
		<p>
		These are the basics of Qemu to get you on your feet.
		Qemu is a cross platform emulator and virtualizer.
		It's far more minimal than virtualbox and can be used within the command line.
		I use it all the time and I suggest you use it as well.
		<br>
		<br>
		Qemu does have a graphical frontend (virtman+libvirt), though we won't be using this.	
		</p>

		<h3>Game plan</h3>
		First we'll verify our CPU supports virtualization, next we'll install qemu, after that we'll create a virtual filesystem to install our operating system to, and finally we'll install our OS.

		<h3>Verify KVM and Virtualization is supported</h3>
		<!--This is from https://www.tecmint.com/install-and-configure-kvm-in-linux/-->
		<p>
		KVM makes your virtual machine work fast instead of slow. It's important you use this feature.
		<br>
		<br>
		You should recieve output from the following commands
		</p>
		<pre>
# On Intel machines:
$ grep -e 'vmx' /proc/cpuinfo --color

# On AMD machines: 
$ grep -e 'svm' /proc/cpuinfo --color

# Check if KVM modules are loaded. It should be by default.
$ lsmod | grep kvm
		</pre>

		<h3>Install Qemu</h3>
		<pre>
# Arch-based systems
$ pacman -Ss qemu
$ pacman -S qemu

# Debian
$ apt install qemu qemu-system-x86 qemu-kvm
		</pre>

		<h3>Create virtual filesystem</h3>
		<p>
		The Qemu package comes with several different commands. 
		We'll use "qemu-img" to create our qemu image.
		We'll install our operating system to this image.
		</p>
		<pre>
$ qemu-img create -f qcow2 muhimage.qcow2 15G

-f <format>	Specify which file format to use. [img,qcow2,vdi,etc]

qcow2	Qcow2 images only take up the space used within them, and the size only goes up to X value - 15G in this case
		</pre>

		<h3>Install OS</h3>
		<p>
		It looks like a lot...and it kinda is. I have this set as an alias in my bashrc.
		<br>
		<br>
		Executing this command will start the VM with archlinux.iso first in the boot order.
		You'll see muhimage.qcow2 as /dev/sda in the VM. Install the operating system as you would normally.
		</p>
		<pre>
$ sudo qemu-system-x86_64 \
-enable-kvm \
-cpu host \
-m 2000 \
-net nic -net user \
-hda muhimage.qcow2 \
-cdrom archlinux.iso \
-boot d

qemu-system-x86_64	Architecture type of the system. One of many that qemu offers. 

-enable-kvm	Enables the use of <a href="https://www.linux-kvm.org/" target="_blank">KVM acceleration</a>

-cpu host	KVM processor with all supported host features

-m &lt;value&gt; 	Allocate &lt;X&gt;mb of ram

-net nic	Enables the network card for the guest
	
-net user	<a href="https://stackoverflow.com/questions/22654634/difference-between-net-user-and-net-nic-in-qemu" target="_blank">Sets up a virtual NAT'ted subnet, with a DHCP server started by qemu that gives out (usually) 10.0.2.15 to your guest and puts the host on 10.0.2.2.</a>

-hda &lt;file&gt;	Specify a block device. [-hdb file -hdd file]

-cdrom		Use file as cdrom

-boot		Change the boot order. d = cdrom
		</pre>

		<img src="../pix/hannahmontana.jpg" alt="Hannah Montana OS">
	</div>	
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
