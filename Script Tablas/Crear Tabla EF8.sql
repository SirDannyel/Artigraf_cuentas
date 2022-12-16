USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[Dim_EF8]    Script Date: 16/12/2022 01:25:39 p. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Dim_EF8](
	[id_ef8] [bigint] IDENTITY(1,1) NOT NULL,
	[EF8] [int] NOT NULL,
	[EF8_Desc] [varchar](200) NOT NULL
) ON [PRIMARY]
GO

