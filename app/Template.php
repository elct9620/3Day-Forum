<?php
/**
 * Tempalte
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

 
/**
 * Get Header
 * 
 * @author Aotoki
 */
function getHeader()
{
	$app = Slim::getInstance();
	$app->render('header.php', array(
		'app' => $app,
	));
}

function getFooter()
{
	$app = Slim::getInstance();
	$app->render('footer.php', array(
		'app' => $app,
	));
}
