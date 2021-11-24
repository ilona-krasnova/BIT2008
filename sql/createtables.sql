CREATE TABLE `BC_User` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `Username` VARCHAR(64) NOT NULL , 
    `Email` VARCHAR(128) NOT NULL , 
    `PasswordHash` VARCHAR(64) NOT NULL , 
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

-- Seed Lookups

CREATE TABLE `BC_LifeCycle` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `LifeCycle` VARCHAR(16) NOT NULL ,
    `Description` VARCHAR(128) NOT NULL ,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

CREATE TABLE `BC_Maintenance` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `Maintenance` VARCHAR(16) NOT NULL ,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

CREATE TABLE `BC_PlantType` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `PlantType` VARCHAR(16) NOT NULL ,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

CREATE TABLE `BC_Sun` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `Sun` VARCHAR(16) NOT NULL ,
    `Description` VARCHAR(128) NOT NULL ,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

CREATE TABLE `BC_Zone` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `Description` VARCHAR(32) NOT NULL ,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

-- Seed

CREATE TABLE `BC_Seed` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `UserID` BIGINT NOT NULL , 
    `SeedName` VARCHAR(64) NOT NULL ,
    `Description` VARCHAR(1024) NOT NULL ,
    `Quantity` SMALLINT NOT NULL ,
    `PlantTypeID` BIGINT NOT NULL ,
    `LifeCycleID` BIGINT NOT NULL ,
    `SunID` BIGINT NOT NULL ,
    `MaintenanceID` BIGINT NOT NULL ,
    PRIMARY KEY (`ID`) , 
    FOREIGN KEY (`UserID`) REFERENCES BC_User(ID) ,
    FOREIGN KEY (`PlantTypeID`) REFERENCES BC_PlantType(ID) ,
    FOREIGN KEY (`LifeCycleID`) REFERENCES BC_LifeCycle(ID) ,
    FOREIGN KEY (`SunID`) REFERENCES BC_Sun(ID) ,
    FOREIGN KEY (`MaintenanceID`) REFERENCES BC_Maintenance(ID)
) ENGINE = InnoDB;

CREATE TABLE `BC_SeedZone` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `SeedID` BIGINT NOT NULL ,
    `ZoneID` BIGINT NOT NULL ,
    PRIMARY KEY (`ID`) ,
    FOREIGN KEY (`SeedID`) REFERENCES BC_Seed(ID) ,
    FOREIGN KEY (`ZoneID`) REFERENCES BC_Zone(ID)
) ENGINE = InnoDB;

CREATE TABLE `BC_SeedComment` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `SeedID` BIGINT NOT NULL ,
    `UserID` BIGINT NOT NULL ,
    `Comment` VARCHAR(1024) NOT NULL ,
    `Timestamp` TIMESTAMP NOT NULL ,
    PRIMARY KEY (`ID`) ,
    FOREIGN KEY (`SeedID`) REFERENCES BC_Seed(ID) ,
    FOREIGN KEY (`UserID`) REFERENCES BC_User(ID)
) ENGINE = InnoDB;

-- Listing

CREATE TABLE `BC_Listing` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `SeedID` BIGINT NOT NULL ,
    `Active` BOOLEAN NOT NULL DEFAULT 1,
    `Posted` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`ID`) ,
    FOREIGN KEY (`SeedID`) REFERENCES BC_Seed(ID)
) ENGINE = InnoDB;

-- Request

CREATE TABLE `BC_Request` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `ListingID` BIGINT NOT NULL ,
    `UserID` BIGINT NOT NULL ,
    `Requested` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`ID`) ,
    FOREIGN KEY (`ListingID`) REFERENCES BC_Listing(ID) ,
    FOREIGN KEY (`UserID`) REFERENCES BC_User(ID)
) ENGINE = InnoDB;

-- Exchange

CREATE TABLE `BC_Exchange` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `RequestID` BIGINT NOT NULL ,
    `ListingIDtoBarter` BIGINT NOT NULL ,
    `Accepted` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `Complete` BOOLEAN NOT NULL DEFAULT 0 ,
    PRIMARY KEY (`ID`) ,
    FOREIGN KEY (`RequestID`) REFERENCES BC_Request(ID) ,
    FOREIGN KEY (`ListingIDtoBarter`) REFERENCES BC_Listing(ID)
) ENGINE = InnoDB;

CREATE TABLE `BC_ExchangeRating` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `ExchangeID` BIGINT NOT NULL ,
    `UserID` BIGINT NOT NULL ,
    `Rating` TINYINT NOT NULL,
    PRIMARY KEY (`ID`) ,
    FOREIGN KEY (`ExchangeID`) REFERENCES BC_Exchange(ID) ,
    FOREIGN KEY (`UserID`) REFERENCES BC_User(ID)
) ENGINE = InnoDB;

CREATE TABLE `BC_ExchangeChat` ( 
    `ID` BIGINT NOT NULL AUTO_INCREMENT , 
    `ExchangeID` BIGINT NOT NULL ,
    `UserID` BIGINT NOT NULL ,
    `Message` VARCHAR(1024) NOT NULL ,
    `Timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`ID`) ,
    FOREIGN KEY (`ExchangeID`) REFERENCES BC_Exchange(ID) ,
    FOREIGN KEY (`UserID`) REFERENCES BC_User(ID)
) ENGINE = InnoDB;