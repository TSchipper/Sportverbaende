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