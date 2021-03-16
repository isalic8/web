<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>DEPRECIATED</title>
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
	<h1>Generating custom onion url</h1>
	<h3>Preface</h3>
	<p>
	<span style="color: red;">DEPRECIATED: Onion version 2 addresses are being replaced by the end of 2021.
<br>
Refer to: <a href="nginx-tor-urlv3.php">Generating onionv3 vanity addresses</a></span>

<br>
<br>


	We'll be using a tool called eschalot that pretty much generates onion domains until it finds the prefix of your choice. You can get yourself a semi-customized onion domain name this way.
	</p>

	<h3>Installing eschalot</h3>
	<p>I had to install the openssl libraries for it to compile properly. This ended up being "openssl-devel" on fedora. I'm not sure what the package is called on other distributions; just give the error a online search.</p>
	<pre>
$ git clone https://github.com/ReclaimYourPrivacy/eschalot.git
$ cd eschalot-1.2.0
$ make
	</pre>

	<h3>Generating our juicy url</h3>
	<p>The longer the prefix, the longer the process will take. More than 8 characters and you're looking to wait a looooong while.</p>
	<pre>
./eschalot -t4 -v -c -p test > results.txt

-t4	Thread count. You can use $(nproc) instead of 4, to use your machine's max CPU/thread count.
-v	Verbosity
-c	Continue after hash is found
-p	Prefix
	</pre>

	<h3>Results</h3>
	<p>You should receive similar output. Eschalot outputs both the onion domain name and it's corresponding private key. DON'T SHARE THE KEY! It's used to spin your tor domain. If someone else has it, they can impersonate your site.</p>
	<pre>
uewavmgvpbgudktv.onion
-----BEGIN RSA PRIVATE KEY-----
MIICXwIBAAKBgQDNw/JQm63+hfhMcpEahzT8RUVyh8Tf1OMAOKUXt6XKVU8PkgM+
8NBpl94gV24YzVHoEtXn+brqfulmJekx6bTj3qDpZbB8W9NIkyrvva812FcDxqW5
llZfu4L5W8qL2aTjwrMfuEWXQJTUjRTM5FnhTwWW1Zq3DMJUZvpQAq8/HwIEAQAA
BwKBgBIgO1PRFbQmsxW8c/L/ZXNxQ6xoUu5ssLq05ExygCjrOHgdwaHKUgolP7T3
8DHSVrNYd/vNqNj9DFhTanxo4cNyFKG+F15LxGLZdeXyXWq30tm76GbFVoAdqK9T
6B1D0ajCkZRfFS2RZQ6jBuZKiz5IAhq8RuMtsoDekgKPso7XAkEA9ISM98MA/pQl
y1hIhMiuoN/MSyxwSET/f/G/4qIGimqWR/nhbYuAHBz5KRaC/tpqTBNmHdt7EpCh
j2xHmmXYawJBANdtiakoRvMA2U20ZQzueEXOfeEeE5+F9ncrX+UYsK5xHCSAy3/t
pgUYmR/rVaL2CUzQM5HtpXYBarU8njt78R0CQQCPEzvG8J4ARv4pNczGSRPhOczG
QMRR4Di1w4DmqLer8i4GVoqk1bM2E8eOLMII0g2TwBUfRMg7q94T9mPOK11BAkEA
ti1tlE6yb6iiP+RFa8bjcpyaRMt+ZL2idIs0oNiG/LZp/nYZgOuJm4IN9lbcMflq
yXpwqUudg+AxEp11M06C7wJBAOyWspyOG1k/29bicS917GDo6MmwKtpfrE59vUjk
21NexXWeHSt8E6BHWA+JcuWT0bWFUDUiB7dUSazT2n094kQ=
-----END RSA PRIVATE KEY-----
	</pre>
	<p>I'll show you how you can use this custom domain with nginx <a href="nginx-tor.php">here</a></p>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
