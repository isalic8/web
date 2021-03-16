<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>PHP OpenBSD</title>
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
	<h1>Let's encrypt with OpenBSD</h1>
	<h3>Preface</h3>
	<p>
	<span style="color: red;">IGNORE THIS PAGE. PHP RUNS WILDLY SLOW ON HTTPD USING THESE STEPS</span><br><br>

	This was more annoying to setup the first time than I thought it'd be.
	I used these two resources:
	</p>
	<li><a href="https://www.php.net/manual/en/install.unix.openbsd.php" target="_blank">https://www.php.net/manual/en/install.unix.openbsd.php</a></li>
	<li><a href="https://jamsek.com/index.php/2018/03/01/openbsd-httpd-mariadb-php-w-wordpress/" target="_blank">https://jamsek.com/index.php/2018/03/01/openbsd-httpd-mariadb-php-w-wordpress/</a></li>

	<h3>Getting situated</h3>
	<p>
	We'll install the most recent version of php, configure it to start at runtime, copy some sample config files, add some optimizations, and finally configure it for use with httpd.
	</p>

	<pre>
# Dependencies. Install the most recent version of php. PHP-7.4 in my case.
$ pkg_add php php-fpm

# Add to /etc/rc.conf.local
httpd_flags=
pkg_scripts=php_fpm
	</pre>

	<p>Next we'll copy the configs and add some slight optimizations.</p>
	<pre>
# Copy configs
$ cp /etc/php-7.4.sample/* /etc/php-7.4/

# Add the following to /etc/php-fpm.conf
pm = ondemand
pm.max_children = 50
pm.max_requests = 500

# Add the following to /etc/php-7.4.ini
[opcache]
opcache.enable=1
opcache.enable_cli=1
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.memory_consumption=128
opcache.save_comments=1
opcache.revalidate_freq=1
	</pre>

	<p>You can then start the service with "rcctl start php74-fpm"</p>

	<h3>HTTPD</h3>
	<p>
	Here's a template for how your httpd config should look
	</p>
	<pre>
server "example.com" {
        #listen on * port 80
        listen on * tls port 443
	root "/htdocs"
        tls {
                certificate "/etc/ssl/example.com.fullchain.pem"
                key "/etc/ssl/private/example.com.key"
        }

        location "*.php" {
                fastcgi socket "/run/php-fpm.sock"
              }
	directory index index.php
}
	</pre>

	<h3>Done</h3>
	<p>You should be all set. Good luck!</p>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
