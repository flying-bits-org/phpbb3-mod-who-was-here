#
# $Id: $
#

BEGIN TRANSACTION;

# Table: 'phpbb_wwh'
CREATE TABLE phpbb_wwh (
	wwh_id INTEGER PRIMARY KEY NOT NULL ,
	user_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	username varchar(255) NOT NULL DEFAULT '',
	username_clean varchar(255) NOT NULL DEFAULT '',
	user_colour varchar(6) NOT NULL DEFAULT '',
	user_ip varchar(15) NOT NULL DEFAULT '127.0.0.1',
	user_type INTEGER UNSIGNED NOT NULL DEFAULT '1',
	viewonline INTEGER UNSIGNED NOT NULL DEFAULT '1',
	wwh_lastpage INTEGER UNSIGNED NOT NULL DEFAULT '0'
);



COMMIT;