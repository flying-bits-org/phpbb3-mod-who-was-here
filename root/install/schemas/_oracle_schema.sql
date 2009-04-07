/*

 $Id$

*/

/*
  This first section is optional, however its probably the best method
  of running phpBB on Oracle. If you already have a tablespace and user created
  for phpBB you can leave this section commented out!

  The first set of statements create a phpBB tablespace and a phpBB user,
  make sure you change the password of the phpBB user before you run this script!!
*/

/*
CREATE TABLESPACE "PHPBB"
	LOGGING 
	DATAFILE 'E:\ORACLE\ORADATA\LOCAL\PHPBB.ora' 
	SIZE 10M
	AUTOEXTEND ON NEXT 10M
	MAXSIZE 100M;

CREATE USER "PHPBB" 
	PROFILE "DEFAULT" 
	IDENTIFIED BY "phpbb_password" 
	DEFAULT TABLESPACE "PHPBB" 
	QUOTA UNLIMITED ON "PHPBB" 
	ACCOUNT UNLOCK;

GRANT ANALYZE ANY TO "PHPBB";
GRANT CREATE SEQUENCE TO "PHPBB";
GRANT CREATE SESSION TO "PHPBB";
GRANT CREATE TABLE TO "PHPBB";
GRANT CREATE TRIGGER TO "PHPBB";
GRANT CREATE VIEW TO "PHPBB";
GRANT "CONNECT" TO "PHPBB";

COMMIT;
DISCONNECT;

CONNECT phpbb/phpbb_password;
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
	user_ip varchar2(15) DEFAULT '127.0.0.1' NOT NULL,
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


