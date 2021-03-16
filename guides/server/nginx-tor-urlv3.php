<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>OnionV3 domain</title>
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
	<h1>Creating an OnionV3 vanity address</h1>

	<h3>Preface</h3>
	<p>
	Tor is abandoning the now depreciated onionv2 addresses for the more secure v3 addresses.
	<br>
	<br>
	We'll use <a href="https://github.com/cathugger/mkp224o">mkp224o</a> to generate our new version 3 domain.
	</p>

	<h3>Compiling the application</h3>
	<p>You'll likely get some errors relating to missing libraries. Search online for the library package for your distribution or refer to <a href="https://github.com/cathugger/mkp224o">mkp224o</a>.</p>

	<pre>
$ git clone https://github.com/cathugger/mkp224o.git
$ cd mkp224o
$ ./autogen.sh
$ ./configure
	</pre>

	<h3>Generating our domain</h3>
	<p>The longer the prefix, the longer the time it takes to generate a key.</p>
	<pre>
$ ./mkp224o -d unixkeys unix

set workdir: unixkeys/
[...]
unixws2it55xk5hpsq26ykddgvqesrdm3zjtbobu7ioxpfdm5ikvogyd.onion

$ ls unixkeys/unixws2[...]

hs[...]_secret_key

	</pre>

	<p>
	After that, all we need to do is copy the secret key to the hidden service directory on our server.
	Make sure that the owner of the file is the tor user ("debian-tor" on debian machines). Tor will overwrite the file if the incorrect owner is set.
	</p>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
