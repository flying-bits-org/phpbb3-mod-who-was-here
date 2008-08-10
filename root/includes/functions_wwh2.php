<?php

/**
*
* @package - NV "who was here?"
* @version $Id: functions_wwh2.php 61 2007-12-17 20:15:23Z nickvergessen $
* @copyright (c) nickvergessen ( http://www.flying-bits.org/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (1 == 1)//REMOVE!file_exists($phpbb_root_path . 'install_wwh'))
{
	if ($user->data['user_id'] != ANONYMOUS)
	{
		$sql = 'DELETE FROM ' . WWH_TABLE . '
			WHERE user_id = ' . $user->data['user_id'] . '
				OR (user_ip = "' . $user->ip . '"
					AND user_id = ' . ANONYMOUS . ')';
		$db->sql_query($sql);

		$wwh_data = array(
			'user_id'			=> $user->data['user_id'],
			'user_ip'			=> $user->ip,
			'username'			=> $user->data['username'],
			'username_clean'	=> $user->data['username_clean'],
			'user_colour'		=> $user->data['user_colour'],
			'user_type'			=> $user->data['user_type'],
			'viewonline'		=> $user->data['session_viewonline'],
			'wwh_lastpage'		=> time(),
		);
		$db->sql_query('INSERT INTO ' . WWH_TABLE . ' ' . $db->sql_build_array('INSERT', $wwh_data));
	}
	else
	{
		$user_logged = false;
		$sql = 'SELECT * FROM ' . WWH_TABLE . " WHERE user_ip = '" . $user->ip . "'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$user_logged = true;
		}
		$db->sql_freeresult($result);
		if (!$user_logged)
		{
			$wwh_data = array(
				'user_id'			=> $user->data['user_id'],
				'user_ip'			=> $user->ip,
				'username'			=> $user->data['username'],
				'username_clean'	=> $user->data['username_clean'],
				'user_colour'		=> $user->data['user_colour'],
				'user_type'			=> $user->data['user_type'],
				'viewonline'		=> 1,
				'wwh_lastpage'		=> time(),
			);
			$db->sql_query('INSERT INTO ' . WWH_TABLE . ' ' . $db->sql_build_array('INSERT', $wwh_data));
		}
	}
}
else
{
	$user->add_lang('mods/lang_wwh_acp');
}

?>