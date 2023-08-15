--------------------------------------------------------------------------------;
-- Feldeinstellungen pro Klasse ------------------------------------------------;
--------------------------------------------------------------------------------;
-- Tabelle;
CREATE TABLE		IF NOT EXISTS
					FieldSettings (
                    	ID					    INT					NOT NULL	AUTO_INCREMENT
                        , UserLogin    		    VARCHAR (255)		NULL
                        , ClassName 		    VARCHAR (255)		NOT NULL
                        , ColumnName		    VARCHAR (255)		NOT NULL
                        , ColumnRank            INT                 NOT NULL
                        , DisplayName		    VARCHAR (255)		NOT NULL
                        , SelectClass           VARCHAR (255)		NULL
                        , DataPresentation      VARCHAR (50)		NULL
                        , ShowInOverview        BIT                 NOT NULL
                        , ShowInForm	        BIT           		NOT NULL
                        , SortOrder     	    VARCHAR (5)			NULL
                        , SortRank     	        INT			        NULL
                    	, PRIMARY KEY		    (ID)
                    );

--	Standardfelder für Klasse Sportverband;
DROP VIEW			IF EXISTS
					FieldSettings_Sportverband;
CREATE VIEW	        FieldSettings_Sportverband				        AS
SELECT              'Sportverband'   								AS	ClassName
					, 'ID'											AS	ColumnName
                    , 10                                            AS  ColumnRank
                    , 'Aktion'										AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 0												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'DisplayName'									AS	ColumnName
                    , 20                                            AS  ColumnRank
                    , 'Sportverband'								AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 0												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'ShortCut'									AS	ColumnName
                    , 30                                            AS  ColumnRank
                    , 'Kürzel'										AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'Name'										AS	ColumnName
                    , 40                                            AS  ColumnRank
                    , 'Name'										AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'NumberOfMembers'								AS	ColumnName
                    , 50                                            AS  ColumnRank
                    , 'Anzahl Mitglieder'							AS	DisplayName
                    , null											AS	SelectClass
                    , 'Integer'                                     AS  DataPresentation
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank;

--	Standardfelder für Klasse Liga;
DROP VIEW			IF EXISTS
					FieldSettings_Liga;
CREATE VIEW	        FieldSettings_Liga						        AS
SELECT              'Liga'           								AS	ClassName
					, 'ID'											AS	ColumnName
                    , 10                                            AS  ColumnRank
                    , 'Aktion'										AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 0												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Liga'           								AS	ClassName
					, 'SportverbandID'								AS	ColumnName
                    , 20                                            AS  ColumnRank
                    , 'Sportverband'								AS	DisplayName
                    , 'Sportverband'								AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 0												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Liga'           								AS	ClassName
					, 'Sportverband'								AS	ColumnName
                    , 30                                            AS  ColumnRank
                    , 'Sportverband'		    					AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 1												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Liga'           								AS	ClassName
					, 'ShortCut'									AS	ColumnName
                    , 40                                            AS  ColumnRank
                    , 'Kürzel'										AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Liga'           								AS	ClassName
					, 'Name'										AS	ColumnName
                    , 50                                            AS  ColumnRank
                    , 'Name'										AS	DisplayName
                    , null											AS	SelectClass
                    , null                                          AS  DataPresentation
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank;

--	Übernahme der Standardfelder für die Klassen Sportverband und Liga;
INSERT INTO         FieldSettings (
                        ClassName
                        , ColumnName
                        , ColumnRank
                        , DisplayName
                        , SelectClass
                        , DataPresentation
                        , ShowInOverview
                        , ShowInForm
                        , SortOrder
                        , SortRank
                    )
SELECT				*
FROM				FieldSettings_Sportverband
WHERE NOT EXISTS	(SELECT * FROM FieldSettings WHERE ClassName = 'Sportverband')
UNION SELECT		*
FROM				FieldSettings_Liga
WHERE NOT EXISTS	(SELECT * FROM FieldSettings WHERE ClassName = 'Liga');

-- Logik zur Ermittlung des nächsten freien Sortierrangs;
DROP VIEW			IF EXISTS
					FieldSettings_NextSortRankPerClassName;
CREATE VIEW	        FieldSettings_NextSortRankPerClassName          AS
SELECT              ClassName
                    , MAX(SortRank) + 1                             AS  NextSortRank 
FROM                FieldSettings
GROUP BY            ClassName;
--------------------------------------------------------------------------------;

--------------------------------------------------------------------------------;
-- Klasse Sportverband ---------------------------------------------------------;
--------------------------------------------------------------------------------;
-- Tabelle;
CREATE TABLE		IF NOT EXISTS
					Sportverband (
                    	ID					INT					NOT NULL	AUTO_INCREMENT
                        , ShortCut			VARCHAR (50)		NOT NULL
                        , Name				VARCHAR (255)		NOT NULL
                        , NumberOfMembers	INT					NULL
                    	, PRIMARY KEY		(ID)
                    );

-- Darstellung;
DROP VIEW			IF EXISTS
					Sportverband_Presentation;
CREATE VIEW			Sportverband_Presentation									AS
SELECT				ID
					, CONCAT (ShortCut, ' - ', Name)							AS	DisplayName
					, ShortCut
					, Name
					, NumberOfMembers
FROM				Sportverband;
--------------------------------------------------------------------------------;

--------------------------------------------------------------------------------;
-- Klasse Liga -----------------------------------------------------------------;
--------------------------------------------------------------------------------;
-- Tabelle;
CREATE TABLE		IF NOT EXISTS
					Liga (
                    	ID					INT					NOT NULL	AUTO_INCREMENT
						, SportverbandID	INT
                        , ShortCut			VARCHAR (50)		NOT NULL
                        , Name				VARCHAR (255)		NOT NULL
                		, PRIMARY KEY		(ID)
						, FOREIGN KEY		(SportverbandID)	REFERENCES	Sportverband (ID)
                    );

-- Darstellung;
DROP VIEW			IF EXISTS
					Liga_Presentation;
CREATE VIEW			Liga_Presentation											AS
SELECT				L.ID
					, CONCAT (L.ShortCut, ' - ', L.Name)						AS	DisplayName
					, L.SportverbandID
					, CONCAT (SV.ShortCut, ' - ', SV.Name)						AS	Sportverband
					, L.ShortCut
					, L.Name
FROM				Liga														AS	L
LEFT JOIN			Sportverband												AS	SV
ON					L.SportverbandID	=		SV.ID;
--------------------------------------------------------------------------------;