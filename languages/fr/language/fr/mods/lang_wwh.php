<?php
/**
*
* wwh [Français]
*
* @package language
* @version $Id: lang_wwh.php 4 2007-06-02
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/
if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
// pour la partie publique
	'WHO_WAS_HERE'						=> 'Qui était en ligne?',
	'WHO_WAS_HERE_LATEST1'				=> 'dernière visite à',
	'WHO_WAS_HERE_LATEST2'				=> '',
	'WHO_WAS_HERE_USERS_TOTAL'				=> 'Au total il y a eu <strong>%d</strong> utilisateurs en ligne:: ',
	'WHO_WAS_HERE_USERS_ZERO_TOTAL'			=> 'Au total il y a eu <strong>0</strong> utilisateur en ligne :: ',
	'WHO_WAS_HERE_USER_TOTAL'				=> 'Au total il y a eu <strong>%d</strong> utilisateur en ligne :: ',
	'WHO_WAS_HERE_REG_USERS_TOTAL'			=> '%d enregistrés',
	'WHO_WAS_HERE_REG_USERS_ZERO_TOTAL'		=> '0 enregistré',
	'WHO_WAS_HERE_REG_USER_TOTAL'			=> '%d enregistré',
	'WHO_WAS_HERE_HIDDEN_USERS_TOTAL'		=> ' %d invisibles',
	'WHO_WAS_HERE_HIDDEN_USERS_ZERO_TOTAL'	=> ' 0 invisible',
	'WHO_WAS_HERE_HIDDEN_USER_TOTAL'		=> ' %d invisible',
	'WHO_WAS_HERE_BOTS_USERS_TOTAL'			=> ' %d robots',
	'WHO_WAS_HERE_BOTS_USERS_ZERO_TOTAL'	=> ' 0 robot',
	'WHO_WAS_HERE_BOTS_USER_TOTAL'			=> ' %d robot',
	'WHO_WAS_HERE_GUEST_USERS_TOTAL'		=> ' %d invités',
	'WHO_WAS_HERE_GUEST_USERS_ZERO_TOTAL'	=> ' 0 invité',
	'WHO_WAS_HERE_GUEST_USER_TOTAL'			=> ' %d invité',
	'WHO_WAS_HERE_WORD'				=> ' et',
	'WHO_WAS_HERE_EXP'				=> 'Ces données sont basées sur les utilisateurs actifs de ce jour',
	'WHO_WAS_HERE_EXP_TIME'			=> 'Ces données sont basées sur les utilisateurs actifs de ces dernières ',
	'WWH_HOUR'						=> '%1$s heure, ',
	'WWH_HOURS'						=> '%1$s heures, ',
	'WWH_MINUTE'					=> '%1$s minute et ',
	'WWH_MINUTES'					=> '%1$s minutes et ',
	'WWH_SECOND'					=> '%1$s seconde.',
	'WWH_SECONDS'					=> '%1$s secondes.',
	'WHO_WAS_HERE_RECORD'			=> 'Le nombre maximum d\'utilisateurs en ligne a été de <strong>%1$s</strong> le %2$s',
	'WHO_WAS_HERE_RECORD_TIME'		=> 'Le nombre maximum d\'utilisateurs en ligne a été de <strong>%1$s</strong> entre %2$s et %3$s',
));

?>