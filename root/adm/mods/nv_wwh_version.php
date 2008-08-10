<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package phpbb_gallery
*/
class nv_wwh_version
{
	function version()
	{
		return array(
			'author'	=> 'nickvergessen',
			'title'		=> 'NV "who was here?"',
			'tag'		=> 'nv_wwh',
			'version'	=> '1.0.0-RC1',
			'file'		=> array('www.flying-bits.org', 'updatecheck', 'nv_wwh.xml'),
		);
	}
}

?>