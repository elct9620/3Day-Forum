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
function getHeader( $tempData = array() )
{
	$app = Slim::getInstance();
	$app->render('header.php', array(
		'app' => $app,
		'tempData' => $tempData,
	));
}

function getFooter( $tempData = array() )
{
	$app = Slim::getInstance();
	$app->render('footer.php', array(
		'app' => $app,
		'tempData' => $tempData,
	));
}
