<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>OpenSMTPD Debian</title>
</head>
<body>
	<div class="main">
	<!--06 July 2020-->
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
	<h1>Compiling OpenSMTPD on Debian 10</h1>

	<h3>Installing dependencies and sources</h3>
	<pre>
# Dependencies
$ apt install build-essential libz-dev libssl-dev libevent-dev libtool bison

# Sources
$ cd /opt
$ git clone git://github.com/OpenSMTPD/OpenSMTPD.git opensmtpd
$ cd opensmtpd*
	</pre>

	<h3>Compile and install</h3>
	<pre>
$ ./bootstrap # Only if you build from git sources
$ ./configure
$ make
$ make install
	</pre>

	<h3>Starting the service</h3>
	<p>For some reason my OpenSMTPD service was masked, which prevented it from starting properly. Unmasking it fixed the problem</p>
	<pre>
$ systemctl unmask opensmtpd
$ systemctl enable opensmtpd
$ systemctl start opensmtpd
	</pre>

	<h3>Done</h3>
	<pre>
$ smtpd -h                                                                                                         │
version: OpenSMTPD 6.7.0-portable                                                                                          │
usage: smtpd [-dFhnv] [-D macro=value] [-f file] [-P system] [-T trace]
	</pre>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
