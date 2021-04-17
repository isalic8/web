<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>GPG Key Generator</title>
</head>
<body>
	<div class="main">
	<div class="header">
		<p>
		Unixfandom.com
		<img src="../../files/pix/penguin.gif" alt="penguin_gif">
		</p>
	</div>

	<nav>
		<?php include '../navigation.php';?>
	</nav>
	<h1>GPG Key Generator</h1>
	<h3>Preface</h3>
	<p>
	This generates an rsa master key with cert privileges and two separate rsa subkeys for encryption, signing, and authentication.<br>
	The new GPG files will be generated in a custom GNUPGHOME directory located in the working directory of the script.
	The default "~/.gnupg/" directory will be untouched.
	</p>

	<h3>Usage</h3>
	<p>
	It requires you set the NAME, EMAIL, and PASS variables before executing the script.<br>
	You can optionally set the COMMENT, MBITS, SBITS, MEX, and SEX, variables as well.<br>
	Information on these variables is given in the preamble of the script.
	</p>

	<pre>
# Recommended usage
$ EMAIL=test@test NAME="Tester Mctester" PASS="strongpassword" ./gpg-script.sh

# Advanced usage
$ EMAIL=test@test NAME="Tester Mctester" PASS="strongpassword" \
	COMMENT="A demonstration keypair" \
	MBITS=1024 SBITS=1024 \
	MEX=1y SEX=1y \
	./gpg-script.sh
	</pre>

	<h3>Script</h3>
	<p>Github link to be added</p>
	<pre>
#!/usr/bin/env sh
# Generates a masterkey with certification privileges and three subkeys for encryption, signing, and authentication.
# The "NAME" "EMAIL" and "PASS" variables must be set before running the script
# Optional variables include:
# COMMENT: The comment left on your key (default='')
# MBITS: The total bits used for generating the masterkey (default='4096')
# SBITS: The total bits used for generating the subkeys (default='4096')
# MEX: Expiration date for masterkey (default='none')
# SEX: Expiration date for subkey (default='3y')

gpg="gpg2"

_ParseCustomVariables(){
	if [ -z "$EMAIL" ] || [ -z "$NAME" ] || [ -z "$PASS" ]; then
		printf "\e[1;31mRun \"NAME=\"Jon Doe\" EMAIL=jon.doe PASS=\"password\" $0\"\e[0m\n"
		exit
	fi

	[ -z "$COMMENT" ] &amp;&amp; COMMENT="" # Optional custom comment for masterkey
	[ -z "$MBITS" ] &amp;&amp; MBITS="4096" # Bits used for masterkey
	[ -z "$SBITS" ] &amp;&amp; SBITS="4096" # Bits used for subkey
	[ -z "$MEX" ] &amp;&amp; MEX="none" # Expiration date used for masterkey
	[ -z "$SEX" ] &amp;&amp; SEX="3y" # Experation date used for subkey
}

_GenGpgEnvironment(){
	file=$(readlink -f "$0")
	dir=${file%/*}
	i=0
	while [ -d "$dir/gpghome-${i}" ]; do
		i=$(( i + 1 ))
	done
	mkdir -p "$dir/gpghome-${i}"
	GNUPGHOME="$dir/gpghome-${i}"
	cd $GNUPGHOME
	wget -O $GNUPGHOME/gpg.conf https://raw.githubusercontent.com/drduh/config/master/gpg.conf
}

_GenMasterkey(){
	$gpg --batch --passphrase "$PASS" --quick-generate-key "$NAME $EMAIL" rsa${MBITS} cert none
	fingerprint=$($gpg --with-colons --fingerprint "$EMAIL" | grep -iE "^fpr" | cut -d':' -f10)
}

_GenSubkeys(){
	$gpg --batch --passphrase "$PASS" --quick-add-key $fingerprint rsa${SBITS} sign $SEX
	$gpg --batch --passphrase "$PASS" --quick-add-key $fingerprint rsa${SBITS} encrypt $SEX
	$gpg --batch --passphrase "$PASS" --quick-add-key $fingerprint rsa${SBITS} auth $SEX
}


_ParseCustomVariables
printf "\e[1;33mGenerating GNUPGHOME\e[0m\n"
_GenGpgEnvironment
printf "\n\e[1;33mGenerating Masterkey\e[0m\n"
_GenMasterkey
printf "\n\e[1;33mGenerating Subkeys\e[0m\n"
_GenSubkeys
printf "\n\e[1;33mDONE.\e[1;31m GNUPGHOME=$GNUPGHOME\e[0m\n"
	</pre>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
