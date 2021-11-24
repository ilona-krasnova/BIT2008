INSERT INTO `BC_User`(
    `Username`, 
    `Email`, 
    `PasswordHash`
) 
VALUES (
    'Gardengal95',
    'gardengal95@hotmail.com' ,
    'ilovegardening95'
) ,
(
    'EverGreen34' ,
    'evergreen34@gmail.com'	, 
    'daisy12!'
) ,
(
    'GreenThumb1' ,
    'greenthumb1@gmail.com'	, 
    'begonia34'
) ,
(
    'Blossom12' ,
    'blossomgirl12@hotmail.com'	, 
    'blooms1234'
) ;

INSERT INTO `BC_LifeCycle`( 
    `LifeCycle`, 
    `Description`
)
VALUES (
    'Annual' ,
    'Plants that perform their entire life cycle from seed to flower'
),
(
    'Perennial'	, 
    'Plants that persist for many growing seasons'
) ,
(
    'Biennial'	, 
    'Plants which require two years to complete their life cycle'
) ;

INSERT INTO `BC_Maintenance`(
    `Maintenance`
) 
VALUES (
    'Low'
) , 
(
    'Medium'
) , 
(
    'High'
);

INSERT INTO `BC_PlantType`(
    `PlantType`
) 
VALUES (
   'Herbs' 
) , 
(
   'Vegetables' 
) , 
(
   'Flowers' 
) , 
(
   'Cannabis' 
);

INSERT INTO `BC_Sun`(
    `Sun` , 
    `Description`
)
VALUES (
    'Full sun' , 
    'Plant needs atleast 6 hours of direct sun daily'
) , 
(
    'Part sun' , 
    'Plant needs atleast 3 to 6 hours of direct sun per day'
) , 
(
    'Part shade' ,
    'Plants require between 3 and 6 hours of sun per day, but need protection from intense mid-day sun'
) , 
(
    'Full Shade' , 
    'Plants require less than 3 hours of direct sun per day'
);

INSERT INTO `BC_Zone`(
    `Description`
)
VALUES 
(
    '1: -51.1 - -45.6'
), 
(
    '2: -45.6 - -40'
),
(
    '3: -40 - -34.4'
),
(
    '4: -34.4 - -28.9'
),
(
    '5: -28.9 - -23.3'
),
(
    '6: -23.3 - -17.8'
),
(
    '7: -17.8 - -12.2'
),
(
    '8: -12.2 - -6.7'
),
(
    '9: -6.7 - -1.1'
);

INSERT INTO `BC_Seed`( 
    `UserID`, 
    `SeedName`, 
    `Description`, 
    `Quantity`, 
    `PlantTypeID`, 
    `LifeCycleID`, 
    `SunID`, 
    `MaintenanceID`
)
VALUES (
    1 ,
    'Rainbow blend carrots' , 
    'Rainbow blend includes atomic red, bambino, cosmic purple, lunar white, and solar yellow.',
    10,
    2,
    3,
    1,
    1
) ,
(
    2 ,
    'Zucchini squash' , 
    'Sow zucchini seeds 3 to 4 inches apart, then thin them as they grow',
    2,
    2,
    1,
    1,
    1
);

INSERT INTO `BC_SeedZone`(
    `SeedID`, 
    `ZoneID`
)
VALUES 
(1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9),
(2, 3), (2, 4), (2, 5), (2, 6), (2, 7), (2, 8), (2, 9);

INSERT INTO `BC_SeedComment`(
    `SeedID`, 
    `UserID`, 
    `Comment`
) 
VALUES (
    1,
    3,
    'Beautiful colours!'
);

INSERT INTO `BC_Listing`(
    `SeedID`
)
VALUES 
    (1), (2);

INSERT INTO `BC_Request`(
    `ListingID`, 
    `UserID`
)
VALUES (1, 2);

INSERT INTO `BC_Exchange`(
    `RequestID`, 
    `ListingIDtoBarter`
)
VALUES (1, 2);

INSERT INTO `BC_ExchangeRating`(
    `ExchangeID`, 
    `UserID`, 
    `Rating`
) 
VALUES (1, 2, 5);

INSERT INTO `BC_ExchangeChat`(
    `ExchangeID`, 
    `UserID`, 
    `Message`
) 
VALUES ( 
    1, 1, 'Hey, I shipped out your seeds!'
);