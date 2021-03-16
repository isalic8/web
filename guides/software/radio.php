<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Radio</title>
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
	<h1>Listening to radio stations in the terminal</h1>
	<h3>Preface</h3>
	<p>
	I thought this was pretty darned awesome.
	Ya ever wanted to listen to your favorite stations on the terminal?
	Welp, HERE IT IS! Using MPV, we can give it a url to either a video or audio file and it'll play it live.
	<br>
	<br>
	I figured that all you'd really need to do is find a website that hosts your station, locate the source url to the audio file its serving, and then just copy and paste it into mpv. With some small investigative work, I figured a nifty way of setting this up
	</p>

	<h3>Getting our audio source</h3>
	<p>First I'd like to apologize if the image is small. By using chromium's development tools, we can select the networking tab to view how long it takes the webpage to fully download all it's assets. Since this is a livestream, we're particularly interested in the "media" file which takes the longest to load. You can recognize it immediately by large blue bar to the right of it. This appears to be the source audio file that the webpage is serving you.</p>
	<img src="../pix/radio1.png" alt="radio website image">

	<p>We can see the full source url by clicking on the asset. In this case, the url is https://14963.live.streamtheworld.com/KSFOAMAAC.aac</p>
	<img src="../pix/radio2.png" alt="radio url image">

	<h3>Listening to the stream</h3>
	<p>I have an alias in my bashrc that runs this command</p>
	<pre>
$ mpv --quiet https://14963.live.streamtheworld.com/KSFOAMAAC.aac

Use 9 and 0 to increase and decrease volume.
Use space to pause the video
Left+Right arrows to seek forward/backwards a little
Up+Down to seek forward/backwards a lot
	</pre>

	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
