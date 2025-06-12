-- SQL ALTER TABLE statements for adding indexes to the player_accounts table.

-- Assumptions:
-- 1. The table is named `player_accounts`.
-- 2. `userId` is already the Primary Key.
-- 3. Columns `username`, `email`, and `pilotName` exist in the `player_accounts` table.
-- 4. `pilotName` is not necessarily unique across all accounts, so a non-unique INDEX is created.
--    If `pilotName` should be unique, change `INDEX` to `UNIQUE INDEX` for `idx_pilotName`.

-- Add UNIQUE index on username
ALTER TABLE `player_accounts`
ADD CONSTRAINT `uq_username` UNIQUE (`username`);

-- Add UNIQUE index on email
ALTER TABLE `player_accounts`
ADD CONSTRAINT `uq_email` UNIQUE (`email`);

-- Add INDEX on pilotName
ALTER TABLE `player_accounts`
ADD INDEX `idx_pilotName` (`pilotName`);
