<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title></title>
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
	<h2>Qemu SMB</h2>
	<h3>Preface</h3>
	<p>
	We can share files between our host and guest machine by using samba in qemu.
	Qemu creates it's own custom smb.conf file in /tmp/qemu-smb.[...]/smb.conf
	The network share will be accessible via //10.0.2.4/qemu.
	Bear in mind that this also requires your guest have internet access and the ability to mount samba shares.
	</p>

	<h3>Dependencies</h3>
	<pre>
# Cifs is used to mount shares
# Samba is used for...well...ya know...
$ pacman -S samba cifs-utils
	</pre>

	<h3>Starting VM with share</h3>
	<pre>
$ qemu-system-x86_64 -enable-kvm -cpu host -m 4000 -net user,<span style="color: red;">smb=$HOME</span> -net nic,model=virtio
	</pre>

	<h3>Mounting share in guest machine</h3>
	<pre>
# We set the GID and UID values to the userid and groupid of our user
# This is so we don't need root privledges to write to the network share
$ mount -t cifs //10.0.2.4/qemu /path/to/mountpoint -o username=anonymous,password=anonymous,gid=1000,uid=1000

# We can automatically mount the share by adding it to our fstab
//10.0.2.4/qemu /home/anon/host cifs nofail,auto,gid=1000,uid=1000,username=anonymous,password=anonymous
	</pre>

	<img src="../pix/qemu-smb.png" alt="qemu-smb.png">
	<em>...messy home directory</em>
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
