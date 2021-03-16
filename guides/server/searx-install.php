<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Searx</title>
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
	<h1>Searx Installation</h1>

	<h3>Preface</h3>
	<p>I'm doing this on a Debian 10 server. The guide assumes you have root privledges. I think ubuntu requires you add your user to the docker group (usermod -aG docker username)</p>
	<h3>Dependencies</h3>
	<pre>
$ apt install docker docker.io nginx 
	</pre>

	<h3>Creating Searx container</h3>
	<p>This pulls and starts the docker container, creating a web socket that's accessible via 127.0.0.1:8888. Normally this image creates a searx instance that's accessible via the servers public IP. We don't want this since we're going to be accessing the container through nginx.</p>
	<pre>
docker pull wonderfall/searx
docker run -d --restart unless-stopped --name searx -p 127.0.0.1:8888:8888 wonderfall/searx
	</pre>

	<h3>Running with Nginx</h3>
	<p>
	Here we'll use
	<a target="_blank" href="https://docs.nginx.com/nginx/admin-guide/web-server/reverse-proxy/">"proxy_pass"</a>
	to send our clients requests to our docker container. This is done so  we can set it up with a domain name and SSL - kinda like
	<a href="https://search.unixfandom.com" target="_blank">this.</a>
	</p>
	<pre>
$ vim /etc/nginx/sites-available/default

# I appended the following:

<code>
server {
	listen 80;
	server_name search.yourdomain.com;

	location / {
	proxy_pass http://127.0.0.1:8888;
	}
}
</code>
	</pre>

	<h3>Starting the container as service</h3>
	<p>Our searx server should be up and running. Let's create a systemd service to start the container on boot</p>
	<pre>
$ vim /etc/systemd/system/docker-searx.service
<code>
[Unit]
Description=Searx docker service
Requires=docker.service
After=docker.service

[Service]
ExecStart=/usr/bin/docker start -a searx
ExecStop=/usr/bin/docker stop -t 2 searx

[Install]
WantedBy=default.target
</code>

$ systemctl enable docker-searx
$ systemctl start docker-searx
$ systemctl status docker-searx
	</pre>

	<h3>DONE!</h3>
	<p>
	Searx should be up and running on "search.yourdomain.com". I recommend changing the access_log and error_log files to "/dev/null" in /etc/nginx/nginx.conf. 
	<br>
	<br>
	Logs are for google.
	</p>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
