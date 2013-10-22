<?php
/**
*
* @package - NV "who was here?"
* @copyright (c) nickvergessen - http://www.flying-bits.org/
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @package phpbb_gallery
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class nv_wwh_version
{
	function version()
	{
		return array(
			'author'	=> 'nickvergessen',
			'title'		=> 'NV "who was here?"',
			'tag'		=> 'nv_wwh',
			'version'	=> '1.2.1',
			'file'		=> array('www.flying-bits.org', 'updatecheck', 'nv_wwh.xml'),
		);
	}
}

?>