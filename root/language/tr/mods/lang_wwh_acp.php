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
	'WWH_DISP_SET'				=> 'Görünüm ayarları',
	'WWH_DISP_BOTS'				=> 'Botları göster',
	'WWH_DISP_BOTS_EXP'			=> 'Bazi kullanıcılar bot nedir diye sorabilir.',
	'WWH_DISP_GUESTS'			=> 'Misafirleri göster',
	'WWH_DISP_GUESTS_EXP'		=> 'Misafirleri kimler çevrimiçi olmuş bölümünde göster',
	'WWH_DISP_HIDDEN'			=> 'Gizli kullanıcıları göster',
	'WWH_DISP_HIDDEN_EXP'		=> 'Gizli kullanıcıların çevrimiçi statüleri gösterilsinmi? (Sadece gizli kullanıcıları görmeye hakki olan gruplar görebilir)',
	'WWH_DISP_TIME'				=> 'Zamanı göster',
	'WWH_DISP_HOVER'			=> 'Fare ile kullanıcı üzerine gelince göster',
	'WWH_DISP_TIME_EXP'			=> '<b>Evet</b> seçeneğiyle herkes zamanı görebilir , <b>Hayır</b> seçeneği ile hiçkimse göremez.',

	'WWH_INSTALL'				=> 'Kurulum',
	'WWH_INSTALLED'				=> '"Kimler çevrimiçi olmuş?" eklentisinin v%s versiyonu kuruldu.',
	'WWH_INSTALL_FALSE'			=> '"Kimler çevrimiçi olmuş?" eklentisin kurulamıyor.',
	'WWH_INSTALL_NEED'			=> '"Kimler çevrimiçi olmuş?" eklentisi kurulsunmu',
	'WWH_INSTALL_NEW_VERSION'	=> 'Yeni eklenti versiyonu',

	'WWH_RECORD'				=> 'Çevrimiçi kullanıcı rekoru',
	'WWH_RECORD_EXP'			=> 'Çevrimiçi kullanıcı rekorunu göster ve kaydet.',
	'WWH_RECORD_TIMESTAMP'		=> 'Kullanıcı rekoru için tarih biçimi',
	'WWH_RESET'					=> 'Çevrimiçi kullanıcı rekorunu sıfırla',
	'WWH_RESET_1'				=> 'Çevrimiçi kullanıcı rekorunu sıfırla',
	'WWH_RESET_EXP'				=> 'Çevrimiçi kullanıcı rekorunu ve bu rekora ait tarihi sıfırlar.',
	'WWH_RESET_TRUE'			=> 'Eğer Gönder butonuna tiklarsanız,\nçevrimiçi kullanıcı rekoru sıfırlanır...',// \n is the beginning of a new line
									//no space after it

	'WWH_SAVED_SETTINGS'		=> 'Ayarlar kaydedildi.',
	'WWH_SORT_BY'				=> 'kullanıcıları suna göre sırala',
	'WWH_SORT_BY_EXP'			=> 'kullanıcıların hangi kriterlere göre sıralanacağının ayarını buradan yapabilirsiniz.',
	'WWH_SORT_BY_0'				=> 'kullanıcı adı A -> Z',
	'WWH_SORT_BY_1'				=> 'kullanıcı adı Z -> A',
	'WWH_SORT_BY_2'				=> 'Son girdiği zaman (azalan)',
	'WWH_SORT_BY_3'				=> 'Son girdiği zaman (artan)',
	'WWH_SORT_BY_4'				=> 'Ziyaret id\'sine göre (azalan)',
	'WWH_SORT_BY_5'				=> 'Ziyaret id\'sine göre (artan)',

	'WWH_UPDATE'				=> 'Güncelle',
	'WWH_UPDATED'				=> '"Kimler çevrimiçi olmuş?" eklentisi v%s versiyonundan v%s versiyonuna güncelle',
	'WWH_UPDATE_FALSE'			=> '"Kimler çevrimiçi olmuş?" eklentisi güncellenemedi.',
	'WWH_UPDATE_NEED'			=> '"Kimler çevrimiçi olmuş?" eklentisini güncelle. Bunun için <a style="font-weight: bold;" href="' . $phpbb_root_path . 'install_wwh/install.php">install.php</a> dosyasını calıştırın.<br />Eğer zaten güncelleme yapmışsanız install_wwh/ klasörünü ftp\'nizden silin.',
	'WWH_UPDATE_NEW_VERSION'	=> 'Yeni eklenti versiyonu',
	'WWH_UPDATE_OLD_VERSION'	=> 'Eski eklenti versiyonu',

	'WWH_VERSION'				=> 'Eklenti versiyonu',
	'WWH_VERSION_EXP'			=> 'Bugün çevrimiçi olan kullanıcıları gösterir , özel zaman dilimi için <b>"Zaman dilimi</b> fonksiyonunu seçin.',
	'WWH_VERSION1'				=> 'Bugün',
	'WWH_VERSION2'				=> 'Zaman dilimi',
	'WWH_VERSION2_EXP'			=> 'Tüm ziyaretçilerin son 24 saat içinde girenleri görmesini istiyorsaniz buranın değerini "0" verin',
	'WWH_VERSION2_EXP2'			=> 'Eğer "Bugün" olarak seçerseniz deaktif olur',
	'WWH_VERSION2_EXP3'			=> 'Saniye',

	'CREATE_INDEX'						=> 'Index oluştur',
	'CREATE_INDEX_EXP'					=> 'Index oluşturulumu eklentinin hızını arttırır. Bazı kullanıcıların index oluşturmak için yeterli yetkisi olmayabilir. Bu durumda eklenti kurulumunda hata mesajı alırsınız. Hata durumunda buradan "Hayır" seçeneğini işaretleyin.',

	'INSTALLER_DELETE'					=> 'Sil',
	'INSTALLER_DELETE_MENU'				=> 'Sil',
	'INSTALLER_DELETE_NOTE'				=> 'Sil',
	'INSTALLER_DELETE_SUCCESSFUL'		=> 'Eklenti başarıyla kaldırıldı.<br />Ftp\'deki dosyalarıda silin.',
	'INSTALLER_DELETE_UNSUCCESSFUL'		=> 'Eklenti <strong>maalesef</strong> silinemiyor.',
	'INSTALLER_DELETE_WELCOME'			=> 'Silme paneline hoşgeldiniz.',
	'INSTALLER_DELETE_WELCOME_NOTE'		=> 'Eğer eklentiyi silerseniz , veritabanında bu eklentinin oluşturduğu tüm tablo ve bilgilerde beraber silinir..',

	'INSTALLER_INTRO'					=> 'Tanıtım (Intro)',
	'INSTALLER_INTRO_WELCOME'			=> 'Eklenti kurulumuna hoşgeldiniz',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Lütfen dilediğiniz fonksiyonu seçin.',

	'INSTALLER_INSTALL'					=> 'Kur',
	'INSTALLER_INSTALL_MENU'			=> 'Kurulum',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Eklentinin v%s versiyonu başarıyla kuruldu.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Eklentinin v%s versiyonu <strong>maalesef</strong> kurulamadi.',
	'INSTALLER_INSTALL_VERSION'			=> 'Eklentinin v%s versiyonunu kur',
	'INSTALLER_INSTALL_WELCOME'			=> 'Kurulum paneline hoşgeldiniz',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Eğer bu modu kurarsanız, veritabanında eklenti ile aynı isimde olan tablolar silinir.',

	'INSTALLER_NEEDS_FOUNDER'			=> 'Yönetici olarak giriş yapmalısınız.',

	'INSTALLER_UPDATE'					=> 'Güncelle',
	'INSTALLER_UPDATE_MENU'				=> 'Güncelleme menüsü',
	'INSTALLER_UPDATE_NOTE'				=> 'Eklentiyi v%s versiyonundan v%s versiyonuna güncelle',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Eklentinin v%s versiyonundan v%s versiyonuna güncelleme islemi başarıyla tamamlandi.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'Eklentinin v%s versiyonundan v%s versiyonuna güncelle isleme <strong>başarısız</strong> oldu.',
	'INSTALLER_UPDATE_VERSION'			=> 'Bu versiyondan güncelle v',
	'INSTALLER_UPDATE_WELCOME'			=> 'Güncelleme paneline hoşgeldiniz',

	'MISSING_PARENT_MODULE'				=> 'Eksik #%s modül "%s".',

	'WARNING'							=> 'Dikkat',
));

?>