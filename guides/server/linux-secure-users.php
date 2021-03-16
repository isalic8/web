<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Securing remote users</title>
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
	<h1>Securing remote users</h1>
	<h3>Preface</h3>
	<p>Just another general guide on securing remote user accounts. Here's the rundown:</p>
	<li>Generate SSH keys for secure authentication</li>
	<li>Restrict user command access</li>
	<li>Changing user shell</li>

	<h3>SSH keys</h3>
	<p>
	Using key based authentication over password based authentication completely eliminates attackers from being able to remotely log into our machine over ssh.
	It'll require the individual to have access to the generated key file in order to login.
	</p>

	<p>
	This command will generate two files. An ssh public key and an ssh private key.
	We'll upload the public key to our server and then login using our private key.
	By default, this command generates the keys in the "~/.ssh/" directory.
	</p>
	<pre>
# Generating the key pair
$ ssh-keygen -t rsa  -b 4096

# Copying the public key file
$ ssh-copy-id -i /path/to/idrsa.pub user@10.0.0.1

# Verifying it works
$ ssh -i /path/to/idrsa user@10.0.0.1

user> echo "IT WORKS!!!" 
	</pre>

	<p>We also want to disable password based authentication in our ssh config</p>

	<pre>
$ vim /etc/ssh/sshd_config

# Add/modify the lines
PermitRootLogin no
PubkeyAuthentication yes
PasswordAuthentication no

$ systemctl restart sshd
	</pre>

	<h3>Restrict user commands</h3>
	<p>
	In the event that an attacker gains access to our user account, we want to restrict any possible commands that could lead to privledge escalation.
	Since we generally only work as a root user when configuring our servers, we'll only allow our user access to the "su" command and nothing more.
	</p>

	<p>We'll create a bash profile and change the user's path variable. We'll also make it only readable and executable.</p>

	<pre>
$ cd /home/user
$ mkdir programs
$ vim .bash_profile

export PATH=~/programs

# Symbolically linking our program
$ ln -s /usr/bin/su /home/user/programs/

# Giving the user only read and execute permissions on the newly create files
$ chown -R root:user programs .bash_profile
$ chmod -R 0750 programs .bash_profile
	</pre>
	<p>Now when you log into your user via ssh, you're restricted to only being able to use "su" for root access. No other commands can be run</p>

	<h3>Changing shell</h3>
	<p>
	Depending on your use case, it is also beneficial to change the users shell. You can change the shell to something like "/usr/sbin/nologin" to disable logins, or something like rbash
	</p>
	<p>Rbash stands for "restricted bash". It's pretty much bash with a lot of the builtin functions removed. (read the manual)</p>
	<pre>
$ usermod -s /usr/bin/rbash user
	</pre>
	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
