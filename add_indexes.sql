-- Assumed table name: player_accounts
-- Assumed userId is already the Primary Key.
-- Assumed columns username, email, and pilotName exist.

-- Add UNIQUE index on username
ALTER TABLE player_accounts
ADD CONSTRAINT UQ_username UNIQUE (username);

-- Add UNIQUE index on email
ALTER TABLE player_accounts
ADD CONSTRAINT UQ_email UNIQUE (email);

-- Add UNIQUE index on pilotName
-- If pilotName can have duplicates, change UNIQUE to INDEX:
-- CREATE INDEX IX_pilotName ON player_accounts (pilotName);
ALTER TABLE player_accounts
ADD CONSTRAINT UQ_pilotName UNIQUE (pilotName);
