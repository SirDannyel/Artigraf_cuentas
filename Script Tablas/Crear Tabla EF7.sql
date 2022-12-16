USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[Dim_EF7]    Script Date: 16/12/2022 01:25:00 p. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Dim_EF7](
	[id_ef7] [bigint] IDENTITY(1,1) NOT NULL,
	[EF7] [int] NOT NULL,
	[EF7_Desc] [varchar](200) NOT NULL
) ON [PRIMARY]
GO

