<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Mail Server</title>
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
	<h1>Configuring a Mail Server</h1>
	<h3>Preface</h3>
	<p>
	It took a bunch of attempts, but I've finally figured it out. We'll setup an email server with dovecot and postfix. Along the way, we'll be setting up dns records to validate our server to send mail and configure it with ssl certificates.
	<br>
	<br>
	Here are the websites I visited:
	<br>
	<a target="_blank" href="https://poolp.org/posts/2019-09-14/setting-up-a-mail-server-with-opensmtpd-dovecot-and-rspamd/">Mail server with opensmtpd</a>
	<br>
	<a target="_blank" href="https://scaron.info/blog/debian-mail-postfix-dovecot.html">Mail server w/ postfix and dovecot</a>
	<br>
	<a target="_blank" href="https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-dkim-with-postfix-on-debian-wheezy">Opendkim</a>
	<br>
	<a target="_blank" href="https://www.vultr.com/docs/how-to-configure-spamassassin-with-postfix-on-ubuntu-16-04">Spamassassin</a>
	</p>

	<h3>Game plan</h3>
	<p>
	<strong>DNS records+RDNS:</strong>
	<br>
	We need to create a few DNS text records in our domain registrar that basically validate/permit our domain to send mail. Without these records, other email providers will interpret our emails as spam, and block them without prejudice. 

	Our server also NEEDS to have a reverse DNS (rDNS) and forward-confirmed rDNS (FCrDNS). We'll set this up. 
	<br>
	<br>
	<strong>MTA: </strong>
	<br>
	The mail transfer agent - postifx in this case - will be in charge of recieving and delivering mail to the intended recipients. <a target="_blank" href="https://www.youtube-nocookie.com/embed/qhA8HuJBa64">Postfix is a "master server", which runs various different independent processes to send mail and recieve mail.</a>.
	<br>
	<br>
	<strong>MDA: </strong>
	<br>
	We need a way to view our mail. Dovecot - a mail delivery agent - will allow authorized users to view/download their emails via POP3 and IMAP. Dovecot's configuration also allows us to specify where email will be stored, the folders to which emails will go, etc. 
	<br>
	<br>
	<strong>Opendkim:</strong>
	<br>
	It's so gmail doesn't block us.
	<br>
	<br>
	<em>"The opendkim service functions as a milter, that is, a plugin software hooked into the SMTP processing of the Postfix MTA. To enable a milter, it is enough to tell Postfix on which socket the milter application is listening. Example /etc/postfix/main.cf"</em> - Debian Wiki
	<br>
	<br>
	<strong>Anti-spam:</strong>
	<br>
	We'll use spamassassin for this.
	<br>
	<br>
	</p>

	<h3>DNS Stuff</h3>
	<p>
	Ipsum consectetur quibusdam excepturi ab id Quam dignissimos vel maxime unde nulla Itaque iusto placeat fugit saepe doloremque? Natus vero nesciunt ea corporis totam Quisquam voluptates nisi fugiat necessitatibus esse
	</p>

	<h3>Generating SSL certificates</h3>
	<p>You're certificate will be stored in /etc/live/letsencrypt. If you've already created ssl certificates for a your domain, running this will just appended the new domains to the existing certificate.</p>
	<pre>
$ sudo apt-get install certbot python-certbot-nginx
$ certbot certonly --standalone -d mail.mydomain.com
	</pre>

	<h3>Postfix (sends and recieves mail)</h3>
	<h4>Dependencies</h4>
	<pre>
$ apt install postfix
$ dpkg-reconfigure postfix
	</pre>

	<p>
	Upon reconfiguring postfix, you'll be prompted to answer some questions.
	<br><br>
	<em>General type of mail configuration: Internet Site</em>
	<br><br>
	<em>NONE doesn't appear to be requested in current config</em>
	<br><br>
	<em>System mail name: example.com</em>
	<br><br>
	<em>Root and postmaster mail recipient: &lt;admin_user_name&gt;</em>
	<br><br>
	<em>Other destinations for mail: server1.example.com, example.com, localhost.example.com, localhost</em>
	<br><br>
	<em>Force synchronous updates on mail queue?: No</em>
	<br><br>
	<em>Local networks: 127.0.0.0/8</em>
	<br><br>
	<em>Yes doesn't appear to be requested in current config</em>
	<br><br>
	<em>Mailbox size limit (bytes): 0</em>
	<br><br>
	<em>Local address extension character: +</em>
	<br><br>
	<em>Internet protocols to use: all</em>
	<br><br>
	</p>

	<h4>Configuration</h4>
	<p>
	This whole section is sourced from <a target="_blank" href="https://scaron.info/blog/debian-mail-postfix-dovecot.html">"scaron.info"</a>. The configuration included is not the entire main.cf file. Add or edit where necessary.
	</p>
	<pre>
$ vim /etc/postfix/main.cf

# Hostname and domain name
myhostname=mymachine.example.com
mydomain=example.com
myorigin=$mydomain

