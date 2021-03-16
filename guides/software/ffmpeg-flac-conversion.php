<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="../../files/pix/icon.gif"/>
	<link rel="stylesheet" href="../../style.css"/>
	<title>FFMPEG Flac conversion</title>
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
	<h1>Converting Flac to high quality mp3 files with ffmpeg</h1>
	<h3>Preface</h3>
	<p>
	The goal is to convert a flac file into a 320kb/s MP3 file whilst retaining all metadata.<br>
	The only dependencies you need are "ffmpeg" (obviously) and "id3v2".<br>
	The ladder is used for embeding metadata.
	</p>

	<h3>Actually doing it</h3>
	<p>
	"-i" Pass our input file<br>
	"-codec:a" Passing our preffered audio codec<br>
	"-map_metadata" This copies over metadata from our input file. "0" tells it to use the default options<br>
	"-id3v2_version" These id3v options have something to do with metadata. I'm not sure exactly what.<br>
	"-map a:0" I <strong>think</strong> this makes it so ffmpeg ONLY outputs the audio streams to the mp3 file. Otherwise ffmpeg tries to copy the album art from the flac file, which MP3 files cannot handle. Errors will be thrown without this option.<br>
	"-b:a 320k" This is our audio bitrate
	</p>
	<pre>
ffmpeg -i "input.flac" -codec:a libmp3lame -map_metadata 0 -id3v2_version 3 -write_id3v1 1 -map a:0 -b:a 320k "output.mp3"
	</pre>

	<h3>Mass converting files</h3>
	<p>
	Here's the script which I'm currently using to convert my music.<br>
	Ffmpeg is set to output the mp3 files to the "./mp3/" directory.
	</p>
	<pre>
#!/bin/sh
for file in $(find '/path/to/music_dir/' -type f | grep -vE "*.jpg|*.log|*.jpeg|*.png")
do
	base=$(basename "$file")
	base_revised="${base%.*}"
	ffmpeg -i "$file" -codec:a libmp3lame -map_metadata 0 -id3v2_version 3 -write_id3v1 1 -map a:0 -b:a 320k "./mp3/${base_revised}.mp3"
done

	</pre>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
