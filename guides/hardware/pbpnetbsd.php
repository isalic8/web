<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Netbsd PBP</title>
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
<!--<small>5/25/20</small>-->
<h1>Installing Netbsd on the Pinebook Pro</h1>
<h3>Preface</h3>
<p>
I'm going to assume that you've already copied the 
<a href="https://wiki.pine64.org/index.php/Pinebook_Pro_Software_Release#NetBSD_.5BmicroSD_.2FeMMC_Boot.5D" target="_blank">netbsd image </a>
to your device and have booted into your system. 
If you have problems booting from the microsd card, try disabling the emmc chip. 
It used to be the case that you were only able to boot from microsd if the chip was disabled.
I'm not sure if this was fixed.
</p>

<h3>Configuring Network</h3>
<p>
There are two ways of doing this:
<ul class="mainli">
	<li>1. Manually configuring wpa_supplicant</li>
	<li>2. Using wpa_cli (frontend to wpa_supplicant)</li>
</ul>
</p>
<p>
We're going to go over the manual method of setting up the network. If you want to use wpa_cli, here's a 
<a href="https://wiki.archlinux.org/index.php/Wpa_supplicant#Connecting_with_wpa_cli" target="_blank">link </a>
to the arch wiki page.
<br/><br/>
Let's identify our interface
</p>

<pre>
$ ifconfig
lo0 flags....

run0: flags..... &lt;---- Substitute this interface for yours when referenced
</pre>

<p>
Next we setup wpa_supplicant and dhcpcd to run at boot.
</p>

<pre>
$ vi /etc/rc.conf

#Append the following

dhcpcd=YES
dhcpcd_flags="${dhcpcd_flags} -b"  #This ensures boot wont hang when network isn't present
wpa_supplicant=YES
wpa_supplicant_flags="-B -i run0 -c /etc/wpa_supplicant.conf"
</pre>

<p>
Next we can add our network to <em>/etc/wpa_supplicant.conf</em>
</p>

<pre>
$ vi /etc/wpa_supplicant.conf

ctrl_interface=/var/run/wpa_supplicant
ctrl_interface_group=wheel
update_config=1
network={
	ssid="my favourite network"
	psk="hunter2"
}

&lt;save and quit&gt;
</pre>

<pre>
# Starting wpa_supplicant 
/etc/rc.d/wpa_supplicant start
</pre>

<h3>Configuring package manager</h3>
<p>

Netbsd has a commented URL for downloading binary packages in ~/.profile
<br/>
Let's uncomment it
</p>

<pre>
$ vi ~/.profile

export PKG_PATH="https://..."
</pre>

<p>
I believe at this point you have to log out and log back in, so the .profile is sourced again.
<br/>
I just gave it a reboot instead. Let's install the <em>"pkgin"</em> package manager now :)
</p>

<pre>
$ pkg_add -v pkgin
$ pkgin update

"Warning earm doesn't match your current architecture...."
Still want to proceed? [y/N] 
</pre>

<p>
Stop here. We have to make sure our architecture is set correctly, or else packages won't install properly. 
<br/><br/>
Fortunatley this is pretty simple :D 
</p>

<pre>
$ echo $PKG_PATH > /usr/pkg/etc/pkgin/repositories.conf

# Note how I overwrote the file. 
# If you choose to instead append the text, make sure you edit <em>repositories.conf</em> to delete the original url
</pre>

<h3>Installing a desktop enviroment</h3>
<p>
Easy so far, huh? Let's install xfce4.
</p>

<pre>
$ pkgin install xfce4 xinit

# We have to link our X system so xinit can read from it.
$ ln -s /usr/X11R7/bin/X /usr/pkg/bin/X

# We add xfce4-session to our .xinitrc
$ echo "exec xfce4-session" > ~/.xinitrc

# Finally we can boot into our desktop enviroment
$ startx
</pre>

<p>
Give XFCE4 a moment to load in. 
<br/><br/>
Alt+f1 will bring you back to the tty prompt.
<br/>
Alt+f2 will bring you to the gui
</p>
</div>
</body>
</html>
