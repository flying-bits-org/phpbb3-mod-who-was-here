<?php

/**
*
* @package phpBB3 - who was here MOD
* @version $Id$
* @copyright (c) nickvergessen ( http://www.flying-bits.org/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'WWH_CONFIG'				=> 'Konfiguration "Wer War Da?"',
	'WWH_TITLE'					=> 'Wer War Da?',
));

?>