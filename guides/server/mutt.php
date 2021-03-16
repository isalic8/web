<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Neomutt</title>
</head>
<body>
	<header>
		<?php include '../navigation1.php';?>
	</header>

	<div class="main">
	<h2>Neomutt, mbsync, gpg</h2>
	<h3>Preface</h3>
	<p>
	Mutt is a terminal email client.
	It's pretty awesome.
	Here's how you configure it with GPG, mbsync (for offline mail), and msmtp (sending mail).
	I'm only showing how to do one gmail account.
	<a target="_blank" href="https://support.google.com/accounts/answer/6010255?hl=en">Make sure you allow less secure apps in gmail.</a>

	<br>
	<br>
	Fyi. The config files are from <a target="_blank" href="https://github.com/LukeSmithxyz/mutt-wizard">Luke Smiths Mutt-Wizard script</a>.
	I dislike using automation scripts that I didn't write.
	It sucks when they fail and you have to disect it.
	They're also prone to becoming depreciated.
	</p>

	<h3>Game plan</h3>
	<p>
	<strong>GPG+Pass:</strong> We'll generate a pair of GPG keys to encrypt our passwords. We can use "pass" - an open sourced unix password manager - to encrypt, then decrypt the passwords to our accounts. When decrypting a password with "pass", there's a grace period where you can decrypt it again without having to type in the password.
	<br>
	<br>
	<strong>Isync:</strong> Isync is a simple programs that syncs mail between your remote repository (google servers in this case) and your local repository. It downloads mail. We'll configure it to use "pass" to obtain the user password. Later we'll direct neomutt to look at the local repository for mail, instead of using imap.
	<br>
	<br>
	<strong>Msmtp:</strong> This program sends mail. We'll again use "pass" to give it our user credentials. Using msmtp allows us to send emails on mutt without having to type in our password every time.
	<br>
	<br>
	<strong>Neomutt:</strong> I won't go into great detail on the configuration file. Neomutt let's us read our local mail (isync) and send mail (msmtp). The config is very readable. I copied it from <a target="_blank" href="https://github.com/LukeSmithxyz/mutt-wizard/blob/master/share/mutt-wizard.muttrc">Mutt-Wizard</a>
	</p>

	<h3>Getting cozy</h3>
	<p>Dependencies:</p>
	<pre>
$ pacman -S neomutt isync msmtp gnupg pass

# These are used to open special filetypes in mutt. (mailcap file)
$ pacman -S mpv feh w3m [vim/neovim]
	</pre>

	<p>
	We'll need our email providers imap server+port and smtp server+port.
	<br>
	There are two things you can do:
	<br>
	1. Search online for your providers information.	
	<br>
	2. Download a CSV file from my site and grep your email provider name
	</p>

	<pre>
# CSV file filled with email providers and their corresponding imap/smtp info
$ wget https://unixfandom.com/files/mutt/domains.csv

# Search for the line containing "gmail.com" as the first word
$ grep -E "^gmail.com" domain.csv

gmail.com,<span style="color: red">imap.gmail.com,993</span>,<span style="color: magenta;">smtp.gmail.com,587</span>
	</pre>

	<h3>Gnupg+Pass</h3>
	<p>We'll use GPG to encrypt our passwords. Lets generate our keys, pop it into pass, then add an email</p>
	<pre>
$ gpg --full-generate-key
$ gpg --list-secret-key --keyid-format LONG

/home/peter/.gnupg/pubring.kbx
------------------------------
sec   rsa2048/<span style="color: red;">6H31[..]6B41</span> 2020-08-08 [SC]
      C620E20890C0AF197F3138606C31D6906C536A41
uid                 [ultimate] peter <petertos322@gmail.com>
ssb   rsa2048/339F9037220340E5 2020-08-08 [E]

$ pass init <span style="color: red;">6H31[..]6B41</span>
$ pass insert <span style="color: red;">peter@gmail.com</span>

