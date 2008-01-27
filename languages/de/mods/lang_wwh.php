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
	'WHO_WAS_HERE_USERS_TOTAL'				=> 'Insgesamt waren <strong>%d</strong> Besucher online :: ',
	'WHO_WAS_HERE_USERS_ZERO_TOTAL'			=> 'Insgesamt waren <strong>0</strong> Besucher online :: ',
	'WHO_WAS_HERE_USER_TOTAL'				=> 'Insgesamt war <strong>%d</strong> Besucher online :: ',
	'WHO_WAS_HERE_REG_USERS_TOTAL'			=> '%d registrierte Mitglieder',
	'WHO_WAS_HERE_REG_USERS_ZERO_TOTAL'		=> '0 registrierte Mitglieder',
	'WHO_WAS_HERE_REG_USER_TOTAL'			=> '%d registriertes Mitglied',
	'WHO_WAS_HERE_HIDDEN_USERS_TOTAL'		=> ' %d unsichtbare Mitglieder',
	'WHO_WAS_HERE_HIDDEN_USERS_ZERO_TOTAL'	=> ' 0 unsichtbare Mitglieder',
	'WHO_WAS_HERE_HIDDEN_USER_TOTAL'		=> ' 1 unsichtbares Mitglied',
	'WHO_WAS_HERE_BOTS_USERS_TOTAL'			=> ' %d Bots',
	'WHO_WAS_HERE_BOTS_USERS_ZERO_TOTAL'	=> ' 0 Bots',
	'WHO_WAS_HERE_BOTS_USER_TOTAL'			=> ' %d Bot',
	'WHO_WAS_HERE_GUEST_USERS_TOTAL'		=> ' %d Gäste',
	'WHO_WAS_HERE_GUEST_USERS_ZERO_TOTAL'	=> ' 0 Gäste',
	'WHO_WAS_HERE_GUEST_USER_TOTAL'			=> ' %d Gast',
	'WHO_WAS_HERE_WORD'				=> ' und',
	'WHO_WAS_HERE_EXP'				=> 'Die Angaben basieren auf den heute aktiven Besuchern',
	'WHO_WAS_HERE_EXP_TIME'			=> 'Die Angaben basieren auf den letzten ',
	'WWH_HOUR'						=> '%1$s Stunde, ',
	'WWH_HOURS'						=> '%1$s Stunden, ',
	'WWH_MINUTE'					=> '%1$s Minute und ',
	'WWH_MINUTES'					=> '%1$s Minuten und ',
	'WWH_SECOND'					=> '%1$s Sekunde',
	'WWH_SECONDS'					=> '%1$s Sekunden',
	'WHO_WAS_HERE_RECORD'			=> 'Der Besucherrekord liegt bei <strong>%1$s</strong> Besuchern, die am %2$s online waren.',
));

?>