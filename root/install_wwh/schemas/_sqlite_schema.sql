#
# $Id: $
#

BEGIN TRANSACTION;

# Table: 'phpbb_wwh'
CREATE TABLE phpbb_wwh (
	rolling INTEGER PRIMARY KEY NOT NULL ,
	ip varchar(15) NOT NULL DEFAULT '127.0.0.1',
	id INTEGER UNSIGNED NOT NULL DEFAULT '1',
	viewonline INTEGER UNSIGNED NOT NULL DEFAULT '1',
	last_page INTEGER UNSIGNED NOT NULL DEFAULT '0'
);



COMMIT;