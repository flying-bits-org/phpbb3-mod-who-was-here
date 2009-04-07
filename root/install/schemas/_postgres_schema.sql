/*

 $Id$

*/

BEGIN;


/*
	Table: 'phpbb_wwh'
*/
CREATE SEQUENCE phpbb_wwh_seq;

CREATE TABLE phpbb_wwh (
	wwh_id INT4 DEFAULT nextval('phpbb_wwh_seq'),
	user_id INT4 DEFAULT '0' NOT NULL CHECK (user_id >= 0),
	username varchar(255) DEFAULT '' NOT NULL,
	username_clean varchar(255) DEFAULT '' NOT NULL,
	user_colour varchar(6) DEFAULT '' NOT NULL,
	user_ip varchar(40) DEFAULT '127.0.0.1' NOT NULL,
	user_type INT4 DEFAULT '1' NOT NULL CHECK (user_type >= 0),
	viewonline INT4 DEFAULT '1' NOT NULL CHECK (viewonline >= 0),
	wwh_lastpage INT4 DEFAULT '0' NOT NULL CHECK (wwh_lastpage >= 0),
	PRIMARY KEY (wwh_id)
);



COMMIT;