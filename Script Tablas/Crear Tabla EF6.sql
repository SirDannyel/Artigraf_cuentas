USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[Dim_EF6]    Script Date: 16/12/2022 01:24:26 p. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Dim_EF6](
	[id_ef6] [bigint] IDENTITY(1,1) NOT NULL,
	[EF6] [int] NULL,
	[EF6_Desc] [varchar](200) NULL
) ON [PRIMARY]
GO

