USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[Dim_EF2]    Script Date: 16/12/2022 01:22:14 p. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Dim_EF2](
	[id_ef2] [bigint] IDENTITY(1,1) NOT NULL,
	[EF2] [int] NOT NULL,
	[EF2_Desc] [varchar](200) NOT NULL
) ON [PRIMARY]
GO

