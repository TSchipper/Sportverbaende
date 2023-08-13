USE					Sportverbaende;
DROP TABLE			IF EXISTS
					Liga;
CREATE TABLE		IF NOT EXISTS
					Liga (
                    	ID					INT					NOT NULL	AUTO_INCREMENT
						, SportverbandID	INT
                        , ShortCut			VARCHAR (50)		NOT NULL
                        , Name				VARCHAR (255)		NOT NULL
                		, PRIMARY KEY		(ID)
						, FOREIGN KEY		(SportverbandID)	REFERENCES	Sportverband (ID)
                    );

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

INSERT INTO			Liga (
						SportverbandID
						, ShortCut
    					, Name
					)
SELECT				SV.ID
					, '1. FBL'
					, 'Erste Fußball Bundesliga'
FROM				Sportverband												AS	SV
WHERE				Name				=		'Deutscher Fußball-Bund'
UNION SELECT		SV.ID
					, '2. FBL'
					, 'Zweite Fußball Bundesliga'
FROM				Sportverband												AS	SV
WHERE				Name				=		'Deutscher Fußball-Bund';