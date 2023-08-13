USE					Sportverbaende;
DROP TABLE			IF EXISTS
					Liga;
DROP TABLE			IF EXISTS
					Sportverband;

CREATE TABLE		IF NOT EXISTS
					Sportverband (
                    	ID					INT					NOT NULL	AUTO_INCREMENT
                        , ShortCut			VARCHAR (50)		NOT NULL
                        , Name				VARCHAR (255)		NOT NULL
                        , NumberOfMembers	INT					NULL
                    	, PRIMARY KEY		(ID)
                    );

DROP VIEW			IF EXISTS
					Sportverband_Presentation;
CREATE VIEW			Sportverband_Presentation									AS
SELECT				ID
					, CONCAT (ShortCut, ' - ', Name)							AS	DisplayName
					, ShortCut
					, Name
					, NumberOfMembers
FROM				Sportverband;

INSERT INTO			Sportverband (
						ShortCut
    					, Name
    					, NumberOfMembers
					)
SELECT				'DFB', 'Deutscher Fußball-Bund', 7171232 
UNION SELECT		'DTB', 'Deutscher Turner-Bund', 4581438 
UNION SELECT		'DTB', 'Deutscher Tennis-Bund', 1444711 
UNION SELECT		'DAV', 'Deutscher Alpenverein', 1357736 
UNION SELECT		'DSB', 'Deutscher Schützenbund', 1309009 
UNION SELECT		'DLV', 'Deutscher Leichtathlethik-Verband', 766424 
UNION SELECT		'DHB', 'Deutscher Handball-Bund', 719787 
UNION SELECT		'DGV', 'Deutscher Golf Verband', 673983 
UNION SELECT		'DRV', 'Deutsche Reiterliche Vereinigung', 664920 
UNION SELECT		'DLRG', 'Deutsche Lebens-Rettungs-Gesellschaft', 546188 
UNION SELECT		'DSV', 'Deutscher Schwimm-Verband', 534160 
UNION SELECT		'DSV', 'Deutscher Skiverband', 515642 
UNION SELECT		'DTTB', 'Deutscher Tischtennis-Bund', 506126 
UNION SELECT		'DBSV', 'Deutscher Behindertensportverband', 490891 
UNION SELECT		'DVV', 'Deutscher Volleyball-Verband', 392122 
UNION SELECT		'DBB', 'Deutscher Basketball-Bund', 215609 
UNION SELECT		'DSV', 'Deutscher Segler-Verband', 192743 
UNION SELECT		'DTSV', 'Deutscher Tanzsportverband', 177325 
UNION SELECT		'DBV', 'Deutscher Badminton-Verband', 166069 
UNION SELECT		'BDF', 'Bund Deutscher Radfahrer', 145994;