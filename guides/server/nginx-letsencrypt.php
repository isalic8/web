<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Let's encrypt</title>
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
	<h1>Letsencrypt</h1>
	<h3>Preface</h3>
	<p>
	Letsencrypt is a service/tool which allows you to generate free, trusted, ssl certificates.
	It's very easy to use.
	On it's own, it only generates the certificates and does nothing more.
	Assuming we've installed the necessary packages, we can use "certbot" and it's nginx plugin to automatically configure our web server with SSL!
	</p>

	<h3>Installation</h3>
	<pre>
apt install certbot python-certbot-nginx
	</pre>

	<h3>Usage</h3>
	<p>
	<strong>--nginx:</strong> Use the nginx plugin to automatically install the certificates to our web server
	<br>
	<strong>-d &lt;domain&gt;:</strong> Include these domains when creating the certificate
	</p>
	<pre>
certbot --nginx -d domain.com -d www.domain.com -d search.domain.com

# Rolling back the nginx modifications
certbot --nginx rollback

# Certificate location
/etc/letsencrypt/live/domain/fullchain.pem
/etc/letsencrypt/live/domain/privkey.pem
	</pre>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>

