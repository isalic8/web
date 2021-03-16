<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>DD wrapper</title>
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
	<h1>DD wrapper script</h1>
	<h3>Preface</h3>
	<p>Wrapper for dd. Used for flashing iso's to flash drives. Somewhat useful. Doesn't support stdin.</p>
	<pre>
#!/bin/sh
# A completely unnecessary wrapper for dd

usage(){
cat &lt;&lt;OEM
command DEV=/dev/sda1 IF=linux.iso FLAGS=\"bs=4M conv=fsync status=progress\"
OEM
exit
}

[ -z $1 ] &amp;&amp; usage 

# Making sure our args don't get interpretted as real commands
if [ -z "$(command -v $1 $2 $3)" ]; then
	eval  ${@} 2>/dev/null
else
	usage
fi

# Using printf to get fancy colors
[ -z "$DEV" ] &amp;&amp; printf "\e[0;31mNo device given\e[0m\n" &amp;&amp; usage
[ -z "$IF" ] &amp;&amp; printf "\e[0;31mNo input file given\e[0m\n" &amp;&amp; usage
[ -z "$FLAGS" ] &amp;&amp; printf "\e[0;33mNo flags given. Using defaults\e[0m\n" &amp;&amp; FLAGS="bs=4M conv=fsync status=progress"

printf "\e[0;31mExecuting dd if=$IF of=$DEV $FLAGS\e[0m\n"
sudo dd if=$IF of=$DEV $FLAGS
	</pre>
	
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
