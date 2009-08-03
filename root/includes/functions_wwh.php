<?php

/**
*
* @package - NV "who was here?"
* @version $Id: functions_wwh.php 61 2007-12-17 20:15:23Z nickvergessen $
* @copyright (c) nickvergessen ( http://www.flying-bits.org/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

function update_who_was_here_session ()
{
	global $phpbb_root_path, $db, $user;

	if ($user->data['user_id'] != ANONYMOUS)
	{
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

		$db->sql_return_on_error(true);
		$sql = 'UPDATE ' . WWH_TABLE . ' 
			SET ' . $db->sql_build_array('UPDATE', $wwh_data) . "
			WHERE user_id = {$user->data['user_id']}
				OR (user_ip = '{$user->ip}'
					AND user_id = " . ANONYMOUS . ')';
		$result = $db->sql_query($sql);
		$db->sql_return_on_error(false);

		if ($result === false)
		{
			// database does not exist yet...
			return;
		}

		$sql_affectedrows = (int) $db->sql_affectedrows();
		if ($sql_affectedrows <> 1)
		{
			if ($sql_affectedrows > 1)
			{
				// Found multiple matches, so we delete them and just add one
				$sql = 'DELETE FROM ' . WWH_TABLE . "
					WHERE user_id = {$user->data['user_id']}
						OR (user_ip = '{$user->ip}'
							AND user_id = " . ANONYMOUS . ')';
				$db->sql_query($sql);
				$db->sql_query('INSERT INTO ' . WWH_TABLE . ' ' . $db->sql_build_array('INSERT', $wwh_data));
			}

			if ($sql_affectedrows == 0)
			{
				// No entry updated. Either the user is not listed yet, or has opened two links in the same time
				$sql = 'SELECT 1 as found
					FROM ' . WWH_TABLE . "
					WHERE user_id = {$user->data['user_id']}
						OR (user_ip = '{$user->ip}'
							AND user_id = " . ANONYMOUS . ')';
				$result = $db->sql_query($sql);
				$found = (int) $db->sql_fetchfield('found');
				$db->sql_freeresult($result);
				if (!$found)
				{
					// He wasn't listed.
					$db->sql_query('INSERT INTO ' . WWH_TABLE . ' ' . $db->sql_build_array('INSERT', $wwh_data));
				}
			}
		}
	}
	else
	{
		$db->sql_return_on_error(true);
		$sql = 'SELECT user_id
			FROM ' . WWH_TABLE . "
			WHERE user_ip = '{$user->ip}'";
		$result = $db->sql_query_limit($sql, 1);
		$db->sql_return_on_error(false);

		if ($result === false)
		{
			// database does not exist yet...
			return;
		}

		$user_logged = (int) $db->sql_fetchfield('user_id');
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
	$db->sql_return_on_error(false);
}

function display_who_was_here ()
{
	global $auth, $config, $db, $template, $user;

	$user->add_lang('mods/lang_wwh');
	// Cleaning the wwh-table
	$timestamp = time();
	if ($config['wwh_version'])
	{
		$timestamp_cleaning = gmmktime(0, 0, 0, gmdate('m', $timestamp), gmdate('d', $timestamp), gmdate('Y', $timestamp));
		$timestamp_cleaning = $timestamp_cleaning - $config['board_timezone'] * 3600;
		$timestamp_cleaning = $timestamp_cleaning - $config['board_dst'] * 3600;
		$timestamp_cleaning = ($timestamp_cleaning < $timestamp - 86400) ? $timestamp_cleaning + 86400 : (($timestamp_cleaning > $timestamp) ? $timestamp_cleaning - 86400 : $timestamp_cleaning);
	}
	else
	{
		$timestamp_cleaning = $timestamp - ((3600 * $config['wwh_del_time_h']) + (60 * $config['wwh_del_time_m']) + $config['wwh_del_time_s']);
	}

	if (($config['wwh_last_clean'] != $timestamp_cleaning) || !$config['wwh_version'])
	{
		$db->sql_return_on_error(true);
		$sql = 'DELETE FROM ' . WWH_TABLE . '
			WHERE wwh_lastpage <= ' . $timestamp_cleaning;
		$result = $db->sql_query($sql);
		$db->sql_return_on_error(false);

		if ($result === false)
		{
			// database does not exist yet...
			$user->add_lang('mods/info_acp_wwh');
			return;
		}

		if ($config['wwh_version'])
		{
			set_config('wwh_last_clean', $timestamp_cleaning);
		}
	}

	// Let's dump out the list of the users =)
	$who_was_here_record = $wwh_username_colour = $wwh_username = $wwh_username_full = $wwh_count_total = $wwh_count_reg = $wwh_count_hidden = $wwh_count_guests = $wwh_count_bot = $who_was_here_list = '';

	switch ($config['wwh_sort_by'])
	{
		case '0':
		case '1':
			$sql_order_by = 'username_clean';
		break;
		case '4':
		case '5':
			$sql_order_by = 'user_id';
		break;
		case '2':
		case '3':
		default:
			$sql_order_by = 'wwh_lastpage';
		break;
	}
	$sql_ordering = (($config['wwh_sort_by'] % 2) == 0) ? 'ASC' : 'DESC';

	// let's try another method to deny doubles
	$user_id_ary = array();

	$sql = 'SELECT user_id, username, username_clean, user_colour, user_type, viewonline, wwh_lastpage, user_ip
		FROM  ' . WWH_TABLE . "
		ORDER BY $sql_order_by $sql_ordering";
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if (!in_array($row['user_id'], $user_id_ary))
		{
			$wwh_username_full = get_username_string((($row['user_type'] == USER_IGNORE) ? 'no_profile' : 'full'), $row['user_id'], $row['username'], $row['user_colour']);
			$hover_time = (($config['wwh_disp_time'] == '2') ? $user->lang['WHO_WAS_HERE_LATEST1'] . '&nbsp;' . $user->format_date($row['wwh_lastpage'],'H:i') . $user->lang['WHO_WAS_HERE_LATEST2'] : '' );
			$hover_ip = ($auth->acl_get('a_') && $config['wwh_disp_ip']) ? $user->lang['IP'] . ':&nbsp;' . $row['user_ip'] : '';
			$hover_info = (($hover_time || $hover_ip) ? ' title="' . $hover_time . (($hover_time && $hover_ip) ? ' | ' : '') . $hover_ip . '"' : '');
			$disp_time = (($config['wwh_disp_time'] == '1') ? '&nbsp;(' . $user->lang['WHO_WAS_HERE_LATEST1'] . '&nbsp;' . $user->format_date($row['wwh_lastpage'],'H:i') . $user->lang['WHO_WAS_HERE_LATEST2'] . (($hover_ip) ? ' | ' . $hover_ip : '' ) . ')' : '' );

			if (($row['viewonline']) || ($row['user_type'] == USER_IGNORE))
			{
				if ($row['user_id'] != ANONYMOUS)
				{
					if ($config['wwh_disp_bots'] || ($row['user_type'] != USER_IGNORE))
					{
						$who_was_here_list .= (($who_was_here_list != '') ? $user->lang['COMMA_SEPARATOR'] : '') . '<span' . $hover_info . '>' . $wwh_username_full . '</span>' . $disp_time;
						$user_id_ary[] = $row['user_id'];
					}
				}
			}
			else if ($config['wwh_disp_hidden'])
			{
				if ($auth->acl_get('u_viewonline'))
				{
					$who_was_here_list .= (($who_was_here_list != '') ? $user->lang['COMMA_SEPARATOR'] : '') . '<em' . $hover_info . '>' .$wwh_username_full . '</em>' . $disp_time;
					$user_id_ary[] = $row['user_id'];
				}
			}

			// At the end let's count them =)
			if ($row['user_id'] == ANONYMOUS)
			{
				$wwh_count_guests = $wwh_count_guests + 1;
			}
			else if ($row['user_type'] == USER_IGNORE)
			{
				$wwh_count_bot = $wwh_count_bot + 1;
			}
			else if ($row['viewonline'] == 1)
			{
				$wwh_count_reg = $wwh_count_reg + 1;
			}
			else
			{
				$wwh_count_hidden = $wwh_count_hidden + 1;
			}
			$wwh_count_total = $wwh_count_total + 1;
		}
	}

	if ($who_was_here_list == '')
	{
		$who_was_here_list = $user->lang['NO_ONLINE_USERS'];
	}

	if (!$config['wwh_disp_bots'])
	{
		$wwh_count_total = $wwh_count_total - $wwh_count_bot;
	}
	if (!$config['wwh_disp_guests'])
	{
		$wwh_count_total = $wwh_count_total - $wwh_count_guests;
	}
	if (!$config['wwh_disp_hidden'])
	{
		$wwh_count_total = $wwh_count_total - $wwh_count_hidden;
	}
	// ok, now we saved the data, lets make the record
	if ($config['wwh_record_ips'] < $wwh_count_total)
	{
		set_config('wwh_record_ips', $wwh_count_total, true);
		set_config('wwh_record_time', time(), true);
	}

	// end of record, so we make the output
	$vars_online = array(
		'WHO_WAS_HERE'			=> array('wwh_count_total', 'l_t2_user_s'),
		'WHO_WAS_HERE_REG'		=> array('wwh_count_reg', 'l_r2_user_s'),
		'WHO_WAS_HERE_HIDDEN'	=> array('wwh_count_hidden', 'l_h2_user_s'),
		'WHO_WAS_HERE_BOTS'		=> array('wwh_count_bot', 'l_b2_user_s'),
		'WHO_WAS_HERE_GUEST'	=> array('wwh_count_guests', 'l_g2_user_s'),
	);
	foreach ($vars_online as $l_prefix => $var_ary)
	{
		switch (${$var_ary[0]})
		{
			case 0:
				${$var_ary[1]} = $user->lang[$l_prefix . '_USERS_ZERO_TOTAL'];
			break;

			case 1:
				${$var_ary[1]} = $user->lang[$l_prefix . '_USER_TOTAL'];
			break;

			default:
				${$var_ary[1]} = $user->lang[$l_prefix . '_USERS_TOTAL'];
			break;
		}
	}
	unset($vars_online);

	$who_was_here_list2 = sprintf($l_t2_user_s, $wwh_count_total);
	$who_was_here_list2 .= sprintf($l_r2_user_s, $wwh_count_reg);
	if ($config['wwh_disp_hidden'])
	{
		$who_was_here_list2 .= '%s ' . sprintf($l_h2_user_s, $wwh_count_hidden);
	}
	if ($config['wwh_disp_bots'])
	{
		$who_was_here_list2 .= '%s ' . sprintf($l_b2_user_s, $wwh_count_bot);
	}
	if ($config['wwh_disp_guests'])
	{
		$who_was_here_list2 .= '%s ' . sprintf($l_g2_user_s, $wwh_count_guests);
	}
	switch (substr_count($who_was_here_list2, '%s'))
	{
		case 3:
			$who_was_here_list2 = sprintf($who_was_here_list2, $user->lang['COMMA_SEPARATOR'], $user->lang['COMMA_SEPARATOR'], $user->lang['WHO_WAS_HERE_WORD']);
			break;

		case 2:
			$who_was_here_list2 = sprintf($who_was_here_list2, $user->lang['COMMA_SEPARATOR'], $user->lang['WHO_WAS_HERE_WORD']);
			break;

		case 1:
			$who_was_here_list2 = sprintf($who_was_here_list2, $user->lang['WHO_WAS_HERE_WORD']);
			break;
	}

	if ($config['wwh_version'])
	{
		$who_was_here_explain = $user->lang['WHO_WAS_HERE_EXP'];
		if ($config['wwh_record'])
		{
			$who_was_here_record = sprintf($user->lang['WHO_WAS_HERE_RECORD'], $config['wwh_record_ips'], $user->format_date($config['wwh_record_time'], $config['wwh_record_timestamp'])) . '<br />';
		}
	}
	else
	{
		$who_was_here_explain = $user->lang['WHO_WAS_HERE_EXP_TIME'];
		if ($config['wwh_del_time_h'])
		{
			$who_was_here_explain .= sprintf($user->lang['WWH_HOUR' . (($config['wwh_del_time_h'] == 1) ? '' : 'S')], $config['wwh_del_time_h']);
		}
		if ($config['wwh_del_time_m'])
		{
			$who_was_here_explain .= '%s ' . sprintf($user->lang['WWH_MINUTE' . (($config['wwh_del_time_m'] == 1) ? '' : 'S')], $config['wwh_del_time_m']);
		}
		if ($config['wwh_del_time_s'])
		{
			$who_was_here_explain .= '%s ' . sprintf($user->lang['WWH_SECOND' . (($config['wwh_del_time_s'] == 1) ? '' : 'S')], $config['wwh_del_time_s']);
		}
		switch (substr_count($who_was_here_explain, '%s'))
		{
			case 2:
				$who_was_here_explain = sprintf($who_was_here_explain, $user->lang['COMMA_SEPARATOR'], $user->lang['WHO_WAS_HERE_WORD']);
				break;

			case 1:
				$who_was_here_explain = sprintf($who_was_here_explain, $user->lang['WHO_WAS_HERE_WORD']);
				break;
		}
		if ($config['wwh_record'])
		{
			$config['wwh_record_time2'] = $config['wwh_record_time'] - (3600 * $config['wwh_del_time_h']) - (60 * $config['wwh_del_time_m']) - $config['wwh_del_time_s'];
			$who_was_here_record = sprintf($user->lang['WHO_WAS_HERE_RECORD_TIME'], $config['wwh_record_ips'], $user->format_date($config['wwh_record_time2'], $config['wwh_record_timestamp']), $user->format_date($config['wwh_record_time'], $config['wwh_record_timestamp'])) . '<br />';
		}
	}
	$template->assign_vars(array(
			'WHO_WAS_HERE_LIST'		=> $user->lang['REGISTERED_USERS'] . ' ' . $who_was_here_list,
			'WHO_WAS_HERE_LIST2'	=> $who_was_here_list2,
			'WHO_WAS_HERE_RECORD'	=> $who_was_here_record,
			'WHO_WAS_HERE_EXP'		=> $who_was_here_explain,
	));
}
?>