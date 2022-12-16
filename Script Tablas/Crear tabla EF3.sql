USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[Dim_EF3]    Script Date: 16/12/2022 01:22:36 p. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Dim_EF3](
	[id_ef3] [bigint] IDENTITY(1,1) NOT NULL,
	[EF3] [int] NOT NULL,
	[EF3_Desc] [varchar](200) NOT NULL
) ON [PRIMARY]
GO

