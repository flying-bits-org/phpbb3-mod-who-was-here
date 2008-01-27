#
# $Id: $
#


# Table: 'phpbb_wwh'
CREATE TABLE phpbb_wwh (
	rolling INTEGER NOT NULL,
	ip VARCHAR(15) CHARACTER SET NONE DEFAULT '127.0.0.1' NOT NULL,
	id INTEGER DEFAULT 1 NOT NULL,
	viewonline INTEGER DEFAULT 1 NOT NULL,
	last_page INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_wwh ADD PRIMARY KEY (rolling);;


CREATE GENERATOR phpbb_wwh_gen;;
SET GENERATOR phpbb_wwh_gen TO 0;;

CREATE TRIGGER t_phpbb_wwh FOR phpbb_wwh
BEFORE INSERT
AS
BEGIN
	NEW.rolling = GEN_ID(phpbb_wwh_gen, 1);
END;;


