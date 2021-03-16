<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Nginx tor</title>
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
	<h1>Setting up tor with nginx</h1>
	<h3>Preface</h3>
	<p>A few things to note: Tor sites don't require ssl. It has it's own means of encryption. We'll be configuring our nginx server to keep our clearnet site and tor site separate. Having the tor domain linked to the same nginx server as our clearnet site may cause problems when you're clearnet site tries to redirect it's users to the https protected site. We're keeping our eggs in different baskets.</p>

	<h3>Dependencies</h3>
	<pre>
$ apt install tor nginx

$ systemctl enable nginx tor
$ systemctl start nginx tor
	</pre>

	<h3>Setting up our tor hidden service</h3>
	<pre>
$ vim /etc/tor/torrc

HiddenServiceDir /var/lib/tor/hidden-name/
HiddenServiceVersion 3
HiddenServicePort 80 127.0.0.1:8080

# Restarting the service generates our own active tor domain.
$ systemctl restart tor

$ ls -l /var/lib/tor/hidden-name
authorized_clients/
hostname
hs_ed25519_public_key
hs_ed25519_secret_key
	</pre>

	<h3>Adding to nginx</h3>
	<p>Here's a template server configuration that makes use of our newly created tor hidden service.</p>
	<pre>
$ vim /etc/nginx/sites-enabled/default

server {
	listen 127.0.0.1:8080;
	root /var/www/;
	client_max_body_size 99M;
	charset utf-8;
	index index.html;
}

$ systemctl restart nginx
	</pre>

	<h3>Adding custom tor domain [OPTIONAL]</h3>
	<p>Assuming you've already <a href="nginx-tor-urlv3.php">generated your tor domains private key</a>, adding our key is pretty darned simple. We just remove the old junk from our hidden service directory, add our new private key to the directory, then restart the service. Restarting the service will look at the private key, then deduce what the domain name is.</p>
	<pre> 
# Use rsync, sftp, or whatever protocol to place the secret key on the server

$ rm -rf /var/lib/tor/hidden-name
$ mv /path/to/hs_ed25519_secret_key /var/lib/tor/hidden-name/
$ systemctl restart tor
	</pre>
	<h3>Results</h3>
	<img src="../pix/nginx-tor.png" alt="results image">
	<small><em>Old photo using onionv2 address...</em></small>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
