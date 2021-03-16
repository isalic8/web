<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../style.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../pix/favicon.ico"/>
	<title>Default Searx</title>
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
	<h1>Setting searx as the default search engine</h1>
	<p>
	I couldn't get this to work properly on firefox unfortunatley. 
	<a href="https://support.mozilla.org/en-US/kb/add-or-remove-search-engine-firefox" target="_blank">It's method of adding custom search engines is horrid.</a> It seems to snag the proxy_pass url (127.0.0.1:8888) instead of our domain (search.yourdomain.com).
	<br>
	<br>
	It can be easily added in chrome/chromium by adding this url to your search engine list:
	<br>
	<br>
	<span style="color:#FF0000;">https://search.yourdomain.com/search?q=%s</span>
	</p>

	</div>
	<div class="footer">
			<?php include '../footer.php';?>
	</div>
</body>
</html>
