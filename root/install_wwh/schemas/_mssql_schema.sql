/*

 $Id: $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_wwh'
*/
CREATE TABLE [phpbb_wwh] (
	[rolling] [int] IDENTITY (1, 1) NOT NULL ,
	[ip] [varchar] (15) DEFAULT ('127.0.0.1') NOT NULL ,
	[id] [int] DEFAULT (1) NOT NULL ,
	[viewonline] [int] DEFAULT (1) NOT NULL ,
	[last_page] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_wwh] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_wwh] PRIMARY KEY  CLUSTERED 
	(
		[rolling]
	)  ON [PRIMARY] 
GO



COMMIT
GO

