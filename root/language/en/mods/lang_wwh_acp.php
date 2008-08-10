<?php

/**
*
* @package phpBB3 - who was here MOD
* @version $Id: lang_wwh.php 61 2007-12-17 20:15:23Z nickvergessen $
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
	'WWH_DISP_SET'				=> 'Display settings',
	'WWH_DISP_BOTS'				=> 'show bots',
	'WWH_DISP_BOTS_EXP'			=> 'Some user might wonder what bots are and fear them.',
	'WWH_DISP_GUESTS'			=> 'show guests',
	'WWH_DISP_GUESTS_EXP'		=> 'Display guests on the counter?',
	'WWH_DISP_HIDDEN'			=> 'show hidden users',
	'WWH_DISP_HIDDEN_EXP'		=> 'Should hidden users be displayed in the list? (only by permission)',
	'WWH_DISP_TIME'				=> 'show time',
	'WWH_DISP_HOVER'			=> 'display on hover',
	'WWH_DISP_TIME_EXP'			=> 'All User see it or none. No special function for Admins.',
	'WWH_DISP_IP'				=> 'show ip',
	'WWH_DISP_IP_EXP'			=> 'Just for the Users with Admin-Permissions, like on the viewonline.php',

	'WWH_INSTALL'				=> 'Installation',
	'WWH_INSTALLED'				=> 'Installed "Who was here?" MOD v%s',
	'WWH_INSTALL_FALSE'			=> '"Who was here?" MOD was not installed',
	'WWH_INSTALL_NEED'			=> 'Install the "Who was here?" MOD',
	'WWH_INSTALL_NEW_VERSION'	=> 'New MOD version',

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

	'WWH_UPDATE'				=> 'Update',
	'WWH_UPDATED'				=> 'Update "Who was here?" MOD from v%1s to v%2s',
	'WWH_UPDATE_FALSE'			=> '"Who was here?" MOD was not updated',
	'WWH_UPDATE_NEED'			=> 'Update the "Who was here?" MOD. Therefor run the <a style="font-weight: bold;" href="' . $phpbb_root_path . 'install_wwh/install.php">install.php</a>.<br />If you did this, you should delete the install_wwh/ directory.',
	'WWH_UPDATE_NEW_VERSION'	=> 'New MOD version',
	'WWH_UPDATE_OLD_VERSION'	=> 'Old MOD version',

	'WWH_VERSION'				=> 'MOD Version',
	'WWH_VERSION_EXP'			=> 'displaying User of today, or of the period set in the next field',
	'WWH_VERSION1'				=> 'today',
	'WWH_VERSION2'				=> 'period of time',
	'WWH_VERSION2_EXP'			=> 'type 0, if you want to display the users of the last 24h',
	'WWH_VERSION2_EXP2'			=> 'disabled, if you have choosen "today"',
	'WWH_VERSION2_EXP3'			=> 'seconds',

	'CREATE_INDEX'						=> 'Create Index',
	'CREATE_INDEX_EXP'					=> 'Creating an index improves the speed of this MOD. Some Users don\'t have the rights to create indexes and would receive an error on the installation. So just turn it off here.',

	'INSTALLER_DELETE'					=> 'Delete',
	'INSTALLER_DELETE_MENU'				=> 'Delete',
	'INSTALLER_DELETE_NOTE'				=> 'Delete',
	'INSTALLER_DELETE_SUCCESSFUL'		=> 'Deleted the MOD successfully.<br />Now delete all files.',
	'INSTALLER_DELETE_UNSUCCESSFUL'		=> 'Could <strong>not</strong> delete the MOD.',
	'INSTALLER_DELETE_WELCOME'			=> 'Welcome to the Deletemenu',
	'INSTALLER_DELETE_WELCOME_NOTE'		=> 'When you choose to delete the MOD, we remove all sql-data insert by the installation.',

	'INSTALLER_INTRO'					=> 'Intro',
	'INSTALLER_INTRO_WELCOME'			=> 'Welcome to the MOD Installation',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Please choose what you want to do.',

	'INSTALLER_INSTALL'					=> 'Install',
	'INSTALLER_INSTALL_MENU'			=> 'Installmenu',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Installation of the MOD v%s was successful. You may delete the install-folder now.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Installation of the MOD v%s was <strong>not</strong> successful.',
	'INSTALLER_INSTALL_VERSION'			=> 'Install MOD v%s',
	'INSTALLER_INSTALL_WELCOME'			=> 'Welcome to the Installationmenu',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'When you choose to install the MOD, any database of previous versions will be dropped.',

	'INSTALLER_NEEDS_FOUNDER'			=> 'You must be logged in as a founder.',

	'INSTALLER_UPDATE'					=> 'Update',
	'INSTALLER_UPDATE_MENU'				=> 'Updatemenu',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD from v%s to v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update of the MOD from v%s to v%s was successful. You may delete the install-folder now.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'Update of the MOD from v%s to v%s was <strong>not</strong> successful.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update MOD from v',
	'INSTALLER_UPDATE_WELCOME'			=> 'Welcome to the Updatemenu',

	'MISSING_PARENT_MODULE'				=> 'Module #%s is missing as a parent module for "%s".',

	'WARNING'							=> 'Warning',
));

?>