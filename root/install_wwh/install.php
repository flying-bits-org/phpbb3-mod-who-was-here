<?php

/**
*
* @package - NV "who was here?"
* @version $Id: install.php 61 2007-12-17 20:15:23Z nickvergessen $
* @copyright (c) nickvergessen ( http://mods.flying-bits.org/ )
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
$new_mod_version = '6.0.5';
$page_title = 'NV "who was here?" v' . $new_mod_version;

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
switch ($mode)
{
	case 'install':
		$install = request_var('install', 0);
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
				$sql = 'if exists (select * from sysobjects where name = "' . $table_prefix . 'wwh")
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

			//we add a little index, so the sql runs faster
			$create_index = new phpbb_db_tools($db);
			$table_name = WWH_TABLE;
			$index_name = 'wwh_user_id';
			$column = array('id');
			$create_index->sql_create_index($table_name, $index_name, $column);

			set_config('wwh_record_ips', 1, true);
			set_config('wwh_record_time', time(), true);
			set_config('wwh_disp_bots', 1);
			set_config('wwh_disp_guests', 1);
			set_config('wwh_disp_hidden', 1);
			set_config('wwh_disp_time', 1);
			set_config('wwh_version', 1);
			set_config('wwh_del_time', 86400);
			set_config('wwh_sort_by', 3);
			set_config('wwh_record', 1);
			set_config('wwh_reset_time', 1);
			set_config('wwh_mod_version', $new_mod_version);

			// create the acp modules
			$modules = new acp_modules();
			$wwh = array(
				'module_basename'	=> '',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> 31,
				'module_class'		=> 'acp',
				'module_langname'	=> 'WWH_TITLE',
				'module_mode'		=> '',
				'module_auth'		=> ''
			);
			$modules->update_module_data($wwh);
			$config_wwh = array(
				'module_basename'	=> 'wwh',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> $wwh['module_id'],
				'module_class'		=> 'acp',
				'module_langname'	=> 'WWH_CONFIG',
				'module_mode'		=> 'overview',
				'module_auth'		=> ''
			);
			$modules->update_module_data($config_wwh);

			// clear cache and log what we did
			$cache->purge();
			add_log('admin', 'NV "who was here?" v' . $new_mod_version . ' installed');

			$installed = true;
		}
	break;
	case 'update604':
		$update = request_var('update', 0);
		$version = request_var('v', '0', true);
		$updated = false;
		if ($update == 1)
		{
			//we add a little index, so the sql runs faster
			$create_index = new phpbb_db_tools($db);
			$table_name = WWH_TABLE;
			$index_name = 'wwh_user_id';
			$column = array('id');
			$create_index->sql_create_index($table_name, $index_name, $column);

			set_config('wwh_disp_hidden', 1);
			set_config('wwh_mod_version', $new_mod_version);

			// clear cache and log what we did
			$cache->purge();
			add_log('admin', 'NV "who was here?" updated to v' . $new_mod_version);
			$updated = true;
		}
	break;
	default:
		//we had a little cheater
	break;
}

include($phpbb_root_path . 'install_wwh/layout.'.$phpEx);
?>