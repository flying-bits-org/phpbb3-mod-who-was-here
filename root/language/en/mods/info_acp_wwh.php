<?php

/**
*
* @package phpBB3 - who was here MOD
* @version $Id: info_acp_wwh.php 61 2007-12-17 20:15:23Z nickvergessen $
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
	'WWH_CONFIG'				=> 'Configurate "Who was here?"',
	'WWH_TITLE'					=> 'Who was here?',

	'WWH_DISP_SET'				=> 'Display settings',
	'WWH_DISP_BOTS'				=> 'show bots',
	'WWH_DISP_BOTS_EXP'			=> 'Some user might wonder what bots are and fear them.',
	'WWH_DISP_GUESTS'			=> 'show guests',
	'WWH_DISP_GUESTS_EXP'		=> 'Display guests on the counter?',
	'WWH_DISP_HIDDEN'			=> 'show hidden users',
	'WWH_DISP_HIDDEN_EXP'		=> 'Should hidden users be displayed in the list? (only by permission)',
	'WWH_DISP_TIME'				=> 'show time',
	'WWH_DISP_TIME_FORMAT'		=> 'time/date format',
	'WWH_DISP_HOVER'			=> 'display on hover',
	'WWH_DISP_TIME_EXP'			=> 'All User see it or none. No special function for Admins.',
	'WWH_DISP_IP'				=> 'show ip',
	'WWH_DISP_IP_EXP'			=> 'Just for the Users with Admin-Permissions, like on the viewonline.php',

	'WWH_INSTALLED'				=> 'Installed "Who was here?" MOD v%s',

	'WWH_RECORD'				=> 'user-record',
	'WWH_RECORD_EXP'			=> 'display and save user-record',
	'WWH_RECORD_TIMESTAMP'		=> 'Timestamp for the record',
	'WWH_RESET'					=> 'Reset Record',
	'WWH_RESET_1'				=> 'reset record',
	'WWH_RESET_EXP'				=> 'Resets the time and the counter of the who-was-here record.',
	'WWH_RESET_TRUE'			=> 'If you submit this form,\nthe record will be reseted.',// \n is the beginning of a new line
									//no space after it

	'WWH_SAVED_SETTINGS'		=> 'saved settings',
	'WWH_SORT_BY'				=> 'sort users by',
	'WWH_SORT_BY_EXP'			=> 'in which order shall the user be displayed?',
	'WWH_SORT_BY_0'				=> 'Username A -> Z',
	'WWH_SORT_BY_1'				=> 'Username Z -> A',
	'WWH_SORT_BY_2'				=> 'Time of visit ascending',
	'WWH_SORT_BY_3'				=> 'Time of visit descending',
	'WWH_SORT_BY_4'				=> 'User-ID ascending',
	'WWH_SORT_BY_5'				=> 'User-ID descending',

	'WWH_UPDATE_NEED'			=> 'Update the "Who was here?" MOD. Therefor run the <a style="font-weight: bold;" href="' . $phpbb_root_path . 'install/index.php">install/index.php</a>.<br />If you did this, you should delete the install/ directory.',

	'WWH_VERSION'				=> 'MOD Version',
	'WWH_VERSION_EXP'			=> 'displaying User of today, or of the period set in the next field',
	'WWH_VERSION1'				=> 'today',
	'WWH_VERSION2'				=> 'period of time',
	'WWH_VERSION2_EXP'			=> 'type 0, if you want to display the users of the last 24h',
	'WWH_VERSION2_EXP2'			=> 'disabled, if you have choosen "today"',
	'WWH_VERSION2_EXP3'			=> 'seconds',

	'WWH_MOD'					=> '"Who was here?" MOD',
	'INSTALL_WWH_MOD'			=> 'Install "Who was here?" MOD',
	'INSTALL_WWH_MOD_CONFIRM'	=> 'Are you sure you want to install the "Who was here?" MOD?',
	'UPDATE_WWH_MOD'			=> 'Update "Who was here?" MOD',
	'UPDATE_WWH_MOD_CONFIRM'	=> 'Are you sure you want to update the "Who was here?" MOD?',
	'UNINSTALL_WWH_MOD'			=> 'Uninstall "Who was here?" MOD',
	'UNINSTALL_WWH_MOD_CONFIRM'	=> 'Are you sure you want to uninstall the "Who was here?" MOD?',
));

?>