# SSL/TLS certificates
smtpd_tls_cert_file = /etc/letsencrypt/live/mail.mydomain.com/fullchain.pem
smtpd_tls_key_file = /etc/letsencrypt/live/mail.mydomain.com/privkey.pem
smtpd_use_tls=yes
smtpd_tls_auth_only=yes

# Anti-SPAM rules adapted from https://wiki.debian.org/Postfix
smtpd_relay_restrictions = permit_sasl_authenticated,
    reject_invalid_hostname,
    reject_unknown_recipient_domain,
    reject_unauth_destination,
    reject_rbl_client sbl.spamhaus.org,
    permit
smtpd_helo_restrictions = permit_sasl_authenticated,
    reject_invalid_helo_hostname,
    reject_non_fqdn_helo_hostname,
    reject_unknown_helo_hostname
smtpd_client_restrictions = permit_mynetworks,
    permit_sasl_authenticated,
    reject_unauth_destination,
    reject_rbl_client cbl.abuseat.org,
    permit

# Mail user agent restrictions adapted from https://askubuntu.com/a/1132874
smtpd_restriction_classes = mua_sender_restrictions,
    mua_client_restrictions,
    mua_helo_restrictions
mua_sender_restrictions = permit_sasl_authenticated, reject
mua_client_restrictions = permit_sasl_authenticated, reject
mua_helo_restrictions = permit_mynetworks,
    reject_non_fqdn_hostname,
    reject_invalid_hostname,
    permit

# Mail will be stored in users' ~/Maildir directories
#
# NB: make sure to enforce this setting as well in the `mail_location`
# of /etc/dovecot/conf.d/10-mail.conf (thanks to Markus Hoffmann for
# pointing this out):
#
#     mail_location = maildir:~/Maildir
#
home_mailbox = Maildir/
mailbox_command =

# From http://wiki2.dovecot.org/HowTo/PostfixAndDovecotSASL
smtpd_sasl_type = dovecot
smtpd_sasl_path = private/auth
smtpd_sasl_auth_enable = yes
	</pre>

	<p>
	Next we'll configure /etc/postfix/master.cf
	<br>
	Uncomment the lines starting with #submission and #smtps.
	</p>
	<pre>
submission inet n       -       y       -       -       smtpd
  -o syslog_name=postfix/submission
  -o smtpd_tls_security_level=encrypt
  -o smtpd_sasl_auth_enable=yes
  -o smtpd_reject_unlisted_recipient=no
  -o smtpd_client_restrictions=$mua_client_restrictions
  -o smtpd_helo_restrictions=$mua_helo_restrictions
  -o smtpd_sender_restrictions=$mua_sender_restrictions
  -o smtpd_recipient_restrictions=
  -o smtpd_relay_restrictions=permit_sasl_authenticated,reject
  -o milter_macro_daemon_name=ORIGINATING
smtps     inet  n       -       y       -       -       smtpd
  -o syslog_name=postfix/smtps
  -o smtpd_tls_wrappermode=yes
  -o smtpd_sasl_auth_enable=yes
  -o smtpd_reject_unlisted_recipient=no
  -o smtpd_client_restrictions=$mua_client_restrictions
  -o smtpd_helo_restrictions=$mua_helo_restrictions
  -o smtpd_sender_restrictions=$mua_sender_restrictions
  -o smtpd_recipient_restrictions=
  -o smtpd_relay_restrictions=permit_sasl_authenticated,reject
  -o milter_macro_daemon_name=ORIGINATING
	</pre>

	<p>And finally add this line at the end for dovecot</p>
	<pre>
dovecot   unix  -       n       n       -       -       pipe
  flags=DRhu user=email:email argv=/usr/lib/dovecot/deliver -f ${sender} -d ${recipient}
	</pre>

	<h3>Dovecot</h3>
	<h4>Dependencies</h4>
	<pre>
$ apt-get install dovecot-common dovecot-imapd dovecot-pop3d
	</pre>

	<h4>Configurations</h4>
	<pre>
$ vim /etc/dovecot/conf.d/10-ssl.conf

# SSL/TLS support: yes, no, required. &lt;doc/wiki/SSL.txt&gt;
# ssl = required
# ssl_cert = &lt;/etc/letsencrypt/live/mail.mydomain.com/fullchain.pem
# ssl_key = &lt;/etc/letsencrypt/live/mail.mydomain.com/privkey.pem
	</pre>
	<pre>
$ vim /etc/dovecot/conf.d/10-auth.conf

# Make sure this line is present
disable_plaintext_auth = yes
	</pre>
	<pre>
$ vim /etc/dovecot/conf.d/10-master.conf

service auth {
  #Postfix smtp-auth
  #unix_listener /var/spool/postfix/private/auth {
      mode = 0660
    }
  }
	</pre>

	<h3>Opendkim</h3>
	<h4>Dependencies</h4>

	<h3>Spamassassing</h3>
	<h4>Dependencies</h4>
</body>
</html>

