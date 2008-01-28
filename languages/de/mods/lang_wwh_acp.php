<?php
/**
*
* wwh acp [Deutsch]
*
* @package language
* @version $Id: lang_wwh.php 4 2007-06-02
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/
if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'WWH_DISP_SET'				=> 'Einstellungen für die Anzeige',
	'WWH_DISP_BOTS'				=> 'Bots anzeigen',
	'WWH_DISP_BOTS_EXP'			=> 'Manche Benutzer könnten sich fragen, was Bots sind.',
	'WWH_DISP_GUESTS'			=> 'Gäste anzeigen',
	'WWH_DISP_GUESTS_EXP'		=> 'Gäste im Zähler aufführen',
	'WWH_DISP_HIDDEN'			=> 'Unsichtbare Benutzer anzeigen',
	'WWH_DISP_HIDDEN_EXP'		=> 'Sollen unsichtbare Benutzer angezeigt werden? (Nur mit Berechtigung von phpBB3 selbst)',
	'WWH_DISP_TIME'				=> 'Zeit anzeigen',
	'WWH_DISP_HOVER'			=> 'als Hover-Effekt',
	'WWH_DISP_TIME_EXP'			=> 'Entweder sehen alle Benutzer die Zeit oder niemand.',

	'WWH_INSTALL'				=> 'Installation',
	'WWH_INSTALLED'				=> '"Wer War Da?" MOD v%s installiert.',
	'WWH_INSTALL_FALSE'			=> '"Wer War Da?" MOD konnte nicht installiert werden.',
	'WWH_INSTALL_NEED'			=> 'Den "Wer War Da?" MOD installieren?',
	'WWH_INSTALL_NEW_VERSION'	=> 'Neue MOD Version',

	'WWH_RECORD'				=> 'Besucherrekord',
	'WWH_RECORD_EXP'			=> 'Den Besucherrekord anzeigen und speichern.',
	'WWH_RESET'					=> 'Besucherrekord zurücksetzen',
	'WWH_RESET_1'				=> 'Besucherrekord zurücksetzen',
	'WWH_RESET_EXP'				=> 'Setzt den Zeitpunkt und den Besucherrekord zurück.',
	'WWH_RESET_TRUE'			=> 'Wenn du dieses Formular absendest,\nwird der Rekord zurückgesetzt.',// \n is the beginning of a new line
									//no space after it

	'WWH_SAVED_SETTINGS'		=> 'Einstellungen gespeichert.',
	'WWH_SORT_BY'				=> 'sortiere Benutzer nach',
	'WWH_SORT_BY_EXP'			=> 'In welcher Reihenfolge sollen die Benutzer aufgelistet werden?',
	'WWH_SORT_BY_0'				=> 'Benutzername A -> Z',
	'WWH_SORT_BY_1'				=> 'Benutzername Z -> A',
	'WWH_SORT_BY_2'				=> 'Besuchszeit aufsteigend',
	'WWH_SORT_BY_3'				=> 'Besuchszeit absteigend',
	'WWH_SORT_BY_4'				=> 'Besucher-ID aufsteigend',
	'WWH_SORT_BY_5'				=> 'Besucher-ID absteigend',

	'WWH_UPDATE'				=> 'Update',
	'WWH_UPDATED'				=> 'Update "Wer War Da?" MOD von v%s auf v%s',
	'WWH_UPDATE_FALSE'			=> '"Wer War Da?" MOD wurde nicht upgedated',
	'WWH_UPDATE_NEED'			=> 'Update deinen "Wer War Da?" MOD',
	'WWH_UPDATE_NEW_VERSION'	=> 'Neue MOD Version',
	'WWH_UPDATE_OLD_VERSION'	=> 'Alte MOD Version',

	'WWH_VERSION'				=> 'MOD Version',
	'WWH_VERSION_EXP'			=> 'Benutzer von heute anzeigen, oder aus dem Zeitraum der im nächsten Feld eingegeben wird',
	'WWH_VERSION1'				=> 'Heute',
	'WWH_VERSION2'				=> 'Zeitraum',
	'WWH_VERSION2_EXP'			=> 'geben 0 ein, wenn die Besucher der letzten 24 Stunden angezeigt werden sollen',
	'WWH_VERSION2_EXP2'			=> 'deaktiviert, wenn "Heute" ausgewählt wurde',
	'WWH_VERSION2_EXP3'			=> 'Sekunden',

	'INSTALLER_INTRO'					=> 'Intro',
	'INSTALLER_INTRO_WELCOME'			=> 'Willkommen zur MOD-Installation',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Bitte wähle aus, was du tun möchtest.',

	'INSTALLER_INSTALL'					=> 'Installieren',
	'INSTALLER_INSTALL_MENU'			=> 'Installation',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Installation der MOD v%s war erfolgreich.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Installation der MOD v%s war <strong>nicht</strong> erfolgreich.',
	'INSTALLER_INSTALL_VERSION'			=> 'Installiere MOD v%s',
	'INSTALLER_INSTALL_WELCOME'			=> 'Willkommen zur Installation',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Wenn du den MOD installierst, werden möglicherweise vorhandene Datenbanktabellen mit gleichem Namen gelöscht.',

	'INSTALLER_NEEDS_FOUNDER'			=> 'Du musst als Gründer eingeloggt sein.',

	'INSTALLER_UPDATE'					=> 'Update',
	'INSTALLER_UPDATE_MENU'				=> 'Updatemenü',
	'INSTALLER_UPDATE_NOTE'				=> 'Update MOD von v%s nach v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update der MOD von v%s nach v%s war erfolgreich.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'Update der MOD von v%s nach v%s war <strong>nicht</strong> erfolgreich.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update MOD von v',
	'INSTALLER_UPDATE_WELCOME'			=> 'Willkommen zum Update',

	'WARNING'							=> 'Warnung',
));

?>