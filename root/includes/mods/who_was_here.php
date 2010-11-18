<?php
/**
*
* @package - NV "who was here?"
* @version $Id$
* @copyright (c) nickvergessen - http://www.flying-bits.org/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class phpbb_mods_who_was_here
{
	static private $prune_timestamp = 0;

	static private $count_total = 0;
	static private $count_reg = 0;
	static private $count_hidden = 0;
	static private $count_bot = 0;
	static private $count_guests = 0;

	static private $ids_reg = array();
	static private $ids_hidden = array();
	static private $ids_bot = array();

	/**
	* Would have been to nice, if we could use a constant.
	*/
	static public function table($table_name = 'wwh')
	{
		global $table_prefix;
		return $table_prefix . $table_name;
	}

	/**
	* Update the users session in the table.
	*/
	static public function update_session()
	{
		global $db, $user;

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
			$sql = 'UPDATE ' . self::table() . ' 
				SET ' . $db->sql_build_array('UPDATE', $wwh_data) . '
				WHERE user_id = ' . (int) $user->data['user_id'] . "
					OR (user_ip = '" . $db->sql_escape($user->ip) . "'
						AND user_id = " . ANONYMOUS . ')';
			$result = $db->sql_query($sql);
			$db->sql_return_on_error(false);

			if ((bool) $result === false)
			{
				// database does not exist yet...
				return;
			}

			$sql_affectedrows = (int) $db->sql_affectedrows();
			if ($sql_affectedrows != 1)
			{
				if ($sql_affectedrows > 1)
				{
					// Found multiple matches, so we delete them and just add one
					$sql = 'DELETE FROM ' . self::table() . '
						WHERE user_id = ' . (int) $user->data['user_id'] . "
							OR (user_ip = '" . $db->sql_escape($user->ip) . "'
								AND user_id = " . ANONYMOUS . ')';
					$db->sql_query($sql);
					$db->sql_query('INSERT INTO ' . self::table() . ' ' . $db->sql_build_array('INSERT', $wwh_data));
				}

				if ($sql_affectedrows == 0)
				{
					// No entry updated. Either the user is not listed yet, or has opened two links in the same time
					$sql = 'SELECT 1 as found
						FROM ' . self::table() . '
						WHERE user_id = ' . (int) $user->data['user_id'] . "
							OR (user_ip = '" . $db->sql_escape($user->ip) . "'
								AND user_id = " . ANONYMOUS . ')';
					$result = $db->sql_query($sql);
					$found = (int) $db->sql_fetchfield('found');
					$db->sql_freeresult($result);
					if (!$found)
					{
						// He wasn't listed.
						$db->sql_query('INSERT INTO ' . self::table() . ' ' . $db->sql_build_array('INSERT', $wwh_data));
					}
				}
			}
		}
		else
		{
			$db->sql_return_on_error(true);
			$sql = 'SELECT user_id
				FROM ' . self::table() . "
				WHERE user_ip = '" . $db->sql_escape($user->ip) . "'";
			$result = $db->sql_query_limit($sql, 1);
			$db->sql_return_on_error(false);

			if ((bool) $result === false)
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
				$db->sql_query('INSERT INTO ' . self::table() . ' ' . $db->sql_build_array('INSERT', $wwh_data));
			}
		}
		$db->sql_return_on_error(false);
	}

	/**
	* Fetching the user-list and putting the stuff into the template.
	*/
	function display()
	{
		global $auth, $config, $db, $template, $user;

		$user->add_lang('mods/lang_wwh');

		if (!self::prune())
		{
			// Error while purging the list, database is missing :-O
			$user->add_lang('mods/info_acp_wwh');
			return;
		}

		self::$count_guests = self::$count_bot = self::$count_reg = self::$count_hidden = self::$count_total = 0;
		$wwh_username_colour = $wwh_username = $wwh_username_full = $users_list = '';

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

		// Let's try another method, to deny duplicate appearance of usernames.
		$user_id_ary = array();

		$sql = 'SELECT user_id, username, username_clean, user_colour, user_type, viewonline, wwh_lastpage, user_ip
			FROM  ' . self::table() . "
			ORDER BY $sql_order_by $sql_ordering";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			if (!in_array($row['user_id'], $user_id_ary))
			{
				$wwh_username_full = get_username_string((($row['user_type'] == USER_IGNORE) ? 'no_profile' : 'full'), $row['user_id'], $row['username'], $row['user_colour']);
				$hover_time = (($config['wwh_disp_time'] == '2') ? $user->lang['WHO_WAS_HERE_LATEST1'] . '&nbsp;' . $user->format_date($row['wwh_lastpage'], $config['wwh_disp_time_format']) . $user->lang['WHO_WAS_HERE_LATEST2'] : '' );
				$hover_ip = ($auth->acl_get('a_') && $config['wwh_disp_ip']) ? $user->lang['IP'] . ':&nbsp;' . $row['user_ip'] : '';
				$hover_info = (($hover_time || $hover_ip) ? ' title="' . $hover_time . (($hover_time && $hover_ip) ? ' | ' : '') . $hover_ip . '"' : '');
				$disp_time = (($config['wwh_disp_time'] == '1') ? '&nbsp;(' . $user->lang['WHO_WAS_HERE_LATEST1'] . '&nbsp;' . $user->format_date($row['wwh_lastpage'], $config['wwh_disp_time_format']) . $user->lang['WHO_WAS_HERE_LATEST2'] . (($hover_ip) ? ' | ' . $hover_ip : '' ) . ')' : '' );

				if ($row['viewonline'] || ($row['user_type'] == USER_IGNORE))
				{
					if (($row['user_id'] != ANONYMOUS) && ($config['wwh_disp_bots'] || ($row['user_type'] != USER_IGNORE)))
					{
						$users_list .= $user->lang['COMMA_SEPARATOR'] . '<span' . $hover_info . '>' . $wwh_username_full . '</span>' . $disp_time;
						$user_id_ary[] = $row['user_id'];
					}
				}
				else if (($config['wwh_disp_hidden']) && ($auth->acl_get('u_viewonline')))
				{
					$users_list .= $user->lang['COMMA_SEPARATOR'] . '<em' . $hover_info . '>' .$wwh_username_full . '</em>' . $disp_time;
					$user_id_ary[] = $row['user_id'];
				}

				// At the end let's count them =)
				if ($row['user_id'] == ANONYMOUS)
				{
					self::$count_guests++;
				}
				else if ($row['user_type'] == USER_IGNORE)
				{
					self::$count_bot++;
					self::$ids_bot[] = (int) $row['user_id'];
				}
				else if ($row['viewonline'] == 1)
				{
					self::$count_reg++;
					self::$ids_reg[] = (int) $row['user_id'];
				}
				else
				{
					self::$count_hidden++;
					self::$ids_hidden[] = (int) $row['user_id'];
				}
				self::$count_total++;
			}
		}

		$users_list = utf8_substr($users_list, utf8_strlen($user->lang['COMMA_SEPARATOR']));
		if ($users_list == '')
		{
			// User list is empty.
			$users_list = $user->lang['NO_ONLINE_USERS'];
		}

		if (!$config['wwh_disp_bots'])
		{
			self::$count_total -= self::$count_bot;
		}
		if (!$config['wwh_disp_guests'])
		{
			self::$count_total -= self::$count_guests;
		}
		if (!$config['wwh_disp_hidden'])
		{
			self::$count_total -= self::$count_hidden;
		}

		// Need to update the record?
		if ($config['wwh_record_ips'] < self::$count_total)
		{
			set_config('wwh_record_ips', self::$count_total, true);
			set_config('wwh_record_time', time(), true);
		}

		// Disabled, see comment on the method itself.
		//self::log();

		$template->assign_vars(array(
			'WHO_WAS_HERE_LIST'		=> $user->lang['REGISTERED_USERS'] . ' ' . $users_list,
			'WHO_WAS_HERE_TOTAL'	=> self::get_total_users_string($config['wwh_disp_hidden'], $config['wwh_disp_bots'], $config['wwh_disp_guests']),
			'WHO_WAS_HERE_EXP'		=> self::get_explanation_string($config['wwh_version']),
			'WHO_WAS_HERE_RECORD'	=> self::get_record_string($config['wwh_record'], $config['wwh_version']),
		));
	}

	/**
	* Deletes the users from the list, whose visit is to old.
	*/
	static public function prune()
	{
		global $config;

		$timestamp = time();
		if ($config['wwh_version'])
		{
			self::$prune_timestamp = gmmktime(0, 0, 0, gmdate('m', $timestamp), gmdate('d', $timestamp), gmdate('Y', $timestamp));
			self::$prune_timestamp -= ($config['board_timezone'] * 3600);
			self::$prune_timestamp -= ($config['board_dst'] * 3600);
			self::$prune_timestamp = (self::$prune_timestamp < $timestamp - 86400) ? self::$prune_timestamp + 86400 : ((self::$prune_timestamp > $timestamp) ? self::$prune_timestamp - 86400 : self::$prune_timestamp);
		}
		else
		{
			self::$prune_timestamp = $timestamp - ((3600 * $config['wwh_del_time_h']) + (60 * $config['wwh_del_time_m']) + $config['wwh_del_time_s']);
		}

		if ((!isset($config['wwh_last_clean']) || ($config['wwh_last_clean'] != self::$prune_timestamp)) || !$config['wwh_version'])
		{
			global $db;

			$db->sql_return_on_error(true);
			$sql = 'DELETE FROM ' . self::table() . '
				WHERE wwh_lastpage <= ' . self::$prune_timestamp;
			$result = $db->sql_query($sql);
			$db->sql_return_on_error(false);

			if ((bool) $result === false)
			{
				// database does not exist yet...
				return false;
			}

			if ($config['wwh_version'])
			{
				set_config('wwh_last_clean', self::$prune_timestamp);
			}
		}

		// Purging was not needed or done succesfully...
		return true;
	}

	/**
	* Logs the daily stats.
	* NOTE: Currently not active, as there might be law conflicts in some states.
	*/
	static public function log()
	{
		global $config;

		if (!$config['wwh_version'])
		{
			// Logging not allowed for this mode.
			return;
		}

		$log_data = array(
			'guest_users'		=> self::$count_guests,
			'hidden_users'		=> self::$count_hidden,
			'registered_users'	=> self::$count_reg,
			'bots'				=> self::$count_bots,
			'hidden_users_list'		=> implode(', ', self::$ids_hidden),
			'registered_users_list'	=> implode(', ', self::$ids_reg),
			'bots_list'				=> implode(', ', self::$ids_bot),
			'start_time'		=> self::$prune_timestamp,
			'end_time'			=> self::$prune_timestamp + 86400,
		);

		$www_log_hash = self::$count_guests . '-' . self::$count_hidden . '-' . self::$count_reg . '-' . self::$count_bots;

		if ($config['wwh_log_hash'] != $www_log_hash)
		{
			global $db;

			if ($config['wwh_log_endtime'] > time())
			{
				$sql = 'UPDATE ' . self::table('wwh_logs') . ' 
					SET ' . $db->sql_build_array('UPDATE', $log_data) . '
					WHERE log_id = ' . (int) $config['wwh_current_log_id'];
				$db->sql_query($sql);
			}
			else
			{
				$db->sql_query('INSERT INTO ' . self::table('wwh_logs') . ' ' . $db->sql_build_array('INSERT', $log_data));
				set_config('wwh_current_log_id', (int) $db->sql_nextid());
				set_config('wwh_log_endtime', $timestamp_cleaning + 86400);
			}
			set_config('wwh_log_hash', $www_log_hash);
		}
	}

	/**
	* Returns the Explanation string for the online list:
	* Demo:	based on users active today
	*		based on users active over the past 30 minutes
	*/
	static public function get_explanation_string($mode)
	{
		global $config, $user;

		if ($mode)
		{
			return $user->lang['WHO_WAS_HERE_EXP'];
		}
		else
		{
			global $config;

			$explanation = $user->lang['WHO_WAS_HERE_EXP_TIME'];
			$explanation .= $user->lang('WWH_HOURS', (int) $config['wwh_del_time_h']);
			$explanation .= $user->lang('WWH_MINUTES', (int) $config['wwh_del_time_m']);
			$explanation .= $user->lang('WWH_SECONDS', (int) $config['wwh_del_time_s']);

			switch (substr_count($explanation, '%s'))
			{
				case 3:
					return sprintf($explanation, '', $user->lang['COMMA_SEPARATOR'], $user->lang['WHO_WAS_HERE_WORD']);
				case 2:
					return sprintf($explanation, '', $user->lang['WHO_WAS_HERE_WORD']);
				default:
					return sprintf($explanation, '');
			}
		}
	}

	/**
	* Returns the Record string for the online list:
	* Demo:	Most users ever online was 1 on Mon 7. Sep 2009
	*		Most users ever online was 1 between Mon 7. Sep 2009 and Tue 8. Sep 2009
	*/
	static public function get_record_string($active, $mode)
	{
		global $config, $user;

		if (!$active)
		{
			return '';
		}
		if ($mode)
		{
			return sprintf($user->lang['WHO_WAS_HERE_RECORD'], $config['wwh_record_ips'], $user->format_date($config['wwh_record_time'], $config['wwh_record_timestamp'])) . '<br />';
		}
		else
		{
			global $config;

			$config['wwh_record_time2'] = $config['wwh_record_time'] - (3600 * $config['wwh_del_time_h']) - (60 * $config['wwh_del_time_m']) - $config['wwh_del_time_s'];
			return sprintf($user->lang['WHO_WAS_HERE_RECORD_TIME'], $config['wwh_record_ips'], $user->format_date($config['wwh_record_time2'], $config['wwh_record_timestamp']), $user->format_date($config['wwh_record_time'], $config['wwh_record_timestamp'])) . '<br />';
		}
	}

	/**
	* Returns the Total string for the online list:
	* Demo:	In total there was 1 user online :: 1 registered, 0 hidden, 0 bots and 0 guests
	*/
	static public function get_total_users_string($display_hidden, $display_bots, $display_guests)
	{
		global $user;

		$total_users_string = $user->lang('WHO_WAS_HERE_TOTAL', self::$count_total);
		$total_users_string .= $user->lang('WHO_WAS_HERE_REG_USERS', self::$count_reg);
		if ($display_hidden)
		{
			$total_users_string .= '%s ' . $user->lang('WHO_WAS_HERE_HIDDEN', self::$count_hidden);
		}
		if ($display_bots)
		{
			$total_users_string .= '%s ' . $user->lang('WHO_WAS_HERE_BOTS', self::$count_bot);
		}
		if ($display_guests)
		{
			$total_users_string .= '%s ' . $user->lang('WHO_WAS_HERE_GUESTS', self::$count_guests);
		}

		switch (substr_count($total_users_string, '%s'))
		{
			case 3:
				return sprintf($total_users_string, $user->lang['COMMA_SEPARATOR'], $user->lang['COMMA_SEPARATOR'], $user->lang['WHO_WAS_HERE_WORD']);
			case 2:
				return sprintf($total_users_string, $user->lang['COMMA_SEPARATOR'], $user->lang['WHO_WAS_HERE_WORD']);
			case 1:
				return sprintf($total_users_string, $user->lang['WHO_WAS_HERE_WORD']);
		}
	}
}
