USE [DWH_Artigraf]
GO

/****** Object:  Table [dbo].[Dim_EF4]    Script Date: 16/12/2022 01:22:57 p. m. ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Dim_EF4](
	[id_ef4] [bigint] IDENTITY(1,1) NOT NULL,
	[EF4] [int] NOT NULL,
	[EF4_Desc] [varchar](200) NOT NULL
) ON [PRIMARY]
GO

