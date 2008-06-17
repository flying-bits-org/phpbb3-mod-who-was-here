<?php

/**
*
* @package phpBB3 - who was here MOD
* @version $Id$
* @copyright (c) nickvergessen ( http://www.flying-bits.org/ )
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'WHO_WAS_HERE'					=> 'Kimler çevrimiçi olmuş?',
	'WHO_WAS_HERE_LATEST1'			=> 'en son saat',
	'WHO_WAS_HERE_LATEST2'			=> ' civarları',
	'WHO_WAS_HERE_USERS_TOTAL'				=> 'Toplam <strong>%d</strong> kullanıcı çevrimiçiydi: ',
	'WHO_WAS_HERE_USERS_ZERO_TOTAL'			=> 'Toplam <strong>0</strong> kullanıcı çevrimiçiydi: ',
	'WHO_WAS_HERE_USER_TOTAL'				=> 'Toplam <strong>%d</strong> kullanıcı çevrimiçiydi: ',
	'WHO_WAS_HERE_REG_USERS_TOTAL'			=> '%d kayıtlı',
	'WHO_WAS_HERE_REG_USERS_ZERO_TOTAL'		=> '0 kayıtlı',
	'WHO_WAS_HERE_REG_USER_TOTAL'			=> '%d kayıtlı',
	'WHO_WAS_HERE_HIDDEN_USERS_TOTAL'		=> '%d gizli',
	'WHO_WAS_HERE_HIDDEN_USERS_ZERO_TOTAL'	=> '0 gizli',
	'WHO_WAS_HERE_HIDDEN_USER_TOTAL'		=> '%d gizli',
	'WHO_WAS_HERE_BOTS_USERS_TOTAL'			=> '%d bot',
	'WHO_WAS_HERE_BOTS_USERS_ZERO_TOTAL'	=> '0 bot',
	'WHO_WAS_HERE_BOTS_USER_TOTAL'			=> '%d bot',
	'WHO_WAS_HERE_GUEST_USERS_TOTAL'		=> '%d misafir',
	'WHO_WAS_HERE_GUEST_USERS_ZERO_TOTAL'	=> '0 misafir',
	'WHO_WAS_HERE_GUEST_USER_TOTAL'			=> '%d misafir',
	'WHO_WAS_HERE_WORD'				=> ' ve',
	'WHO_WAS_HERE_EXP'				=> 'Bu bilgi bugün aktif olan kullanıcılara dayalıdır',
	'WHO_WAS_HERE_EXP_TIME'			=> 'Bu bilgi geçmişte aktif olan kullanıcılara dayalıdır. ',
	'WWH_HOUR'						=> '%1$s Saat ve',
	'WWH_HOURS'						=> '%1$s Saat',
	'WWH_MINUTE'					=> '%1$s Dakika ve',
	'WWH_MINUTES'					=> '%1$s Dakika',
	'WWH_SECOND'					=> '%1$s Saniye ve',
	'WWH_SECONDS'					=> '%1$s Saniye',
	'WHO_WAS_HERE_RECORD'			=> 'En çok <strong>%1$s</strong> kullanıcı, %2$s tarihinde çevrimiçi oldu.',
	'WHO_WAS_HERE_RECORD_TIME'		=> 'En çok <strong>%1$s</strong> kullanıcı, %2$s ve %3$s tarihleri arasında çevrimiçi oldu.',
));

?>