<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="files/pix/icon.gif"/>
	<link rel="stylesheet" href="style.css"/>
	<title>Unixfandom</title>
</head>
<body>
	<div class="main">
		<div class="header">
			<p>
			<a href="index.php">
			Unixfandom.com
			<img src="files/pix/penguin.gif" alt="penguin_gif">
			</a>
			</p>
		</div>

		<nav>
			<?php include 'navigation.php';?>
		</nav>

		<div class="grid-container">
			<div class="grid-item">
			<h1>Title</h1>
			<p>
			This website is running on 100% opensourced software.
			I write guides on Linux related applications and hardware.
			All the html and css is written by hand! There's none of that static site generator nonsense.
			</p>
				<div id="index_gif_row">
				<img src="files/pix/vim.gif" alt="vim_gif" id="vim_gif">
				<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img style="border:0;width:88px;height:31px" src="files/pix/vcss.png" alt="Valid CSS!" />
				</a>
				<a href="https://validator.w3.org/check/referer">
				<img style="border:0;width:88px;height:31px" src="files/pix/valid-xhtml10.png" alt="Valid XHTML 1.0!" />
				</a>
				</div>
			</div>

			<div class="grid-item">
			<img src="files/pix/mountain.jpg" alt="">
			<p>This image has nothing to do with my page... thought it'd make things look more lively.</p>
			</div>
		</div>
		<div class="footer">
				<?php include 'footer.php';?>
		</div>
	</div>
</body>
</html>
