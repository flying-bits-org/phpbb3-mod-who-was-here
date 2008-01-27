<?php
/**
*
* wwh acp [Français]
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
	'WWH_DISP_SET'				=> 'Réglages pour le MOD "Qui était en ligne?"',
	'WWH_DISP_BOTS'				=> 'Afficher les robots',
	'WWH_DISP_BOTS_EXP'			=> 'Certains utilisateurs pourraient se demander ce que sont les robots et s\'en inquiéter.',
	'WWH_DISP_GUESTS'			=> 'Afficher les invités',
	'WWH_DISP_GUESTS_EXP'		=> 'Afficher les invités en tant que plus nombreux utilisateurs en ligne',
	'WWH_DISP_TIME'				=> 'Afficher l\'heure',
	'WWH_DISP_HOVER'			=> 'En incrustation sur le nom',
	'WWH_DISP_TIME_EXP'			=> 'Soit tous les utilisateurs peuvent la voir, soit personne ne le peut. Il n\'y a pas de fonctionnalité spéciale pour les administrateurs.',

	'WWH_INSTALL'				=> 'Installation',
	'WWH_INSTALLED'				=> 'Le MOD "Qui était en ligne ?" v%s installé',
	'WWH_INSTALL_FALSE'			=> 'Le MOD "Qui était en ligne ?" n\'est pas installé',
	'WWH_INSTALL_NEED'			=> 'Installer le MOD "Qui était en ligne ?"',
	'WWH_INSTALL_NEW_VERSION'	=> 'Nouvelle version du MOD',

	'WWH_RECORD'				=> 'Record d\'utilisateurs',
	'WWH_RECORD_EXP'			=> 'Afficher et sauvegarder le record d\'utilisateurs',
	'WWH_RESET'					=> 'Réinitialiser le record d\'utilisateurs',
	'WWH_RESET_1'				=> 'Réinitialiser le record d\'utilisateurs',
	'WWH_RESET_EXP'				=> 'Réinitialise le temps et le compteur du record de "Qui était en ligne ?"',
	'WWH_RESET_TRUE'			=> 'Si vous validez ce choix,\n le record sera réinitialisé',// \n est le début d\'une nouvelle ligne
									//pas d\'espace après lui

	'WWH_SAVED_SETTINGS'		=> 'configurations sauvegardées',
	'WWH_SORT_BY'				=> 'ordre d\'affichage',
	'WWH_SORT_BY_EXP'			=> 'dans quel ordre voulez vous afficher les utilisateurs?',
	'WWH_SORT_BY_0'				=> 'Nom d\'utilisateur A -> Z',
	'WWH_SORT_BY_1'				=> 'Nom d\'utilisateur Z -> A',
	'WWH_SORT_BY_2'				=> 'Heure de visite par ordre croissant',
	'WWH_SORT_BY_3'				=> 'Heure de visite par ordre décroissant',
	'WWH_SORT_BY_4'				=> 'Numéro d\'utilisateur par ordre croissant',
	'WWH_SORT_BY_5'				=> 'Numéro d\'utilisateur par ordre décroissant',

	'WWH_UPDATE'				=> 'Mise à jour',
	'WWH_UPDATED'				=> 'Mettre à jour le MOD "Qui était en ligne ?" de la v%s vers la v%s',
	'WWH_UPDATE_FALSE'			=> 'Le MOD "Qui était en ligne ?" n\'est pas à jour',
	'WWH_UPDATE_NEED'			=> 'Mettre à jour le MOD "Qui était en ligne ?"',
	'WWH_UPDATE_NEW_VERSION'	=> 'Nouvelle version du MOD',
	'WWH_UPDATE_OLD_VERSION'	=> 'Ancienne version du MOD',

	'WWH_VERSION'				=> 'Version du MOD',
	'WWH_VERSION_EXP'			=> 'affichez les utilisateurs d\'aujourd\'hui, ou ceux configurés dans le champ suivant',
	'WWH_VERSION1'				=> 'aujourd\'hui',
	'WWH_VERSION2'				=> 'période de temps',
	'WWH_VERSION2_EXP'			=> 'mettre 0, si vous voulez afficher les utilisateurs des dernières 24h',
	'WWH_VERSION2_EXP2'			=> 'désactivé , si vous avez choisi "aujourd\'hui"',
	'WWH_VERSION2_EXP3'			=> 'secondes',

	'INSTALLER_INTRO'					=> 'Introduction',
	'INSTALLER_INTRO_WELCOME'			=> 'Bienvenue dans l\'installation du MOD',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Choisissez ce que vous voulez faire.',

	'INSTALLER_INSTALL'					=> 'Installation',
	'INSTALLER_INSTALL_MENU'			=> 'Menu d\'installation',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'L\'installation du MOD v%s a réussi.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'L\'installation du MOD v%s a <strong>échoué</strong>.',
	'INSTALLER_INSTALL_VERSION'			=> 'Installation du MOD v%s',
	'INSTALLER_INSTALL_WELCOME'			=> 'Bienvenue dans le menu d\'installation',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Quand vous choisissez d\'installer ce  MOD, aucune donnée des précédentes versions ne sera oubliée.',

	'INSTALLER_NEEDS_FOUNDER'			=> 'Vous devez être connecté en tant que fondateur.',

	'INSTALLER_UPDATE'					=> 'Mise à jour',
	'INSTALLER_UPDATE_MENU'				=> 'Menu de la mise à jour',
	'INSTALLER_UPDATE_NOTE'				=> 'Mise à jour du MOD de la v%s vers la v%s',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'La mise à jour du MOD de la v%s vers la v%s a réussi.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'La mise à jour du MOD de la v%s vers la v%s a <strong>échoué</strong>.',
	'INSTALLER_UPDATE_VERSION'			=> 'Mise à jour du MOD v',
	'INSTALLER_UPDATE_WELCOME'			=> 'Bienvenue dans le menu de mise à jour',

	'WARNING'							=> 'Attention',
));

?>