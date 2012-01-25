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
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo $basePath; ?>asset/css/style.css" />
</head>

<body>
	
	<div data-scrollspy="scrollspy" class="topbar">
      <div class="topbar-inner">
        <div class="container">
          <a href="<?php echo $app->urlFor('Home');?>" class="brand">3Day Forum</a>
          <ul class="nav">
			<li><a href="<?php echo $app->urlFor('Home');?>">Home</a></li>
			<li><a href="<?php echo $app->urlFor('Profile');?>">Profile</a></li>
          </ul>
        </div>
      </div>
    </div>
	
	<div class="container">
		<header>
			<h1>3Day Forum</h1>
		</header>
		<nav>
			<ul class="breadcrumb">
				<li><a href="<?php echo $app->urlFor('Home'); ?>" title="Home">Home</a><?php echo isset($tempData['forumTree']) || isset($tempData['postData']) ? '<span class="divider">/</span>' : ''; ?></li>
				<?php 
					if(isset($tempData['forumTree'])){
						$lastObject = FALSE;
						$notHavePost = !isset($tempData['postData']);
						foreach ($tempData['forumTree'] as $ID => $forum) {
							if(!next($tempData['forumTree'])){
								$lastObject = TRUE & $notHavePost;
							}
				?>
				<li<?php echo ($lastObject) ? ' class="active"' : ''; ?>>
					<?php
						if($lastObject){
							echo $forum->Name;
						}else{
					?>
					<a href="<?php echo $app->urlFor('Home', array('forumID' => $forum->getID())); ?>"><?php echo $forum->Name; ?></a><span class="divider">/</span></li>
					<?php
						}
					?>
				</li>
				<?php
						}
					}
					
					if(isset($tempData['postData'])){
				?>
				<li class="active"><?php echo $tempData['postData']['thread']['Name']; ?></li>
				<?php
					}
				?>
			</ul>
		</nav>