$ pass peter@gmail.com
secret_password64
	</pre>
	<h3>Isync</h3>
	<p>
	Isync (mbsync) downloads our mail locally.
	Read the <a target="_blank" href="https://wiki.archlinux.org/index.php/Isync">Arch Wiki</a> for the gritty details.
	Otherwise, just copy and paste below. Substitute where applicable. Whitespace matters!
	<pre>
$ vim ~/.mbsyncrc

<code>
IMAPStore <span style="color: red">peter-remote</span>
Host <span style="color: red;">imap.gmail.com</span>
Port <span style="color: red;">993</span>
User <span style="color: red">peter@gmail.com</span>
PassCmd "pass <span style="color: red;">peter@gmail.com"</span>
SSLType IMAPS
CertificateFile /etc/ssl/certs/ca-certificates.crt

MaildirStore <span style="color: red">peter-local</span>
Path ~/.local/share/mail/<span style="color: red">peter</span>/
Inbox ~/.local/share/mail/<span style="color: red">peter</span>/INBOX
Subfolders Verbatim

Channel <span style="color: red">peter</span>
Master :<span style="color: red">peter-remote</span>:
Slave :<span style="color: red">peter-local</span>:
Create Both # Create a local folder creates the same folder on the remote repo
Expunge Both # Deleting a local folder deletes the same folder on the remote repo
Patterns * # Determines which mailboxes to sync. Asterisk=All
SyncState * # Not entirely sure what this does. I just know it prevents disatrous local email deletions
ExpireUnread no
</code>
	</pre>

	<p>We should be able to download our mail without error</p>
	<pre>
# Sync all channels
$ mbsync -a 

C: 0/4  B: 0/9  M: +0/0 *0/0 #0/0  S: +0/0 *0/0 #0/0
C: 0/4  B: 1/9  M: +0/0 *0/0 #0/0  S: +1152/1152 *0/0 #0/0
C: 0/4  B: 2/9  M: +0/0 *0/0 #0/0  S: +2394/2394 *0/0 #0/0
	</pre>

	<h3>Msmtp</h3>
	<p>A simple program which sends mail. Later we'll be using this with neomutt. Let's create the config.</p>
	<pre>
$ vim ~/msmtprc

<code>
defaults
auth    on
tls     on
tls_starttls on
tls_trust_file /etc/ssl/certs/ca-certificates.crt
logfile .cache/msmtprc.log

account <span style="color: red;">peter</span>
host <span style="color: red;">smtp.gmail.com</span>
port <span style="color: red;">587</span>
from <span style="color: red;">peter@gmail.com</span>
user <span style="color: red;">peter@gmail.com</span>
passwordeval  "pass <span style="color: red;">peter@gmail.com</span>"
</code>

# Sending a test email 
$ echo hello | msmtp -a peter recpipient@email.com
	</pre>

	<h3>Mutt</h3>
	<p>
	As I mentioned earlier, I won't be going deep into the configuration of mutt. Lukes build works perfect.
	</p>
	<pre>
$ mkdir -p $HOME/.config/mutt/

# Mutt config files
$ wget -O $HOME/.config/mutt/muttrc https://unixfandom.com/files/mutt/muttrc

# Mailcap determines which external applications open X filetypes
$ wget -O $HOME/.config/mutt/mailcap https://unixfandom.com/files/mutt/mailcap
	</pre>

	<h3>Test run</h3>
	<pre>
$ neomutt
	</pre>
	<img src="../pix/neomutt-postinstall.png" alt="neomut-post-install.png">

	<h3>Cronjob</h3>
	<p>We can set a cronjob to automatically sync our mail every 5 minutes</p>
	<pre>
$ pacman -S cronie
$ systemctl enable cronie
$ systemctl start cronie

$ crontab -e

<code>
*/5 * * * * mbsync -a
</code>
	</pre>
	</div>
</body>
</html>
