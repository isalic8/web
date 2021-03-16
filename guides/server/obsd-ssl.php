<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>SSl OpenBsd</title>
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
	<h1>Let's encrypt with OpenBsd</h1>
	<h3>Preface</h3>
	<p>
	Installing ssl certificates is a breeze with OpenBsd.
	Most of the configuration is self explanatory.
	We'll use acme-client to generate our certs.
	I'm asssuming that you've already added your servers ip to your domains dns records.
	</p>

	<h3>Setting things up</h3>
	<p>
	There ain't too much to do here.
	We'll add our domain name to acme-client's config and then start the httpd web server.
	The acme client creates a file in /var/www/acme/ which is accessible over the webserver.
	This file is then transmitted to Let's Encrypt.
	Let's Encrypt then attempts to download this file from our domain (http://example.com/path/to/file).
	If the file is the same as the file sent from our localmachine, then Let's Encrypt knows that our server is legitamite and not a bad actor posing as the owner of the domain.
	</p>

	<p>Pewww.., now that that's out of the way, here's the beans on setting it up.</p>
	<pre>
# Copy config file 
cp /etc/example/acme-client.conf /etc/

# Start the webserver
rcctl -f start httpd
	</pre>

	<h3>Editing the config</h3>
	<p>
	I don't need to explain anything here. Just replace "example.com" with your domain name in /etc/acme-client.configuration.
	It should look somethings like this.
	</p>
	<pre>
#
# $OpenBSD: acme-client.conf,v 1.4 2020/09/17 09:13:06 florian Exp $
#
authority letsencrypt {
        api url "https://acme-v02.api.letsencrypt.org/directory"
        account key "/etc/acme/letsencrypt-privkey.pem"
}

authority letsencrypt-staging {
        api url "https://acme-staging-v02.api.letsencrypt.org/directory"
        account key "/etc/acme/letsencrypt-staging-privkey.pem"
}

authority buypass {
        api url "https://api.buypass.com/acme/directory"
        account key "/etc/acme/buypass-privkey.pem"
        contact "mailto:me@example.com"
}

authority buypass-test {
        api url "https://api.test4.buypass.no/acme/directory"
        account key "/etc/acme/buypass-test-privkey.pem"
        contact "mailto:me@example.com"
}

domain unixfandom.com {
       alternative names { secure.example.com }
        domain key "/etc/ssl/private/unixfandom.com.key"
        domain full chain certificate "/etc/ssl/unixfandom.com.fullchain.pem"
        sign with letsencrypt
}
	</pre>

	<h3>Generating the cert</h3>
	<p>
	Again self explanatory. 
	One thing I haven't tested is having more than one alternative domain listed.
	I'm not sure if you separate the domains by space or comma - I should test this...
	</p>
	<pre>
$ acme-client unixfandom.com

# Cert path
/etc/ssl/unixfandom.com.key
/etc/ssl/unixfandom.com.fullchain.pem
	</pre>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
