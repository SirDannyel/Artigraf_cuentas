USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[Dim_EF5]    Script Date: 16/12/2022 01:23:45 p. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Dim_EF5](
	[id_ef5] [bigint] IDENTITY(1,1) NOT NULL,
	[EF5] [int] NOT NULL,
	[EF5_Desc] [varchar](200) NOT NULL
) ON [PRIMARY]
GO

