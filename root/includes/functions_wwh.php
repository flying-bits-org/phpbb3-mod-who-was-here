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
$user->add_lang('mods/lang_wwh');
include_once($phpbb_root_path . 'includes/functions_wwh2.' . $phpEx);

if (1 == 1)//REMOVE!file_exists($phpbb_root_path . 'install_wwh'))
{
	//cleaning the wwh-table
	$timestamp = time();
	if ($config['wwh_version'])
	{
		$timestamp_cleaning = gmmktime(0,0,0,gmdate('m', $timestamp),gmdate('d', $timestamp),gmdate('Y', $timestamp));
		$timestamp_cleaning = $timestamp_cleaning - $config['board_timezone'] * 3600;
		$timestamp_cleaning = $timestamp_cleaning - $config['board_dst'] * 3600;
		$timestamp_cleaning = ($timestamp_cleaning < $timestamp - 86400) ? $timestamp_cleaning + 86400 : (($timestamp_cleaning > $timestamp) ? $timestamp_cleaning - 86400 : $timestamp_cleaning);
	}
	else
	{
		$timestamp_cleaning = $timestamp - ((3600 * $config['wwh_del_time_h']) + (60 * $config['wwh_del_time_m']) + $config['wwh_del_time_s']);
	}

	$sql = 'DELETE FROM ' . WWH_TABLE . " WHERE wwh_lastpage <= $timestamp_cleaning";
	$db->sql_query($sql);

	// let's dump out the list of the users =)
	$who_was_here_record = $wwh_username_colour = $wwh_username = $wwh_username_full = $wwh_count_total = $wwh_count_reg = $wwh_count_hidden = $wwh_count_guests = $wwh_count_bot = $who_was_here_list = '';

	switch ($config['wwh_sort_by'])
	{
		case '0':
			$order_by = 'username_clean ASC';
		break;

		case '1':
			$order_by = 'username_clean DESC';
		break;

		case '4':
			$order_by = 'user_id ASC';
		break;

		case '5':
			$order_by = 'user_id DESC';
		break;

		case '2':
			$order_by = 'wwh_lastpage ASC';
		break;

		case '3':
		default:
			$order_by = 'wwh_lastpage DESC';
		break;
	}

	// let's try another method to deny doubles
	$user_id_ary = array();

	$sql = 'SELECT user_id, username, username_clean, user_colour, user_type, viewonline, wwh_lastpage, user_ip
		FROM  ' . WWH_TABLE . "
		ORDER BY $order_by";
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if (!in_array($row['user_id'], $user_id_ary))
		{
			$wwh_username_full = get_username_string(($row['user_type'] == USER_IGNORE) ? 'no_profile' : 'full', $row['user_id'], $row['username'], $row['user_colour'], $guest_username = false, $custom_profile_url = false);
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

			// at the end let's count them =)
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
	}//end while!

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