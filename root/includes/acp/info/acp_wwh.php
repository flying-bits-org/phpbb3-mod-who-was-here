<?php
/**
*
* @package - NV "who was here?"
* @copyright (c) nickvergessen - http://www.flying-bits.org/
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package module_install
*/
class acp_wwh_info
{
	function module()
	{		
		return array(
			'filename'	=> 'acp_wwh',
			'title'		=> 'WWH_TITLE',
			'version'	=> '1.0.1',
			'modes'		=> array(
				'config_wwh'	=> array(
				'title'		=> 'WWH_CONFIG',
				'auth'		=> 'acl_a_board',
				'cat'		=> array('ACP_BOARD_CONFIGURATION'),
				),
			),
		);
	}
}

?>