USE					Sportverbaende;

DROP TABLE			IF EXISTS
					FieldSettings;
                    
CREATE TABLE		IF NOT EXISTS
					FieldSettings (
                    	ID					INT					NOT NULL	AUTO_INCREMENT
                        , UserLogin    		VARCHAR (255)		NULL
                        , ClassName 		VARCHAR (255)		NOT NULL
                        , ColumnName		VARCHAR (255)		NOT NULL
                        , ColumnRank        INT                 NOT NULL
                        , DisplayName		VARCHAR (255)		NOT NULL
                        , SelectClass       VARCHAR (255)		NULL
                        , ShowInOverview    BIT                 NOT NULL
                        , ShowInForm	    BIT           		NOT NULL
                        , SortOrder     	VARCHAR (5)			NULL
                        , SortRank     	    INT			        NULL
                    	, PRIMARY KEY		(ID)
                    );

INSERT INTO         FieldSettings (
                        ClassName
                        , ColumnName
                        , ColumnRank
                        , DisplayName
                        , SelectClass
                        , ShowInOverview
                        , ShowInForm
                        , SortOrder
                        , SortRank
                    )
SELECT              'Sportverband'   								AS	ClassName
					, 'ID'											AS	ColumnName
                    , 10                                            AS  ColumnRank
                    , 'Aktion'										AS	DisplayName
                    , null											AS	SelectClass
                    , 0												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'DisplayName'									AS	ColumnName
                    , 20                                            AS  ColumnRank
                    , 'Sportverband'								AS	DisplayName
                    , null											AS	SelectClass
                    , 0												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'ShortCut'									AS	ColumnName
                    , 30                                            AS  ColumnRank
                    , 'Kürzel'										AS	DisplayName
                    , null											AS	SelectClass
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'Name'										AS	ColumnName
                    , 40                                            AS  ColumnRank
                    , 'Name'										AS	DisplayName
                    , null											AS	SelectClass
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		'Sportverband'   								AS	ClassName
					, 'NumberOfMembers'								AS	ColumnName
                    , 50                                            AS  ColumnRank
                    , 'Anzahl Mitglieder'							AS	DisplayName
                    , null											AS	SelectClass
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank

UNION SELECT  		 'Liga'           								AS	ClassName
					, 'ID'											AS	ColumnName
                    , 10                                            AS  ColumnRank
                    , 'Aktion'										AS	DisplayName
                    , null											AS	SelectClass
                    , 0												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		 'Liga'           								AS	ClassName
					, 'SportverbandID'								AS	ColumnName
                    , 20                                            AS  ColumnRank
                    , 'SportverbandID'								AS	DisplayName
                    , 'Sportverband'								AS	SelectClass
                    , 0												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		 'Liga'           								AS	ClassName
					, 'Sportverband'								AS	ColumnName
                    , 30                                            AS  ColumnRank
                    , 'Sportverband'		    					AS	DisplayName
                    , null											AS	SelectClass
                    , 1												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		 'Liga'           								AS	ClassName
					, 'DisplayName'									AS	ColumnName
                    , 40                                            AS  ColumnRank
                    , 'Sportverband'								AS	DisplayName
                    , null											AS	SelectClass
                    , 0												AS	ShowInOverview
                    , 0												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		 'Liga'           								AS	ClassName
					, 'ShortCut'									AS	ColumnName
                    , 50                                            AS  ColumnRank
                    , 'Kürzel'										AS	DisplayName
                    , null											AS	SelectClass
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank
UNION SELECT  		 'Liga'           								AS	ClassName
					, 'Name'										AS	ColumnName
                    , 50                                            AS  ColumnRank
                    , 'Name'										AS	DisplayName
                    , null											AS	SelectClass
                    , 1												AS	ShowInOverview
                    , 1												AS	ShowInForm
                    , null											AS	SortOrder
                    , null											AS	SortRank