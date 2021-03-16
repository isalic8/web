<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Home</title>
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
	<h1>Wine/Win DLL files</h1>

	<h3>Preface</h3>
	<p>
	Just as linux depends on libraries to run applications, so does windows. A windows library file can be identified by it's ".dll" extension. To get an application working under wine, ya gotta make sure you have installed all the libraries that your application requires to run.
	</p>
	<pre>
# Example of missing library under wine:
err:module:import_dll Library MFC42.DLL (which is needed by L"Z:\\media\\iso\\PidGen.dll") not found
	</pre>
	<p>
	Resolving these errors is simple.
	<br>
	All you need to do is download the right DLL file and place it in <span class="emph">"$WINEPREIFX/drive_c/windows/system32".</span>
	</p>

	<h3>Installing the DLL</h3>
	<p>
	There are two ways of doing this: Use "winetricks" or manually download.
	</p>

	<h4>Winetricks</h4>
	<pre>
# Installing on Arch
$ pacman cabextract unzip p7zip wget samba (for gui: zenity ) 

# Installing manually
$ cd "${HOME}/Downloads"
$ wget  https://raw.githubusercontent.com/Winetricks/winetricks/master/src/winetricks
$ chmod +x winetricks
	</pre>

	<p>
	Say the error called for the library named "msxml6.dll".
	We can install it with winetricks as so:
	</p>

	<pre>
# Set wineprefix and wine architecture if you're using a non-default wine location
$ WINEPREFIX=~/.wine/office14 WINEARCH=win32 (or win64 depending)

$ winetricks msxml6
[...]
# DONE
	</pre>

	<h4>Manually</h4>
	<p>
	Head over to <a target="_blank" href="http://www.dlldownloader.com">http://www.dlldownloader.com</a> and search for and download your dll file. 
	<br>
	Next place the file in <span class="emph">"$WINEPREIFX/drive_c/windows/system32".</span>
	<br>
	<br>
	If you aren't using a custom wineprefix, place the file in the default wine directory:
	<br>
	<span class="emph">~/.wine/drive_c/windows/system32</span>
	</p>

	<h3>Closing thoughts</h3>
	<p>Google the error if all else fails.
	Somtimes the application will ask for X.dll, but you may have to install Y.dll instead.
	</p>
	</div>
	<div class="footer">
		<?php include '../footer.php';?>
	</div>
</body>
</html>
