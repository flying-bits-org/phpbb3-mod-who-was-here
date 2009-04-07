/*

 $Id$

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_wwh'
*/
CREATE TABLE [phpbb_wwh] (
	[wwh_id] [int] IDENTITY (1, 1) NOT NULL ,
	[user_id] [int] DEFAULT (0) NOT NULL ,
	[username] [varchar] (255) DEFAULT ('') NOT NULL ,
	[username_clean] [varchar] (255) DEFAULT ('') NOT NULL ,
	[user_colour] [varchar] (6) DEFAULT ('') NOT NULL ,
	[user_ip] [varchar] (15) DEFAULT ('127.0.0.1') NOT NULL ,
	[user_type] [int] DEFAULT (1) NOT NULL ,
	[viewonline] [int] DEFAULT (1) NOT NULL ,
	[wwh_lastpage] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_wwh] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_wwh] PRIMARY KEY  CLUSTERED 
	(
		[wwh_id]
	)  ON [PRIMARY] 
GO



COMMIT
GO

