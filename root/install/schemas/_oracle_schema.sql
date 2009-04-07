/*

 $Id$

*/


/*
	Table: 'phpbb_wwh'
*/
CREATE TABLE phpbb_wwh (
	wwh_id number(8) NOT NULL,
	user_id number(8) DEFAULT '0' NOT NULL,
	username varchar2(255) DEFAULT '' ,
	username_clean varchar2(255) DEFAULT '' ,
	user_colour varchar2(6) DEFAULT '' ,
	user_ip varchar2(40) DEFAULT '127.0.0.1' NOT NULL,
	user_type number(2) DEFAULT '1' NOT NULL,
	viewonline number(1) DEFAULT '1' NOT NULL,
	wwh_lastpage number(11) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_wwh PRIMARY KEY (wwh_id)
)
/


CREATE SEQUENCE phpbb_wwh_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_wwh
BEFORE INSERT ON phpbb_wwh
FOR EACH ROW WHEN (
	new.wwh_id IS NULL OR new.wwh_id = 0
)
BEGIN
	SELECT phpbb_wwh_seq.nextval
	INTO :new.wwh_id
	FROM dual;
END;
/


