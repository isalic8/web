<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Digispark</title>
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
	<h1>Digispark</h1>
	<h3>Preface</h3>
	<p>
	The digispark is a small and cheap Arduino that can be used as a keystroke injector.
	Ya simply write a playload, plug it in, and it types things like any keyboard would.
	<br>
	<br>
	Here's how to set it for use with arduino.
	</p>
	<img src="../pix/digispark.png" alt="digispark.png">

	<h3>Schematic stuff</h3>
	I have the Digispark ATTINY85. I bought 3 for $10 on amazon.
	<br>
	<br>
	It runs at 16.5mhz. It has 8kb of flash memory. The bootloader waits 10 seconds before executing the code.

	<h3>Download latest Arduino IDE</h3>
	<p>
	Visit <a href="https://www.arduino.cc/en/Main/Software" target="_blank">https://www.arduino.cc/en/Main/Software</a> and download a copy.
	</p>

	<pre>
$ tar -xJf arduino-1.8.13-linux64.tar.xz
$ cd arduino-1.8.13
$ sudo bash install.sh

Adding desktop shortcut, menu item and file associations for Arduino IDE...
[...]
done!

# Give it a test run. This will create the ~/Arduino directory.
$ arduino
	</pre>

	<h3>Digispark dependencies</h3>
	<pre>
$ pacman -S libusb-compat libusb lib32-libusb

# This is the board's bootloader I believe.
$ yay -S micronucleus-git

# Contains libraries and sample scripts for various boards, including the digispark.
$ git clone https://github.com/digistump/DigistumpArduino.git ~/Arduino/digistump_arduino

# These are optional scripts you can use.
# It includes things such as "rick rolls", fork bombs, wifi profile grabbers, keyloggers, etc. 
$ https://github.com/CedArctic/DigiSpark-Scripts.git ~/Arduino/digispark_scripts
	</pre>

	<h3>Arduino digi stuff</h3>
	<p>
	We have to add our board to the Arduino board manager. This is explained well <a href="http://digistump.com/wiki/digispark/tutorials/connecting#installation_instructions" target="_blank">on the official digispark site.</a>	
	</p>

	<h3>Example script (keystroke injector)</h3>
	<pre>
[code]
#include "DigiKeyboard.h"

void setup() {
  // don't need to set anything up to use DigiKeyboard
}


void loop() {
  // this is generally not necessary but with some older systems it seems to
  // prevent missing the first character after a delay:
  DigiKeyboard.sendKeyStroke(0);
  
  // Type out this string letter by letter on the computer (assumes US-style
  // keyboard)
  DigiKeyboard.println("Hello Digispark!");
  
  // It's better to use DigiKeyboard.delay() over the regular Arduino delay()
  // if doing keyboard stuff because it keeps talking to the computer to make
  // sure the computer knows the keyboard is alive and connected
  DigiKeyboard.delay(5000);
}
	</pre>

	Copy and paste this into the Arduino IDE, click verify, upload, and finally insert your digispark.
	<br>
	<br>
	<strong>You can find this exact script by navigating to File&gt;Sketchbook&gt;digistump_arduino&gt;digispark-avr&gt;libraries&gt;digispark-keyboard</strong>
	</div>
</body>
</html>
