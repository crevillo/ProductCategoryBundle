DROP TABLE IF EXISTS 'ezproductcategory';
CREATE TABLE 'ezproductcategory' (
  'id' integer PRIMARY KEY AUTOINCREMENT,
  'name' text(255) NOT NULL DEFAULT ''
);