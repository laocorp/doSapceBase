-- Assumptions:
-- 1. All mentioned tables and columns exist as described.
-- 2. For columns specified as "PK/UNIQUE on id", 'id' is intended to be the Primary Key.
--    If a Primary Key already exists on a table, these statements might need adjustment
--    (e.g., using ADD CONSTRAINT UQ_id UNIQUE (id) instead of PRIMARY KEY).
-- 3. Standard SQL syntax is used.

-- Table: shop_category
-- INDEX on active
CREATE INDEX IX_shop_category_active ON shop_category (active);

-- Table: shop_items
-- PK on id
ALTER TABLE shop_items
ADD CONSTRAINT PK_shop_items PRIMARY KEY (id);

-- COMPOUND INDEX on (category, active)
CREATE INDEX IX_shop_items_category_active ON shop_items (category, active);

-- Table: itemsUpgradeSystem
-- PK on id
ALTER TABLE itemsUpgradeSystem
ADD CONSTRAINT PK_itemsUpgradeSystem PRIMARY KEY (id);

-- Table: upgradesSystem
-- PK on id
ALTER TABLE upgradesSystem
ADD CONSTRAINT PK_upgradesSystem PRIMARY KEY (id);

-- COMPOUND INDEX on (idUser, itemId)
CREATE INDEX IX_upgradesSystem_idUser_itemId ON upgradesSystem (idUser, itemId);

-- INDEX on idUser
CREATE INDEX IX_upgradesSystem_idUser ON upgradesSystem (idUser);

-- Table: categoryupgradesystem
-- PK on id
ALTER TABLE categoryupgradesystem
ADD CONSTRAINT PK_categoryupgradesystem PRIMARY KEY (id);
