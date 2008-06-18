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
	'WWH_DISP_SET'				=> 'Réglages pour le MOD "Qui était en ligne?"',
	'WWH_DISP_BOTS'				=> 'Afficher les robots',
	'WWH_DISP_BOTS_EXP'			=> 'Certains utilisateurs pourraient se demander ce que sont les robots et s\'en inquiéter.',
	'WWH_DISP_GUESTS'			=> 'Afficher les invités',
	'WWH_DISP_GUESTS_EXP'		=> 'Afficher les invités dans le compteur',
	'WWH_DISP_HIDDEN'			=> 'Montrer les utilisateurs invisibles',
	'WWH_DISP_HIDDEN_EXP'		=> 'Les utilisateurs invisibles doivent-ils être affichés dans la liste? (seulement par permission)',	
	'WWH_DISP_TIME'				=> 'Afficher l\'heure',
	'WWH_DISP_HOVER'			=> 'En incrustation sur le nom',
	'WWH_DISP_TIME_EXP'			=> 'Soit tous les utilisateurs peuvent la voir, soit personne ne le peut. Il n\'y a pas de fonctionnalité spéciale pour les administrateurs.',
	'WWH_DISP_IP'				=> 'montrer l\'ip',
	'WWH_DISP_IP_EXP'			=> 'Uniquement pour les utilisateurs ayant des droits d\'administration, comme dans le viewonline.php',

	'WWH_INSTALL'				=> 'Installation',
	'WWH_INSTALLED'				=> 'Le MOD "Qui était en ligne ?" v%s installé',
	'WWH_INSTALL_FALSE'			=> 'Le MOD "Qui était en ligne ?" n\'est pas installé',
	'WWH_INSTALL_NEED'			=> 'Installer le MOD "Qui était en ligne ?"',
	'WWH_INSTALL_NEW_VERSION'	=> 'Nouvelle version du MOD',

	'WWH_RECORD'				=> 'Record d\'utilisateurs',
	'WWH_RECORD_EXP'			=> 'Afficher et sauvegarder le record d\'utilisateurs',
	'WWH_RECORD_TIMESTAMP'		=> 'Compteur de temps pour le record',
	'WWH_RESET'					=> 'Réinitialiser le record d\'utilisateurs',
	'WWH_RESET_1'				=> 'Réinitialiser le record d\'utilisateurs',
	'WWH_RESET_EXP'				=> 'Réinitialise le temps et le compteur du record de "Qui était en ligne ?"',
	'WWH_RESET_TRUE'			=> 'Si vous validez ce choix,\n le record sera réinitialisé',// \n est le début d\'une nouvelle ligne
									//pas d\'espace après lui

	'WWH_SAVED_SETTINGS'		=> 'Configurations sauvegardées',
	'WWH_SORT_BY'				=> 'Ordre d\'affichage',
	'WWH_SORT_BY_EXP'			=> 'Dans quel ordre voulez vous afficher les utilisateurs?',
	'WWH_SORT_BY_0'				=> 'Nom d\'utilisateur A -> Z',
	'WWH_SORT_BY_1'				=> 'Nom d\'utilisateur Z -> A',
	'WWH_SORT_BY_2'				=> 'Heure de visite par ordre croissant',
	'WWH_SORT_BY_3'				=> 'Heure de visite par ordre décroissant',
	'WWH_SORT_BY_4'				=> 'Numéro d\'utilisateur par ordre croissant',
	'WWH_SORT_BY_5'				=> 'Numéro d\'utilisateur par ordre décroissant',

	'WWH_UPDATE'				=> 'Mise à jour',
	'WWH_UPDATED'				=> 'Mettre à jour le MOD "Qui était en ligne ?" de la v%s vers la v%s',
	'WWH_UPDATE_FALSE'			=> 'Le MOD "Qui était en ligne ?" n\'est pas à jour',
	'WWH_UPDATE_NEED'			=> 'Mettez à jour le MOD "Qui était en ligne?". Pour celà lancer l\' <a style="font-weight: bold;" href="' . $phpbb_root_path . 'install_wwh/install.php">install.php</a>.<br />Si vous l\'avez fait, vous devez effacer le répertoire install_wwh/ .',
	'WWH_UPDATE_NEW_VERSION'	=> 'Nouvelle version du MOD',
	'WWH_UPDATE_OLD_VERSION'	=> 'Ancienne version du MOD',

	'WWH_VERSION'				=> 'Version du MOD',
	'WWH_VERSION_EXP'			=> 'Affichez les utilisateurs d\'aujourd\'hui, ou ceux configurés dans le champ suivant',
	'WWH_VERSION1'				=> 'Aujourd\'hui',
	'WWH_VERSION2'				=> 'Période de temps',
	'WWH_VERSION2_EXP'			=> 'Mettre 0, si vous voulez afficher les utilisateurs des dernières 24h',
	'WWH_VERSION2_EXP2'			=> 'Désactivé , si vous avez choisi "aujourd\'hui"',
	'WWH_VERSION2_EXP3'			=> 'Secondes',
	
	'CREATE_INDEX'						=> 'Créer un Index',
	'CREATE_INDEX_EXP'					=> 'La création d\'un index améliore la rapidité de ce MOD. Certains uttilisateurs n\'ont pas les droits de créer des index et peuvent recevoir une erreur lors de l\'installation. Désactivez le ici.',	

	'INSTALLER_DELETE'					=> 'Désinstaller',
	'INSTALLER_DELETE_MENU'				=> 'Désinstaller',
	'INSTALLER_DELETE_NOTE'				=> 'Désinstaller',
	'INSTALLER_DELETE_SUCCESSFUL'		=> 'Le MOD a été désinstallé avec succès.<br />Maintenant supprimez tous les fichiers.',
	'INSTALLER_DELETE_UNSUCCESSFUL'		=> 'Vous <strong>ne</strong> pouvez <strong>pas</strong> supprimer le MOD.',
	'INSTALLER_DELETE_WELCOME'			=> 'Bienvenue dans le Menu de Désinstallation',
	'INSTALLER_DELETE_WELCOME_NOTE'		=> 'Quand vous choisissez de désinstaller le MOD, nous supprimons toutes les requêtes sql insérées par l\'installation.',
	
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
	
	'MISSING_PARENT_MODULE'				=> 'Le Module #%s est manquant en tant que module-parent pour "%s".',

	'WARNING'							=> 'Attention',
));

?>