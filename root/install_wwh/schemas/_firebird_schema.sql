#
# $Id: $
#


# Table: 'phpbb_wwh'
CREATE TABLE phpbb_wwh (
	wwh_id INTEGER NOT NULL,
	user_id INTEGER DEFAULT 0 NOT NULL,
	username VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	username_clean VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	user_colour VARCHAR(6) CHARACTER SET NONE DEFAULT '' NOT NULL,
	user_ip VARCHAR(15) CHARACTER SET NONE DEFAULT '127.0.0.1' NOT NULL,
	user_type INTEGER DEFAULT 1 NOT NULL,
	viewonline INTEGER DEFAULT 1 NOT NULL,
	wwh_lastpage INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_wwh ADD PRIMARY KEY (wwh_id);;


CREATE GENERATOR phpbb_wwh_gen;;
SET GENERATOR phpbb_wwh_gen TO 0;;

CREATE TRIGGER t_phpbb_wwh FOR phpbb_wwh
BEFORE INSERT
AS
BEGIN
	NEW.wwh_id = GEN_ID(phpbb_wwh_gen, 1);
END;;


