USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[EF1_Select]    Script Date: 13/12/2022 11:43:24 a. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[EF1_Select](
	[id_ef1] [bigint] IDENTITY(1,1) NOT NULL,
	[EF1] [int] NOT NULL,
	[EF1_Desc] [varchar](200) NOT NULL
) ON [PRIMARY]
GO

