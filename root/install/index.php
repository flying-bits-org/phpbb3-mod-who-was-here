<?php
/**
*
* @package - NV recent topics
* @version $Id$
* @copyright (c) nickvergessen ( http://www.flying-bits.org/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
define('IN_INSTALL', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
if (!class_exists('phpbb_mods_who_was_here'))
{
	include($phpbb_root_path . 'includes/mods/who_was_here.' . $phpEx);
}

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

$mod_name = 'WWH_MOD';

$version_config_name = 'wwh_mod_version';
$language_file = 'mods/info_acp_wwh';

$versions = array(
	// Version 1.0.0-RC1
	'1.0.0-RC1'	=> array(
		'config_add' => array(
			array('wwh_record_ips', 1, true),
			array('wwh_record_time', time(), true),
			array('wwh_disp_bots', 1),
			array('wwh_disp_guests', 1),
			array('wwh_disp_hidden', 1),
			array('wwh_disp_time', 1),
			array('wwh_disp_ip', 1),
			array('wwh_version', 1),
			array('wwh_del_time_h', 24),
			array('wwh_del_time_m', 0),
			array('wwh_del_time_s', 0),
			array('wwh_sort_by', 3),
			array('wwh_record', 1),
			array('wwh_record_timestamp', 'D j. M Y'),
			array('wwh_reset_time', 1),
		),
		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'WWH_TITLE'),

			array('acp', 'WWH_TITLE', array(
					'module_basename'	=> 'wwh',
					'module_langname'	=> 'WWH_CONFIG',
					'module_mode'		=> 'overview',
					'module_auth'		=> 'acl_a_board',
				),
			),
		),
		'table_add' => array(
			array(phpbb_mods_who_was_here::table(), array(
					'COLUMNS'		=> array(
						'wwh_id'			=> array('UINT', NULL, 'auto_increment'),
						'user_id'			=> array('UINT', 0),
						'username'			=> array('VCHAR', ''),
						'username_clean'	=> array('VCHAR', ''),
						'user_colour'		=> array('VCHAR:6', ''),
						'user_ip'			=> array('VCHAR:40', '127.0.0.1'),
						'user_type'			=> array('UINT:2', 1),
						'viewonline'		=> array('UINT:1', 1),
						'wwh_lastpage'		=> array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY'		=> 'wwh_id',
				),
			),
		),
	),

	// Version 1.0.0
	'1.0.0'	=> array(
	),

	// Version 1.0.1
	'1.0.1'	=> array(
		'config_add' => array(
			array('wwh_disp_time_format', 'G:i'),
		),
	),

	// Version 1.0.2
	'1.0.2'	=> array(
	),

	// Version 1.2.0
	'1.2.0'	=> array(
		'table_index_add' => array(
			array(phpbb_mods_who_was_here::table(), 'user_id_ip', array('user_id', 'user_ip')),
		),
	),
);

// Include the UMIL Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

?>