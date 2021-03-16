<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>NFS</title>
</head>
<body>
	<header>
		<?php include '../navigation1.php';?>
	</header>

	<div class="main">
	<h2>Setting up NFS share in Debain Linux</h2>
	<h3>Dependencies</h3>
	<pre>
apt install nfs-kernel portmap
	</pre>

	<h3>Generating share</h3>
	<pre>
/media/nfs		192.168.1.0/24(rw,sync,no_subtree_check)
/media/nfs		192.168.1.112(rw,sync,no_subtree_check) 192.168.1.121(ro,sync,no_subtree_check)

ro: specifies that the directory may only be mounted as read only
rw: grants both read and write permissions on the directory
no_root_squash: is an extremely dangerous option that allows remote “root” users the same privilege as the “root” user of the host machine
subtree_check: specifies that, in the case of a directory is exported instead of an entire filesystem, the host should verify the location of files and directories on the host filesystem
no_subtree_check: specifies that the host should not check the location of the files being accessed withing the host filesystem
sync: this just ensures that the host keeps any changes uploaded to the shared directory in sync
async: ignores synchronization checks in favor of increased speed

$ systemctl restart nfs-kernel-server

	</pre>
	<p></p>

	</div>
</body>
</html>
