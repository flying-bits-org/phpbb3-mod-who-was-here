#
# $Id: $
#

# Table: 'phpbb_wwh'
CREATE TABLE phpbb_wwh (
	rolling mediumint(8) UNSIGNED NOT NULL auto_increment,
	ip varbinary(15) DEFAULT '127.0.0.1' NOT NULL,
	id int(8) UNSIGNED DEFAULT '1' NOT NULL,
	viewonline int(1) UNSIGNED DEFAULT '1' NOT NULL,
	last_page int(11) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (rolling)
);


