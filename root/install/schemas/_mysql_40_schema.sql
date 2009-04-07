#
# $Id$
#

# Table: 'phpbb_wwh'
CREATE TABLE phpbb_wwh (
	wwh_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	username varbinary(255) DEFAULT '' NOT NULL,
	username_clean varbinary(255) DEFAULT '' NOT NULL,
	user_colour varbinary(6) DEFAULT '' NOT NULL,
	user_ip varbinary(15) DEFAULT '127.0.0.1' NOT NULL,
	user_type int(2) UNSIGNED DEFAULT '1' NOT NULL,
	viewonline int(1) UNSIGNED DEFAULT '1' NOT NULL,
	wwh_lastpage int(11) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (wwh_id)
);


