<?php

/**
*
* @package - NV "who was here?"
* @version $Id: install.php 61 2007-12-17 20:15:23Z nickvergessen $
* @copyright (c) nickvergessen ( http://www.flying-bits.org/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->add_lang('mods/lang_wwh_acp');

$major_versions = array('6.0.');
$minor_versions['6.0.'] = array(4, 5, 6, 7);
$new_mod_version = end($major_versions) . end($minor_versions[end($major_versions)]);

$page_title = 'NV "who was here?" v' . $new_mod_version;
$log_name = 'Modification NV "who was here?"' . ((request_var('update', 0) > 0) ? '-Update' : '') . ' v' . $new_mod_version;

$mode = request_var('mode', 'else', true);
function split_sql_file($sql, $delimiter)
{
	$sql = str_replace("\r" , '', $sql);
	$data = preg_split('/' . preg_quote($delimiter, '/') . '$/m', $sql);

	$data = array_map('trim', $data);

	// The empty case
	$end_data = end($data);

	if (empty($end_data))
	{
		unset($data[key($data)]);
	}

	return $data;
}
// What sql_layer should we use?
switch ($db->sql_layer)
{
	case 'mysql':
		$db_schema = 'mysql_40';
		$delimiter = ';';
	break;

	case 'mysql4':
		if (version_compare($db->mysql_version, '4.1.3', '>='))
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
function wwh_create_index($table, $column)
{
	global $db;

	switch ($db->sql_layer)
	{
		case 'firebird':
		case 'postgres':
		case 'oracle':
		case 'sqlite':
			$sql = 'CREATE INDEX ' . $table . "_$column ON " . TOPICS_TABLE . "($column)";
		break;

		case 'mysql':
		case 'mysql4':
		case 'mysqli':
			$sql = "ALTER TABLE `" . $table . "` ADD INDEX (`$column`)";
		break;

		case 'mssql':
		case 'mssql_odbc':
			$sql = "CREATE INDEX $column ON " . $table . "($column) ON [PRIMARY]";
		break;

		default:
			trigger_error("Your database ({$db->sql_layer})is not supported by phpbb3 itself.");
		break;
	}
	$db->sql_query($sql);
}

function add_module($array)
{
	global $user;
	$modules = new acp_modules();
	$failed = $modules->update_module_data($array, true);
	if ($failed == 'PARENT_NO_EXIST')
	{
		trigger_error(sprintf($user->lang['MISSING_PARENT_MODULE'], $array['parent_id'], $user->lang[$array['module_langname']]));
	}
}

$delete = request_var('delete', 0);
$index = request_var('index', 0);
$install = request_var('install', 0);
$update = request_var('update', 0);
$version = request_var('v', '0', true);
switch ($mode)
{
	case 'install':
		$installed = false;
		if ($install == 1)
		{
			// Drop thes tables if existing
			if ($db->sql_layer != 'mssql')
			{
				$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'wwh';
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			else
			{
				$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . 'wwh)
					drop table ' . $table_prefix . 'wwh';
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

			if ($index == 1)
			{
				//we add a little index, so the sql runs faster
				//wwh_create_index(WWH_TABLE, 'id');
			}

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

			// create the acp modules
			$modules = new acp_modules();
			$wwh = array('module_basename' => '', 'module_enabled' => 1, 'module_display' => 1, 'parent_id' => 31, 'module_class' => 'acp', 'module_langname' => 'WWH_TITLE', 'module_mode' => '', 'module_auth' => '');
			add_module($wwh);
			$sql = 'SELECT module_id
				FROM ' . MODULES_TABLE . "
				WHERE module_langname = 'WWH_TITLE'
				LIMIT 1";
			$result = $db->sql_query($sql);
			while( $row = $db->sql_fetchrow($result) )
			{
				$wwh['module_id'] = $row['module_id'];
			}
			$db->sql_freeresult($result);

			$config_wwh = array('module_basename' => 'wwh', 'module_enabled' => 1, 'module_display' => 1, 'parent_id' => $wwh['module_id'], 'module_class' => 'acp', 'module_langname' => 'WWH_CONFIG', 'module_mode' => 'overview', 'module_auth' => '');
			add_module($config_wwh);

			// clear cache and log what we did
			set_config('wwh_mod_version', $new_mod_version);
			$cache->purge();
			add_log('admin', 'LOG_INSTALL_INSTALLED', $log_name);
			add_log('admin', 'LOG_PURGE_CACHE');
			$installed = true;
		}
	break;
	case 'update':
		$version = request_var('v', '0', true);
		$updated = $ask_for_index = false;
		switch ($version)
		{
			case '6.0.4':
				$ask_for_index = true;
			case '6.0.5':
			break;
		}

		if ($update == 1)
		{
			switch ($version)
			{
				case '6.0.4':
					set_config('wwh_disp_hidden', 1);
					if ($index == 1)
					{
						wwh_create_index(WWH_TABLE, 'id');
					}

				case '6.0.5':
					set_config('wwh_record_timestamp', 'D j. M Y');
					set_config('wwh_del_time_h', 0);
					set_config('wwh_del_time_m', 0);
					set_config('wwh_del_time_s', 0);

				case '6.0.6':
					set_config('wwh_disp_ip', 1);
				break;
			}
			set_config('wwh_mod_version', $new_mod_version);
			$cache->purge();
			add_log('admin', 'LOG_INSTALL_INSTALLED', $log_name);
			add_log('admin', 'LOG_PURGE_CACHE');
			$updated = true;
		}
	break;
	case 'delete':
		$deleted = false;

		if ($delete == 1)
		{
			$deleting_modules = "'WWH_TITLE', 'WWH_CONFIG'";
			$sql = 'DELETE FROM ' . MODULES_TABLE . "
				WHERE module_langname IN ($deleting_modules);";
			$db->sql_query($sql);
			$deleting_configs = "'wwh_record_ips', 'wwh_record_time', 'wwh_disp_bots', 'wwh_disp_guests', 'wwh_disp_hidden', 'wwh_disp_time', 'wwh_version', 'wwh_del_time_h', 'wwh_del_time_m', 'wwh_del_time_s', 'wwh_sort_by', 'wwh_record', 'wwh_record_timestamp', 'wwh_reset_time'";
			$sql = 'DELETE FROM ' . CONFIG_TABLE . "
				WHERE config_name IN ($deleting_configs);";
			$db->sql_query($sql);
			// Drop thes tables if existing
			if ($db->sql_layer != 'mssql')
			{
				$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . 'wwh';
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			else
			{
				$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . 'wwh)
					drop table ' . $table_prefix . 'wwh';
				$result = $db->sql_query($sql);
				$db->sql_freeresult($result);
			}
			$cache->purge();
			add_log('admin', 'LOG_INSTALL_INSTALLED', 'Modification NV "who was here?"-Uninstall');
			add_log('admin', 'LOG_PURGE_CACHE');
			$deleted = true;
		}
	break;
}

include($phpbb_root_path . 'install_wwh/layout.'.$phpEx);
?>