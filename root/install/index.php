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
define('IN_PHPBB', true);
define('ADMIN_START', 1);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
include($phpbb_root_path . 'includes/functions_install.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

// Load language and custom template-path
$user->add_lang('mods/info_acp_wwh');
$template->set_custom_template('style', 'install_wwh');
$template->assign_var('T_TEMPLATE_PATH', 'style');

$new_mod_version = '1.0.0';
$page_title = 'NV "who was here?" v' . $new_mod_version;

function install_back_link($u_action)
{
	global $user;
	return '<br /><br /><a href="' . $u_action . '">&laquo; ' . $user->lang['BACK_TO_PREV'] . '</a>';
}
// What sql_layer should we use?
switch ($db->sql_layer)
{
	case 'mysql':
		$db_schema = 'mysql_40';
		$delimiter = ';';
	break;

	case 'mysql4':
		if (version_compare($db->sql_server_info(true), '4.1.3', '>='))
		{
			$db_schema = 'mysql_41';
		}
		else
		{
			$db_schema = 'mysql_40';
		}
		$delimiter = ';';
	break;

	case 'mysqli':
		$db_schema = 'mysql_41';
		$delimiter = ';';
	break;

	case 'mssql':
		$db_schema = 'mssql';
		$delimiter = 'GO';
	break;

	case 'postgres':
		$db_schema = 'postgres';
		$delimiter = ';';
	break;

	case 'sqlite':
		$db_schema = 'sqlite';
		$delimiter = ';';
	break;

	case 'firebird':
		$db_schema = 'firebird';
		$delimiter = ';;';
	break;

	case 'oracle':
		$db_schema = 'oracle';
		$delimiter = '/';
	break;

	default:
		trigger_error('Sorry, unsupportet Databases found.');
	break;
}

$mode = request_var('mode', 'else');
$version = request_var('version', '0.0.0');
$confirm = request_var('confirm', 0);
switch ($mode)
{
	case 'install':
		if ($confirm)
		{
			/*/ Use phpBB-Stuff
			include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
			$phpbb_db_tools = new phpbb_db_tools($db);
			*/
			// Drop this table if existing
			if ($db->sql_layer != 'mssql')
			{
				$sql = 'DROP TABLE IF EXISTS ' . WWH_TABLE;
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			else
			{
				$sql = 'if exists (select * from sysobjects where name = ' . WWH_TABLE . ')
					drop table ' . WWH_TABLE;
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			// locate the schema files
			$dbms_schema = 'schemas/_' . $db_schema . '_schema.sql';
			$sql_query = @file_get_contents($dbms_schema);
			$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
			$sql_query = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql_query));
			$sql_query = split_sql_file($sql_query, $delimiter);
			// make the new one's
			foreach ($sql_query as $sql)
			{
				if (!$db->sql_query($sql))
				{
					$error = $db->sql_error();
					$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
				}
			}
			unset($sql_query);

			$sql = 'DELETE FROM ' . CONFIG_TABLE . '
				WHERE ' . $db->sql_in_set('config_name', array('wwh_record_ips', 'wwh_record_time', 'wwh_disp_bots', 'wwh_disp_guests', 'wwh_disp_hidden', 'wwh_disp_time', 'wwh_disp_ip', 'wwh_version', 'wwh_del_time', 'wwh_del_time_h', 'wwh_del_time_m', 'wwh_del_time_s', 'wwh_sort_by', 'wwh_record', 'wwh_record_timestamp', 'wwh_reset_time'));;
			$result = $db->sql_query($sql);

			// create the acp modules
			$modules = new acp_modules();
			$wwh_category = array(
				'module_basename'	=> '',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> 31,
				'module_class'		=> 'acp',
				'module_langname'	=> 'WWH_TITLE',
				'module_mode'		=> '',
				'module_auth'		=> ''
			);
			$modules->update_module_data($wwh_category);
			$wwh_config = array(
				'module_basename'	=> 'wwh',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> $wwh_category['module_id'],
				'module_class'		=> 'acp',
				'module_langname'	=> 'WWH_CONFIG',
				'module_mode'		=> 'overview',
				'module_auth'		=> ''
			);
			$modules->update_module_data($wwh_config);

			set_config('wwh_record_ips', 1, true);
			set_config('wwh_record_time', time(), true);
			set_config('wwh_disp_bots', 1);
			set_config('wwh_disp_guests', 1);
			set_config('wwh_disp_hidden', 1);
			set_config('wwh_disp_time', 1);
			set_config('wwh_disp_ip', 1);
			set_config('wwh_version', 1);
			set_config('wwh_del_time_h', 24);
			set_config('wwh_del_time_m', 0);
			set_config('wwh_del_time_s', 0);
			set_config('wwh_sort_by', 3);
			set_config('wwh_record', 1);
			set_config('wwh_record_timestamp', 'D j. M Y');
			set_config('wwh_reset_time', 1);

			set_config('wwh_mod_version', $new_mod_version);

			// clear cache and log what we did
			$cache->purge();
			add_log('admin', sprintf($user->lang['INSTALLER_INSTALL_SUCCESSFUL'], $new_mod_version));

			$template->assign_vars(array(
				'S_INFORMATION'		=> sprintf($user->lang['INSTALLER_INSTALL_SUCCESSFUL'], $new_mod_version),
			));
		}
		$template->assign_vars(array(
			'S_NOT_INTRO'		=> true,
			'S_INSTALL'			=> true,
			'L_WELCOME'			=> $user->lang['INSTALLER_INSTALL_WELCOME'],
			'L_WELCOME_NOTE'	=> $user->lang['INSTALLER_INSTALL_WELCOME_NOTE'],
			'L_LEGEND'			=> $user->lang['INSTALLER_INSTALL'],
			'L_LABLE'			=> 'v' . $new_mod_version,
			'S_ACTION'			=> append_sid("{$phpbb_root_path}install/index.$phpEx", 'mode=install'),
		));
	break;
	case 'update':
		if ($confirm)
		{
			switch ($version)
			{
				case '1.0.0-RC1':
					// Nothing to do

				break;
			}

			set_config('wwh_mod_version', $new_mod_version);
			$cache->purge();
			add_log('admin', sprintf($user->lang['INSTALLER_UPDATE_SUCCESSFUL'], $version, $new_mod_version));

			$template->assign_vars(array(
				'S_INFORMATION'		=> sprintf($user->lang['INSTALLER_INSTALL_SUCCESSFUL'], $new_mod_version),
			));
		}
		$template->assign_vars(array(
			'S_NOT_INTRO'		=> true,
			'S_UPDATE'			=> $version,
			'L_WELCOME'			=> $user->lang['INSTALLER_UPDATE_WELCOME'],
			'L_LEGEND'			=> $user->lang['INSTALLER_UPDATE'],
			'L_LABLE'			=> sprintf($user->lang['INSTALLER_UPDATE_NOTE'], $version, $new_mod_version),
			'S_ACTION'			=> append_sid("{$phpbb_root_path}install/index.$phpEx", 'mode=update&amp;version=' . $version),
		));
	break;
	default:
		if ($user->data['user_type'] == USER_FOUNDER)
		{
			$template->assign_vars(array(
				'S_INTRO'			=> true,
				'L_WELCOME'			=> $user->lang['INSTALLER_INTRO_WELCOME'],
				'L_WELCOME_NOTE'	=> $user->lang['INSTALLER_INTRO_WELCOME_NOTE'],
			));
		}
	break;
}
if ($user->data['user_type'] != USER_FOUNDER)
{
	$template->assign_vars(array(
		'S_WARNING'		=> $user->lang['INSTALLER_NEEDS_FOUNDER'],
	));
}

$template->assign_vars(array(
	'L_PAGE_TITLE'		=> $page_title,
	'L_INSTALL_VERSION'	=> sprintf($user->lang['INSTALLER_INSTALL_VERSION'], $new_mod_version),

	'S_VERSION'			=> $version,

	'U_INTRO'				=> append_sid("{$phpbb_root_path}install/index.$phpEx"),
	'U_INSTALL'				=> append_sid("{$phpbb_root_path}install/index.$phpEx", 'mode=install'),
	'U_UPDATE_1_0_0-RC1'	=> append_sid("{$phpbb_root_path}install/index.$phpEx", 'mode=update&amp;version=1.0.0-RC1'),
));

page_header($page_title);

$template->set_filenames(array(
	'body' => 'install_body.html')
);

page_footer();

?>