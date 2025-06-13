-- Assumed existing schema:
-- CREATE TABLE player_accounts (
--     userId INT PRIMARY KEY AUTO_INCREMENT,
--     username VARCHAR(255) NOT NULL,
--     email VARCHAR(255) NOT NULL,
--     pilotName VARCHAR(255) NOT NULL,
--     -- ... other columns
-- );

-- Add UNIQUE index on username
ALTER TABLE `player_accounts`
ADD CONSTRAINT `UQ_username` UNIQUE (`username`);

-- Add UNIQUE index on email
ALTER TABLE `player_accounts`
ADD CONSTRAINT `UQ_email` UNIQUE (`email`);

-- Add UNIQUE index on pilotName
-- If pilotName is not guaranteed to be unique across all records,
-- a non-unique index might be more appropriate:
-- ALTER TABLE `player_accounts` ADD INDEX `IDX_pilotName` (`pilotName`);
-- However, based on common game design, pilot names are often unique.
ALTER TABLE `player_accounts`
ADD CONSTRAINT `UQ_pilotName` UNIQUE (`pilotName`);
