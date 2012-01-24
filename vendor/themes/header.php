<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8" />

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
			 Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>3Day Forum</title>
	<meta name="description" content="" />
	<meta name="author" content="蒼時弦也" />

	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	
	<!-- Load Bootstrap -->
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<header>
			<h1>3Day Forum</h1>
		</header>
		<nav>
			<ul class="breadcrumb">
				<li><a href="<?php echo $app->urlFor('Home'); ?>" title="Home">Home</a><?php echo ($user->userID) ? '<span class="divider">/</span>' : ''; ?></li>
				<?php if($user->userID){ ?>
				<li><a href="" title="Profile">Profile</a></li>
				<?php } ?>
			</ul>
		</nav>
