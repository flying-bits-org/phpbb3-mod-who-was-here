<?php
/**
*
* wwh [Deutsch]
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
	'WHO_WAS_HERE'					=> 'Wer war da?',
	'WHO_WAS_HERE_LATEST1'			=> 'zuletzt um',
	'WHO_WAS_HERE_LATEST2'			=> ' Uhr',
	'WHO_WAS_HERE_USERS_TOTAL'				=> 'Insgesamt waren <strong>%d</strong> Besucher online: ',
	'WHO_WAS_HERE_USERS_ZERO_TOTAL'			=> 'Insgesamt waren <strong>0</strong> Besucher online: ',
	'WHO_WAS_HERE_USER_TOTAL'				=> 'Insgesamt war <strong>%d</strong> Besucher online: ',
	'WHO_WAS_HERE_REG_USERS_TOTAL'			=> '%d registrierte',
	'WHO_WAS_HERE_REG_USERS_ZERO_TOTAL'		=> '0 registrierte',
	'WHO_WAS_HERE_REG_USER_TOTAL'			=> '%d registrierter',
	'WHO_WAS_HERE_HIDDEN_USERS_TOTAL'		=> '%d unsichtbare',
	'WHO_WAS_HERE_HIDDEN_USERS_ZERO_TOTAL'	=> '0 unsichtbare',
	'WHO_WAS_HERE_HIDDEN_USER_TOTAL'		=> '%d unsichtbarer',
	'WHO_WAS_HERE_BOTS_USERS_TOTAL'			=> '%d Bots',
	'WHO_WAS_HERE_BOTS_USERS_ZERO_TOTAL'	=> '0 Bots',
	'WHO_WAS_HERE_BOTS_USER_TOTAL'			=> '%d Bot',
	'WHO_WAS_HERE_GUEST_USERS_TOTAL'		=> '%d Gäste',
	'WHO_WAS_HERE_GUEST_USERS_ZERO_TOTAL'	=> '0 Gäste',
	'WHO_WAS_HERE_GUEST_USER_TOTAL'			=> '%d Gast',
	'WHO_WAS_HERE_WORD'				=> ' und',
	'WHO_WAS_HERE_EXP'				=> 'basierend auf den heute aktiven Besuchern',
	'WHO_WAS_HERE_EXP_TIME'			=> 'basierend auf den aktiven Besuchern der letzten ',
	'WWH_HOUR'						=> '%1$s Stunde',
	'WWH_HOURS'						=> '%1$s Stunden',
	'WWH_MINUTE'					=> '%1$s Minute',
	'WWH_MINUTES'					=> '%1$s Minuten',
	'WWH_SECOND'					=> '%1$s Sekunde',
	'WWH_SECONDS'					=> '%1$s Sekunden',
	'WHO_WAS_HERE_RECORD'			=> 'Der Besucherrekord liegt bei <strong>%1$s</strong> Besuchern, die am %2$s online waren.',
	'WHO_WAS_HERE_RECORD_TIME'		=> 'Der Besucherrekord liegt bei <strong>%1$s</strong> Besuchern, die zwischen %2$s und %3$s online waren.',
));

?>