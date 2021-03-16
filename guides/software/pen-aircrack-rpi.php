<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Aircrack RPI</title>
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
	<h1>Installing Aircrack in RPI3</h1>
	<h3>Preface</h3>
	<p>
	I reference the <a target="_blank" href="https://www.aircrack-ng.org/doku.php?id=install_aircrack#installing_aircrack-ng_from_source">official aircrack installation guide</a>.
	</p>

	<h3>Dependencies</h3>
	<pre>
$ apt-get -y install libssl-dev libnl-3-dev libnl-genl-3-dev ethtool
	</pre>

	<h3>Installation</h3>
	<pre>
$ wget https://download.aircrack-ng.org/aircrack-ng-1.6.tar.gz
$ tar -zxvf aircrack-ng-1.6.tar.gz
$ cd aircrack-ng-1.6
$ autoreconf -i
$ ./configure --with-experimental
$ make
$ make install
$ ldconfig
	</pre>
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
